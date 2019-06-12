<?php

//if ($this->rbac->has_permission('UPLOAD_UTILITIES', 'COURSE_ACADEMIC_BATCH_MASTERS')) {
//    
//} else {
//    $this->layout->render(array('error' => '401'));
//}
//
//if ($this->input->is_ajax_request()) {
//    
//} else {
//    $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
//    $this->layout->render(array('error' => 'general'));
//}
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Book_assign_logs Class File
 * PHP Version 7.1.1
 * 
 * @category   Upload Utility
 * @package    Upload Utility
 * @subpackage course academic batch upload utility
 * @class      Course_academic_batch_utilities
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   11/01/2018
 */
class Course_academic_batch_utilities extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
        $this->layout->breadcrumbsFlag = false;
        $this->load->model('Course_academic_batch_utility');
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function index() {
        $this->layout->navTitle = 'Course academic upload utility';
        $this->layout->title = 'Course academic upload utility';
        if ($this->rbac->has_permission('UPLOAD_UTILITIES', 'COURSE_ACADEMIC_BATCH_MASTERS')) {
            $this->scripts_include->includePlugins(array('jq_validation'), 'js');
            $this->layout->render();
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function upload_file() {
        $this->layout->navTitle = 'Course academic upload utility';
        $this->layout->title = 'Course academic upload utility';
        if ($this->rbac->has_permission('UPLOAD_UTILITIES', 'COURSE_ACADEMIC_BATCH_MASTERS')) {

            $this->scripts_include->includePlugins(array('datatable','chosen', 'jq_validation'), 'js');
            $this->scripts_include->includePlugins(array('datatable','chosen'), 'css');
            $config = array();
            $user_id = $this->rbac->get_user_id();
            $temp_table_name = 'temp_course_a_b_m_' . $user_id;
            $config['upload_path'] = './uploads/course_aca_batch_master';
            $config['allowed_types'] = array('xls', 'xlsx', 'csv');
            $config['file_element'] = 'upload_file';
            $config['on_failure_redirect'] = 'course-academic-batch-upload';
            $config['file'] = $_FILES;
            $config['temp_table_name'] = 'temp_course_a_b_m_';
            $config['seek_line'] = 1;
            $config['temp_table_heading'] = array(
                'CATEGORY_NAME',
                'CATEGORY_CODE',
                'CATEGORY_DESC',
                'DEPARTMENT_NAME',
                'DEPARTMENT_CODE',
                'BATCH_NAME',
                'BATCH_DESC',
                'START_YEAR',
                'END_YEAR',
                'NO_OF_SEMISTER'
            );
            $config['uploaded_file_heading'] = array(
                'CATEGORY_NAME',
                'CATEGORY_CODE',
                'CATEGORY_DESC',
                'DEPARTMENT_NAME',
                'DEPARTMENT_CODE',
                'BATCH_NAME',
                'BATCH_DESC',
                'START_YEAR',
                'END_YEAR',
                'NO_OF_SEMISTER'
            );

            $config['validation_rules'] = array(
                //Blank validation
                array('message' => "''CATEGORY_NAME'' can not be blank."
                    , 'condition' => "CATEGORY_NAME IS NULL OR CATEGORY_NAME=''"
                ),
                array('message' => "''CATEGORY_CODE'' can not be blank."
                    , 'condition' => "CATEGORY_CODE IS NULL OR CATEGORY_CODE=''"
                ),
                array('message' => "''DEPARTMENT_NAME'' can not be blank."
                    , 'condition' => "DEPARTMENT_NAME IS NULL OR DEPARTMENT_NAME=''"
                ),
                array('message' => "''BATCH_NAME'' can not be blank."
                    , 'condition' => "BATCH_NAME IS NULL OR BATCH_NAME=''"
                ),
                array('message' => "''START_YEAR'' can not be blank."
                    , 'condition' => "START_YEAR IS NULL OR START_YEAR=''"
                ),
                array('message' => "''END_YEAR'' can not be blank."
                    , 'condition' => "END_YEAR IS NULL OR END_YEAR=''"
                ),
                array('message' => "''NO_OF_SEMISTER'' can not be blank."
                    , 'condition' => "NO_OF_SEMISTER IS NULL OR NO_OF_SEMISTER=''"
                )
            );
            $this->load->library('upload_utility', $config);
            $temp_table_name = $this->upload_utility->upload_file();

            if ($temp_table_name) {
                $data = array();
                $data['temp_table'] = $temp_table_name;
                $data['valid_table_config'] = $this->_get_grid_config($config['uploaded_file_heading'], 'course-academic-batch-upload-valid', 'valid_rec_dt');
                $data['invalid_table_config'] = $this->_get_grid_config($config['uploaded_file_heading'], 'course-academic-batch-upload-invalid', 'invalid_rec_dt', 'invalid');
                $this->layout->data = $data;
                $this->layout->render(array('view' => 'upload_utilities/course_academic_batch_utilities/upload_file'));
            } else {
                redirect('course-academic-batch-upload');
            }
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    private function _get_grid_config($file_heading, $url, $table_id, $type = 'valid') {
        $header = array();
        if ($type == 'invalid') {
            $header[] = array(
                'db_column' => 'remarks',
                'name' => 'REMARKS',
                'title' => 'REMARKS',
                'class_name' => '',
                'orderable' => 'false',
                'visible' => 'true',
                'searchable' => 'false'
            );
        }
        foreach ($file_heading as $col) {
            $title = ucfirst(strtolower(str_replace("_", " ", $col)));
            $header[] = array(
                'db_column' => "$col",
                'name' => "$col",
                'title' => "$col",
                'class_name' => '',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            );
        }
        $header[] = array(
            'db_column' => 'Action',
            'name' => 'Action',
            'title' => 'Action',
            'class_name' => '',
            'orderable' => 'false',
            'visible' => 'true',
            'searchable' => 'false'
        );

        $dt_tool_btn = array(
            array(
                'btn_class' => 'btn-warning',
                'btn_href' => '#',
                'btn_icon' => '',
                'btn_title' => 'XLS',
                'btn_text' => '<span class="fa fa-file-excel-o"></span> Excel',
                'btn_separator' => ' ',
                'attr' => ($type == 'valid') ? 'id="export_valid_xls"' : 'id="export_invalid_xls"'
            ),
            array(
                'btn_class' => 'btn-info',
                'btn_href' => '#',
                'btn_icon' => '',
                'btn_title' => 'CSV',
                'btn_text' => '<span class="fa fa-file-text-o"></span> CSV',
                'btn_separator' => ' ',
                'attr' => ($type == 'valid') ? 'id="export_valid_csv"' : 'id="export_invalid_csv"'
            )
        );
        $dt_tool_btn = get_link_buttons($dt_tool_btn);

        $config = array(
            'dt_markup' => TRUE,
            'dt_id' => $table_id,
            'dt_header' => $header,
            'dt_ajax' => array(
                'dt_url' => base_url($url),
                'dt_param' => '{"type":"' . $type . '"}'
            ),
            'custom_lengh_change' => false,
            'dt_dom' => array(
                'top_dom' => true,
                'top_length_change' => true,
                'top_filter' => true,
                'top_buttons' => $dt_tool_btn,
                'top_pagination' => true,
                'buttom_dom' => true,
                'buttom_length_change' => FALSE,
                'buttom_pagination' => true
            ),
            'options' => array(
                'iDisplayLength' => 15
            )
        );
        if ($type == 'valid') {
            $config['dt_sleep'] = 3000; //to avoid datatable hand issue
        }
        return $config;
    }

    /**
     * @param  : 
     * @desc   : used to fetch valid and invalid records for gird
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_temp_table_data_grid() {

        if ($this->rbac->has_permission('UPLOAD_UTILITIES', 'COURSE_ACADEMIC_BATCH_MASTERS')) {
            if ($this->input->is_ajax_request()) {
                $columns = "";
                $user_id = $this->rbac->get_user_id();
                $temp_table_name = 'temp_course_a_b_m_' . $user_id;
                $type = $this->input->post('type');
                if ($type == 'invalid') {
                    $condition = "LENGTH(TRIM(REMARKS))>0";
                    $columns.="remarks,";
                } else {
                    $condition = "REMARKS IS NULL OR REMARKS=''";
                }
                $columns.= "category_name,category_code,category_desc,department_name,department_code,batch_name,batch_desc,start_year,end_year,no_of_semister,record_no";

                $data = array();
                $grid_buttons = array(
                    array(
                        'btn_class' => 'btn-danger delete-record',
                        'btn_href' => '#',
                        'btn_icon' => 'fa-remove',
                        'btn_title' => 'delete record',
                        'btn_separator' => '',
                        'param' => array('$1'),
                        'style' => '',
                        'attr' => 'data-row_id="$1"'
                    )
                );

                $button_set = get_link_buttons($grid_buttons);
                $data['button_set'] = $button_set;
                $returned_list = $this->Course_academic_batch_utility->get_temp_table_data_dt($columns, $temp_table_name, $data, $condition);
                echo $returned_list;
                exit();
            } else {
                $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
                $this->layout->render(array('error' => 'general'));
            }
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @param  : 
     * @desc   : used to delete temp table record
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function delete_temp_record() {
        if ($this->rbac->has_permission('UPLOAD_UTILITIES', 'COURSE_ACADEMIC_BATCH_MASTERS')) {

            if ($this->input->is_ajax_request()):
                $row_id = $this->input->post('record_no');
                $user_id = $this->rbac->get_user_id();
                $temp_table_name = 'temp_course_a_b_m_' . $user_id;

                if ($row_id):
                    $row_id = c_decode($row_id);
                    $result = $this->Course_academic_batch_utility->delete_temp_row($row_id, $temp_table_name);
                    if ($result):
                        echo 1;
                        exit();
                    else:
                        echo 'Data deletion error !';
                        exit();
                    endif;
                endif;
                echo 'No data found to delete';
                exit();
            else:
                $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
                $this->layout->render(array('error' => 'general'));
            endif;
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @param  : 
     * @desc   : used to download/export valid and invalid records
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function export_grid_data() {

        if ($this->rbac->has_permission('UPLOAD_UTILITIES', 'COURSE_ACADEMIC_BATCH_MASTERS')) {
            if ($this->input->is_ajax_request()):
                
                $export_type = $this->input->post('export_type');
                $type = $this->input->post('data');
                
                $columns="";
                $remarks=array();

                $user_id = $this->rbac->get_user_id();
                $temp_table_name = 'temp_course_a_b_m_' . $user_id;
                
                if ($type == 'invalid') {
                    $condition = "LENGTH(TRIM(REMARKS))>0";
                    $columns="remarks,";
                    $remarks=array('remarks'=>'remarks');
                } else {
                    $condition = "REMARKS IS NULL OR REMARKS=''";
                }
                $columns .= "record_no,category_name,category_code,category_desc,department_name,department_code,batch_name,batch_desc,start_year,end_year,no_of_semister";

                $tableHeading = array(
                    'record_no' => 'record_no',
                    'category_name' => 'category_name',
                    'category_code' => 'category_code',
                    'category_desc' => 'category_desc',
                    'department_name' => 'department_name',
                    'department_code' => 'department_code',
                    'batch_name' => 'batch_name',
                    'batch_desc' => 'batch_desc',
                    'start_year' => 'start_year',
                    'end_year' => 'end_year',
                    'no_of_semister' => 'no_of_semister'                    
                );
                $tableHeading=  array_merge($remarks,$tableHeading);
                $data = $this->Course_academic_batch_utility->get_temp_table_data_dt($columns, $temp_table_name, null, $condition, true);
                $head_cols = $body_col_map = array();
                $date = array(
                    array(
                        'title' => 'Date of Export Report',
                        'value' => date('d-m-Y')
                    )
                );
                foreach ($tableHeading as $db_col => $col) {
                    if ($db_col == 'department_name') {
                        $head_cols[] = array(
                            'title' => strtoupper($col),
                            'track_auto_filter' => 1,
                            'freeze_column' => true
                        );
                    } else {
                        $head_cols[] = array(
                            'title' => strtoupper($col),
                            'track_auto_filter' => 1
                        );
                    }

                    $body_col_map[] = array('db_column' => $db_col);
                }
                $header = array($date, $head_cols);
                $worksheet_name = $type . '_records';
                $file_name = 'course_aca_batch_upload_' . $type . date('d_m_Y_H_i_s') . '.' . $export_type;
                $config = array(
                    'db_data' => $data['aaData'],
                    'header_rows' => $header,
                    'body_column' => $body_col_map,
                    'worksheet_name' => $worksheet_name,
                    'file_name' => $file_name,
                    'download' => true
                );

                $this->load->library('excel_utility');
                $this->excel_utility->download_excel($config, $export_type);
                ob_end_flush();
                exit;

            else:
                $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
                $this->layout->render(array('error' => 'general'));
            endif;
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @param  : 
     * @desc   : used to save imported data
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function save_import_data() {
        if ($this->Course_academic_batch_utility->save_import_data_db()) {
            echo json_encode(array('type' => 'success', 'message' => 'Data uploaded successfully.'));
            exit();
        } else {
            echo json_encode(array('type' => 'error', 'message' => 'Data saving error, Please tray again!'));
            exit();
        }
    }

}
