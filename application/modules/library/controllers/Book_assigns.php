<?php

/**
 * Book_assigns Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Book_assigns
 * @class      Book_assigns
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Book_assigns Class
 * 
 * @category   Library
 * @package    Library
 * @class      Book_assigns
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Book_assigns extends CI_Controller {

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

        $this->load->model('book_assign');
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

        $this->breadcrumbs->push('index', '/library/book_assigns/index');
        $this->scripts_include->includePlugins(array('datatable'), 'css');
        $this->scripts_include->includePlugins(array('datatable'), 'js');
        $this->layout->navTitle = 'Book assign list';
        $this->layout->title = 'Book assign list';
        $header = array(
            array(
                'db_column' => 'bledger_id',
                'name' => 'Bledger_id',
                'title' => 'Bledger_id',
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
                'db_column' => 'issue_date',
                'name' => 'Issue_date',
                'title' => 'Issue_date',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'due_date',
                'name' => 'Due_date',
                'title' => 'Due_date',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'return_date',
                'name' => 'Return_date',
                'title' => 'Return_date',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'return_delay_fine',
                'name' => 'Return_delay_fine',
                'title' => 'Return_delay_fine',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'book_return_condition',
                'name' => 'Book_return_condition',
                'title' => 'Book_return_condition',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ), array(
                'db_column' => 'book_lost_fine',
                'name' => 'Book_lost_fine',
                'title' => 'Book_lost_fine',
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
                'db_column' => 'user_type',
                'name' => 'User_type',
                'title' => 'User_type',
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
            'btn_href' => base_url('library/book_assigns/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $grid_buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('library/book_assigns/edit'),
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
            'attr' => 'data-bassign_id="$1"'
        );
        $button_set = get_link_buttons($grid_buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = $this->book_assign->get_book_assign_datatable($data);
            echo $returned_list;
            exit();
        }

        $dt_tool_btn = array(
            array(
                'btn_class' => 'btn-primary',
                'btn_href' => base_url('library/book_assigns/create'),
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
                'dt_url' => base_url('library/book_assigns/index'),
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
            $tableHeading = array('bledger_id' => 'bledger_id', 'user_id' => 'user_id', 'issue_date' => 'issue_date', 'due_date' => 'due_date', 'return_date' => 'return_date', 'return_delay_fine' => 'return_delay_fine', 'book_return_condition' => 'book_return_condition', 'book_lost_fine' => 'book_lost_fine', 'remarks' => 'remarks', 'created' => 'created', 'created_by' => 'created_by', 'user_type' => 'user_type',);
            $cols = 'bledger_id,user_id,issue_date,due_date,return_date,return_delay_fine,book_return_condition,book_lost_fine,remarks,created,created_by,user_type';
            $data = $this->book_assign->get_book_assign_datatable(null, true, $tableHeading);
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
            $worksheet_name = 'book_assigns';
            $file_name = 'book_assigns' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
        $this->breadcrumbs->push('create', '/library/book_assigns/create');

        $this->layout->navTitle = 'Book assign create';
        $data = array();
        if ($this->input->post()):
            $config = array(
                array(
                    'field' => 'bledger_id',
                    'label' => 'bledger_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'issue_date',
                    'label' => 'issue_date',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'due_date',
                    'label' => 'due_date',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'return_date',
                    'label' => 'return_date',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'return_delay_fine',
                    'label' => 'return_delay_fine',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_return_condition',
                    'label' => 'book_return_condition',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_lost_fine',
                    'label' => 'book_lost_fine',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'remarks',
                    'label' => 'remarks',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'user_type',
                    'label' => 'user_type',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):

                $data['data'] = $this->input->post();
                $result = $this->book_assign->save($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('/library/book_assigns');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        endif;
        $data['bledger_id_list'] = $this->book_assign->get_book_ledgers_options('bledger_id', 'bledger_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * Edit Method
     * 
     * @param   $bassign_id=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function edit($bassign_id = null) {
        $this->breadcrumbs->push('edit', '/library/book_assigns/edit');

        $this->layout->navTitle = 'Book assign edit';
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
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'issue_date',
                    'label' => 'issue_date',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'due_date',
                    'label' => 'due_date',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'return_date',
                    'label' => 'return_date',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'return_delay_fine',
                    'label' => 'return_delay_fine',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_return_condition',
                    'label' => 'book_return_condition',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'book_lost_fine',
                    'label' => 'book_lost_fine',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'remarks',
                    'label' => 'remarks',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'user_type',
                    'label' => 'user_type',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):
                $result = $this->book_assign->update($data['data']);
                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully updated!');
                    redirect('/library/book_assigns');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        else:
            $bassign_id = c_decode($bassign_id);
            $result = $this->book_assign->get_book_assign(null, array('bassign_id' => $bassign_id));
            if ($result):
                $result = current($result);
            endif;
            $data['data'] = $result;
        endif;
        $data['bledger_id_list'] = $this->book_assign->get_book_ledgers_options('bledger_id', 'bledger_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * View Method
     * 
     * @param   $bassign_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function view($bassign_id) {
        $this->breadcrumbs->push('view', '/library/book_assigns/view');

        $data = array();
        if ($bassign_id):
            $bassign_id = c_decode($bassign_id);

            $this->layout->navTitle = 'Book assign view';
            $result = $this->book_assign->get_book_assign(null, array('bassign_id' => $bassign_id), 1);
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
            $bassign_id = $this->input->post('bassign_id');
            if ($bassign_id):
                $bassign_id = c_decode($bassign_id);

                $result = $this->book_assign->delete($bassign_id);
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