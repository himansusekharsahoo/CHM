<?php

/**
 * Book_purchage_detail_logs Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Book_purchage_detail_logs
 * @class      Book_purchage_detail_logs
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Book_purchage_detail_logs Class
 * 
 * @category   Library
 * @package    Library
 * @class      Book_purchage_detail_logs
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Book_purchage_detail_logs extends CI_Controller {

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

        $this->load->model('book_purchage_detail_log');
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

        $this->breadcrumbs->push('index', '/library/book_purchage_detail_logs/index');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'css');
        $this->scripts_include->includePlugins(array('datatable','chosen'), 'js');
        $this->layout->navTitle = 'Book purchage detail log list';
        $this->layout->title = 'Book purchage detail log list';
        $header = array(
            array(
                'db_column' => 'bill_number',
                'name' => 'Bill_number',
                'title' => 'Bill_number',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'purchase_date',
                'name' => 'Purchase_date',
                'title' => 'Purchase_date',
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
                'db_column' => 'vendor_name',
                'name' => 'Vendor_name',
                'title' => 'Vendor_name',
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
        $data = $grid_buttons = array();

        $grid_buttons[] = array(
            'btn_class' => 'btn-info',
            'btn_href' => base_url('library/book_purchage_detail_logs/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $grid_buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('library/book_purchage_detail_logs/edit'),
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
            'attr' => 'data-bpurchase_id="$1"'
        );
        $button_set = get_link_buttons($grid_buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = $this->book_purchage_detail_log->get_book_purchage_detail_log_datatable($data);
            echo $returned_list;
            exit();
        }

        $dt_tool_btn = array(
            array(
                'btn_class' => 'btn-primary',
                'btn_href' => base_url('library/book_purchage_detail_logs/create'),
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
                'dt_url' => base_url('library/book_purchage_detail_logs/index'),
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
            $book_ledger_id = $this->input->post('book_ledger_id');            
            $condition='';
            if($book_ledger_id){
                $book_ledger_id= c_decode($book_ledger_id);
                $condition=array('bledger_id'=>$book_ledger_id);
            }
           
            $data = $this->book_purchage_detail_log->get_book_purchage_detail_log_datatable(null, true, $condition);
            $head_cols = $body_col_map = array();
            $date = array(
                array(
                    'title' => 'Date of Export Report',
                    'value' => date('d-m-Y')
                )
            );
            $tableHeading = array('bill_number' => 'bill number', 'purchase_date' => 'purchase date', 'price' => 'price', 'vendor_name' => 'vendor name', 'remarks' => 'remarks',);
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
     * Create Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function create() {
        $this->breadcrumbs->push('create', '/library/book_purchage_detail_logs/create');

        $this->layout->navTitle = 'Book purchage detail log create';
        $data = array();
        if ($this->input->post()):
            $config = array(
                array(
                    'field' => 'bledger_id',
                    'label' => 'bledger_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'bill_number',
                    'label' => 'bill_number',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'purchase_date',
                    'label' => 'purchase_date',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'price',
                    'label' => 'price',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vendor_name',
                    'label' => 'vendor_name',
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

                $data['data'] = $this->input->post();
                $result = $this->book_purchage_detail_log->save($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('/library/book_purchage_detail_logs');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        endif;
        $data['bledger_id_list'] = $this->book_purchage_detail_log->get_book_ledgers_options('bledger_id', 'bledger_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * Edit Method
     * 
     * @param   $bpurchase_id=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function edit($bpurchase_id = null) {
        $this->breadcrumbs->push('edit', '/library/book_purchage_detail_logs/edit');

        $this->layout->navTitle = 'Book purchage detail log edit';
        $data = array();
        if ($this->input->post()):
            $data['data'] = $this->input->post();
            $config = array(
                array(
                    'field' => 'bledger_id',
                    'label' => 'bledger_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'bill_number',
                    'label' => 'bill_number',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'purchase_date',
                    'label' => 'purchase_date',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'price',
                    'label' => 'price',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vendor_name',
                    'label' => 'vendor_name',
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
                $result = $this->book_purchage_detail_log->update($data['data']);
                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully updated!');
                    redirect('/library/book_purchage_detail_logs');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        else:
            $bpurchase_id = c_decode($bpurchase_id);
            $result = $this->book_purchage_detail_log->get_book_purchage_detail_log(null, array('bpurchase_id' => $bpurchase_id));
            if ($result):
                $result = current($result);
            endif;
            $data['data'] = $result;
        endif;
        $data['bledger_id_list'] = $this->book_purchage_detail_log->get_book_ledgers_options('bledger_id', 'bledger_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * View Method
     * 
     * @param   $bpurchase_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function view($bpurchase_id) {
        $this->breadcrumbs->push('view', '/library/book_purchage_detail_logs/view');

        $data = array();
        if ($bpurchase_id):
            $bpurchase_id = c_decode($bpurchase_id);

            $this->layout->navTitle = 'Book purchage detail log view';
            $result = $this->book_purchage_detail_log->get_book_purchage_detail_log(null, array('bpurchase_id' => $bpurchase_id), 1);
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
            $bpurchase_id = $this->input->post('bpurchase_id');
            if ($bpurchase_id):
                $bpurchase_id = c_decode($bpurchase_id);

                $result = $this->book_purchage_detail_log->delete($bpurchase_id);
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