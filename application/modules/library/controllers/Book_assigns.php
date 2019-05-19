<?php

/**
 * Book_assigns Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Book_assigns
 * @class      Book_assigns
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   11/08/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Book_assigns Class
 * 
 * @category   Library
 * @package    Library
 * @class      Book_assigns
 * @desc    
 * @author     HimansuS                  
 * @since   11/08/2018
 */
class Book_assigns extends CI_Controller {

    /**
     * __construct Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('book_assign');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * Index Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function index() {
        if ($this->rbac->has_permission('MANAGE_BOOK_ASSIGNS', 'LIST')) {
            $this->breadcrumbs->push('index', '/library/book_assigns/index');
            $this->scripts_include->includePlugins(array('datatable','chosen'), 'css');
            $this->scripts_include->includePlugins(array('datatable','chosen'), 'js');
            $this->layout->navTitle = 'Book assign list';
            $this->layout->title = 'Book assign list';
            $header = array(
                array(
                    'db_column' => 'isbn_no',
                    'name' => 'Ledger ID',
                    'title' => 'Ledger ID',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'card_no',
                    'name' => 'Card Number',
                    'title' => 'Card Number',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'issue_date',
                    'name' => 'Issue Date',
                    'title' => 'Issue Date',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'due_date',
                    'name' => 'Due Date',
                    'title' => 'Due Date',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'return_date',
                    'name' => 'Return Date',
                    'title' => 'Return Date',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'return_delay_fine',
                    'name' => 'Delay Fine',
                    'title' => 'Delay Fine',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'book_return_condition',
                    'name' => 'Book Condition',
                    'title' => 'Book Condition',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'remarks',
                    'name' => 'Remarks',
                    'title' => 'Remarks',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'user_type',
                    'name' => 'User Type',
                    'title' => 'User Type',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'Action',
                    'name' => 'Action',
                    'title' => 'Action',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'false'
                )
            );
            $data = $grid_buttons = array();

            $grid_buttons[] = array(
                'btn_class' => 'btn-info',
                'btn_href' => base_url('view-book-assign'),
                'btn_icon' => 'fa-eye',
                'btn_title' => 'view record',
                'btn_separator' => ' ',
                'param' => array('$1'),
                'style' => ''
            );
            $grid_buttons[] = array(
                'btn_class' => 'btn-primary',
                'btn_href' => base_url('edit-book-assign'),
                'btn_icon' => 'fa-pencil',
                'btn_title' => 'edit record',
                'btn_separator' => ' ',
                'param' => array('$1'),
                'style' => ''
            );

            $grid_buttons[] = array(
                'btn_class' => 'btn-danger delete-record',
                'btn_href' => '#',
                'btn_icon' => 'fa-remove',
                'btn_title' => 'delete record',
                'btn_separator' => '',
                'param' => array('$1'),
                'style' => '',
                'attr' => 'data-bassign_id="$1"'
            );
            $button_set = get_link_buttons($grid_buttons);
            $data['button_set'] = $button_set;

            if ($this->input->is_ajax_request()) {
                $returned_list = $this->book_assign->get_book_assign_datatable($data);
                echo $returned_list;
                exit();
            }

            $dt_tool_btn = array(
                array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('create-book-assign'),
                    'btn_icon' => '',
                    'btn_title' => 'Create',
                    'btn_text' => 'Create',
                    'btn_separator' => ' '
                ),
                array(
                    'btn_class' => 'btn-warning',
                    'btn_href' => '#',
                    'btn_icon' => '',
                    'btn_title' => 'XLS',
                    'btn_text' => '<span class="fa fa-file-excel-o"></span> Excel',
                    'btn_separator' => ' ',
                    'attr' => 'id="export_table_xls"'
                ),
                array(
                    'btn_class' => 'btn-info',
                    'btn_href' => '#',
                    'btn_icon' => '',
                    'btn_title' => 'CSV',
                    'btn_text' => '<span class="fa fa-file-text-o"></span> CSV',
                    'btn_separator' => ' ',
                    'attr' => 'id="export_table_csv"'
                )
            );
            $dt_tool_btn = get_link_buttons($dt_tool_btn);

            $config = array(
                'dt_markup' => TRUE,
                'dt_id' => 'raw_cert_data_dt_table',
                'dt_header' => $header,
                'dt_ajax' => array(
                    'dt_url' => base_url('library/book_assigns/index'),
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
            $data['data'] = array('config' => $config);
            $this->layout->render($data);
        }else{
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * Export_grid_data Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function export_grid_data() {
        if ($this->input->is_ajax_request()):
            if ($this->rbac->has_permission('MANAGE_BOOK_ASSIGNS', 'XLS_EXPORT') || $this->rbac->has_permission('MANAGE_BOOK_ASSIGNS', 'CSV_EXPORT')) {
                $export_type = $this->input->post('export_type');
                $tableHeading = array('bledger_id' => 'bledger_id', 'member_id' => 'member_id', 'issue_date' => 'issue_date', 'due_date' => 'due_date', 'return_date' => 'return_date', 'return_delay_fine' => 'return_delay_fine', 'book_return_condition' => 'book_return_condition', 'book_lost_fine' => 'book_lost_fine', 'remarks' => 'remarks', 'created' => 'created', 'created_by' => 'created_by', 'user_type' => 'user_type',);
                $cols = 'bledger_id,member_id,issue_date,due_date,return_date,return_delay_fine,book_return_condition,book_lost_fine,remarks,created,created_by,user_type';
                $data = $this->book_assign->get_book_assign_datatable(null, true, $tableHeading);
                $head_cols = $body_col_map = array();
                $date = array(
                    array(
                        'title' => 'Date of Export Report',
                        'value' => date('d-m-Y')
                    )
                );
                foreach ($tableHeading as $db_col => $col) {
                    $head_cols[] = array(
                        'title' => ucfirst($col),
                        'track_auto_filter' => 1
                    );
                    $body_col_map[] = array('db_column' => $db_col);
                }
                $header = array($date, $head_cols);
                $worksheet_name = 'book_assigns';
                $file_name = 'book_assigns' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
            }else{
                $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
                $this->layout->render(array('error' => 'general'));
            }

        else:
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        endif;
    }

    /**
     * Create Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function create() {
        if ($this->rbac->has_permission('MANAGE_BOOK_ASSIGNS', 'CREATE')) {
            $this->scripts_include->includePlugins(array('jq_validation', 'bs_datepicker'), 'js');
            $this->scripts_include->includePlugins(array('bs_datepicker'), 'css');
            $this->breadcrumbs->push('create', '/library/book_assigns/create');

            $this->layout->navTitle = 'Book assign create';
            $data = array();
            if ($this->input->post()):
                $config = array(
                    array(
                        'field' => 'bledger_id',
                        'label' => 'bledger_id',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'member_id',
                        'label' => 'member_id',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'issue_date',
                        'label' => 'issue_date',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'due_date',
                        'label' => 'due_date'
                    ),
                    array(
                        'field' => 'return_date',
                        'label' => 'return_date'
                    ),
                    array(
                        'field' => 'return_delay_fine',
                        'label' => 'return_delay_fine'
                    ),
                    array(
                        'field' => 'book_return_condition',
                        'label' => 'book_return_condition'
                    ),
                    array(
                        'field' => 'book_lost_fine',
                        'label' => 'book_lost_fine'
                    ),
                    array(
                        'field' => 'remarks',
                        'label' => 'remarks'
                    ),
                    array(
                        'field' => 'user_type',
                        'label' => 'user_type',
                        'rules' => 'required'
                    ),
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run()):

                    $data['data'] = $this->input->post();
                    $result = $this->book_assign->save($data['data']);

                    if ($result >= 1):
                        $this->session->set_flashdata('success', 'Record successfully saved!');
                        redirect(base_url('book-assigns'));
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            endif;
            $data['bledger_id_list'] = $this->book_assign->get_book_ledgers_options('isbn_no','bledger_id');
            $data['member_id_list'] = $this->book_assign->get_library_members_options('card_no', 'member_id');
            $data['member_id_list'][''] = "Select Card Number";
            /*
             * @TODO : Fetch list from the database column comments. For book_return_condition_list and user_type_list.
             */
            $data['book_return_condition_list'] = array('ok' => 'Good',
                                                    'damaged' => 'Damaged',
                                                    'lost' => 'Lost');
            $data['user_type_list'] = array('student' => 'Student','staff' => 'Staff');
            $this->layout->data = $data;
            $this->layout->render();
        }else{
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * Edit Method
     * 
     * @param   $bassign_id=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function edit($bassign_id = null) {
        if($this->rbac->has_permission('MANAGE_BOOK_ASSIGNS', 'EDIT')){
            $this->scripts_include->includePlugins(array('jq_validation', 'bs_datepicker'), 'js');
            $this->scripts_include->includePlugins(array('bs_datepicker'), 'css');
            $this->breadcrumbs->push('edit', '/library/book_assigns/edit');

            $this->layout->navTitle = 'Book assign edit';
            $data = array();
            if ($this->input->post()):
                $data['data'] = $this->input->post();
                $config = array(
                    array(
                        'field' => 'bledger_id',
                        'label' => 'bledger_id',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'member_id',
                        'label' => 'member_id',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'issue_date',
                        'label' => 'issue_date',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'due_date',
                        'label' => 'due_date'
                    ),
                    array(
                        'field' => 'return_date',
                        'label' => 'return_date',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'return_delay_fine',
                        'label' => 'return_delay_fine'
                    ),
                    array(
                        'field' => 'book_return_condition',
                        'label' => 'book_return_condition'
                    ),
                    array(
                        'field' => 'book_lost_fine',
                        'label' => 'book_lost_fine'
                    ),
                    array(
                        'field' => 'remarks',
                        'label' => 'remarks'
                    ),
                    array(
                        'field' => 'user_type',
                        'label' => 'user_type',
                        'rules' => 'required'
                    ),
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run()):
                    $result = $this->book_assign->update($data['data']);
                    if ($result >= 1):
                        $this->session->set_flashdata('success', 'Record successfully updated!');
                        redirect('/library/book_assigns');
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            else:
                $bassign_id = c_decode($bassign_id);
                $result = $this->book_assign->get_book_assign(null, array('bassign_id' => $bassign_id));
                if ($result):
                    $result = current($result);
                endif;
                $data['data'] = $result;
            endif;
            $data['bledger_id_list'] = $this->book_assign->get_book_ledgers_options('isbn_no','bledger_id');
            $data['member_id_list'] = $this->book_assign->get_library_members_options('card_no', 'member_id');
            /*
             * @TODO : Fetch list from the database column comments. For book_return_condition_list and user_type_list.
             */
            $data['book_return_condition_list'] = array('ok' => 'Good',
                                                    'damaged' => 'Damaged',
                                                    'lost' => 'Lost');
            $data['user_type_list'] = array('student' => 'Student','staff' => 'Staff');
            $this->layout->data = $data;
            $this->layout->render();
        }else{
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * View Method
     * 
     * @param   $bassign_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function view($bassign_id) {
        if ($this->rbac->has_permission('MANAGE_BOOK_ASSIGNS', 'VIEW')) {
            $this->breadcrumbs->push('view', '/library/book_assigns/view');

            $data = array();
            if ($bassign_id):
                $bassign_id = c_decode($bassign_id);

                $this->layout->navTitle = 'Book assign view';
                $result = $this->book_assign->get_book_assign(null, array('bassign_id' => $bassign_id), 1);
                if ($result):
                    $result = current($result);
                endif;

                $data['data'] = $result;
                $this->layout->data = $data;
                $this->layout->render();

            endif;
            return 0;
        }else{
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * Delete Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function delete() {
        if ($this->input->is_ajax_request()):
            if ($this->rbac->has_permission('MANAGE_BOOK_ASSIGNS', 'DELETE')) {
                $bassign_id = $this->input->post('bassign_id');
                if ($bassign_id):
                    $bassign_id = c_decode($bassign_id);

                    $result = $this->book_assign->delete($bassign_id);
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
            }else{
                $this->layout->render(array('error' => '401'));
            }
        else:
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        endif;
        return 'Invalid request type.';
    }
    
    public function add_member() {
        //print_r($_POST);
        $data['data'] = array(
            'card_no' => $this->input->post('card_no'),
            'user_id' => $this->input->post('user_id'),
            'expiry_date' => $this->input->post('expiry_date'),
            'date_issue' => date('Y-m-d')
        );
        $result = $this->book_assign->enroll_member($data['data']);
        echo $result;
    }
    
    public function isbn_status() {
        $bledger_id = $this->input->post('bledger_id');
        $count = $this->book_assign->isbn_status($bledger_id);
        if ($count > 0) {
            echo 'false';
        } else {
            echo 'true';
        }
    }
}

?>