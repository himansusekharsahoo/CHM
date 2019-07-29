<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Book_assignment
 *
 * @author Shivaraj
 */
class Book_assignment extends CI_Controller {

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

        $this->load->model('book_assignments');
        $this->load->model('library_user');
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
            $this->breadcrumbs->push('index', '/library/book_assignment/index');
            $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'css');
            $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'js');
            $this->layout->navTitle = 'Book assign list';
            $this->layout->title = 'Book assign list';
            $header = array(
                array(
                    'db_column' => 'isbn_no',
                    'name' => 'isbn_no',
                    'title' => 'ISBN',
                    'class_name' => 'ledger_id',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'card_no',
                    'name' => 'card_no',
                    'title' => 'Card number',
                    'class_name' => 'card_no',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'issue_date',
                    'name' => 'issue_date',
                    'title' => 'Issue date',
                    'class_name' => 'issue_date',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'due_date',
                    'name' => 'due_date',
                    'title' => 'Due date',
                    'class_name' => 'due_date',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'return_date',
                    'name' => 'return_date',
                    'title' => 'Return date',
                    'class_name' => 'return_date',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'return_delay_fine',
                    'name' => 'return_delay_fine',
                    'title' => 'Delay fine',
                    'class_name' => 'return_delay_fine',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'book_return_condition',
                    'name' => 'book_return_condition',
                    'title' => 'Book condition',
                    'class_name' => 'book_return_condition',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'remarks',
                    'name' => 'Remarks',
                    'title' => 'Remarks',
                    'class_name' => 'remarks',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'user_type',
                    'name' => 'user_type',
                    'title' => 'User type',
                    'class_name' => 'user_type',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'Action',
                    'name' => 'Action',
                    'title' => 'Action',
                    'class_name' => 'action',
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
                $returned_list = $this->book_assignments->get_book_assign_datatable($data);
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
                    'dt_url' => base_url('library/book_assignment/index'),
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
        } else {
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
                $tableHeading = array(
                    'isbn_no' => 'ISBN',
                    'card_no' => 'Card number',
                    'issue_date' => 'Issue date',
                    'due_date' => 'Due date',
                    'return_date' => 'Return date',
                    'return_delay_fine' => 'Delay fine',
                    'book_return_condition' => 'Book condition',
                    'remarks' => 'remarks',
                    'user_type' => 'user_type'
                );
                $data = $this->book_assignments->get_book_assign_datatable(null, true);
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
            } else {
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
            $this->scripts_include->includePlugins(array('jq_validation', 'bs_datepicker', 'jq_typehead', 'datatable'), 'js');
            $this->scripts_include->includePlugins(array('bs_datepicker', 'jq_typehead', 'datatable'), 'css');
            $this->breadcrumbs->push('create', '/library/book_assignment/create');

            $this->layout->navTitle = 'Book assignment';
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
                    $result = $this->book_assignments->save($data['data']);

                    if ($result >= 1):
                        $this->session->set_flashdata('success', 'Record successfully saved!');
                        redirect(base_url('book-assigns'));
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            endif;
            $data['bledger_id_list'] = $this->book_assignments->get_book_ledgers_options('isbn_no', 'bledger_id');
            $data['member_id_list'] = $this->book_assignments->get_library_members_options('card_no', 'member_id');
            $data['member_id_list'][''] = "Select Card Number";
            /*
             * @TODO : Fetch list from the database column comments. For book_return_condition_list and user_type_list.
             */
            $data['book_return_condition_list'] = array('ok' => 'Good',
                'damaged' => 'Damaged',
                'lost' => 'Lost');
            $data['user_type_list'] = array('student' => 'Student', 'staff' => 'Staff');
            $this->layout->data = $data;
            $this->layout->render();
        }else {
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
        if ($this->rbac->has_permission('MANAGE_BOOK_ASSIGNS', 'EDIT')) {
            $this->scripts_include->includePlugins(array('jq_validation', 'bs_datepicker'), 'js');
            $this->scripts_include->includePlugins(array('bs_datepicker'), 'css');
            $this->breadcrumbs->push('edit', '/library/book_assignment/edit');

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
                    $result = $this->book_assignments->update($data['data']);
                    if ($result >= 1):
                        $this->session->set_flashdata('success', 'Record successfully updated!');
                        redirect('/library/book_assignment');
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            else:
                $bassign_id = c_decode($bassign_id);
                $result = $this->book_assignments->get_book_assign(null, array('bassign_id' => $bassign_id));
                if ($result):
                    $result = current($result);
                endif;
                $data['data'] = $result;
            endif;
            $data['bledger_id_list'] = $this->book_assignments->get_book_ledgers_options('isbn_no', 'bledger_id');
            $data['member_id_list'] = $this->book_assignments->get_library_members_options('card_no', 'member_id');
            /*
             * @TODO : Fetch list from the database column comments. For book_return_condition_list and user_type_list.
             */
            $data['book_return_condition_list'] = array('ok' => 'Good',
                'damaged' => 'Damaged',
                'lost' => 'Lost');
            $data['user_type_list'] = array('student' => 'Student', 'staff' => 'Staff');
            $this->layout->data = $data;
            $this->layout->render();
        }else {
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
            $this->breadcrumbs->push('view', '/library/book_assignment/view');

            $data = array();
            if ($bassign_id):
                $bassign_id = c_decode($bassign_id);

                $this->layout->navTitle = 'Book assign view';
                $result = $this->book_assignments->get_book_assign(null, array('bassign_id' => $bassign_id), 1);
                if ($result):
                    $result = current($result);
                endif;

                $data['data'] = $result;
                $this->layout->data = $data;
                $this->layout->render();

            endif;
            return 0;
        }else {
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

                    $result = $this->book_assignments->delete($bassign_id);
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
            }else {
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
        $result = $this->book_assignments->enroll_member($data['data']);
        echo $result;
    }

    public function isbn_status() {
        $bledger_id = $this->input->post('bledger_id');
        $count = $this->book_assignments->isbn_status($bledger_id);
        if ($count > 0) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    /**
     * @param  : 
     * @desc   : display library user details after typehead dropdown selections
     * @return :
     * @author : Shiv
     * @created: 14-April-2019
     */
    public function show_search_user_details() {
        if ($this->input->is_ajax_request()) {
            $search_user_id = $this->input->post('user_id');
            $show_columns = array(
                'name' => 'Name',
                'email' => 'Email',
                'mobile' => 'Mobile',
                'card_no' => 'Card Number',
                'user_status' => 'Status'
            );
            $condition = " and user_id=$search_user_id";
            $user_details = $this->library_user->searched_user_details($condition);
            foreach ($user_details as $key => $rec) {
                $assigned_book_info = $this->book_assignments->get_total_assign_books_data_by_member($rec['member_id']);
                $markup = "<div class='col-sm-12'>
                                <div class='box box-widget widget-user-2 box-border'>
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class='widget-user-header bg-green'>
                                        <div class='widget-user-image'>";
                $photo = '';
                if ($rec['student_photo']) {
                    $photo = $rec['student_photo'];
                }
                if ($photo) {
                    $markup .= "<img class='img-circle' src='$photo'>";
                } else {
                    $markup .= "<span class='img-circle fa fa-user fa-3x' style='float:left;'></span>";
                }
                $markup .= "</div>
                          <!-- /.widget-user-image -->
                          <h3 class='widget-user-username'>" . $rec['first_name'] . " " . $rec['last_name'] . "</h3>
                           </div>
                                    <div class='box-footer no-padding'>
                                        <table class='table table-bordered'>";
                $markup .= '<tr><td><i class="fa fa-envelope-o"></i> <a  href="mailto:' . $rec['email'] . '">' . $rec['email'] . '</a></td><td><i class="fa fa-mobile-phone"></i> ' . $rec['mobile'] . '</td></tr>';
                if ($key == 'card_no') {
                    if ($rec['card_no'] == '' || strlen(trim($rec['card_no'])) == 0) {
                        $markup .= "<tr>
                                        <td colspan=2>
                                            <i class='fa fa-credit-card'></i> Card No: <a href='create-library-user' class='btn btn-xs btn-primary'>Generate Card</a>
                                            </div>
                                        </td>
                                    </tr> ";
                    } else {
                        $markup .= "<tr>
                                        <td colspan=2>
                                            <i class='fa fa-credit-card'></i> Card No: " . $rec['card_no'] . "
                                                    <a href='#' id='print_library_card' data-id='" . c_encode($rec['member_id']) . "'>
                                                        <i class='glyphicon glyphicon-print text-primary'></i></a>
                                            </div>
                                        </td>
                                    </tr> ";
                    }
                }
                if ($key == 'user_status' && $rec['user_status'] == 'inactive') {
                    $markup .= "<tr class='nav_search_user_li'>
                                    <td colspan=2>
                                        <div class='col-sm-12 no_pad'>
                                            <span class='col-sm-8'> User is " . $rec['user_status'] . " <span class='text-danger'>[Please contact Site Admin]</span></span>
                                        </div>
                                    </td>
                                </tr> ";
                }
                $markup .= "<tr><td>Total no.of books issues:</td><td>$assigned_book_info</td></tr>";
                $markup .= "</table>
                                        <br>
                                        <div class='col-sm-12'>";
                $markup .= "
                                        </div>

                                    </div>
                                </div>
                            </div>";
            }
            echo $markup;
            exit;
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @param  : 
     * @desc   : display library user details after typehead dropdown selections
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function show_search_user_details_old() {
        if ($this->input->is_ajax_request()) {
            $search_user_id = $this->input->post('user_id');
            $show_columns = array(
                'name' => 'Name',
                'email' => 'Email',
                'mobile' => 'Mobile',
                'card_no' => 'Card Number',
                'user_status' => 'Status'
            );
            $condition = " and user_id=$search_user_id";
            $user_details = $this->library_user->searched_user_details($condition);
            foreach ($user_details as $rec) {
                $markup = "<div class='col-sm-12'>
                                <div class='box box-widget widget-user-2 box-border'>
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class='widget-user-header bg-green'>
                                        <div class='widget-user-image'>";
                $photo = '';
                if ($rec['student_photo']) {
                    $photo = $rec['student_photo'];
                }
                if ($photo) {
                    $markup .= "<img class='img-circle' src='$photo'>";
                } else {
                    $markup .= "<span class='img-circle fa fa-user fa-3x' style='float:left;'></span>";
                }
                $markup .= "</div>
                          <!-- /.widget-user-image -->
                          <h3 class='widget-user-username'>" . $rec['first_name'] . " " . $rec['last_name'] . "</h3>
                           </div>
                                    <div class='box-footer no-padding'>
                                        <ul class='nav nav-stacked'>";
                $save_butn = 1;
                foreach ($show_columns as $db_column => $alias) {
                    if (array_key_exists($db_column, $rec)) {
                        if ($db_column == 'user_status' && $rec[$db_column] == 'inactive') {
                            $save_butn = 0;
                            $markup .= "<li class='nav_search_user_li'>
                                                <div class='col-sm-12 no_pad'>
                                                    <span class='col-sm-4'>$alias</span>
                                                    <span class='col-sm-8'>" . $rec[$db_column] . " <span class='text-danger'>[Please contact Site Admin]</span></span>
                                                </div>
                                            </li> ";
                        } else if ($db_column == 'card_no') {
                            if ($rec[$db_column] == '' || strlen(trim($rec[$db_column])) == 0) {
                                $markup .= "<li class='nav_search_user_li'>
                                                <div class='col-sm-12 no_pad'>
                                                    <span class='col-sm-4'>$alias</span>
                                                    <span class='col-sm-8'><a href='create-library-user' class='btn btn-xs btn-primary'>Generate Card</a></span>
                                                </div>
                                            </li> ";
                            } else {
                                $markup .= "<li class='nav_search_user_li'>
                                                <div class='col-sm-12 no_pad'>
                                                    <span class='col-sm-4'>$alias</span>
                                                    <span class='col-sm-8'>" . $rec[$db_column] . "
                                                         <a href='#' id='print_library_card' data-id='" . c_encode($rec['member_id']) . "'>
                                                         <i class='glyphicon glyphicon-print text-primary'></i></a></span>
                                                </div>
                                            </li> ";
                            }
                        } else {
                            $markup .= "<li class='nav_search_user_li'>
                                                <div class='col-sm-12 no_pad'>
                                                    <span class='col-sm-4'>$alias</span>
                                                    <span class='col-sm-8'>" . $rec[$db_column] . "</span>
                                                </div>
                                            </li> ";
                        }
                    }
                }

                $markup .= "</ul>
                                        <br>
                                        <div class='col-sm-12'>";
                $markup .= "
                                        </div>

                                    </div>
                                </div>
                            </div>";
            }
            echo $markup;
            exit;
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    function search_book_details() {
        if ($this->input->is_ajax_request()) {
            $search_text = $this->input->post('search_text');
            $result = $this->book_assignments->get_book_details($search_text);
            echo json_encode(array(
                "status" => true,
                "error" => null,
                "data" => $result
            ));
            exit;
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    function assign_book() {
        $return_book_after_days = $this->rbac->get_app_config_item('library/role_config/default/return_book_after_days');
        $return_book_after_days = (string) $return_book_after_days[0];
        $return_book_after_days = explode(',', $return_book_after_days);

        $days = (isset($return_book_after_days[0])) ? $return_book_after_days[0] : 5; //return days

        $book_ledger_id = $this->input->post('ledger_id');
        $user_id = $this->input->post('user_id');
        $book_copy_id = $this->input->post('book_copy_id');
        $issue_date = date('Y-m-d h:m:s');
        $due_date = date('Y-m-d H:i:s', strtotime("+$days day", time()));
        $this->db->trans_start();
        $member_id = $this->book_assignments->get_member_id_user($user_id);
        if (empty($member_id)) {
            echo json_encode(array('status' => false));
            exit;
        }

        $count = $this->book_assignments->check_if_same_book_assigned($book_ledger_id, $member_id);
        if ($count > 0) {
            echo json_encode(array('status' => false, 'msg' => 'Same book is assigned for the member.'));
            exit;
        }
        $current_coppies_count = $this->book_assignments->check_currently_available_books($book_ledger_id);
        if ($current_coppies_count == 0) {
            echo json_encode(array('status' => false, 'msg' => 'Book is not available in stock.'));
            exit;
        }
        $book_data = array(
            'bledger_id' => $book_ledger_id,
            'member_id' => $member_id,
            'book_copy_id' => $book_copy_id,
            'issue_date' => $issue_date,
            'due_date' => $due_date,
            'return_date' => NULL
        );

        $this->book_assignments->store_book_assignment_info($book_data);
        $this->book_assignments->update_current_copies($book_ledger_id);
        $this->book_assignments->update_book_availability($book_copy_id);
        $this->db->trans_complete();
        if ($this->db->trans_status()) {
            echo json_encode(array('status' => true, 'msg' => 'Book is assigned successfully'));
        } else {
            echo json_encode(array('status' => false, 'msg' => 'Error occurred please try again'));
        }
    }

    function fetch_books_list() {
        $input_array = array();
        $input_array['bledger_id'] = $this->input->post('bledger_id');
        $input_array['start'] = $this->input->post('start');
        $input_array['length'] = $this->input->post('length');
        $input_array['order'] = $this->input->post('order');
        $data = $this->book_assignments->get_books_list($input_array);
        $response = array("recordsTotal" => $data['total_rows'], "recordsFiltered" => $data['found_rows'], 'data' => $data['data']);
        echo json_encode($response);
    }

    function return_borrowed_books() {
        $is_updated = $this->book_returns->return_borrowed_book($this->input->post());
        if ($is_updated) {
            echo json_encode(array('status' => TRUE));
        } else {
            echo json_encode(array('status' => FALSE));
        }
    }

}
