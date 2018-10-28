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

        $this->breadcrumbs->push('index', '/library/book_ledgers/index');
        $this->scripts_include->includePlugins(array('datatable'), 'css');
        $this->scripts_include->includePlugins(array('datatable'), 'js');
        $this->layout->navTitle = 'Book ledger list';
        $this->layout->title = 'Book ledger list';
        $header = array(
            array(
                'db_column' => 'book_id',
                'name' => 'Book_id',
                'title' => 'Book_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'bcategory_id',
                'name' => 'Bcategory_id',
                'title' => 'Bcategory_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'bpublication_id',
                'name' => 'Bpublication_id',
                'title' => 'Bpublication_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'bauthor_id',
                'name' => 'Bauthor_id',
                'title' => 'Bauthor_id',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'blocation_id',
                'name' => 'Blocation_id',
                'title' => 'Blocation_id',
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
                'db_column' => 'bar_code',
                'name' => 'Bar_code',
                'title' => 'Bar_code',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'qr_code',
                'name' => 'Qr_code',
                'title' => 'Qr_code',
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
                'db_column' => 'modified',
                'name' => 'Modified',
                'title' => 'Modified',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'midified_by',
                'name' => 'Midified_by',
                'title' => 'Midified_by',
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
            'btn_href' => base_url('library/book_ledgers/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $grid_buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('library/book_ledgers/edit'),
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
            'attr' => 'data-bledger_id="$1"'
        );
        $button_set = get_link_buttons($grid_buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = $this->book_ledger->get_book_ledger_datatable($data);
            echo $returned_list;
            exit();
        }

        $dt_tool_btn = array(
            array(
                'btn_class' => 'btn-primary',
                'btn_href' => base_url('library/book_ledgers/create'),
                'btn_icon' => '',
                'btn_title' => 'Create',
                'btn_text' => 'Create',
                'btn_separator' => ' '
            ),
            array(
                'btn_class' => 'no_pad',
                'btn_href' => '#',
                'btn_icon' => '',
                'btn_title' => 'XLS',
                'btn_text' => ' <img src="' . base_url("images/excel_icon.png") . '" alt="XLS">',
                'btn_separator' => ' ',
                'attr' => 'id="export_table_xls"'
            ),
            array(
                'btn_class' => 'no_pad',
                'btn_href' => '#',
                'btn_icon' => '',
                'btn_title' => 'CSV',
                'btn_text' => ' <img src="' . base_url("images/csv_icon_sm.gif") . '" alt="CSV">',
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
                'dt_url' => base_url('library/book_ledgers/index'),
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
                'iDisplayLength' => '15'
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
            $tableHeading = array('book_id' => 'book_id', 'bcategory_id' => 'bcategory_id', 'bpublication_id' => 'bpublication_id', 'bauthor_id' => 'bauthor_id', 'blocation_id' => 'blocation_id', 'page' => 'page', 'mrp' => 'mrp', 'isbn_no' => 'isbn_no', 'edition' => 'edition', 'bar_code' => 'bar_code', 'qr_code' => 'qr_code', 'created' => 'created', 'created_by' => 'created_by', 'modified' => 'modified', 'midified_by' => 'midified_by',);
            $cols = 'book_id,bcategory_id,bpublication_id,bauthor_id,blocation_id,page,mrp,isbn_no,edition,bar_code,qr_code,created,created_by,modified,midified_by';
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
        $this->breadcrumbs->push('create', '/library/book_ledgers/create');

        $this->layout->navTitle = 'Book ledger create';
        $data = array();
        if ($this->input->post()):
            $config = array(
                array(
                    'field' => 'book_id',
                    'label' => 'book_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'bcategory_id',
                    'label' => 'bcategory_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'bpublication_id',
                    'label' => 'bpublication_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'bauthor_id',
                    'label' => 'bauthor_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'blocation_id',
                    'label' => 'blocation_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'page',
                    'label' => 'page',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'mrp',
                    'label' => 'mrp',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'isbn_no',
                    'label' => 'isbn_no',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'edition',
                    'label' => 'edition',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'bar_code',
                    'label' => 'bar_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'qr_code',
                    'label' => 'qr_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'midified_by',
                    'label' => 'midified_by',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):

                $data['data'] = $this->input->post();
                $result = $this->book_ledger->save($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('/library/book_ledgers');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        endif;
        $data['bauthor_id_list'] = $this->book_ledger->get_book_author_masters_options('bauthor_id', 'bauthor_id');
        $data['bcategory_id_list'] = $this->book_ledger->get_book_category_masters_options('bcategory_id', 'bcategory_id');
        $data['book_id_list'] = $this->book_ledger->get_books_options('book_id', 'book_id');
        $data['blocation_id_list'] = $this->book_ledger->get_book_location_masters_options('blocation_id', 'blocation_id');
        $data['bpublication_id_list'] = $this->book_ledger->get_book_publication_masters_options('publication_id', 'publication_id');
        $this->layout->data = $data;
        $this->layout->render();
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
        $this->breadcrumbs->push('edit', '/library/book_ledgers/edit');

        $this->layout->navTitle = 'Book ledger edit';
        $data = array();
        if ($this->input->post()):
            $data['data'] = $this->input->post();
            $config = array(
                array(
                    'field' => 'book_id',
                    'label' => 'book_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'bcategory_id',
                    'label' => 'bcategory_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'bpublication_id',
                    'label' => 'bpublication_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'bauthor_id',
                    'label' => 'bauthor_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'blocation_id',
                    'label' => 'blocation_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'page',
                    'label' => 'page',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'mrp',
                    'label' => 'mrp',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'isbn_no',
                    'label' => 'isbn_no',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'edition',
                    'label' => 'edition',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'bar_code',
                    'label' => 'bar_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'qr_code',
                    'label' => 'qr_code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'midified_by',
                    'label' => 'midified_by',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):
                $result = $this->book_ledger->update($data['data']);
                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully updated!');
                    redirect('/library/book_ledgers');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        else:
            $bledger_id = c_decode($bledger_id);
            $result = $this->book_ledger->get_book_ledger(null, array('bledger_id' => $bledger_id));
            if ($result):
                $result = current($result);
            endif;
            $data['data'] = $result;
        endif;
        $data['bauthor_id_list'] = $this->book_ledger->get_book_author_masters_options('bauthor_id', 'bauthor_id');
        $data['bcategory_id_list'] = $this->book_ledger->get_book_category_masters_options('bcategory_id', 'bcategory_id');
        $data['book_id_list'] = $this->book_ledger->get_books_options('book_id', 'book_id');
        $data['blocation_id_list'] = $this->book_ledger->get_book_location_masters_options('blocation_id', 'blocation_id');
        $data['bpublication_id_list'] = $this->book_ledger->get_book_publication_masters_options('publication_id', 'publication_id');
        $this->layout->data = $data;
        $this->layout->render();
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
        $this->breadcrumbs->push('view', '/library/book_ledgers/view');

        $data = array();
        if ($bledger_id):
            $bledger_id = c_decode($bledger_id);

            $this->layout->navTitle = 'Book ledger view';
            $result = $this->book_ledger->get_book_ledger(null, array('bledger_id' => $bledger_id), 1);
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
        else:
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        endif;
        return 'Invalid request type.';
    }

}

?>