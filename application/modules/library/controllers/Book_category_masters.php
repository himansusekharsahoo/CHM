<?php

/**
 * Book_category_masters Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Book_category_masters
 * @class      Book_category_masters
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Book_category_masters Class
 * 
 * @category   Library
 * @package    Library
 * @class      Book_category_masters
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Book_category_masters extends CI_Controller {

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

        $this->load->model('book_category_master');
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
        $this->breadcrumbs->push('index', '/library/book_category_masters/index');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'css');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'js');

        if ($this->rbac->has_permission('MANAGE_BOOK_CATEGORY', 'LIST')) {
            $this->layout->navTitle = 'Book category list';
            $this->layout->title = 'Book category list';
            $header = array(
                array(
                    'db_column' => 'name',
                    'name' => 'Name',
                    'title' => 'Name',
                    'class_name' => 'name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'code',
                    'name' => 'Code',
                    'title' => 'Code',
                    'class_name' => 'code',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'status',
                    'name' => 'Status',
                    'title' => 'Status',
                    'class_name' => 'status',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'created',
                    'name' => 'Created',
                    'title' => 'Created',
                    'class_name' => 'created',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'created_by',
                    'name' => 'Created_by',
                    'title' => 'Created by',
                    'class_name' => 'created_by',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                )
            );
            $data = $grid_buttons = array();
            $button_flag = FALSE;
            if ($this->rbac->has_permission('MANAGE_BOOK_CATEGORY', 'VIEW')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-info',
                    'btn_href' => base_url('view-book-category'),
                    'btn_icon' => 'fa-eye',
                    'btn_title' => 'view record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
                $button_flag = true;
            }
            if ($this->rbac->has_permission('MANAGE_BOOK_CATEGORY', 'EDIT')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('edit-book-category'),
                    'btn_icon' => 'fa-pencil',
                    'btn_title' => 'edit record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
                $button_flag = true;
            }

            if ($this->rbac->has_permission('MANAGE_BOOK_CATEGORY', 'DELETE')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-danger delete-record',
                    'btn_href' => '#',
                    'btn_icon' => 'fa-remove',
                    'btn_title' => 'delete record',
                    'btn_separator' => '',
                    'param' => array('$1'),
                    'style' => '',
                    'attr' => 'data-bcategory_id="$1"'
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
                $returned_list = $this->book_category_master->get_book_category_master_datatable($data);
                echo $returned_list;
                exit();
            }
            $dt_button_flag = false;
            $dt_tool_btn = array();

            if ($this->rbac->has_permission('MANAGE_BOOK_CATEGORY', 'CREATE')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('create-book-category'),
                    'btn_icon' => '',
                    'btn_title' => 'Create',
                    'btn_text' => 'Create',
                    'btn_separator' => ' '
                );
                $dt_button_flag = true;
            }

            if ($this->rbac->has_permission('MANAGE_BOOK_CATEGORY', 'XLS_EXPORT')) {
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

            if ($this->rbac->has_permission('MANAGE_BOOK_CATEGORY', 'CSV_EXPORT')) {
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
                    'dt_url' => base_url('manage-book-category'),
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
            if ($this->rbac->has_permission('MANAGE_BOOK_CATEGORY', 'XLS_EXPORT') || $this->rbac->has_permission('MANAGE_BOOK_CATEGORY', 'CSV_EXPORT')) {
                $export_type = $this->input->post('export_type');
                $tableHeading = array('name' => 'name', 'code' => 'code', 'status' => 'status'
                    , 'created' => 'created', 'created_by_name' => 'created_by');
                $data = $this->book_category_master->get_book_category_master_datatable(null, true, $tableHeading);
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
                $worksheet_name = 'book_category_masters';
                $file_name = 'book_category_masters' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
        if ($this->rbac->has_permission('MANAGE_BOOK_CATEGORY', 'CREATE')) {
            $this->breadcrumbs->push('create', '/library/book_category_masters/create');
            $this->layout->navTitle = 'Book category master create';
            $this->scripts_include->includePlugins(array('jq_validation'), 'js');
            $data = array();
            if ($this->input->post()):
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'name',
                        'rules' => 'required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run()):
                    $post_data = $this->input->post();
                    $post_data['created_by'] = $this->rbac->get_user_id();
                    $code = str_replace(" ", "_", trim($post_data['name']));
                    $code = str_replace(array("__"), "_", $code);
                    $post_data['code'] = strtoupper(strtolower($code));
                    $data['data'] = $post_data;
                    $condition = " AND replace(lower(name),' ','')=replace(lower('" . $post_data['name'] . "'),' ','')";
                    if (!$this->book_category_master->check_duplicate($condition)) :
                        $result = $this->book_category_master->save($post_data);
                        if ($result >= 1):
                            $this->session->set_flashdata('success', 'Record successfully saved!');
                            redirect('manage-book-category');
                        else:
                            $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                        endif;
                    else:
                        $this->session->set_flashdata('error', 'Book category name is already exists, Please try another!');
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
     * @param   $bcategory_id=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function edit($bcategory_id = null) {
        if ($this->rbac->has_permission('MANAGE_BOOK_CATEGORY', 'EDIT')) {
            $this->breadcrumbs->push('edit', '/library/book_category_masters/edit');
            $this->layout->navTitle = 'Book category master edit';
            $this->scripts_include->includePlugins(array('jq_validation'), 'js');
            $data = array();
            if ($this->input->post()):
                $post_data = $this->input->post();
                $data['data'] = $post_data;
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'name',
                        'rules' => 'required'
                    )
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run()):
                    $condition = " AND bcategory_id!='" . $post_data['bcategory_id'] . "' and replace(lower(name),' ','')=replace(lower('" . $post_data['name'] . "'),' ','')";
                    if (!$this->book_category_master->check_duplicate($condition)) :
                        //$post_data['modified'] = date("Y-m-d H:i:s");
                        //$post_data['modified_by'] = $this->rbac->get_user_id();
                        $code = str_replace(" ", "_", trim($post_data['name']));
                        $code = str_replace(array("__"), "_", $code);
                        $post_data['code'] = strtoupper(strtolower($code));

                        $result = $this->book_category_master->update($post_data);
                        if ($result >= 1):
                            $this->session->set_flashdata('success', 'Record successfully updated!');
                            redirect('manage-book-category');
                        else:
                            $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                        endif;
                    else:
                        $this->session->set_flashdata('error', 'Book category name is already exists, Please try another!');
                    endif;

                endif;
            else:
                $bcategory_id = c_decode($bcategory_id);
                $result = $this->book_category_master->get_book_category_master(null, array('bcategory_id' => $bcategory_id));
                if ($result):
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
     * View Method
     * 
     * @param   $bcategory_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function view($bcategory_id) {
        if ($this->rbac->has_permission('MANAGE_BOOK_CATEGORY', 'VIEW')) {
            $this->breadcrumbs->push('view', '/library/book_category_masters/view');
            $data = array();
            if ($bcategory_id):
                $bcategory_id = c_decode($bcategory_id);

                $this->layout->navTitle = 'Book category master view';
                $result = $this->book_category_master->get_book_category_master(null, array('bcategory_id' => $bcategory_id), 1);
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
     * @since   10/28/2018
     */
    public function delete() {
        if ($this->input->is_ajax_request()):
            if ($this->rbac->has_permission('MANAGE_BOOK_CATEGORY', 'DELETE')) {
                $bcategory_id = $this->input->post('bcategory_id');
                if ($bcategory_id):
                    $bcategory_id = c_decode($bcategory_id);

                    $result = $this->book_category_master->delete($bcategory_id);
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

}

?>