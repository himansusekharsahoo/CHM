<?php

/**
 * Student_users Class File
 * PHP Version 7.1.1
 * 
 * @category   Student
 * @package    Student
 * @subpackage Student_users
 * @class      Student_users
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Student_users Class
 * 
 * @category   Student
 * @package    Student
 * @class      Student_users
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Student_users extends CI_Controller {

    /**
     * __construct Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('student_user');
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
     * @since   10/28/2018
     */
    public function index() {

        $this->breadcrumbs->push('index', '/student/student_users/index');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'css');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'js');
        $this->layout->navTitle = 'Student user list';
        $this->layout->title = 'Student user list';
        $header = array(
            array(
                'db_column' => 'first_name',
                'name' => 'First_name',
                'title' => 'First_name',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'last_name',
                'name' => 'Last_name',
                'title' => 'Last_name',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'login_id',
                'name' => 'Login_id',
                'title' => 'Login_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'email',
                'name' => 'Email',
                'title' => 'Email',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'password',
                'name' => 'Password',
                'title' => 'Password',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'temp_registration_no',
                'name' => 'Temp_registration_no',
                'title' => 'Temp_registration_no',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'registration_no',
                'name' => 'Registration_no',
                'title' => 'Registration_no',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'login_status',
                'name' => 'Login_status',
                'title' => 'Login_status',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'mobile',
                'name' => 'Mobile',
                'title' => 'Mobile',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'mobile_verified',
                'name' => 'Mobile_verified',
                'title' => 'Mobile_verified',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'email_verified',
                'name' => 'Email_verified',
                'title' => 'Email_verified',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'created',
                'name' => 'Created',
                'title' => 'Created',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'modified',
                'name' => 'Modified',
                'title' => 'Modified',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'created_by',
                'name' => 'Created_by',
                'title' => 'Created_by',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'modified_by',
                'name' => 'Modified_by',
                'title' => 'Modified_by',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'status',
                'name' => 'Status',
                'title' => 'Status',
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
            'btn_href' => base_url('student/student_users/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $grid_buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('student/student_users/edit'),
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
            'attr' => 'data-user_id="$1"'
        );
        $button_set = get_link_buttons($grid_buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = $this->student_user->get_student_user_datatable($data);
            echo $returned_list;
            exit();
        }

        $dt_tool_btn = array(
            array(
                'btn_class' => 'btn-primary',
                'btn_href' => base_url('student/student_users/create'),
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
                'dt_url' => base_url('student/student_users/index'),
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
    }

    /**
     * Export_grid_data Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function export_grid_data() {
        if ($this->input->is_ajax_request()):
            $export_type = $this->input->post('export_type');
            $tableHeading = array('first_name' => 'first_name', 'last_name' => 'last_name', 'login_id' => 'login_id', 'email' => 'email', 'password' => 'password', 'temp_registration_no' => 'temp_registration_no', 'registration_no' => 'registration_no', 'login_status' => 'login_status', 'mobile' => 'mobile', 'mobile_verified' => 'mobile_verified', 'email_verified' => 'email_verified', 'created' => 'created', 'modified' => 'modified', 'created_by' => 'created_by', 'modified_by' => 'modified_by', 'status' => 'status',);
            $cols = 'first_name,last_name,login_id,email,password,temp_registration_no,registration_no,login_status,mobile,mobile_verified,email_verified,created,modified,created_by,modified_by,status';
            $data = $this->student_user->get_student_user_datatable(null, true, $tableHeading);
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
            $worksheet_name = 'student_users';
            $file_name = 'student_users' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
    }

    /**
     * Create Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function create() {
        $this->breadcrumbs->push('create', '/student/student_users/create');

        $this->layout->navTitle = 'Student user create';
        $data = array();
        if ($this->input->post()):
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
                    'field' => 'temp_registration_no',
                    'label' => 'temp_registration_no',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'registration_no',
                    'label' => 'registration_no',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'login_status',
                    'label' => 'login_status',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'mobile',
                    'label' => 'mobile',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'mobile_verified',
                    'label' => 'mobile_verified',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'email_verified',
                    'label' => 'email_verified',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):

                $data['data'] = $this->input->post();
                $result = $this->student_user->save($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('/student/student_users');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        endif;
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * Edit Method
     * 
     * @param   $user_id=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function edit($user_id = null) {
        $this->breadcrumbs->push('edit', '/student/student_users/edit');

        $this->layout->navTitle = 'Student user edit';
        $data = array();
        if ($this->input->post()):
            $data['data'] = $this->input->post();
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
                    'field' => 'temp_registration_no',
                    'label' => 'temp_registration_no',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'registration_no',
                    'label' => 'registration_no',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'login_status',
                    'label' => 'login_status',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'mobile',
                    'label' => 'mobile',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'mobile_verified',
                    'label' => 'mobile_verified',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'email_verified',
                    'label' => 'email_verified',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):
                $result = $this->student_user->update($data['data']);
                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully updated!');
                    redirect('/student/student_users');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        else:
            $user_id = c_decode($user_id);
            $result = $this->student_user->get_student_user(null, array('user_id' => $user_id));
            if ($result):
                $result = current($result);
            endif;
            $data['data'] = $result;
        endif;
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * View Method
     * 
     * @param   $user_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function view($user_id) {
        $this->breadcrumbs->push('view', '/student/student_users/view');

        $data = array();
        if ($user_id):
            $user_id = c_decode($user_id);

            $this->layout->navTitle = 'Student user view';
            $result = $this->student_user->get_student_user(null, array('user_id' => $user_id), 1);
            if ($result):
                $result = current($result);
            endif;

            $data['data'] = $result;
            $this->layout->data = $data;
            $this->layout->render();

        endif;
        return 0;
    }

    /**
     * Delete Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function delete() {
        if ($this->input->is_ajax_request()):
            $user_id = $this->input->post('user_id');
            if ($user_id):
                $user_id = c_decode($user_id);

                $result = $this->student_user->delete($user_id);
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
        return 'Invalid request type.';
    }

}

?>