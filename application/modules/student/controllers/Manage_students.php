<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Manage_studnts
 * @desc    :
 * @author  : HimansuS
 * @created :10/08/2018
 */
class Manage_students extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('manage_student');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * @param  : 
     * @desc   : redirect to student list page
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function index() {
        if ($this->rbac->has_permission('STUDENT_USERS', 'LIST')) {
            $this->breadcrumbs->push('index', base_url('student-list'));
            $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'css');
            $this->scripts_include->includePlugins(array('datatable', 'chosen'), 'js');
            $this->layout->navTitle = 'Student list';
            $this->layout->title = 'Student list';
            $header = array(
                array(
                    'db_column' => 'first_name',
                    'name' => 'First_name',
                    'title' => 'First name',
                    'class_name' => 'first_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true',
                    'data' => 'function (item) {return myApp.CommonMethod.ucFirst(item[0]);}'
                ), array(
                    'db_column' => 'last_name',
                    'name' => 'Last_name',
                    'title' => 'Last name',
                    'class_name' => 'last_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true',
                    'data' => 'function (item) {return myApp.CommonMethod.ucFirst(item[1]);}'
                ), array(
                    'db_column' => 'login_id',
                    'name' => 'Login_id',
                    'title' => 'Login id',
                    'class_name' => 'login_id',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'email',
                    'name' => 'Email',
                    'title' => 'Email',
                    'class_name' => 'email',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'login_status',
                    'name' => 'Login_status',
                    'title' => 'Login status',
                    'class_name' => 'login_status',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true',
                    'data' => 'function (item) {return myApp.CommonMethod.ucFirst(item[4]);}'
                ), array(
                    'db_column' => 'mobile',
                    'name' => 'Mobile',
                    'title' => 'Mobile',
                    'class_name' => 'mobile',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'mobile_verified',
                    'name' => 'Mobile_verified',
                    'title' => 'Mobile verified',
                    'class_name' => 'mobile_verified',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true',
                    'data' => 'function (item) {return myApp.CommonMethod.ucFirst(item[6]);}'
                ), array(
                    'db_column' => 'email_verified',
                    'name' => 'email_verified',
                    'title' => 'Email verified',
                    'class_name' => 'email_verified',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true',
                    'data' => 'function (item) {return myApp.CommonMethod.ucFirst(item[7]);}'
                ), array(
                    'db_column' => 'status',
                    'name' => 'Status',
                    'title' => 'Status',
                    'class_name' => 'status',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true',
                    'data' => 'function (item) {return myApp.CommonMethod.ucFirst(item[8]);}'
                ), array(
                    'db_column' => 'Action',
                    'name' => 'Action',
                    'title' => 'Action',
                    'class_name' => 'Action',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'false'
                )
            );
            $data = $grid_buttons = array();
            if ($this->rbac->has_permission('STUDENT_USERS', 'VIEW')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-info',
                    'btn_href' => base_url('view-student-profile'),
                    'btn_icon' => 'fa-eye',
                    'btn_title' => 'view record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
            }
            if ($this->rbac->has_permission('STUDENT_USERS', 'EDIT')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('edit-student-profile'),
                    'btn_icon' => 'fa-pencil',
                    'btn_title' => 'edit record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
            }
            if ($this->rbac->has_permission('STUDENT_USERS', 'DELETE')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-danger delete-record',
                    'btn_href' => '#',
                    'btn_icon' => 'fa-remove',
                    'btn_title' => 'delete record',
                    'btn_separator' => '',
                    'param' => array('$1'),
                    'style' => '',
                    'attr' => 'data-user_id="$1"'
                );
            }

            $button_set = get_link_buttons($grid_buttons);
            $data['button_set'] = $button_set;

            if ($this->input->is_ajax_request()) {
                $returned_list = $this->manage_student->get_student_datatable($data);
                echo $returned_list;
                exit();
            }
            $dt_tool_btn = array();
            if ($this->rbac->has_permission('STUDENT_USERS', 'CREATE')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('create-student-profile'),
                    'btn_icon' => '',
                    'btn_title' => 'Create',
                    'btn_text' => 'Create',
                    'btn_separator' => ' '
                );
            }
            if ($this->rbac->has_permission('STUDENT_USERS', 'XLS_EXPORT')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-warning',
                    'btn_href' => '#',
                    'btn_icon' => '',
                    'btn_title' => 'XLS',
                    'btn_text' => '<span class="fa fa-file-excel-o"></span> Excel',
                    'btn_separator' => ' ',
                    'attr' => 'id="export_table_xls"'
                );
            }
            if ($this->rbac->has_permission('STUDENT_USERS', 'CSV_EXPORT')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-info',
                    'btn_href' => '#',
                    'btn_icon' => '',
                    'btn_title' => 'CSV',
                    'btn_text' => '<span class="fa fa-file-text-o"></span> CSV',
                    'btn_separator' => ' ',
                    'attr' => 'id="export_table_csv"'
                );
            }

            $dt_tool_btn = get_link_buttons($dt_tool_btn);

            $config = array(
                'dt_markup' => true,
                'dt_id' => 'raw_cert_data_dt_table',
                'dt_header' => $header,
                'dt_ajax' => array(
                    'dt_url' => base_url('student-list'),
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
     * @param              : 
     * @desc               :used to export grid data
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function export_grid_data() {
        if ($this->input->is_ajax_request()) {
            if ($this->rbac->has_permission('STUDENT_USERS', 'XLS_EXPORT') || $this->rbac->has_permission('STUDENT_USERS', 'CSV_EXPORT')) {
                $export_type = $this->input->post('export_type');
                $tableHeading = array('first_name' => 'first_name', 'last_name' => 'last_name', 'login_id' => 'login_id', 'email' => 'email', 'login_status' => 'login_status', 'mobile' => 'mobile', 'mobile_verified' => 'mobile_verified', 'email_verified' => 'email_verified', 'status' => 'status',);

                $data = $this->manage_student->get_student_datatable(null, true, $tableHeading);
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
                $worksheet_name = 'student profiles';
                $file_name = 'student_profiles' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
                $this->layout->render(array('error' => '401'));
            }
        } else {
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        }
    }

    /**
     * @param              : 
     * @desc               :
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function create() {
        if ($this->rbac->has_permission('STUDENT_USERS', 'CREATE')) {
            $this->breadcrumbs->push('create', base_url('create-student-profile'));
            $this->layout->navTitle = 'Add new student';
            $this->layout->title = 'Add new student';
            $this->scripts_include->includePlugins(array('jq_validation','pass_meter'), 'js');
            $user_id = $this->rbac->get_user_id();
            $data = array();
            if ($this->input->post()) :
                $data['data'] = $post_data = $this->input->post();
                $config = array(
                    array(
                        'field' => 'first_name',
                        'label' => 'first_name',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'last_name',
                        'label' => 'last_name',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'login_id',
                        'label' => 'login_id',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'password',
                        'label' => 'password',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'mobile',
                        'label' => 'mobile',
                        'rules' => 'required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run()) :
                    $post_data['created_by'] = $user_id;
                    unset($data['data']['re_password'], $post_data['submit']);
                    $result = $this->manage_student->save($post_data);
                    if ($result):
                        $this->session->set_flashdata('success', 'Record successfully saved!');
                        redirect(base_url('student-list'));
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            endif;
            $this->layout->data = $data;
            $this->layout->render();
        }else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @param              : $user_id=null
     * @desc               : edit student profile
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function edit($user_id = null) {
        if ($this->rbac->has_permission('STUDENT_USERS', 'EDIT')) {
            $this->breadcrumbs->push('edit', base_url('edit-student-profile'));
            $this->scripts_include->includePlugins(array('jq_validation','pass_meter'), 'js');
            $this->layout->navTitle = 'Edit student profile';
            $this->layout->title = 'Edit student profile';
            $data = array();
            if ($this->input->post()) :
                $data['data'] = $post_data = $this->input->post();
                $config = array(
                    array(
                        'field' => 'first_name',
                        'label' => 'first_name',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'last_name',
                        'label' => 'last_name',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'mobile',
                        'label' => 'mobile',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'login_id',
                        'label' => 'login_id',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Please enter registration id'
                        )
                    )
                );
                $this->form_validation->set_rules($config);
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

                if ($this->form_validation->run()) :
                    $condition = " AND user_id!='" . $post_data['user_id'] . "'AND replace(lower(email),' ','')=replace(lower('" . $post_data['email'] . "'),' ','')";
                    if (!$this->manage_student->check_duplicate($condition)) :
                        $condition = " AND user_id!='" . $post_data['user_id'] . "'AND replace(lower(login_id),' ','')=replace(lower('" . $post_data['login_id'] . "'),' ','')";
                        if (!$this->manage_student->check_duplicate($condition)) :
                            $result = $this->manage_student->update($data['data']);
                            if ($result >= 1):
                                $this->session->set_flashdata('success', 'Record successfully updated!');
                                redirect('student-list');
                            else:
                                $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                            endif;
                        else:
                            $this->session->set_flashdata('error', 'Registeration id is already exists, Please try another!');
                        endif;

                    else:
                        $this->session->set_flashdata('error', 'Email id is already exists, Please try another!');
                    endif;

                endif;
            else:
                $user_id = c_decode($user_id);
                $result = $this->manage_student->get_student_data(null, array('user_id' => $user_id));

                if ($result) :
                    $result = current($result);
                endif;
                $data['data'] = $result;
            endif;
            $this->layout->data = $data;
            $this->layout->render();
        }else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @param              : $user_id
     * @desc               : view student profile
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function view($user_id) {
        if ($this->rbac->has_permission('STUDENT_USERS', 'VIEW')) {
            $this->breadcrumbs->push('view', base_url('view-student-profile'));
            $this->layout->navTitle = 'Student profile';
            $this->layout->title = 'Student profile';
            $data = array();
            if ($user_id) :
                $user_id = c_decode($user_id);
                $result = $this->manage_student->get_student_data(null, array('user_id' => $user_id), 1);
                if ($result) :
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
     * @param              : 
     * @desc               : delete a student
     * @return             :
     * @author             :
     * @created:10/08/2018
     */
    public function delete() {
        if ($this->input->is_ajax_request()) {
            if ($this->rbac->has_permission('STUDENT_USERS', 'DELETE')) {
                $user_id = $this->input->post('user_id');
                if ($user_id) :
                    $user_id = c_decode($user_id);
                    $result = $this->manage_student->delete($user_id);
                    if ($result) :
                        echo 1;
                        exit();
                    else:
                        echo 'Data deletion error !';
                        exit();
                    endif;
                endif;
                echo 'No data found to delete';
                exit();
            } else {
                $this->layout->render(array('error' => '401'));
            }
        } else {
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        }
        return 'Invalid request type.';
    }

    /**
     * 
     * @method
     * @param   
     * @desc    used to reset student user password
     * @return 
     * @author  HimansuS                  
     * @since   
     */
    public function reset_student_password() {
        if ($this->input->is_ajax_request()) {            
            $user_id = c_decode($this->input->post('uid'));
            $new_pass = $this->input->post('npassword');
            
            $condition = array('user_id' => $user_id);
            if ($this->manage_student->update_student_password($condition, $new_pass)) {                
                echo json_encode(array('status' => 'success', 'title' => 'Reset Student Password', 'message' => 'Password successfully updated!'));
            } else {
                echo json_encode(array('status' => 'error', 'title' => 'Reset Student Password', 'message' => 'There is some error, Please refresh the page and try again!'));
            }
            exit;
        } else {
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        }
    }
}
