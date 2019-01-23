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
            $this->scripts_include->includePlugins(array('datatable'), 'css');
            $this->scripts_include->includePlugins(array('datatable', 'jq_validation'), 'js');
            $this->layout->navTitle = 'Book ledger list';
            $this->layout->title = 'Book ledger list';
            $header = array(
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
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'publicatoin_name',
                    'name' => 'Bpublication_id',
                    'title' => 'Publication',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'author_name',
                    'name' => 'Bauthor_id',
                    'title' => 'Author',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'location',
                    'name' => 'Blocation_id',
                    'title' => 'Location',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'page',
                    'name' => 'Page',
                    'title' => 'Page',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'mrp',
                    'name' => 'Mrp',
                    'title' => 'Mrp',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'isbn_no',
                    'name' => 'Isbn_no',
                    'title' => 'Isbn_no',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'edition',
                    'name' => 'Edition',
                    'title' => 'Edition',
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
            if ($button_flag) {
                $button_set = get_link_buttons($grid_buttons);
                $data['button_set'] = $button_set;
                $action_column = array(
                    'db_column' => 'Action',
                    'name' => 'Action',
                    'title' => 'Action',
                    'class_name' => 'dt_name',
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
                    'btn_class' => 'no_pad',
                    'btn_href' => '#',
                    'btn_icon' => '',
                    'btn_title' => 'XLS',
                    'btn_text' => ' <img src="' . base_url("images/excel_icon.png") . '" alt="XLS">',
                    'btn_separator' => ' ',
                    'attr' => 'id="export_table_xls"'
                );
                $dt_button_flag = true;
            }

            if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'CSV_EXPORT')) {
                $dt_tool_btn[] = array(
                    'btn_class' => 'no_pad',
                    'btn_href' => '#',
                    'btn_icon' => '',
                    'btn_title' => 'CSV',
                    'btn_text' => ' <img src="' . base_url("images/csv_icon_sm.gif") . '" alt="CSV">',
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
                    'buttom_length_change' => true,
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
            if ($this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'XLS_EXPORT') || $this->rbac->has_permission('MANAGE_BOOK_LEDGER', 'CSV_EXPORT')) {
                $export_type = $this->input->post('export_type');
                $tableHeading = array(
                    'book_name' => 'book_name', 'bcategory_name' => 'category_name'
                    , 'publicatoin_name' => 'ublicatoin_name', 'author_name' => 'author_name'
                    , 'location' => 'location', 'page' => 'page', 'mrp' => 'mrp'
                    , 'isbn_no' => 'isbn_no', 'edition' => 'edition', 'created' => 'created', 'created_by' => 'created_by'
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
            $this->scripts_include->includePlugins(array('jq_validation', 'bs_datepicker'), 'js');
            $this->scripts_include->includePlugins(array('bs_datepicker'), 'css');
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
                }
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run()):
                    $post_data['created_by'] = $user_id;
                    //pma($post_data, 1);
                    unset($post_data['submit']);
                    $result = $this->book_ledger->save($post_data);
                    if ($result):
                        $this->session->set_flashdata('success', 'Record successfully saved!');
                        redirect(base_url('manage-book-ledger'));
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            endif;
            $data['bauthor_id_list'] = $this->book_ledger->get_book_author_masters_options('author_name', 'bauthor_id');
            $data['bcategory_id_list'] = $this->book_ledger->get_book_category_masters_options('name', 'bcategory_id');
            $data['book_id_list'] = $this->book_ledger->get_books_options('name', 'book_id');
            $data['blocation_id_list'] = $this->book_ledger->get_book_location_masters_options('concat(floor, " ", block, " ", rack_no, " ", self_no)', 'blocation_id');
            $data['bpublication_id_list'] = $this->book_ledger->get_book_publication_masters_options('name', 'publication_id');
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
            $this->scripts_include->includePlugins(array('jq_validation', 'bs_datepicker'), 'js');
            $this->scripts_include->includePlugins(array('bs_datepicker'), 'css');

            $this->layout->navTitle = 'Book ledger edit';
            $data = array();
            if ($this->input->post()):
                $user_id = $this->rbac->get_user_id();
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
                }
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run()):
                    $post_data['modified'] = date("Y-m-d H:i:s");
                    $post_data['modified_by'] = $user_id;
                    unset($post_data['submit']);
                    $result = $this->book_ledger->update($post_data);
                    if ($result >= 1):
                        $this->session->set_flashdata('success', 'Record successfully updated!');
                        redirect('manage-book-ledger');
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            else:
                $bledger_id = c_decode($bledger_id);
                $result = $this->book_ledger->get_book_ledger(null, array('t1.bledger_id' => $bledger_id));
                if ($result):
                    $result = current($result);
                endif;
                $data['data'] = $result;
            endif;

            $data['bauthor_id_list'] = $this->book_ledger->get_book_author_masters_options('author_name', 'bauthor_id');
            $data['bcategory_id_list'] = $this->book_ledger->get_book_category_masters_options('name', 'bcategory_id');
            $data['book_id_list'] = $this->book_ledger->get_books_options('name', 'book_id');
            $data['blocation_id_list'] = $this->book_ledger->get_book_location_masters_options('concat(floor, " ", block, " ", rack_no, " ", self_no)', 'blocation_id');
            $data['bpublication_id_list'] = $this->book_ledger->get_book_publication_masters_options('name', 'publication_id');
            $this->layout->data = $data;
            $this->layout->render();
        }else {
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

            $data = array();
            if ($bledger_id):
                $bledger_id = c_decode($bledger_id);

                $this->layout->navTitle = 'Book ledger view';
                $result = $this->book_ledger->get_book_ledger(null, array('t1.bledger_id' => $bledger_id), 1);
                //pma($result,1);
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

}

?>