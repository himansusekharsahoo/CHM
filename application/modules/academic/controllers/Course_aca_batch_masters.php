<?php

/**
 * Course_aca_batch_masters Class File
 * PHP Version 7.1.1
 * 
 * @category   Academic
 * @package    Academic
 * @subpackage Course_aca_batch_masters
 * @class      Course_aca_batch_masters
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Course_aca_batch_masters Class
 * 
 * @category   Academic
 * @package    Academic
 * @class      Course_aca_batch_masters
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Course_aca_batch_masters extends CI_Controller {

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

        $this->load->model('course_aca_batch_master');
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

        $this->breadcrumbs->push('index', '/academic/course_aca_batch_masters/index');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'css');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'js');
        $this->layout->navTitle = 'Course aca batch master list';
        $this->layout->title = 'Course aca batch master list';
        $header = array(
            array(
                'db_column' => 'name',
                'name' => 'Name',
                'title' => 'Name',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'description',
                'name' => 'Description',
                'title' => 'Description',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'start_year',
                'name' => 'Start_year',
                'title' => 'Start_year',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'end_year',
                'name' => 'End_year',
                'title' => 'End_year',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'terms',
                'name' => 'Terms',
                'title' => 'Terms',
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
                'db_column' => 'created',
                'name' => 'Created',
                'title' => 'Created',
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
                'db_column' => 'course_dept_id',
                'name' => 'Course_dept_id',
                'title' => 'Course_dept_id',
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
            'btn_href' => base_url('academic/course_aca_batch_masters/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $grid_buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('academic/course_aca_batch_masters/edit'),
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
            'attr' => 'data-course_aca_batch_id="$1"'
        );
        $button_set = get_link_buttons($grid_buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = $this->course_aca_batch_master->get_course_aca_batch_master_datatable($data);
            echo $returned_list;
            exit();
        }

        $dt_tool_btn = array(
            array(
                'btn_class' => 'btn-primary',
                'btn_href' => base_url('academic/course_aca_batch_masters/create'),
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
                'dt_url' => base_url('academic/course_aca_batch_masters/index'),
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
            $tableHeading = array('name' => 'name', 'description' => 'description', 'start_year' => 'start_year', 'end_year' => 'end_year', 'terms' => 'terms', 'status' => 'status', 'created' => 'created', 'created_by' => 'created_by', 'course_dept_id' => 'course_dept_id',);
            $cols = 'name,description,start_year,end_year,terms,status,created,created_by,course_dept_id';
            $data = $this->course_aca_batch_master->get_course_aca_batch_master_datatable(null, true, $tableHeading);
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
            $worksheet_name = 'course_aca_batch_masters';
            $file_name = 'course_aca_batch_masters' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
        $this->breadcrumbs->push('create', '/academic/course_aca_batch_masters/create');

        $this->layout->navTitle = 'Course aca batch master create';
        $data = array();
        if ($this->input->post()):
            $config = array(
                array(
                    'field' => 'name',
                    'label' => 'name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'description',
                    'label' => 'description',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'start_year',
                    'label' => 'start_year',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'end_year',
                    'label' => 'end_year',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'terms',
                    'label' => 'terms',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'course_dept_id',
                    'label' => 'course_dept_id',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):

                $data['data'] = $this->input->post();
                $result = $this->course_aca_batch_master->save($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('/academic/course_aca_batch_masters');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        endif;
        $data['course_dept_id_list'] = $this->course_aca_batch_master->get_course_department_masters_options('course_dept_id', 'course_dept_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * Edit Method
     * 
     * @param   $course_aca_batch_id=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function edit($course_aca_batch_id = null) {
        $this->breadcrumbs->push('edit', '/academic/course_aca_batch_masters/edit');

        $this->layout->navTitle = 'Course aca batch master edit';
        $data = array();
        if ($this->input->post()):
            $data['data'] = $this->input->post();
            $config = array(
                array(
                    'field' => 'name',
                    'label' => 'name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'description',
                    'label' => 'description',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'start_year',
                    'label' => 'start_year',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'end_year',
                    'label' => 'end_year',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'terms',
                    'label' => 'terms',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'course_dept_id',
                    'label' => 'course_dept_id',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):
                $result = $this->course_aca_batch_master->update($data['data']);
                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully updated!');
                    redirect('/academic/course_aca_batch_masters');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        else:
            $course_aca_batch_id = c_decode($course_aca_batch_id);
            $result = $this->course_aca_batch_master->get_course_aca_batch_master(null, array('course_aca_batch_id' => $course_aca_batch_id));
            if ($result):
                $result = current($result);
            endif;
            $data['data'] = $result;
        endif;
        $data['course_dept_id_list'] = $this->course_aca_batch_master->get_course_department_masters_options('course_dept_id', 'course_dept_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * View Method
     * 
     * @param   $course_aca_batch_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function view($course_aca_batch_id) {
        $this->breadcrumbs->push('view', '/academic/course_aca_batch_masters/view');

        $data = array();
        if ($course_aca_batch_id):
            $course_aca_batch_id = c_decode($course_aca_batch_id);

            $this->layout->navTitle = 'Course aca batch master view';
            $result = $this->course_aca_batch_master->get_course_aca_batch_master(null, array('course_aca_batch_id' => $course_aca_batch_id), 1);
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
            $course_aca_batch_id = $this->input->post('course_aca_batch_id');
            if ($course_aca_batch_id):
                $course_aca_batch_id = c_decode($course_aca_batch_id);

                $result = $this->course_aca_batch_master->delete($course_aca_batch_id);
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