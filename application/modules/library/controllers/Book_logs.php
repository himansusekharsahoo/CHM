<?php

/**
 * Book_logs Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Book_logs
 * @class      Book_logs
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Book_logs Class
 * 
 * @category   Library
 * @package    Library
 * @class      Book_logs
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Book_logs extends CI_Controller {

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

        $this->load->model('book_log');
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

        $this->breadcrumbs->push('index', '/library/book_logs/index');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'css');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'js');
        $this->layout->navTitle = 'Book log list';
        $this->layout->title = 'Book log list';
        $header = array(
            array(
                'db_column' => 'category_name',
                'name' => 'Category_name',
                'title' => 'Category_name',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'category_code',
                'name' => 'Category_code',
                'title' => 'Category_code',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'category_parent_id',
                'name' => 'Category_parent_id',
                'title' => 'Category_parent_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'publication_name',
                'name' => 'Publication_name',
                'title' => 'Publication_name',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'publication_code',
                'name' => 'Publication_code',
                'title' => 'Publication_code',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'publication_remarks',
                'name' => 'Publication_remarks',
                'title' => 'Publication_remarks',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'author_name',
                'name' => 'Author_name',
                'title' => 'Author_name',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'author_remarks',
                'name' => 'Author_remarks',
                'title' => 'Author_remarks',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'location_floor',
                'name' => 'Location_floor',
                'title' => 'Location_floor',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'location_block',
                'name' => 'Location_block',
                'title' => 'Location_block',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'location_rack_no',
                'name' => 'Location_rack_no',
                'title' => 'Location_rack_no',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'location_self_no',
                'name' => 'Location_self_no',
                'title' => 'Location_self_no',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'ledger_id',
                'name' => 'Ledger_id',
                'title' => 'Ledger_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'ledger_page',
                'name' => 'Ledger_page',
                'title' => 'Ledger_page',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'ledger_mrp',
                'name' => 'Ledger_mrp',
                'title' => 'Ledger_mrp',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'ledger_isbn',
                'name' => 'Ledger_isbn',
                'title' => 'Ledger_isbn',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'ledger_edition',
                'name' => 'Ledger_edition',
                'title' => 'Ledger_edition',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'ledger_bar_code',
                'name' => 'Ledger_bar_code',
                'title' => 'Ledger_bar_code',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'ledger_qr_code',
                'name' => 'Ledger_qr_code',
                'title' => 'Ledger_qr_code',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'ledger_created',
                'name' => 'Ledger_created',
                'title' => 'Ledger_created',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'ledger_created_by',
                'name' => 'Ledger_created_by',
                'title' => 'Ledger_created_by',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'ledger_modified',
                'name' => 'Ledger_modified',
                'title' => 'Ledger_modified',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'ledger_modified_by',
                'name' => 'Ledger_modified_by',
                'title' => 'Ledger_modified_by',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'book_id',
                'name' => 'Book_id',
                'title' => 'Book_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'book_name',
                'name' => 'Book_name',
                'title' => 'Book_name',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'book_code',
                'name' => 'Book_code',
                'title' => 'Book_code',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'book_status',
                'name' => 'Book_status',
                'title' => 'Book_status',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'book_created',
                'name' => 'Book_created',
                'title' => 'Book_created',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'book_created_by',
                'name' => 'Book_created_by',
                'title' => 'Book_created_by',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'book_modified',
                'name' => 'Book_modified',
                'title' => 'Book_modified',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'book_modified_by',
                'name' => 'Book_modified_by',
                'title' => 'Book_modified_by',
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
            'btn_href' => base_url('library/book_logs/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $grid_buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('library/book_logs/edit'),
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
            'attr' => 'data-book_log_id="$1"'
        );
        $button_set = get_link_buttons($grid_buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = $this->book_log->get_book_log_datatable($data);
            echo $returned_list;
            exit();
        }

        $dt_tool_btn = array(
            array(
                'btn_class' => 'btn-primary',
                'btn_href' => base_url('library/book_logs/create'),
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
                'dt_url' => base_url('library/book_logs/index'),
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
            $tableHeading = array('category_name' => 'category_name', 'category_code' => 'category_code', 'category_parent_id' => 'category_parent_id', 'publication_name' => 'publication_name', 'publication_code' => 'publication_code', 'publication_remarks' => 'publication_remarks', 'author_name' => 'author_name', 'author_remarks' => 'author_remarks', 'location_floor' => 'location_floor', 'location_block' => 'location_block', 'location_rack_no' => 'location_rack_no', 'location_self_no' => 'location_self_no', 'ledger_id' => 'ledger_id', 'ledger_page' => 'ledger_page', 'ledger_mrp' => 'ledger_mrp', 'ledger_isbn' => 'ledger_isbn', 'ledger_edition' => 'ledger_edition', 'ledger_bar_code' => 'ledger_bar_code', 'ledger_qr_code' => 'ledger_qr_code', 'ledger_created' => 'ledger_created', 'ledger_created_by' => 'ledger_created_by', 'ledger_modified' => 'ledger_modified', 'ledger_modified_by' => 'ledger_modified_by', 'book_id' => 'book_id', 'book_name' => 'book_name', 'book_code' => 'book_code', 'book_status' => 'book_status', 'book_created' => 'book_created', 'book_created_by' => 'book_created_by', 'book_modified' => 'book_modified', 'book_modified_by' => 'book_modified_by', 'created' => 'created',);
            $cols = 'category_name,category_code,category_parent_id,publication_name,publication_code,publication_remarks,author_name,author_remarks,location_floor,location_block,location_rack_no,location_self_no,ledger_id,ledger_page,ledger_mrp,ledger_isbn,ledger_edition,ledger_bar_code,ledger_qr_code,ledger_created,ledger_created_by,ledger_modified,ledger_modified_by,book_id,book_name,book_code,book_status,book_created,book_created_by,book_modified,book_modified_by,created';
            $data = $this->book_log->get_book_log_datatable(null, true, $tableHeading);
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
            $worksheet_name = 'book_logs';
            $file_name = 'book_logs' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
        $this->breadcrumbs->push('create', '/library/book_logs/create');

        $this->layout->navTitle = 'Book log create';
        $data = array();
        if ($this->input->post()):
            $config = array(
                array(
                    'field' => 'category_name',
                    'label' => 'category_name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'category_code',
                    'label' => 'category_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'category_parent_id',
                    'label' => 'category_parent_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'publication_name',
                    'label' => 'publication_name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'publication_code',
                    'label' => 'publication_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'publication_remarks',
                    'label' => 'publication_remarks',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'author_name',
                    'label' => 'author_name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'author_remarks',
                    'label' => 'author_remarks',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'location_floor',
                    'label' => 'location_floor',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'location_block',
                    'label' => 'location_block',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'location_rack_no',
                    'label' => 'location_rack_no',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'location_self_no',
                    'label' => 'location_self_no',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_id',
                    'label' => 'ledger_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_page',
                    'label' => 'ledger_page',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_mrp',
                    'label' => 'ledger_mrp',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_isbn',
                    'label' => 'ledger_isbn',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_edition',
                    'label' => 'ledger_edition',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_bar_code',
                    'label' => 'ledger_bar_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_qr_code',
                    'label' => 'ledger_qr_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_created',
                    'label' => 'ledger_created',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_created_by',
                    'label' => 'ledger_created_by',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_modified',
                    'label' => 'ledger_modified',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_modified_by',
                    'label' => 'ledger_modified_by',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_id',
                    'label' => 'book_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_name',
                    'label' => 'book_name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_code',
                    'label' => 'book_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_status',
                    'label' => 'book_status',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_created',
                    'label' => 'book_created',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_created_by',
                    'label' => 'book_created_by',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_modified',
                    'label' => 'book_modified',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_modified_by',
                    'label' => 'book_modified_by',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):

                $data['data'] = $this->input->post();
                $result = $this->book_log->save($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('/library/book_logs');
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
     * @param   $book_log_id=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function edit($book_log_id = null) {
        $this->breadcrumbs->push('edit', '/library/book_logs/edit');

        $this->layout->navTitle = 'Book log edit';
        $data = array();
        if ($this->input->post()):
            $data['data'] = $this->input->post();
            $config = array(
                array(
                    'field' => 'category_name',
                    'label' => 'category_name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'category_code',
                    'label' => 'category_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'category_parent_id',
                    'label' => 'category_parent_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'publication_name',
                    'label' => 'publication_name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'publication_code',
                    'label' => 'publication_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'publication_remarks',
                    'label' => 'publication_remarks',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'author_name',
                    'label' => 'author_name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'author_remarks',
                    'label' => 'author_remarks',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'location_floor',
                    'label' => 'location_floor',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'location_block',
                    'label' => 'location_block',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'location_rack_no',
                    'label' => 'location_rack_no',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'location_self_no',
                    'label' => 'location_self_no',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_id',
                    'label' => 'ledger_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_page',
                    'label' => 'ledger_page',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_mrp',
                    'label' => 'ledger_mrp',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_isbn',
                    'label' => 'ledger_isbn',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_edition',
                    'label' => 'ledger_edition',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_bar_code',
                    'label' => 'ledger_bar_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_qr_code',
                    'label' => 'ledger_qr_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_created',
                    'label' => 'ledger_created',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_created_by',
                    'label' => 'ledger_created_by',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_modified',
                    'label' => 'ledger_modified',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'ledger_modified_by',
                    'label' => 'ledger_modified_by',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_id',
                    'label' => 'book_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_name',
                    'label' => 'book_name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_code',
                    'label' => 'book_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_status',
                    'label' => 'book_status',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_created',
                    'label' => 'book_created',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_created_by',
                    'label' => 'book_created_by',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_modified',
                    'label' => 'book_modified',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_modified_by',
                    'label' => 'book_modified_by',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):
                $result = $this->book_log->update($data['data']);
                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully updated!');
                    redirect('/library/book_logs');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        else:
            $book_log_id = c_decode($book_log_id);
            $result = $this->book_log->get_book_log(null, array('book_log_id' => $book_log_id));
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
     * @param   $book_log_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function view($book_log_id) {
        $this->breadcrumbs->push('view', '/library/book_logs/view');

        $data = array();
        if ($book_log_id):
            $book_log_id = c_decode($book_log_id);

            $this->layout->navTitle = 'Book log view';
            $result = $this->book_log->get_book_log(null, array('book_log_id' => $book_log_id), 1);
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
            $book_log_id = $this->input->post('book_log_id');
            if ($book_log_id):
                $book_log_id = c_decode($book_log_id);

                $result = $this->book_log->delete($book_log_id);
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