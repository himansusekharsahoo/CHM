<?php

/**
 * Book_location_masters Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Book_location_masters
 * @class      Book_location_masters
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Book_location_masters Class
 * 
 * @category   Library
 * @package    Library
 * @class      Book_location_masters
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Book_location_masters extends CI_Controller {

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

        $this->load->model('book_location_master');
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

        $this->breadcrumbs->push('index', base_url('manage-book-location'));
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'css');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'js');
        $this->layout->navTitle = 'Book location list';
        $this->layout->title = 'Book location list';
        if ($this->rbac->has_permission('MANAGE_BOOK_LOCATION', 'LIST')) {

            $header = array(
                array(
                    'db_column' => 'floor',
                    'name' => 'Floor',
                    'title' => 'Floor',
                    'class_name' => 'floor',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'block',
                    'name' => 'Block',
                    'title' => 'Block',
                    'class_name' => 'block',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'rack_no',
                    'name' => 'Rack_no',
                    'title' => 'Rack no',
                    'class_name' => 'rack_no',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'self_no',
                    'name' => 'Self_no',
                    'title' => 'Self no',
                    'class_name' => 'self_no',
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
                )
            );
            $data = $grid_buttons = array();
            $button_flag = FALSE;
            if ($this->rbac->has_permission('MANAGE_BOOK_LOCATION', 'VIEW')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-info',
                    'btn_href' => base_url('view-book-location'),
                    'btn_icon' => 'fa-eye',
                    'btn_title' => 'view record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
                $button_flag = true;
            }
            if ($this->rbac->has_permission('MANAGE_BOOK_LOCATION', 'EDIT')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('edit-book-location'),
                    'btn_icon' => 'fa-pencil',
                    'btn_title' => 'edit record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
                $button_flag = true;
            }

            if ($this->rbac->has_permission('MANAGE_BOOK_LOCATION', 'DELETE')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-danger delete-record',
                    'btn_href' => '#',
                    'btn_icon' => 'fa-remove',
                    'btn_title' => 'delete record',
                    'btn_separator' => '',
                    'param' => array('$1'),
                    'style' => '',
                    'attr' => 'data-blocation_id="$1"'
                );
                $button_flag = true;
            }

            if ($button_flag) {
                $button_set = get_link_buttons($grid_buttons);
                $data['button_set'] = $button_set;
                $action_column = array(
                    'db_column' => 'Action',
                    'name' => 'Action',
                    'title' => 'Action',
                    'class_name' => 'dt_name',
                    'orderable' => 'false',
                    'visible' => 'true',
                    'searchable' => 'false'
                );
                array_push($header, $action_column);
            }

            if ($this->input->is_ajax_request()) {
                $returned_list = $this->book_location_master->get_book_location_master_datatable($data);
                echo $returned_list;
                exit();
            }
            $dt_button_flag = false;
            $dt_tool_btn = array();
            if ($this->rbac->has_permission('MANAGE_BOOK_LOCATION', 'CREATE')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('create-book-location'),
                    'btn_icon' => '',
                    'btn_title' => 'Create',
                    'btn_text' => 'Create',
                    'btn_separator' => ' '
                );
                $dt_button_flag = true;
            }
            if ($this->rbac->has_permission('MANAGE_BOOK_LOCATION', 'XLS_EXPORT')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-warning',
                    'btn_href' => '#',
                    'btn_icon' => '',
                    'btn_title' => 'XLS',
                    'btn_text' => '<span class="fa fa-file-excel-o"></span> Excel',
                    'btn_separator' => ' ',
                    'attr' => 'id="export_table_xls"'
                );
                $dt_button_flag = true;
            }

            if ($this->rbac->has_permission('MANAGE_BOOK_LOCATION', 'CSV_EXPORT')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-info',
                    'btn_href' => '#',
                    'btn_icon' => '',
                    'btn_title' => 'CSV',
                    'btn_text' => '<span class="fa fa-file-text-o"></span> CSV',
                    'btn_separator' => ' ',
                    'attr' => 'id="export_table_csv"'
                );
                $dt_button_flag = true;
            }

            if ($dt_button_flag) {
                $dt_tool_btn = get_link_buttons($dt_tool_btn);
            }
            $config = array(
                'dt_markup' => TRUE,
                'dt_id' => 'raw_cert_data_dt_table',
                'dt_header' => $header,
                'dt_ajax' => array(
                    'dt_url' => base_url('manage-book-location'),
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
     * @since   10/28/2018
     */
    public function export_grid_data() {
        if ($this->input->is_ajax_request()):
            if ($this->rbac->has_permission('MANAGE_BOOK_LOCATION', 'XLS_EXPORT') || $this->rbac->has_permission('MANAGE_BOOK_LOCATION', 'CSV_EXPORT')) {
                $export_type = $this->input->post('export_type');
                $tableHeading = array('floor' => 'floor', 'block' => 'block', 'rack_no' => 'rack_no', 'self_no' => 'self_no', 'remarks' => 'remarks',);
                $cols = 'floor,block,rack_no,self_no,remarks';
                $data = $this->book_location_master->get_book_location_master_datatable(null, true, $tableHeading);
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
                $worksheet_name = 'book_location_masters';
                $file_name = 'book_location_masters' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
        $this->breadcrumbs->push('create', base_url('create-book-location'));
        $this->layout->navTitle = 'Book location create';
        $this->scripts_include->includePlugins(array('jq_validation'), 'js');
        if ($this->rbac->has_permission('MANAGE_BOOK_LOCATION', 'CREATE')) {
            $data = array();
            if ($this->input->post()):
                $config = array(
                    array(
                        'field' => 'floor',
                        'label' => 'floor',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'rack_no',
                        'label' => 'rack_no',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'self_no',
                        'label' => 'self_no',
                        'rules' => 'required'
                    )
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run()):

                    $data['data'] = $this->input->post();
                    $result = $this->book_location_master->save($data['data']);

                    if ($result >= 1):
                        $this->session->set_flashdata('success', 'Record successfully saved!');
                        redirect('manage-book-location');
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            endif;
            $this->layout->data = $data;
            $this->layout->render();
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * Edit Method
     * 
     * @param   $blocation_id=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function edit($blocation_id = null) {
        $this->breadcrumbs->push('edit', base_url('edit-book-location'));
        $this->layout->navTitle = 'Book location edit';
        $this->scripts_include->includePlugins(array('jq_validation'), 'js');
        if ($this->rbac->has_permission('MANAGE_BOOK_LOCATION', 'EDIT')) {
            $data = array();
            if ($this->input->post()):
                $data['data'] = $this->input->post();
                $config = array(
                    array(
                        'field' => 'floor',
                        'label' => 'floor',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'block',
                        'label' => 'block',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'rack_no',
                        'label' => 'rack_no',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'self_no',
                        'label' => 'self_no',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'remarks',
                        'label' => 'remarks',
                        'rules' => 'required'
                    ),
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run()):
                    $result = $this->book_location_master->update($data['data']);
                    if ($result >= 1):
                        $this->session->set_flashdata('success', 'Record successfully updated!');
                        redirect('manage-book-location');
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            else:
                $blocation_id = c_decode($blocation_id);
                $result = $this->book_location_master->get_book_location_master(null, array('blocation_id' => $blocation_id));
                if ($result):
                    $result = current($result);
                endif;
                $data['data'] = $result;
            endif;
            $this->layout->data = $data;
            $this->layout->render();
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * View Method
     * 
     * @param   $blocation_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function view($blocation_id) {
        $this->breadcrumbs->push('view', base_url('view-book-location'));
        if ($this->rbac->has_permission('MANAGE_BOOK_LOCATION', 'VIEW')) {
            $data = array();
            if ($blocation_id):
                $blocation_id = c_decode($blocation_id);

                $this->layout->navTitle = 'Book location master view';
                $result = $this->book_location_master->get_book_location_master(null, array('blocation_id' => $blocation_id), 1);
                if ($result):
                    $result = current($result);
                endif;

                $data['data'] = $result;
                $this->layout->data = $data;
                $this->layout->render();

            endif;
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
     * @since   10/28/2018
     */
    public function delete() {
        if ($this->input->is_ajax_request()):
            if ($this->rbac->has_permission('MANAGE_BOOK_LOCATION', 'DELETE')) {
                $blocation_id = $this->input->post('blocation_id');
                if ($blocation_id):
                    $blocation_id = c_decode($blocation_id);

                    $result = $this->book_location_master->delete($blocation_id);
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
            } else {
                $this->layout->render(array('error' => '401'));
            }
        else:
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        endif;
        return 'Invalid request type.';
    }

}

?>