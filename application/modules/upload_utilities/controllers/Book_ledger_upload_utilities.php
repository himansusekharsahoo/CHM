<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Book_ledger_upload_utilities Class File
 * PHP Version 7.1.1
 * 
 * @category   Upload Utility
 * @package    Upload Utility
 * @subpackage book ledger upload utility
 * @class      Book_ledger_upload_utilities
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   11/01/2018
 */
class Book_ledger_upload_utilities extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
        $this->layout->breadcrumbsFlag = false;
        $this->load->model('Book_ledger_upload_utility');
    }

    /**
     * @param  : 
     * @desc   : load book ledger uplod utility page
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function index() {
        $this->layout->navTitle = 'Book ledger upload utility';
        $this->layout->title = 'Book ledger upload utility';
        if ($this->rbac->has_permission('UPLOAD_UTILITIES', 'BOOK_LEDGER_UPLOAD_UTILTIY')) {
            $this->scripts_include->includePlugins(array('jq_validation'), 'js');
            $this->layout->render();
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @param  : 
     * @desc   : process the excel file and display valid and invalid record grid
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function upload_file() {
         $this->layout->navTitle = 'Book ledger upload utility';
        $this->layout->title = 'Book ledger upload utility';
        if ($this->rbac->has_permission('UPLOAD_UTILITIES', 'BOOK_LEDGER_UPLOAD_UTILTIY')) {

            $this->scripts_include->includePlugins(array('datatable','chosen', 'jq_validation'), 'js');
            $this->scripts_include->includePlugins(array('datatable','chosen'), 'css');
            $config = array();
            $user_id = $this->rbac->get_user_id();
            $temp_table_name = 'temp_book_ledger_' . $user_id;
            $config['upload_path'] = './uploads/book_ledger';
            $config['allowed_types'] = array('xls', 'xlsx', 'csv');
            $config['file_element'] = 'upload_file';
            $config['on_failure_redirect'] = 'book-ledger-upload';
            $config['file'] = $_FILES;
            $config['temp_table_name'] = 'temp_book_ledger_';
            $config['seek_line'] = 0;
            $config['temp_table_heading'] = array(
                'BOOK_NAME',
                'BOOK_CATEGORY_NAME',
                'BOOK_PUBLICATION',
                'AUTHOR_NAME',
                'ISBN',
                'PAGES',
                'MRP',
                'EDITION',
                'BOOK_LOCATION',
                //'NUMBER_OF_BOOKS'
                //'BILL_NUMBER',
                //'PURCHASE_DATE',
                //'PRICE',
                //'VENDOR_NAME',
                //'PURCHASE_REMARKS'
            );
            $config['uploaded_file_heading'] = array(
                'BOOK_NAME',
                'BOOK_CATEGORY_NAME',
                'BOOK_PUBLICATION',
                'AUTHOR_NAME',
                'ISBN',
                'PAGES',
                'MRP',
                'EDITION',
                'BOOK_LOCATION',
                //'NUMBER_OF_BOOKS'
                //'BILL_NUMBER',
                //'PURCHASE_DATE',
                //'PRICE',
                //'VENDOR_NAME',
                //'PURCHASE_REMARKS'
            );

            $config['validation_rules'] = array(
                //Blank validation
                array('message' => "''BOOK_NAME'' can not be blank."
                    , 'condition' => "BOOK_NAME IS NULL OR BOOK_NAME=''"
                ),
                array('message' => "''BOOK_CATEGORY_NAME'' can not be blank."
                    , 'condition' => "BOOK_CATEGORY_NAME IS NULL OR BOOK_CATEGORY_NAME=''"
                ),
                array('message' => "''BOOK_PUBLICATION'' can not be blank."
                    , 'condition' => "BOOK_PUBLICATION IS NULL OR BOOK_PUBLICATION=''"
                ),
                array('message' => "''ISBN'' can not be blank."
                    , 'condition' => "ISBN IS NULL OR ISBN=''"
                ),
                array('message' => "''PAGES'' can not be blank."
                    , 'condition' => "PAGES IS NULL OR PAGES=''"
                ),
                array('message' => "''MRP'' can not be blank."
                    , 'condition' => "MRP IS NULL OR MRP=''"
                ),
//                array('message' => "''NUMBER_OF_BOOKS'' can not be blank."
//                    , 'condition' => "NUMBER_OF_BOOKS IS NULL OR NUMBER_OF_BOOKS=''"
//                ),
                //duplicate record validation                
                //book name,category,publication,author,edition
                array('message' => "Duplicate record."
                    , 'condition' => "RECORD_NO IN(
                    SELECT D.record_no
                        FROM(
                            SELECT main.record_no 
                            FROM $temp_table_name main 
                            INNER JOIN (
                                SELECT book_name,book_category_name,book_publication,author_name,edition,COUNT(book_name),record_no 
                                FROM $temp_table_name t 
                                GROUP BY book_name,book_category_name,book_publication,author_name,edition 
                                HAVING COUNT(book_name) > 1 
                            ) dup ON 
                            main.book_name=dup.book_name 
                            AND main.book_category_name=dup.book_category_name 
                            AND main.book_publication=dup.book_publication 
                            AND main.author_name=dup.author_name 
                            AND main.edition=dup.edition 
                        ) D
                    )"
                ),
                //duplicate isbn validation                
                array('message' => "Duplicate \'ISBN\'"
                    , 'condition' => "RECORD_NO IN(
                        SELECT record_no
                        FROM(
                            SELECT main.record_no 
                            FROM $temp_table_name main 
                            INNER JOIN (
                                SELECT isbn,COUNT(isbn),record_no 
                                FROM $temp_table_name t 
                                GROUP BY isbn
                                HAVING COUNT(isbn) > 1 
                            ) dup ON 
                            main.isbn=dup.isbn
                        ) D
                    )"
                ),
            );
            $this->load->library('upload_utility', $config);
            $temp_table_name = $this->upload_utility->upload_file();

            if ($temp_table_name) {
                $data = array();
                $data['temp_table'] = $temp_table_name;
                $data['valid_table_config'] = $this->_get_grid_config($config['uploaded_file_heading'], 'book-ledger-upload-valid', 'valid_rec_dt');
                $data['invalid_table_config'] = $this->_get_grid_config($config['uploaded_file_heading'], 'book-ledger-upload-invalid', 'invalid_rec_dt', 'invalid');
                $this->layout->data = $data;
                $this->layout->render(array('view' => 'upload_utilities/book_ledger_upload_utilities/upload_file'));
            } else {
                redirect('book-ledger-upload');
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
                'iDisplayLength' => 15,
            )
        );
        if($type == 'valid'){
            $config['dt_sleep']=3000;//to avoid datatable hand issue
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

        if ($this->rbac->has_permission('UPLOAD_UTILITIES', 'BOOK_LEDGER_UPLOAD_UTILTIY')) {
            if ($this->input->is_ajax_request()) {
                $columns = "";
                $user_id = $this->rbac->get_user_id();
                $temp_table_name = 'temp_book_ledger_' . $user_id;
                $type = $this->input->post('type');
                if ($type == 'invalid') {
                    $condition = "LENGTH(TRIM(REMARKS))>0";
                    $columns.="remarks,";
                } else {
                    $condition = "REMARKS IS NULL OR REMARKS=''";
                }                
                $columns.= "book_name,book_category_name,book_publication,author_name,isbn,pages"
                        . ",mrp,edition,book_location";
                        //. ",bill_number,purchase_date,price,vendor_name,purchase_remarks";

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
                $returned_list = $this->Book_ledger_upload_utility->get_temp_table_data_dt($columns, $temp_table_name, $data, $condition);
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
        if ($this->rbac->has_permission('UPLOAD_UTILITIES', 'BOOK_LEDGER_UPLOAD_UTILTIY')) {

            if ($this->input->is_ajax_request()):
                $row_id = $this->input->post('record_no');
                $user_id = $this->rbac->get_user_id();
                $temp_table_name = 'temp_book_ledger_' . $user_id;

                if ($row_id):
                    $row_id = c_decode($row_id);
                    $result = $this->Book_ledger_upload_utility->delete_temp_row($row_id, $temp_table_name);
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

        if ($this->rbac->has_permission('UPLOAD_UTILITIES', 'BOOK_LEDGER_UPLOAD_UTILTIY')) {
            if ($this->input->is_ajax_request()):

                $export_type = $this->input->post('export_type');
                $type = $this->input->post('data');                
                $user_id = $this->rbac->get_user_id();
                $columns="";
                $remarks=array();
                $temp_table_name = 'temp_book_ledger_' . $user_id;
                if ($type == 'invalid') {
                    $condition = "LENGTH(TRIM(REMARKS))>0";
                    $columns='remarks,';
                    $remarks=array('remarks'=>'remarks');
                } else {
                    $condition = "REMARKS IS NULL OR REMARKS=''";
                }
                $columns .= "record_no,category_name,category_code,category_desc,department_name,department_code,batch_name,batch_desc,start_year,end_year,no_of_semister";
                $tableHeading = array(
                    'record_no' => 'record_no',
                    'book_name' => 'book_name',
                    'book_category_name' => 'book_category_name',
                    'author_name' => 'author_name',
                    'isbn' => 'isbn',
                    'pages' => 'pages',
                    'mrp' => 'mrp',
                    'edition' => 'edition',
                    'book_location' => 'book_location',
                    //'number_of_books' => 'number_of_books'
                );
                $tableHeading=  array_merge($remarks,$tableHeading);
                $data = $this->Book_ledger_upload_utility->get_temp_table_data_dt($columns, $temp_table_name, null, $condition, true);
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
                $file_name = 'book_ledg_batch_upload_' . $type . date('d_m_Y_H_i_s') . '.' . $export_type;
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
        if ($this->Book_ledger_upload_utility->save_import_data_db()) {
            echo json_encode(array('type' => 'success', 'message' => 'Data uploaded successfully.'));
            exit();
        } else {
            echo json_encode(array('type' => 'error', 'message' => 'Data saving error, Please tray again!'));
            exit();
        }
    }

    /**
     * @param  : 
     * @desc   : used to downlod the book ledger template excel file
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_ledger_template() {
        if ($this->rbac->has_permission('UPLOAD_UTILITIES', 'BOOK_LEDGER_UPLOAD_UTILTIY')) {
            if ($this->input->is_ajax_request()):
                $export_type = 'xlsx';
                $user_id = $this->rbac->get_user_id();
                $temp_table_name = 'temp_book_ledger_' . $user_id;
                $book_location=  $this->Book_ledger_upload_utility->get_book_location_xls_validation();
                $tableHeading = array(
                    'book_name' => 'book_name',
                    'book_category_name' => 'book_category_name',
                    'book_publication' => 'book_publication',
                    'author_name' => 'author_name',
                    'isbn' => 'isbn',
                    'pages' => 'pages',
                    'mrp' => 'mrp',
                    'edition' => 'edition',
                    'book_location' => 'book_location',
                    //'no_of_books' => 'number_of_books'
                );
                $head_cols = $body_col_map = array();
                $date = array(
                    array(
                        'title' => 'Date of Export Report',
                        'value' => date('d-m-Y')
                    )
                );
                foreach ($tableHeading as $db_col => $col) {
                    $head_cols[] = array(
                        'title' => strtoupper($col),
                        'track_auto_filter' => 1
                    );
                    $body_col_map[] = array('db_column' => $db_col);
                }
                $header = array($head_cols);
                $worksheet_name = 'book_ledger_data';
                $file_name = 'book_ledger_upload_template_' . date('d_m_Y_H_i_s') . '.' . $export_type;
                $config = array(
                    'db_data' => array(),
                    'header_rows' => $header,
                    'body_column' => $body_col_map,
                    'worksheet_name' => $worksheet_name,
                    'file_name' => $file_name,
                    'download' => true,
                    'data_validation' => array(
                        'I2:I5000' => array(
                            'allow_blank_flag' => false,
                            'show_input_message_flag' => true,
                            'show_error_message_flag' => true,
                            'show_dropdown_flag' => true,
                            'error_popup_title_message' => 'Error',
                            'error_popup_body_message' => 'Select book location from list.',
                            'tooltip_title_message' => 'Select book location.',
                            'tooltip_body_message' => '',
                            'formula_data' => '"'.$book_location.'"',
                            'range_flag' => 'true'
                        )
                    )
                );
                //pma($config,1);
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

}
