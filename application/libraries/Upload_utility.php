<?php

class Upload_utility {

    public function __construct($config = array()) {
        $this->_ci = & get_instance();
        if ($config) {
            $this->_config = array_merge($this->_config, $config);
        }
    }

    private $_ci;
    private $_messages = array();

    private function _set_messages() {
        $extns = implode('/', $this->_config['allowed_types']);
        $this->_messages = array(
            'SELECT_FILE' => $this->_ci->lang->line('UPLOAD_UTIL_NO_FILE'),
            'INVALID_FILE_TYPE' => $this->_ci->lang->line('UPLOAD_UTIL_INV_FILE_TYPE'),
            'INVALID_UPLOAD_FILE_TYPE' => str_replace('[EXTN_PH]', $extns, $this->_ci->lang->line('UPLOAD_UTIL_INV_UP_FILE_TYPE')),
            'TEMP_TABLE_PREFIX' => $this->_ci->lang->line('UPLOAD_UTIL_TEMP_TBL_PREFIX'),
            'TEMP_TABLE_COL_NAME' => $this->_ci->lang->line('UPLOAD_UTIL_TEMP_COL_NAME'),
            'INVALID_FILE_HEADING' => $this->_ci->lang->line('UPLOAD_UTIL_INV_FILE_HEAD'),
            'INVALID_VALIDATION_RULE' => $this->_ci->lang->line('UPLOAD_UTIL_INV_VAL_RULE'),
            'VALIDATION_RULE_DB_ERR' => $this->_ci->lang->line('UPLOAD_UTIL_VAL_RULE_DB_ERR'),
            'FILE_READ_ERR' => $this->_ci->lang->line('UPLOAD_UTIL_FILE_READ_ERR'),
            'TEMP_TABLE_CREATE_ERR' => $this->_ci->lang->line('UPLOAD_UTIL_TEMP_TBL_CREATE_ERR'),
            'DATA_VALIDATION_PRC_ERR' => $this->_ci->lang->line('UPLOAD_UTIL_DATA_VAL_PROC_ERR'),
            'CTL_FILE_EXE_ERR' => $this->_ci->lang->line('UPLOAD_UTIL_CTL_EXE_ERR'),
            'CTL_FILE_CREATE_ERR' => $this->_ci->lang->line('UPLOAD_UTIL_CTL_CREATE_ERR'),
        );
        //to overwrite default messages
        if ($this->_config['utility_err_message'] != '' && is_array($this->_config['utility_err_message'])) {
            $this->_messages = array_merge($this->_messages, $this->_config['utility_err_message']);
        }
    }

    private $_config = array(
        /*         * ****MANDATORY OPTIONS******* */
        'upload_path' => './uploads', //upload path        
        'allowed_types' => array('xlsx', 'xls'), //allow file types        
        'file' => '', //should be $_FILES,
        'file_element' => 'file_upload',
        'temp_table_name' => '', //provide only the prefix part ex: TEMP_HRBP_EMP_<cuid part will append by script> ex: TEMP_HRBP_EMP_BDPN8315 
        'temp_table_heading' => '', //temporary table heading
        //uploaded file heading, if not provide then script will assign "temp_table_heading" value to this, but it is mandatory 
        //in case supporting multi language
        'uploaded_file_heading' => '',
        /*         * ****OPTIONAL OPTIONS******* */
        'uploaded_file_heading_comparison' => '', //uploaded file heading in lower case,if not provide the script will assing "uploaded_file_heading" value in lower case      
        'upload_config' => '', //codeigniter upload library config
        'extn' => '', //uploaded file extention
        'csv_file_path' => 'csv', //converted csv path
        'on_success_redirect' => '', //provide url to be redirect on success 
        'on_failure_redirect' => '', //provide url to be redirect on failure
        'uploaded_file_name' => '', //will be autoset by script
        'uploaded_file_details' => '', //will be autoset by script,contains uploaded file details by ci upload library        
        'csv_delimeter' => ';',
        'validation_rules' => '', //validation rules
        'validation_rules_error' => '', //Generates by script when validation rule is not correctly defined
        'utility_err_message' => '',//provide message if you want to overwrite default message in _message var
        'seek_line'=>0
    );

    /**
     * @param
     * @return
     * @desc assign/initialize all the required variables
     * @author HimansuS
     */
    private function _initialize() {

        if ($this->_config['file']) {
            if (!isset($this->_config['file_element']) || $this->_config['file_element'] == '') {
                $this->_config['file_element'] = key($this->_config['file']);
            }

            //set file extention
            if (isset($this->_config['file'][$this->_config['file_element']]['name'])) {
                $extn = explode('.', $this->_config['file'][$this->_config['file_element']]['name']);
                $this->_config['extn'] = end($extn);
                //set uploaded file name without extention
                $this->_config['uploaded_file_name'] = current($extn);
            }
        }
        //set on success redirect url
        if ($this->_config['on_success_redirect'] == '') {
            $this->_config['on_success_redirect'] = current_url();
        }

        //set on success redirect url
        if ($this->_config['on_failure_redirect'] == '') {
            $this->_config['on_failure_redirect'] = current_url();
        }

        //set upload config for ci upload library
        if ($this->_config['upload_config'] == '') {
            $this->_config['upload_config'] = array(
                'upload_path' => $this->_config['upload_path'],
                'allowed_types' => $this->_config['allowed_types']
            );
        } else {
            //if upload confi set then merge configs
            $this->_config['upload_config'] = array_merge(
                    array(
                'upload_path' => $this->_config['upload_path'],
                'allowed_types' => $this->_config['allowed_types']
                    ), $this->_config['upload_config']);
        }
        //create upload directory if not exists
        create_dir($this->_config['upload_path']);
        //create csv directory if not exists
        create_dir($this->_config['upload_path'] . '/' . $this->_config['csv_file_path']);

        //prepare temporary table ingredients
        if ($this->_config['uploaded_file_heading'] == '') {
            $this->_config['uploaded_file_heading'] = $this->_config['temp_table_heading'];
        }
        //prepare temp table comparison column array
        if ($this->_config['uploaded_file_heading_comparison'] == '') {
            $this->_config['uploaded_file_heading_comparison'] = array();
            foreach ($this->_config['uploaded_file_heading'] as $col_name) {
                $this->_config['uploaded_file_heading_comparison'][] = str_replace(' ', '_', strtolower(trim($col_name)));
            }
        }
        //set utility default errror messages
        $this->_set_messages();
    }

    /**
     * @param
     * @return Boolean TRUE/FALSE
     * @desc used to cross check mandatory fields
     * @author HimansuS
     */
    private function _validate_configs() {
        $flag = TRUE;

        if (!isset($this->_config['file']) || !is_array($this->_config['file'])) {
            $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_messages['SELECT_FILE']);
            $flag = FALSE;
        } else {
            if (!isset($this->_config['extn'])) {
                $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_messages['INVALID_FILE_TYPE']);
                $flag = FALSE;
            } else if ($this->_config['extn'] && !in_array($this->_config['extn'], $this->_config['allowed_types'])) {
                $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_messages['INVALID_UPLOAD_FILE_TYPE']);
                $flag = FALSE;
            } else if ($this->_config['temp_table_name'] == '') {
                $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_messages['TEMP_TABLE_PREFIX']);
                $flag = FALSE;
            } else if ($this->_config['temp_table_heading'] == '') {
                $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_messages['TEMP_TABLE_COL_NAME']);
                $flag = FALSE;
            }
        }
        return $flag;
    }

    /**
     * @param
     * @return
     * @desc used to create temporary table
     * @author
     */
    private function _create_temp_table($heading, $table) {
        $this->_ci->db->trans_begin();
        if ($this->_is_table_exist($table)) {
            //drop the table
            $drop_table = "DROP TABLE $table";
            $this->_ci->db->query($drop_table);
        }
        if ($this->_ci->db->dbdriver == 'mysqli') {
            $create_table = 'CREATE TABLE ' . $table . '(RECORD_NO INT UNSIGNED NOT NULL AUTO_INCREMENT';
            if ($heading && is_array($heading)) {
                foreach ($heading as $key => $head) {
                    $create_table .= ',' . $head . ' VARCHAR(4000)';
                }
            } else {
                $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_messages['INVALID_FILE_HEADING']);
            }
            $create_table .= ',PRIMARY KEY (RECORD_NO))';
            
        } else {
            //oracle
            //TEMP_ID VARCHAR2(10) NOT NULL CONSTRAINT PK_CATALOG_TEMP_" . $cuid . " PRIMARY KEY
            $create_table = 'CREATE TABLE ' . $table . '(RECORD_NO NUMBER AUTO_INCREMENT';
            if ($heading && is_array($heading)) {
                foreach ($heading as $key => $head) {
                    $create_table .= ',"' . $head . '" VARCHAR2(4000 BYTE)';
                }                
            } else {
                $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_messages['INVALID_FILE_HEADING']);
            }
            $create_table .= ')';
        }


        $this->_ci->db->query($create_table);
        if ($this->_ci->db->trans_status() === FALSE) {
            $this->_ci->db->trans_rollback();
            return FALSE;
        } else {
            $this->_ci->db->trans_commit();
            return TRUE;
        }
    }

    /**
     * @param
     * @return
     * @desc: check tabel exist or not 
     * @author HimansuS
     */
    private function _is_table_exist($table_name) {
        if ($this->_ci->db->dbdriver == 'mysqli') {
            $result = $this->_ci->db->list_tables();            
            foreach ($result as $row) {
                if (strtolower($row) == strtolower($table_name)) {
                    return TRUE;
                }
            }
            return FALSE;
        } else {
            $query = "SELECT COUNT(1) COUNTX  FROM USER_TAB_COLUMNS WHERE TABLE_NAME= '" . $table_name . "'";
            $result = $this->_ci->db->query($query)->row_array();
            if (isset($result['COUNTX']) && $result['COUNTX'] != 0) {
                return TRUE;
            }
            return FALSE;
        }
    }

    /**
     * @param
     * @return
     * @desc: get table columns list
     * @author HimansuS
     */
    private function _get_table_columns($table) {
        $field_details = $this->_ci->db->field_data($table);
        foreach ($field_details as $field) {
            $data[] = $field->name;
        }
        return $data;
    }

    /**
     * @param String $ctl_file_path ex:./uploads/ctls/
     * @param String $csv_full_file_path ex:c:\inetpub\wwwroot\uploads\csv
     * @param String $table Ex: TEMP_HRBP_TABLE_CUID
     * @param Array $table_columns array(column1,column2)
     * @param String $delimeter csv file delimeter
     * @return full ctl file path ex: ex:c:\inetpub\wwwroot\uploads\ctl\TEMP_TABLE_CUID.CTL
     * @desc used to crate .ctl file
     * @author HimansuS
     */
    private function _create_ctl_file($ctl_file_path, $csv_full_file_path, $table, $table_columns, $delimeter = '') {
        if (!$delimeter) {
            $delimeter = $this->_config['csv_delimeter'];
        }
        //prepare table coloumn string
        $heading_str = '';
        if (isset($table_columns) && is_array($table_columns)) {
            //prepare header string
            foreach ($table_columns as $head) {
                $heading_str.= "\n\t" . $head . ' CHAR(5000) "TRIM(:' . $head . ')",';
            }
            $heading_str = rtrim($heading_str, ",");

            $ctl_code = "LOAD DATA CHARACTERSET UTF8 INFILE '" . $csv_full_file_path . "'\r\n INTO TABLE $table \r\n FIELDS TERMINATED BY '$delimeter' \r\n OPTIONALLY ENCLOSED BY '\"' \r\n (\r\n RECORD_NO SEQUENCE(count), $heading_str\n)";

            $ctl_dir = $ctl_file_path . 'ctls';
            //create ctl dir if not exists
            create_dir($ctl_dir);
            $this->_config['full_ctl_file_path'] = $ctl_dir . '/' . $table . '.ctl';
            create_file($this->_config['full_ctl_file_path'], $ctl_code);
            return $this->_config['full_ctl_file_path'];
        }
        return FALSE;
    }

    /**
     * @param string $full_ctl_file_name: ctl file name with full path
     * @param string $file_path: path for generating the log file
     * @param string $table: temp table name
     * @return
     * @desc used to execute the ctl file
     * @author HimansuS
     */
    private function _execute_ctl_file($full_ctl_file_name, $file_path, $table) {
        $success_flag = TRUE;
        if (file_exists($full_ctl_file_name)) {
            $log_file_dir = $file_path . '/' . 'logs';
            $log_file_name = $file_path . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $table . '.log';
            //create ctl dir if not exists
            create_dir($log_file_dir);
            $log_file_name = $log_file_dir . DIRECTORY_SEPARATOR . $table . '.log';
            //prepare sqlldr command
            $command = "sqlldr " . DB_USER . "/" . DB_PASS . "@" . DB_NAME . " LOG=" . $log_file_name . " control=" . $full_ctl_file_name . " skip=1";
            //execute sql loader command                            
            exec($command, $output);
            return $success_flag;
        }
        return FALSE;
    }

    /**
     * @param Array $validation_rules Ex: <pre>array(
     *  array('message'=>'validation error message','condition'=>'validateion condition'),
     *  array('message' => "''USER CUID'' cannot be left blank", 'condition' => "USER_CUID IS NULL OR USER_CUID=''")
     * )</pre>
     * @return Boolean TRUE/FALSE
     * @desc used to validate the temp table records as per the business rule
     * @author HimansuS
     */
    private function _validate_records($validation_rules = '') {
        if ($validation_rules) {
            $this->_ci->db->trans_begin();
            if (is_array($validation_rules)) {
                foreach ($validation_rules as $rule) {
                    if (isset($rule['message']) && $rule['condition']) {
                        $this->_update_remark($rule['message'], $rule['condition']);
                    } else {
                        $this->_config['validation_rules_error'] = $this->_messages['INVALID_VALIDATION_RULE'];
                        return FALSE;
                    }
                }
            }
            if ($this->_ci->db->trans_status() === FALSE) {
                $this->_ci->db->trans_rollback();
                $this->_config['validation_rules_error'] = $this->_messages['VALIDATION_RULE_DB_ERR'];
                return FALSE;
            } else {
                $this->_ci->db->trans_commit();
                return TRUE;
            }
        }
        return TRUE; //assume there is no validation rules
    }

    /**
     * @param <p>string $table : temporary table name</p>
     * @param <p>string $message: remark message</p>
     * @param <p>string $condition : query condition</p>
     * @return <p>NA</p>
     * @desc <p>update the remark column as per condition passed in query</p>
     * @author <p>HimansuS</p>
     */
    private function _update_remark($message, $condition) {
        $update_remarks = "UPDATE " . $this->_config['temp_table_name'] . "
            SET remarks = CASE WHEN remarks is null THEN '$message'
                WHEN remarks is not null THEN CONCAT(remarks,', <br>$message')
                END 
            WHERE $condition";        
        $this->_ci->db->query($update_remarks);
    }

    /**
     * @param  string $full_csv_file_path
     * @param  string $temp_table_name
     * @param  array $temp_table_columns
     * @param  string $delemeter default is ";"
     * 
     * @desc   : used to load data into temp table using mysql
     * @return :
     * @author : HimansuS
     * @created:
     */
    private function _load_temp_data($full_csv_file_path, $temp_table_name, $temp_table_columns, $delemeter = ';',$seek_line=0) {
        $seek_line++;
        $load_query = "LOAD DATA local INFILE '" . $full_csv_file_path . "'
                IGNORE INTO TABLE $temp_table_name CHARACTER SET UTF8
                FIELDS TERMINATED BY '$delemeter'  ENCLOSED BY '\"'				
                LINES TERMINATED BY '\r\n' 				
                IGNORE $seek_line LINES
                (" . implode(', ', $temp_table_columns) . ")";        
        if ($this->_ci->db->simple_query($load_query)) {
            return true;
        }
        return false;
    }

    /**
     * @param
     * @return String temporary table name
     * @desc process the uploading
     * @author HimansuS
     */
    public function upload_file() {
        $this->_initialize();
        if ($this->_validate_configs()) {
            $this->_ci->load->library('upload', $this->_config['upload_config']);

            if (!$this->_ci->upload->do_upload($this->_config['file_element'])) {
                $error_msg = array('error' => $this->_ci->upload->display_errors());
                $this->_ci->session->set_flashdata($this->_config['file_element'], $error_msg['error']);
                redirect($this->_config['on_failure_redirect']);
            } else {

                $this->_config['uploaded_file_details'] = $this->_ci->upload->data();
                /* expected values from above line
                 * Array
                  (
                  [file_name] => SKD_UAT_Access1.xlsx
                  [file_type] => application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
                  [file_path] => G:/sdp_app2/sdp_work_new/uploads/hrbp_up2/
                  [full_path] => G:/sdp_app2/sdp_work_new/uploads/hrbp_up2/SKD_UAT_Access1.xlsx
                  [raw_name] => SKD_UAT_Access1
                  [orig_name] => SKD_UAT_Access.xlsx
                  [client_name] => SKD_UAT_Access.xlsx
                  [file_ext] => .xlsx
                  [file_size] => 10.54
                  [is_image] =>
                  [image_width] =>
                  [image_height] =>
                  [image_type] =>
                  [image_size_str] =>
                  )
                  some more indexes are added manually
                 * converted_to_csv
                 * csv_full_path                 * 
                 */

                //convert uploaded file into csv file
                $uploaded_file = $this->_config['uploaded_file_details']['full_path']; //uploaded filepath with name
                $csv_file_name = $this->_config['uploaded_file_details']['raw_name'] . '.csv'; //only csv file name with extention
                $csv_file_path = $this->_config['uploaded_file_details']['file_path'] . $this->_config['csv_file_path'] . '/'; //converted csv file store path

                if (convert_xls_to_csv($uploaded_file, $csv_file_name, $csv_file_path)) {
                    $this->_config['uploaded_file_details']['converted_to_csv'] = 1;
                    $this->_config['uploaded_file_details']['csv_full_path'] = $csv_file_path . $csv_file_name;
                } else {
                    $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_messages['FILE_READ_ERR']);
                    redirect($this->_config['on_failure_redirect']);
                }

                if ($this->_config['uploaded_file_details']['converted_to_csv'] === 1) {
                    $this->_config['temp_table_name'] = $this->_config['temp_table_name'] . $this->_ci->rbac->get_user_id();

                    //validate uploaded file columns
                    $csv_file_heading = get_csv_heading($this->_config['uploaded_file_details']['csv_full_path'], $this->_config['csv_delimeter'],$this->_config['seek_line']);
                    
                    if (count($this->_config['uploaded_file_heading_comparison']) != count($csv_file_heading) ||
                            array_diff_uassoc($this->_config['uploaded_file_heading_comparison'], $csv_file_heading, "array_key_val_check")) {
                        $this->_ci->session->set_flashdata($this->_config['file_element'], '<br>' . $this->_ci->lang->line('UPLOAD_UTILITY_COLUMN_ERR_MSG') . ' - <br>' . str_replace('_', ' ', implode('<br>', $this->_config['uploaded_file_heading']) . '<br>'));
                        redirect($this->_config['on_failure_redirect']);
                    }
                    //add remarks column
                    $temp_file_heading = $this->_config['temp_table_heading'];
                    array_unshift($temp_file_heading, 'REMARKS');
                    //create temporary table to load the csv file
                    if (!$this->_create_temp_table($temp_file_heading, $this->_config['temp_table_name'])) {
                        $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_messages['TEMP_TABLE_CREATE_ERR']);
                        redirect($this->_config['on_failure_redirect']);
                    } else {
                        if ($this->_ci->db->dbdriver == 'mysqli') {
                            if ($this->_load_temp_data($this->_config['uploaded_file_details']['csv_full_path']
                                            , $this->_config['temp_table_name']
                                            , $this->_config['temp_table_heading']
                                            ,$this->_config['csv_delimeter']
                                            ,$this->_config['seek_line'])) {
                                if ($this->_validate_records($this->_config['validation_rules'])) {
                                    //render grid page                                    
                                    return $this->_config['temp_table_name'];
                                } else {
                                    if (isset($this->_config['validation_rules_error'])) {
                                        $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_config['validation_rules_error']);
                                    } else {
                                        $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_messages['DATA_VALIDATION_PRC_ERR']);
                                    }
                                    redirect($this->_config['on_failure_redirect']);
                                }
                            } else {
                                $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_messages['CTL_FILE_CREATE_ERR']);
                                redirect($this->_config['on_failure_redirect']);
                            }
                        } else {
                            //create ctl file
                            if ($this->_create_ctl_file($this->_config['uploaded_file_details']['file_path']
                                            , $this->_config['uploaded_file_details']['csv_full_path']
                                            , $this->_config['temp_table_name']
                                            , $this->_config['temp_table_heading'])) {

                                if ($this->_execute_ctl_file($this->_config['full_ctl_file_path']
                                                , $this->_config['uploaded_file_details']['file_path']
                                                , $this->_config['temp_table_name'])) {

                                    if ($this->_validate_records($this->_config['validation_rules'])) {
                                        //render grid page                                    
                                        return $this->_config['temp_table_name'];
                                    } else {
                                        if (isset($this->_config['validation_rules_error'])) {
                                            $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_config['validation_rules_error']);
                                        } else {
                                            $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_messages['DATA_VALIDATION_PRC_ERR']);
                                        }
                                        redirect($this->_config['on_failure_redirect']);
                                    }
                                } else {
                                    $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_messages['CTL_FILE_EXE_ERR']);
                                    redirect($this->_config['on_failure_redirect']);
                                }
                            } else {
                                $this->_ci->session->set_flashdata($this->_config['file_element'], $this->_messages['CTL_FILE_CREATE_ERR']);
                                redirect($this->_config['on_failure_redirect']);
                            }
                        }
                    }
                }
            }
        } else {
            redirect($this->_config['on_failure_redirect']);
        }
        return FALSE;
    }

    /**
     * @param
     * @return Array
     * @desc fetch invalid records from temp table
     * @author HimansuS
     */
    public function get_invalid_records($table_name) {
        return $this->get_temp_table_records($table_name, FALSE);
    }

    /**
     * @param
     * @return array
     * @desc fetch valid records from temp table
     * @author HimansuS
     */
    public function get_valid_records($table_name) {
        return $this->get_temp_table_records($table_name);
    }

    /**
     * @param String $table_name Ex. Temp_utility
     * @param Boolean $valid
     * @return Array $res
     * @desc fetch temp table table records as per flag
     * @author HimansuS
     */
    public function get_temp_table_records($table_name, $valid = true) {
        if ($valid) {
            $custome_cond = 'REMARKS IS NULL';
        } else {
            $custome_cond = 'REMARKS IS NOT NULL';
        }
        $query = "SELECT DISTINCT * FROM $table_name WHERE $custome_cond";
        $res = $this->_ci->db->query($query)->result_array();
        return $res;
    }

    /**
     * @param NA
     * @return NA
     * @desc used to download the invalid records
     * @author HimansuS
     */
    public function download_invalid_records() {

        if ($this->_config['temp_table_name'] == '') {
            return FALSE;
        }
        $invalid_records = $this->get_temp_table_records($this->_config['temp_table_name'], FALSE);
        $cuid = $this->_ci->rbac->get_user_id();
        $gmt_date = date('m_d_Y_H_i_s', convert_to_time(date('Y-m-d H:i:s')));
        $this->_config['download_file_name'] = $this->_config['download_file_name'] . '_' . $cuid . '_' . $gmt_date . '.xlsx';

        $this->_ci->load->helper('to_excel');
        download_to_excel($invalid_records
                , $this->_config['download_file_name']
                , $this->_config['temp_table_heading']
                , $this->_config['worksheet_name']
                , NULL, NULL, TRUE, TRUE, 40, FALSE, TRUE, ''
                , $this->_config['file_heading']);
    }

}
