<?php

/**
 * Student_profiles Class File
 * PHP Version 7.1.1
 * 
 * @category   Student
 * @package    Student
 * @subpackage Student_profiles
 * @class      Student_profiles
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Student_profiles Class
 * 
 * @category   Student
 * @package    Student
 * @class      Student_profiles
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Student_profiles extends CI_Controller {

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

        $this->load->model('student_profile');
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

        $this->breadcrumbs->push('index', '/student/student_profiles/index');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'css');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'js');
        $this->layout->navTitle = 'Student profile list';
        $this->layout->title = 'Student profile list';
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
                'db_column' => 'user_id',
                'name' => 'User_id',
                'title' => 'User_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'course_aca_batch_id',
                'name' => 'Course_aca_batch_id',
                'title' => 'Course_aca_batch_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'course_semister_id',
                'name' => 'Course_semister_id',
                'title' => 'Course_semister_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'photo',
                'name' => 'Photo',
                'title' => 'Photo',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'sign',
                'name' => 'Sign',
                'title' => 'Sign',
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
            'btn_href' => base_url('student/student_profiles/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $grid_buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('student/student_profiles/edit'),
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
            'attr' => 'data-sprofile_id="$1"'
        );
        $button_set = get_link_buttons($grid_buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = $this->student_profile->get_student_profile_datatable($data);
            echo $returned_list;
            exit();
        }

        $dt_tool_btn = array(
            array(
                'btn_class' => 'btn-primary',
                'btn_href' => base_url('student/student_profiles/create'),
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
                'dt_url' => base_url('student/student_profiles/index'),
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
            $tableHeading = array('first_name' => 'first_name', 'last_name' => 'last_name', 'user_id' => 'user_id', 'course_aca_batch_id' => 'course_aca_batch_id', 'course_semister_id' => 'course_semister_id', 'photo' => 'photo', 'sign' => 'sign',);
            $cols = 'first_name,last_name,user_id,course_aca_batch_id,course_semister_id,photo,sign';
            $data = $this->student_profile->get_student_profile_datatable(null, true, $tableHeading);
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
            $worksheet_name = 'student_profiles';
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
        $this->breadcrumbs->push('create', '/student/student_profiles/create');

        $this->layout->navTitle = 'Student profile create';
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
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'course_aca_batch_id',
                    'label' => 'course_aca_batch_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'course_semister_id',
                    'label' => 'course_semister_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'photo',
                    'label' => 'photo',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'sign',
                    'label' => 'sign',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):

                $data['data'] = $this->input->post();
                $result = $this->student_profile->save($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('/student/student_profiles');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        endif;
        $data['user_id_list'] = $this->student_profile->get_student_users_options('user_id', 'user_id');
        $data['course_aca_batch_id_list'] = $this->student_profile->get_course_aca_batch_masters_options('course_aca_batch_id', 'course_aca_batch_id');
        $data['course_semister_id_list'] = $this->student_profile->get_course_semister_master_options('semister_id', 'semister_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * Edit Method
     * 
     * @param   $sprofile_id=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function edit($sprofile_id = null) {
        $this->breadcrumbs->push('edit', '/student/student_profiles/edit');

        $this->layout->navTitle = 'Student profile edit';
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
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'course_aca_batch_id',
                    'label' => 'course_aca_batch_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'course_semister_id',
                    'label' => 'course_semister_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'photo',
                    'label' => 'photo',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'sign',
                    'label' => 'sign',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):
                $result = $this->student_profile->update($data['data']);
                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully updated!');
                    redirect('/student/student_profiles');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        else:
            $sprofile_id = c_decode($sprofile_id);
            $result = $this->student_profile->get_student_profile(null, array('sprofile_id' => $sprofile_id));
            if ($result):
                $result = current($result);
            endif;
            $data['data'] = $result;
        endif;
        $data['user_id_list'] = $this->student_profile->get_student_users_options('user_id', 'user_id');
        $data['course_aca_batch_id_list'] = $this->student_profile->get_course_aca_batch_masters_options('course_aca_batch_id', 'course_aca_batch_id');
        $data['course_semister_id_list'] = $this->student_profile->get_course_semister_master_options('semister_id', 'semister_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * View Method
     * 
     * @param   $sprofile_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function view($sprofile_id) {
        $this->breadcrumbs->push('view', '/student/student_profiles/view');

        $data = array();
        if ($sprofile_id):
            $sprofile_id = c_decode($sprofile_id);

            $this->layout->navTitle = 'Student profile view';
            $result = $this->student_profile->get_student_profile(null, array('sprofile_id' => $sprofile_id), 1);
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
            $sprofile_id = $this->input->post('sprofile_id');
            if ($sprofile_id):
                $sprofile_id = c_decode($sprofile_id);

                $result = $this->student_profile->delete($sprofile_id);
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