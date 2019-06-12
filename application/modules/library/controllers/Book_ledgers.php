<?php

/**
 * Book_ledgers Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Book_ledgers
 * @class      Book_ledgers
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Book_ledgers Class
 * 
 * @category   Library
 * @package    Library
 * @class      Book_ledgers
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Book_ledgers extends CI_Controller {

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

        $this->load->model('book_ledger');
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

        if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'LIST')) {
            $this->breadcrumbs->push('index', '/library/book_ledgers/index');
            $this->scripts_include->includePlugins(array('datatable', 'chosen', 'print_element'), 'css');
            $this->scripts_include->includePlugins(array('datatable', 'chosen', 'jq_validation', 'promise', 'print_element'), 'js');
            $this->layout->navTitle = 'Book ledger list';
            $this->layout->title = 'Book ledger list';
            $header = array(
                array(
                    'db_column' => 'bledger_id',
                    'name' => 'bledger_id',
                    'title' => '<input type=\'checkbox\' name=\'id\' value=\'\'>',
                    'class_name' => 'text-center qr_check_box',
                    'orderable' => 'false',
                    'visible' => 'true',
                    'searchable' => 'false',
                    'render' => 'function (data, type, full, meta){'
                    . 'return \'<input type="checkbox" name="check_all" class="book_ledger_chk" value="\' + data + \'">\';'
                    . '}',
                ),
                array(
                    'db_column' => 'book_name',
                    'name' => 'book_name',
                    'title' => 'Book name',
                    'class_name' => 'book_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'bcategory_name',
                    'name' => 'Bcategory_id',
                    'title' => 'Book category',
                    'class_name' => 'book_category_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'publicatoin_name',
                    'name' => 'Bpublication_id',
                    'title' => 'Publication',
                    'class_name' => 'book_publication',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'author_name',
                    'name' => 'Bauthor_id',
                    'title' => 'Author',
                    'class_name' => 'author_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'location',
                    'name' => 'Blocation_id',
                    'title' => 'Location',
                    'class_name' => 'location',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'page',
                    'name' => 'Page',
                    'title' => 'Page',
                    'class_name' => 'book_page',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'mrp',
                    'name' => 'Mrp',
                    'title' => 'MRP',
                    'class_name' => 'book_mrp',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'isbn_no',
                    'name' => 'Isbn_no',
                    'title' => 'ISBN',
                    'class_name' => 'isbn_no',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'edition',
                    'name' => 'Edition',
                    'title' => 'Edition',
                    'class_name' => 'edition',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'ledger_total_copies',
                    'name' => 'total_copies',
                    'title' => 'Total copies',
                    'class_name' => 'total_copies',
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
            $button_flag = FALSE;
            $data = $grid_buttons = array();
            if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'VIEW')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-info',
                    'btn_href' => base_url('view-book-ledger'),
                    'btn_icon' => 'fa-eye',
                    'btn_title' => 'view record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
                $button_flag = TRUE;
            }
            if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'EDIT')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('edit-book-ledger'),
                    'btn_icon' => 'fa-pencil',
                    'btn_title' => 'edit record',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
                $button_flag = TRUE;
            }
            if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'DELETE')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-danger delete-record',
                    'btn_href' => '#',
                    'btn_icon' => 'fa-remove',
                    'btn_title' => 'delete record',
                    'btn_separator' => '',
                    'param' => array('$1'),
                    'style' => '',
                    'attr' => 'data-bledger_id="$1"'
                );
                $button_flag = TRUE;
            }
            if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'QRCODE')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => '#',
                    'btn_icon' => 'fa-qrcode',
                    'btn_title' => 'show QR code',
                    'btn_separator' => ' ',
                    'style' => 'margin-top:1px;margin-left:2px;',
                    'attr' => 'id="show_qrcode_popup" data-ledger-id="$1"'
                );
            }
            if ($button_flag) {
                $button_set = get_link_buttons($grid_buttons);
                $data['button_set'] = $button_set;
                $action_column = array(
                    'db_column' => 'Action',
                    'name' => 'Action',
                    'title' => 'Action',
                    'class_name' => 'dt_name action_td',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'false'
                );
                array_push($header, $action_column);
            }

            if ($this->input->is_ajax_request()) {
                $returned_list = $this->book_ledger->get_book_ledger_datatable($data);
                echo $returned_list;
                exit();
            }
            $dt_button_flag = false;
            $dt_tool_btn = array();
            if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'CREATE')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('create-book-ledger'),
                    'btn_icon' => '',
                    'btn_title' => 'Create',
                    'btn_text' => 'Create',
                    'btn_separator' => ' '
                );
                $dt_button_flag = true;
            }

            if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'XLS_EXPORT')) {
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

            if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'CSV_EXPORT')) {
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
            if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'PRINT')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'btn-default',
                    'btn_href' => '#',
                    'btn_icon' => 'fa-qrcode fa-lg',
                    'btn_title' => 'show QR code',
                    'btn_text' => ' QR Code',
                    'btn_separator' => ' ',
                    'attr' => 'id="show_qrcode_batch"'
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
                    'dt_url' => base_url('manage-book-ledger'),
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
                    'order' => array(
                        array(
                            'column' => 2,
                            'order' => 'asc'
                        )
                    )
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
            if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'XLS_EXPORT') || $this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'CSV_EXPORT')) {
                $export_type = $this->input->post('export_type');
                $tableHeading = array(
                    'book_name' => 'book_name', 'bcategory_name' => 'category_name'
                    , 'publicatoin_name' => 'ublicatoin_name', 'author_name' => 'author_name'
                    , 'location' => 'location', 'page' => 'page', 'mrp' => 'mrp'
                    , 'isbn_no' => 'isbn_no', 'edition' => 'edition', 'ledger_total_copies' => 'total_copies', 'created' => 'created', 'created_by' => 'created_by'
                    , 'modified' => 'modified', 'midified_by' => 'midified_by'
                );

                $data = $this->book_ledger->get_book_ledger_datatable(null, true, $tableHeading);
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
                $worksheet_name = 'book_ledgers';
                $file_name = 'book_ledgers' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
     * @since   10/28/2018
     */
    public function create() {
        if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'CREATE')) {
            $this->breadcrumbs->push('create', '/library/book_ledgers/create');
            $this->scripts_include->includePlugins(array('jq_validation', 'bs_datepicker', 'chosen'), 'js');
            $this->scripts_include->includePlugins(array('bs_datepicker', 'chosen'), 'css');
            $this->layout->navTitle = 'Book ledger create';
            $data = array();
            $user_id = $this->rbac->get_user_id();
            if ($this->input->post()):
                $data['data'] = $post_data = $this->input->post();
                $config = array(
                    array(
                        'field' => 'book_id',
                        'label' => 'book_id',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Book name is required',
                        ),
                    ),
                    array(
                        'field' => 'bcategory_id',
                        'label' => 'bcategory_id',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Book category is required',
                        ),
                    ),
                    array(
                        'field' => 'bpublication_id',
                        'label' => 'bpublication_id',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Book publication is required',
                        ),
                    ),
                    array(
                        'field' => 'bauthor_id',
                        'label' => 'bauthor_id',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Book author is required',
                        ),
                    ),
                    array(
                        'field' => 'blocation_id',
                        'label' => 'blocation_id',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Book location is required',
                        ),
                    ),
                    array(
                        'field' => 'page',
                        'label' => 'page',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Number of pages in books is required',
                        ),
                    )
                );
                if (isset($post_data['purchase_det_flag']) && $post_data['purchase_det_flag']) {
                    $config[] = array(
                        'field' => 'bill_number',
                        'label' => 'bill_number',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Bill number is required',
                        ),
                    );
                    $config[] = array(
                        'field' => 'purchase_date',
                        'label' => 'purchase_date',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Purchase date is required',
                        ),
                    );
                    $config[] = array(
                        'field' => 'price',
                        'label' => 'price',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Price is required',
                        ),
                    );
                    $config[] = array(
                        'field' => 'total_copies',
                        'label' => 'total_copies',
                        'rules' => "required",
                        'errors' => array(
                            'required' => 'Total copies is required',
                        //'number' => 'Please enter valid number',
                        ),
                    );
                }
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run()):
                    $post_data['created_by'] = $user_id;
                    //pma($post_data, 1);
                    unset($post_data['submit']);

                    $condition = " AND book_id='" . $post_data['book_id'] . "' AND bcategory_id='" . $post_data['bcategory_id'] . "' AND "
                            . "bpublication_id='" . $post_data['bpublication_id'] . "' AND bauthor_id='" . $post_data['bauthor_id'] . "' AND "
                            . "isbn_no='" . $post_data['isbn_no'] . "'";
                    if (!$this->book_ledger->check_duplicate($condition)) :
                        $result = $this->book_ledger->save($post_data);
                        if ($result):
                            $this->session->set_flashdata('success', 'Record successfully saved!');
                            redirect(base_url('manage-book-ledger'));
                        else:
                            $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                        endif;
                    else:
                        $this->session->set_flashdata('error', 'Book ledger is already exists, Please try another!');
                    endif;
                endif;
            endif;
            $data['bauthor_id_list'] = $this->book_ledger->get_book_author_masters_options('author_name', 'bauthor_id', '', true);
            $data['bcategory_id_list'] = $this->book_ledger->get_book_category_masters_options('name', 'bcategory_id', '', true);
            $data['book_id_list'] = $this->book_ledger->get_books_options('name', 'book_id', '', true);
            $data['blocation_id_list'] = $this->book_ledger->get_book_location_masters_options('concat(floor, " ", block, " ", rack_no, " ", self_no)', 'blocation_id', '', true);
            $data['bpublication_id_list'] = $this->book_ledger->get_book_publication_masters_options('name', 'publication_id', '', true);
            $this->layout->data = $data;
            $this->layout->render();
        }else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * Edit Method
     * 
     * @param   $bledger_id=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function edit($bledger_id = null) {
        if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'EDIT')) {
            $this->breadcrumbs->push('edit', '/library/book_ledgers/edit');
            $this->scripts_include->includePlugins(array('jq_validation', 'datatable', 'chosen', 'bs_datepicker', 'promise'), 'js');
            $this->scripts_include->includePlugins(array('datatable', 'chosen', 'bs_datepicker'), 'css');

            $this->layout->navTitle = 'Book ledger edit';
            $data = array();
            if ($this->input->post()):
                $user_id = $this->rbac->get_user_id();
                $data['data'] = $post_data = $this->input->post();
                $data['purchase_details_flag'] = $post_data['purchase_details_flag'];

                $condition = " AND book_id='" . $post_data['book_id'] . "' AND bcategory_id='" . $post_data['bcategory_id'] . "' AND "
                        . "bpublication_id='" . $post_data['bpublication_id'] . "' AND bauthor_id='" . $post_data['bauthor_id'] . "' AND "
                        . "isbn_no='" . $post_data['isbn_no'] . "' AND bledger_id!='" . c_decode($post_data['bledger_id']) . "'";
                $config = array(
                    array(
                        'field' => 'blocation_id',
                        'label' => 'blocation_id',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Book location is required',
                        ),
                    ),
                    array(
                        'field' => 'page',
                        'label' => 'page',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Number of pages in books is required',
                        ),
                    )
                );
                if (!$post_data['purchase_details_flag']) {
                    $config[] = array(
                        'field' => 'book_id',
                        'label' => 'book_id',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Book name is required',
                        )
                    );
                    $config[] = array(
                        'field' => 'bcategory_id',
                        'label' => 'bcategory_id',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Book category is required',
                        )
                    );
                    $config[] = array(
                        'field' => 'bpublication_id',
                        'label' => 'bpublication_id',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Book publication is required',
                        )
                    );
                    $config[] = array(
                        'field' => 'bauthor_id',
                        'label' => 'bauthor_id',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Book author is required',
                        )
                    );
                }

                $this->form_validation->set_rules($config);

                if ($this->form_validation->run()):
                    $post_data['modified'] = date("Y-m-d H:i:s");
                    $post_data['modified_by'] = $user_id;
                    unset($post_data['submit']);

                    $condition = " AND book_id='" . $post_data['book_id'] . "' AND bcategory_id='" . $post_data['bcategory_id'] . "' AND "
                            . "bpublication_id='" . $post_data['bpublication_id'] . "' AND bauthor_id='" . $post_data['bauthor_id'] . "' AND "
                            . "isbn_no='" . $post_data['isbn_no'] . "' AND bledger_id!='" . c_decode($post_data['bledger_id']) . "'";

                    if (!$this->book_ledger->check_duplicate($condition)) :
                        $result = $this->book_ledger->update($post_data);
                        if ($result >= 1):
                            $this->session->set_flashdata('success', 'Record successfully updated!');
                            redirect('manage-book-ledger');
                        else:
                            $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                        endif;
                    else:
                        $this->session->set_flashdata('error', 'Book ledger is already exists, Please try another!');
                    endif;



                endif;
            else:
                $data = $grid_buttons = array();
                $dbledger_id = c_decode($bledger_id);
                $result = $this->book_ledger->get_book_ledger(null, array('t1.bledger_id' => $dbledger_id));

                //end purchage details gird
                $data['purchase_details_flag'] = FALSE;
                if ($result):
                    $result = current($result);
                    if ($result['bpurchase_id']) {
                        $data['purchase_details_flag'] = TRUE;
                    }
                endif;
                $data['data'] = $result;

                //purchage details grid
                $header = array(
                    array(
                        'db_column' => 'bill_number',
                        'name' => 'Bill_number',
                        'title' => 'Bill number',
                        'class_name' => 'dt_name',
                        'orderable' => 'true',
                        'visible' => 'true',
                        'searchable' => 'true'
                    ), array(
                        'db_column' => 'purchase_date',
                        'name' => 'Purchase_date',
                        'title' => 'Purchase date',
                        'class_name' => 'dt_name',
                        'orderable' => 'true',
                        'visible' => 'true',
                        'searchable' => 'true'
                    ), array(
                        'db_column' => 'price',
                        'name' => 'Price',
                        'title' => 'Price',
                        'class_name' => 'dt_name',
                        'orderable' => 'true',
                        'visible' => 'true',
                        'searchable' => 'true'
                    ), array(
                        'db_column' => 'ledger_total_copies',
                        'name' => 'total_copies',
                        'title' => 'Total copies',
                        'class_name' => 'dt_name',
                        'orderable' => 'true',
                        'visible' => 'true',
                        'searchable' => 'true'
                    ), array(
                        'db_column' => 'vendor_name',
                        'name' => 'Vendor_name',
                        'title' => 'Vendor name',
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
                        'db_column' => 'Action',
                        'name' => 'Action',
                        'title' => 'Action',
                        'class_name' => 'dt_name',
                        'orderable' => 'true',
                        'visible' => 'true',
                        'searchable' => 'false'
                    )
                );

                $dt_button_flag = false;
                $dt_tool_btn = array();
                if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'CREATE')) {
                    $dt_tool_btn[] = array(
                        'btn_class' => 'btn-primary',
                        'btn_href' => '#',
                        'btn_icon' => '',
                        'btn_title' => 'Create',
                        'btn_text' => 'Create',
                        'btn_separator' => ' ',
                        'attr' => 'id="log_new_purchage_details"'
                    );
                    $dt_button_flag = true;
                }

                if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'XLS_EXPORT')) {
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

                if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'CSV_EXPORT')) {
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
                    'dt_id' => 'book_purchase_details_dt_table',
                    'dt_header' => $header,
                    'dt_ajax' => array(
                        'dt_url' => base_url('book-ledger-purchase-details'),
                        'dt_param' => "{ledger_id:'$bledger_id'}"
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

            endif;
            $data['config'] = $config;
            $data['bauthor_id_list'] = $this->book_ledger->get_book_author_masters_options('author_name', 'bauthor_id', '', true);
            $data['bcategory_id_list'] = $this->book_ledger->get_book_category_masters_options('name', 'bcategory_id', '', true);
            $data['book_id_list'] = $this->book_ledger->get_books_options('name', 'book_id', '', true);
            $data['blocation_id_list'] = $this->book_ledger->get_book_location_masters_options('concat(floor, " ", block, " ", rack_no, " ", self_no)', 'blocation_id', '', true);
            $data['bpublication_id_list'] = $this->book_ledger->get_book_publication_masters_options('name', 'publication_id', '', true);

            $this->layout->data = $data;
            $this->layout->render();
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * View Method
     * 
     * @param   $bledger_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function view($bledger_id) {
        if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'VIEW')) {
            $this->breadcrumbs->push('view', '/library/book_ledgers/view');
            $this->scripts_include->includePlugins(array('datatable', 'promise'), 'js');
            $this->scripts_include->includePlugins(array('datatable'), 'css');

            $data = array();
            if ($bledger_id):
                $ledger_id = c_decode($bledger_id);

                $this->layout->navTitle = 'Book ledger view';
                $result = $this->book_ledger->get_book_ledger(null, array('t1.bledger_id' => $ledger_id), 1);
                //pma($result,1);
                if ($result):
                    $result = current($result);
                endif;
                //purchage details grid
                $header = array(
                    array(
                        'db_column' => 'bill_number',
                        'name' => 'Bill_number',
                        'title' => 'Bill number',
                        'class_name' => 'dt_name',
                        'orderable' => 'true',
                        'visible' => 'true',
                        'searchable' => 'true'
                    ), array(
                        'db_column' => 'purchase_date',
                        'name' => 'Purchase_date',
                        'title' => 'Purchase date',
                        'class_name' => 'dt_name',
                        'orderable' => 'true',
                        'visible' => 'true',
                        'searchable' => 'true'
                    ), array(
                        'db_column' => 'price',
                        'name' => 'Price',
                        'title' => 'Price',
                        'class_name' => 'dt_name',
                        'orderable' => 'true',
                        'visible' => 'true',
                        'searchable' => 'true'
                    ), array(
                        'db_column' => 'total_copies',
                        'name' => 'total_copies',
                        'title' => 'Total copies',
                        'class_name' => 'dt_name',
                        'orderable' => 'true',
                        'visible' => 'true',
                        'searchable' => 'true'
                    ), array(
                        'db_column' => 'vendor_name',
                        'name' => 'Vendor_name',
                        'title' => 'Vendor name',
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
                    )
                );

                $dt_button_flag = false;
                $dt_tool_btn = array();

                if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'XLS_EXPORT')) {
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

                if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'CSV_EXPORT')) {
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
                    'dt_id' => 'book_purchase_details_dt_table',
                    'dt_header' => $header,
                    'dt_ajax' => array(
                        'dt_url' => base_url('book-ledger-purchase-details'),
                        'dt_param' => "{ledger_id:'$bledger_id'}"
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

                $data['data'] = $result;
                $data['config'] = $config;
                $this->layout->data = $data;
                $this->layout->render();

            endif;
            return 0;
        } else {
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
            if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'DELETE')) {
                $bledger_id = $this->input->post('bledger_id');
                if ($bledger_id):
                    $bledger_id = c_decode($bledger_id);
                    $result = $this->book_ledger->delete($bledger_id);
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

    /**
     * @param  : 
     * @desc   : used to generate barcode and qrcode
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_bar_qr_code() {
        if ($this->input->is_ajax_request()) {
            $ledger_ids = $this->input->post('ledger_id');
            $encoded = $this->input->post('enc');
            if ($ledger_ids) {
                $markup = "";
                require_once APPPATH . 'libraries/Chm_qrcode.php';
                require_once APPPATH . 'libraries/Chm_barcode.php';
                $qrcode = new Chm_qrcode();
                $barcode = new Chm_barcode();
                $bar_code_details = $msg = array();
                $exp_ids = explode(",", $ledger_ids);

                foreach ($exp_ids as $ledger_id) {

                    if ($ledger_id) {
                        if ($encoded) {
                            $ledger_id = c_decode($ledger_id);
                        }

                        $conditions = array('t1.bledger_id' => $ledger_id);
                        $ledger_detail = $this->book_ledger->get_book_ledger(null, $conditions);

                        if ($ledger_detail) {
                            $ledger_detail = $ledger_detail[0];
                            $ledger_id = c_decode($ledger_id);
                            $qr_columns = $this->rbac->get_app_config_item('library/book_qrcode_columns');
                            $qr_col_text = '';
                            if (isset($qr_columns)) {
                                $qr_columns = (string) $qr_columns[0];
                                $extract = explode(',', $qr_columns);
                                foreach ($extract as $col) {
                                    $lebel = str_replace("_", " ", $col);
                                    $lebel = ucfirst(strtolower($lebel));
                                    if (isset($ledger_detail[$col])) {
                                        $qr_col_text .= $lebel . ": " . $ledger_detail[$col] . " ";
                                    }
                                }
                            }

                            $qr_config = array(
                                'text' => $qr_col_text
                            );

                            //$qrcode_details = $qrcode->generate_qrcode($qr_config);
                            $sql = "SELECT * FROM book_copies_info b where bledger_id='" . $ledger_detail['bledger_id'] . "'";
                            $book_copies = $this->db->query($sql)->result_array();
                            if (!empty($book_copies)) {
                                foreach ($book_copies as $copy) {
                                    $bar_config = array(
                                        'text' => ($copy['book_barcode_info']) ? $copy['book_barcode_info'] : $ledger_detail['bledger_id']
                                    );
                                    $barcode_details = $barcode->generate_barcode($bar_config);
                                    $bar_code_details[] = array(
                                        //'qrcode_image' => base_url($qrcode_details['qrcode_image']),
                                        'barcode_image' => base_url($barcode_details['barcode_image']),
                                        'book_name' => $ledger_detail['book_name'],
                                        'isbn_no' => $ledger_detail['isbn_no']
                                    );
                                }
                            }
                        }
                    }
                }//end loop

                if ($bar_code_details) {
                    $chunk = array_chunk($bar_code_details, 3);
                    
                    $markup .= "<div class='row'>";
                    $markup .= "<div class='col-sm-12'>";
                    $markup .= "<div>Name: " . $chunk[0][0]['book_name'] . "</div>";
                    $markup .= "<div>ISBN: " . $chunk[0][0]['isbn_no'] . "</div><br>";
                    foreach ($chunk as $rows) {
                        $markup .= '<table>';
                        foreach ($rows as $rec) {
                            $markup .= "<tr>";
                            //$markup .= "<div><image src='" . $rec['qrcode_image'] . "' alter='No QR code found'></div><br>";
                            $markup .= "<td><image src='" . $rec['barcode_image'] . "'></td>";
                            $markup .= "</tr>";
                        }
                        $markup .= '</table>';
                    }
                    $markup .= "</div>";
                    $markup .= "</div>";
                }
                $msg = array(
                    'status' => 'success',
                    'title' => 'Bar codes',
                    'message' => $markup
                );
            } else {
                $msg = array(
                    'status' => 'error',
                    'title' => 'Bar codes',
                    'message' => 'There are some error, please refresh the page and try again!'
                );
            }
            echo json_encode($msg);
            exit;
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * 
     * @method get_book_purchase_details
     * @param   Integer $ledger_id
     * @desc    used to fetch purchase details for ledger update grid
     * @return 
     * @author  HimansuS                  
     * @since   20May19
     */
    public function get_book_purchase_details() {
        if ($this->input->is_ajax_request()):
            $ledger_id = $this->input->post('ledger_id');

        else:
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        endif;
    }

    /**
     * 
     * @method get_purchage_details_grid
     * @param   NA
     * @desc    used to feed purchase details grid
     * @return JSON 
     * @author  HimansuS                  
     * @since   21/05/2019
     */
    public function get_purchage_details_grid() {
        if ($this->input->is_ajax_request()) {

            $ledger_id = $this->input->post('ledger_id');
            $button_flag = FALSE;
            $data = array();

            if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'DELETE')) {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-danger delete-purchase-details',
                    'btn_href' => '#',
                    'btn_icon' => 'fa-remove',
                    'btn_title' => 'delete record',
                    'btn_separator' => '',
                    'param' => array('$1'),
                    'style' => '',
                    'attr' => 'data-bpurchase_id="$1" data-purchase-books="$2"'
                );
                $button_flag = TRUE;
            }

            if ($button_flag) {
                $button_set = get_link_buttons($grid_buttons);
                $data['button_set'] = $button_set;
                $action_column = array(
                    'db_column' => 'Action',
                    'name' => 'Action',
                    'title' => 'Action',
                    'class_name' => 'dt_name action_td',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'false'
                );
                //array_push($header, $action_column);
            }
            $condition = array('bledger_id' => c_decode($ledger_id));
            $returned_list = $this->book_ledger->get_book_purchage_detail_log_datatable($data, false, $condition);
            echo $returned_list;
            exit();
        } else {
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        }
    }

    /**
     * 
     * @method save_book_purchase_details
     * @param   NA
     * @desc    used to store book purchase details
     * @return NA
     * @author  HimansuS                  
     * @since   22/05/2019
     */
    public function save_book_purchase_details() {
        if ($this->input->is_ajax_request()) {
            $post_data = $this->input->post();
            $this->load->library('security');
            $post_data = $this->security->xss_clean($post_data);
            if ($this->book_ledger->save_book_purchase_details($post_data)) {
                $msg = array(
                    'status' => 'success',
                    'title' => 'Book Purchase Details',
                    'message' => 'Purchase details saved successfully.'
                );
            } else {
                $msg = array(
                    'status' => 'error',
                    'title' => 'Book Purchase Details',
                    'message' => 'Purchase details saveing error,Please try again.'
                );
            }
            echo json_encode($msg);
            exit;
        } else {
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        }
    }

    /**
     * export_purchase_details_grid_data Method
     * 
     * @param   
     * @desc    used to export book purchase details
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function export_purchase_details_grid_data() {
        if ($this->input->is_ajax_request()):
            $export_type = $this->input->post('export_type');
            $book_ledger_id = $this->input->post('book_ledger_id');
            $condition = '';
            if ($book_ledger_id) {
                $book_ledger_id = c_decode($book_ledger_id);
                $condition = array('bledger_id' => $book_ledger_id);
            }

            $data = $this->book_ledger->get_book_purchage_detail_log_datatable(null, true, $condition);
            $head_cols = $body_col_map = array();
            $date = array(
                array(
                    'title' => 'Date of Export Report',
                    'value' => date('d-m-Y')
                )
            );
            $tableHeading = array('bill_number' => 'bill number', 'purchase_date' => 'purchase date', 'price' => 'price', 'total_copies' => 'total copies', 'vendor_name' => 'vendor name', 'remarks' => 'remarks',);
            foreach ($tableHeading as $db_col => $col) {
                $head_cols[] = array(
                    'title' => ucfirst($col),
                    'track_auto_filter' => 1
                );
                $body_col_map[] = array('db_column' => $db_col);
            }
            $header = array($date, $head_cols);
            $worksheet_name = 'book_purchage_detail_logs';
            $file_name = 'book_purchage_detail_logs' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
     * delete_purchase_details Method
     * 
     * @param   
     * @desc    used to delete book purchase details 
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function delete_purchase_details() {
        if ($this->input->is_ajax_request()):
            $bpurchase_id = $this->input->post('bpurchase_id');
            if ($bpurchase_id):
                $bpurchase_id = c_decode($bpurchase_id);

                $result = $this->book_ledger->delete_purchase_detail($bpurchase_id);
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