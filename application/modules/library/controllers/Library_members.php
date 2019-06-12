<?php

/**
 * Library_members Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Library_members
 * @class      Library_members
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   11/08/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Library_members Class
 * 
 * @category   Library
 * @package    Library
 * @class      Library_members
 * @desc    
 * @author     HimansuS                  
 * @since   11/08/2018
 */
class Library_members extends CI_Controller {

    /**
     * __construct Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('library_member');
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
     * @since   11/08/2018
     */
    public function index() {
        if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'LIST')) {
            $this->breadcrumbs->push('index', '/library/library_members/index');
            $this->scripts_include->includePlugins(array('datatable','chosen'), 'css');
            $this->scripts_include->includePlugins(array('datatable','chosen'), 'js');
            $this->layout->navTitle = 'Library member list';
            $this->layout->title = 'Library member list';
            $header = array(
                array(
                    'db_column' => 'card_no',
                    'name' => 'Card Number',
                    'title' => 'Card Number',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'date_issue',
                    'name' => 'Issue Date',
                    'title' => 'Issue Date',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'expiry_date',
                    'name' => 'Expiry Date',
                    'title' => 'Expiry Date',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'email',
                    'name' => 'User Email',
                    'title' => 'User Email',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ), array(
                    'db_column' => 'user_role_id',
                    'name' => 'User Role',
                    'title' => 'User Role',
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
                'btn_href' => base_url('view-library-member'),
                'btn_icon' => 'fa-eye',
                'btn_title' => 'view record',
                'btn_separator' => ' ',
                'param' => array('$1'),
                'style' => ''
            );
            $grid_buttons[] = array(
                'btn_class' => 'btn-primary',
                'btn_href' => base_url('edit-library-member'),
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
                'attr' => 'data-member_id="$1"'
            );
            $grid_buttons[] = array(
                'btn_class' => 'btn-primary',
                'btn_href' => base_url('print-library-card'),
                'btn_icon' => 'fa-print',
                'btn_title' => 'print library card',
                'btn_separator' => ' ',
                'param' => array('$1'),
                'style' => 'margin-left:5px;',
                'attr' => 'target="_blank"'
            );
            $button_set = get_link_buttons($grid_buttons);
            $data['button_set'] = $button_set;

            if ($this->input->is_ajax_request()) {
                $returned_list = $this->library_member->get_library_member_datatable($data);
                echo $returned_list;
                exit();
            }

            $dt_tool_btn = array(
                array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('create-library-member'),
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
                    'dt_url' => base_url('library-members'),
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
        }else{
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
     * @since   11/08/2018
     */
    public function export_grid_data() {
        if ($this->input->is_ajax_request()):
            if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'XLS_EXPORT') || $this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'CSV_EXPORT')) {
                $export_type = $this->input->post('export_type');
                $tableHeading = array('card_no' => 'card_no', 'date_issue' => 'date_issue', 'expiry_date' => 'expiry_date', 'user_id' => 'user_id', 'user_role_id' => 'user_role_id', 'created' => 'created', 'created_by' => 'created_by', 'status' => 'status',);
                $cols = 'card_no,date_issue,expiry_date,user_id,user_role_id,created,created_by,status';
                $data = $this->library_member->get_library_member_datatable(null, true, $tableHeading);
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
                $worksheet_name = 'library_members';
                $file_name = 'library_members' . date('d_m_Y_H_i_s') . '.' . $export_type;
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
     * @since   11/08/2018
     */
    public function create() {
        if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'CREATE')) {
            $this->scripts_include->includePlugins(array('jq_validation', 'bs_datepicker'), 'js');
            $this->scripts_include->includePlugins(array('bs_datepicker'), 'css');
            $this->breadcrumbs->push('create', '/library/library_members/create');

            $this->layout->navTitle = 'Library member create';
            $data = array();
            if ($this->input->post()):
                $config = array(
                    array(
                        'field' => 'card_no',
                        'label' => 'card_no',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'date_issue',
                        'label' => 'date_issue',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'expiry_date',
                        'label' => 'expiry_date'
                    ),
                    array(
                        'field' => 'user_id',
                        'label' => 'user_id',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'user_role_id',
                        'label' => 'user_role_id',
                        'rules' => 'required'
                    ),
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run()):

                    $data['data'] = $this->input->post();
                    $result = $this->library_member->save($data['data']);

                    if ($result >= 1):
                        $this->session->set_flashdata('success', 'Record successfully saved!');
                        redirect('library-members');
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            endif;
            $data['user_list'] = $this->library_member->get_user_list('email', 'user_id',array('status'=>'active'));
            $data['user_list'][''] = "Select user email";
            $data['user_type_list'] = array('2' => 'Student','1' => 'Staff');
            $this->layout->data = $data;
            $this->layout->render();
        }else{
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * Edit Method
     * 
     * @param   $member_id=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function edit($member_id = null) {
        if($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'EDIT')){
            $this->scripts_include->includePlugins(array('jq_validation', 'bs_datepicker'), 'js');
            $this->scripts_include->includePlugins(array('bs_datepicker'), 'css');
            $this->breadcrumbs->push('edit', '/library/library_members/edit');

            $this->layout->navTitle = 'Library member edit';
            $data = array();
            if ($this->input->post()):
                $data['data'] = $this->input->post();
                $config = array(
                    array(
                        'field' => 'card_no',
                        'label' => 'card_no',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'date_issue',
                        'label' => 'date_issue',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'expiry_date',
                        'label' => 'expiry_date'
                    ),
                    array(
                        'field' => 'user_id',
                        'label' => 'user_id',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'user_role_id',
                        'label' => 'user_role_id',
                        'rules' => 'required'
                    ),
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run()):
                    $result = $this->library_member->update($data['data']);
                    if ($result >= 1):
                        $this->session->set_flashdata('success', 'Record successfully updated!');
                        redirect('library-members');
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            else:
                $member_id = c_decode($member_id);
                $result = $this->library_member->get_library_member(null, array('member_id' => $member_id));
                if ($result):
                    $result = current($result);
                endif;
                $data['data'] = $result;
            endif;

            $data['user_list'] = $this->library_member->get_user_list('email', 'user_id',array('status'=>'active'));
            $data['user_list'][''] = "Select user email";
            $data['user_type_list'] = array('2' => 'Student','1' => 'Staff');
            $this->layout->data = $data;
            $this->layout->render();
        }else{
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * View Method
     * 
     * @param   $member_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function view($member_id) {
        if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'VIEW')) {
            $this->breadcrumbs->push('view', '/library/library_members/view');

            $data = array();
            if ($member_id):
                $member_id = c_decode($member_id);

                $this->layout->navTitle = 'Library member view';
                $result = $this->library_member->get_library_member(null, array('member_id' => $member_id), 1);
                if ($result):
                    $result = current($result);
                endif;

                $data['data'] = $result;
                $this->layout->data = $data;
                $this->layout->render();

            endif;
            return 0;
        }else{
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
     * @since   11/08/2018
     */
    public function delete() {
        if ($this->input->is_ajax_request()):
            if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'DELETE')) {
                $member_id = $this->input->post('member_id');
                if ($member_id):
                    $member_id = c_decode($member_id);

                    $result = $this->library_member->delete($member_id);
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
            }else{
                $this->layout->render(array('error' => '401'));
            }
        else:
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        endif;
        return 'Invalid request type.';
    }

    public function print_library_card($id) {
        if ($id):
            $member_id = c_decode($id);
            $result = $this->library_member->get_library_member(null, array('member_id' => $member_id), 1);
            //print_r($result);exit;
            $style = array(
                'position' => 'C',
                'align' => 'C',
                'stretch' => true,
                'fitwidth' => true,
                'cellfitalign' => '',
                'border' => false,
                'hpadding' => 'auto',
                'vpadding' => 'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255),
                'text' => false,
                'font' => 'helvetica',
                'fontsize' => 24,
                'stretchtext' => 20
            );
            ob_start();
            $this->load->library('Pdf');
            $pdf = new Pdf('L', 'mm', array(59,98), true, 'UTF-8', false);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetTitle('Library member card');
            $pdf->SetHeaderMargin(0);
            $pdf->SetTopMargin(0);
            $pdf->setFooterMargin(0);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('CHM');
            $pdf->AddPage();
            $pdf->SetLineStyle(array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0)));
            $html = '<center><h1>Card Number: '.$result[0]['card_no'].'</h1>'
                    . '<b>Name: </b>'.$result[0]['user_id'].'<br />'
                    . '<b>Date of Issue: </b>'.$result[0]['date_issue'].'<br />'
                    . 'Expiry Date: '.$result[0]['expiry_date'].'<br />'
                    . ''.$pdf->write1DBarcode($result[0]['card_no'], 'C39E+', '', '', '120', 15, 0.4, $style, 'N').'</center>';

            // output the HTML content
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output($result[0]['card_no'].'.pdf', 'I');
        endif;
        return 0;
    }
    
    public function encode_id() {
        if ($this->input->is_ajax_request()):
            $id = $this->input->post('member_id');
            echo c_encode($id);
        else:
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        endif;
    }
    
    public function unique_card_number() {
        $card_no = $this->input->post('card_no');
        $count = $this->library_member->unique_card_number($card_no);
        if ($count > 0) {
            echo 'false';
        } else {
            echo 'true';
        }
    }
    public function unique_user() {
        $user_id = $this->input->post('user_id');
        $count = $this->library_member->unique_user($user_id);
        if ($count > 0) {
            echo 'false';
        } else {
            echo 'true';
        }
    }
}

?>