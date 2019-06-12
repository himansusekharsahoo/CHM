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
class Library_users extends CI_Controller
{

    /**
     * __construct Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('library_user');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
        $this->config->load('custom_app_config');
    }

    /**
     * Index Method
     * 
     * @param   
     * @desc    display library list
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function index()
    {
        if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'LIST'))
        {
            $this->breadcrumbs->push('index', base_url('library-users'));
            $this->scripts_include->includePlugins(array('datatable', 'chosen', 'print_element'), 'css');
            $this->scripts_include->includePlugins(array('datatable', 'chosen', 'print_element'), 'js');
            $this->layout->navTitle = 'Library user list';
            $this->layout->title = 'Library user list';
            $header = array(
                array(
                    'db_column' => 'user_name',
                    'name' => 'Name',
                    'title' => 'Name',
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ),
                array(
                    'db_column' => 'card_no',
                    'name' => 'Card Number',
                    'title' => 'Card Number',
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
            if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'VIEW'))
            {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-info',
                    'btn_href' => base_url('view-library-user'),
                    'btn_icon' => 'fa-eye',
                    'btn_title' => 'view library card',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => ''
                );
            }
            if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'EDIT'))
            {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-primary renew_member_card',
                    'btn_href' => '#',
                    'btn_icon' => 'fa-refresh',
                    'btn_title' => 'renew library card',
                    'btn_separator' => ' ',
                    'param' => array('$1'),
                    'style' => '',
                    'attr' => 'data-member_id="$1"'
                );
            }

            if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'DELETE'))
            {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-danger delete-record',
                    'btn_href' => '#',
                    'btn_icon' => 'fa-remove',
                    'btn_title' => 'delete library member',
                    'btn_separator' => '',
                    'param' => array('$1'),
                    'style' => '',
                    'attr' => 'data-member_id="$1"'
                );
            }
            if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'PRINT'))
            {
                $grid_buttons[] = array(
                    'btn_class' => 'btn-primary show_icard_modal',
                    'btn_href' => '#', //base_url('print-library-card'),
                    'btn_icon' => 'fa-print',
                    'btn_title' => 'print library card',
                    'btn_separator' => ' ',
                    'style' => 'margin-left:5px;',
                    'attr' => 'data-member_id="$1"'
                );
            }

            $button_set = get_link_buttons($grid_buttons);
            $data['button_set'] = $button_set;

            if ($this->input->is_ajax_request())
            {
                $columns = 'member_id,user_name,card_no,email,date_issue,expiry_date,status';
                $returned_list = $this->library_user->get_library_member_datatable($data, null, null, $columns);
                echo $returned_list;
                exit();
            }

            $dt_tool_btn = array(
                array(
                    'btn_class' => 'btn-primary',
                    'btn_href' => base_url('create-library-user'),
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
                    'dt_url' => base_url('library-users'),
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
        } else
        {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * Export_grid_data Method
     * 
     * @param   
     * @desc    export library grid data
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function export_grid_data()
    {
        if ($this->input->is_ajax_request()):
            if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'XLS_EXPORT') || $this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'CSV_EXPORT'))
            {
                $export_type = $this->input->post('export_type');
                $tableHeading = array(
                    'user_name' => 'user_name',
                    'card_no' => 'card_no',
                    'date_issue' => 'date_issue',
                    'expiry_date' => 'expiry_date',
                    'email' => 'email',
                    'mobile' => 'mobile',
                    'user_type' => 'user_type',
                    'code_list' => 'code_list',
                    'created' => 'created',
                    'created_by_name' => 'created_by_name',
                    'status' => 'status'
                );
                $data = $this->library_user->get_library_member_datatable(null, true, $tableHeading);
                $head_cols = $body_col_map = array();
                $date = array(
                    array(
                        'title' => 'Date of Export Report',
                        'value' => date('d-m-Y')
                    )
                );
                foreach ($tableHeading as $db_col => $col)
                {
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
            } else
            {
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
     * @desc    register new library user
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function create()
    {
        if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'CREATE'))
        {
            $this->scripts_include->includePlugins(array('jq_validation', 'jq_typehead', 'promise'), 'js');
            $this->scripts_include->includePlugins(array('bs_datepicker', 'jq_typehead'), 'css');
            $this->breadcrumbs->push('create', base_url('create-library-users'));

            $this->layout->navTitle = 'Library user create';
            $data = array();
            if ($this->input->is_ajax_request())
            {
                $post_data = array('user_id' => $this->input->post('user_id'));
                $user_type = 'old_user';
                $result = $this->library_user->save($post_data, $user_type);
                if ($result >= 1):
                    echo json_encode(array('status' => 'success', 'title' => 'Success', 'message' => 'Library member registered successfully.'));
                else:
                    echo json_encode(array('status' => 'error', 'title' => 'Error', 'message' => 'Unable to store the data, please conatact site admin!'));
                endif;
                exit;
            }else if ($this->input->post()):
                $data['data'] = $post_data = $this->input->post();
                $config = array(
                    array(
                        'field' => 'first_name',
                        'label' => 'first_name',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Please enter first name.',
                        )
                    ),
                    array(
                        'field' => 'last_name',
                        'label' => 'last_name',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Please enter last name.',
                        )
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Please enter email id.',
                        )
                    ),
                    array(
                        'field' => 'mobile',
                        'label' => 'mobile',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'Please enter mobile number.',
                        )
                    )
                );
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run()) :
                    $condition = " AND replace(lower(email),' ','')=replace(lower('" . $post_data['email'] . "'),' ','')";
                    if (!$this->library_user->check_duplicate($condition)) :

                        $result = $this->library_user->save($post_data, 'new_user');
                        if ($result >= 1):
                            $this->session->set_flashdata('success', 'User Registered successfully!');
                            redirect('create-library-user');
                        else:
                            $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                        endif;
                    else:
                        $this->session->set_flashdata('error', 'Email id is already exists, Please try another!');
                    endif;

                endif;
            endif;

            $this->layout->data = $data;
            $this->layout->render();
        }else
        {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function search_user()
    {
        if ($this->input->is_ajax_request())
        {
            $search_text = $this->input->post('search_text');
            $user_type = $this->input->post('user_type');
            $result = $this->library_user->search_lib_user($user_type, $search_text);
            echo json_encode(array(
                "status" => true,
                "error" => null,
                "data" => $result
            ));
            exit;
        } else
        {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * @param  : 
     * @desc   : display library user details after typehead dropdown selections
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function show_search_user_details()
    {
        if ($this->input->is_ajax_request())
        {
            $search_user_id = $this->input->post('user_id');
            $show_columns = array(
                'name' => 'Name',
                'email' => 'Email',
                'mobile' => 'Mobile',
                'user_status' => 'Status'
            );
            $condition = " and user_id=$search_user_id";
            $user_details = $this->library_user->searched_user_details($condition);
            //pma($user_details, 1);
            foreach ($user_details as $rec)
            {
                $markup = "<div class='col-sm-12 no_pad'>
                            <div class='col-sm-4'>
                                <div class='box box-widget widget-user-2 box-border'>
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class='widget-user-header bg-green'>
                                        <div class='widget-user-image'>";

                $photo = '';
                if ($rec['student_photo'])
                {
                    $photo = $rec['student_photo'];
                }
                if ($photo)
                {
                    $markup .= "<img class='img-circle' src='$photo'>";
                } else
                {
                    $markup .= "<span class='img-circle fa fa-user fa-3x' style='float:left;'></span>";
                }
                $markup .= "</div>
                                        <!-- /.widget-user-image -->
                                        <h3 class='widget-user-username'>" . $rec['first_name'] . " " . $rec['last_name'] . "</h3>                                        
                                    </div>
                                    <div class='box-footer no-padding'>
                                        <ul class='nav nav-stacked'>";
                $save_butn = 1;
                foreach ($show_columns as $db_column => $alias)
                {
                    if (array_key_exists($db_column, $rec))
                    {
                        if ($db_column == 'user_status' && $rec[$db_column] == 'inactive')
                        {
                            $save_butn = 0;
                            $markup .= "<li class='nav_search_user_li'>
                                                <div class='col-sm-12 no_pad'>
                                                    <span class='col-sm-4'>$alias</span>
                                                    <span class='col-sm-8'>" . $rec[$db_column] . " <span class='text-danger'>[Please contact Site Admin]</span></span>
                                                </div>
                                            </li> ";
                        } else
                        {
                            $markup .= "<li class='nav_search_user_li'>
                                                <div class='col-sm-12 no_pad'>
                                                    <span class='col-sm-4'>$alias</span>
                                                    <span class='col-sm-8'>" . $rec[$db_column] . "</span>
                                                </div>
                                            </li> ";
                        }
                    }
                }

                $markup .= "</ul>
                                        <br>
                                        <div class='col-sm-12'>";
                if ($save_butn == 1)
                {
                    $markup .= "<input type='button' id='create_lib_member' value='Save' class='btn btn-primary btn-xs pull-right marginB5'>";
                    $markup .= "<a href='#' id='cancel_old_user' class='btn btn-default btn-xs pull-right marginB5 marginR5'>Cancel</a>";
                } else
                {
                    $markup .= "<a href='#' id='cancel_old_user' class='btn btn-default btn-xs pull-right marginB5 marginR5'>Close</a>";
                }
                $markup .= "
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>";
            }
            echo $markup;
            exit;
        } else
        {
            $this->layout->render(array('error' => '401'));
        }
    }

    /**
     * Edit Method
     * 
     * @param   $member_id=null
     * @desc    edit library member data
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function renew_icard()
    {
        if ($this->input->is_ajax_request()):
            if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'EDIT'))
            {
                $member_id = $this->input->post('member_id');
                if ($member_id):
                    $member_id = c_decode($member_id);
                    $result = $this->library_user->renew_library_card($member_id);
                    if ($result):
                        echo json_encode(array('status' => 'success', 'title' => 'Renew library card', 'message' => 'Library card successfully renewed.'));
                    else:
                        echo json_encode(array('status' => 'error', 'title' => 'Renew library card', 'message' => 'Library card renew error, Please try again.'));
                    endif;
                    exit();
                endif;
                echo json_encode(array('status' => 'error', 'title' => 'Renew library card', 'message' => 'Library card renew error, Please try again.'));
                exit();
            }else
            {
                $this->layout->render(array('error' => '401'));
            }
        else:
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        endif;
    }

    /**
     * Edit Method
     * 
     * @param   $member_id=null
     * @desc    edit library member data
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function edit($member_id = null)
    {
        if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'EDIT'))
        {
            $this->scripts_include->includePlugins(array('jq_validation', 'bs_datepicker'), 'js');
            $this->scripts_include->includePlugins(array('bs_datepicker'), 'css');
            $this->breadcrumbs->push('edit', '/library/library_members/edit');

            $this->layout->navTitle = 'Renew library card';
            $data = array();
            if ($this->input->post()):
                $data['data'] = $this->input->post();
                $config = array(
                    array(
                        'field' => 'expiry_date',
                        'label' => 'expiry_date'
                    )
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run()):
                    $result = $this->library_user->update($data['data']);
                    if ($result >= 1):
                        $this->session->set_flashdata('success', 'Record successfully updated!');
                        redirect('library-members');
                    else:
                        $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                    endif;
                endif;
            else:
                $member_id = c_decode($member_id);
                $result = $this->library_user->get_library_member(null, array('member_id' => $member_id));
                if ($result):
                    $result = current($result);
                endif;

                $data['data'] = $result;
            endif;
            $this->layout->data = $data;
            $this->layout->render();
        }else
        {
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
    public function view($member_id)
    {
        if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'VIEW'))
        {
            $this->breadcrumbs->push('view', '/library/library_members/view');

            $data = array();
            if ($member_id):
                $member_id = c_decode($member_id);

                $this->layout->navTitle = 'Library member view';
                $result = $this->library_user->get_library_member(null, array('member_id' => $member_id), 1);
                if ($result):
                    $result = current($result);
                endif;
                $data['data'] = $result;
                $this->layout->data = $data;
                $this->layout->render();

            endif;
            return 0;
        }else
        {
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
    public function delete()
    {
        if ($this->input->is_ajax_request()):
            if ($this->rbac->has_permission('MANAGE_LIBRARY_MEMBERS', 'DELETE'))
            {
                $member_id = $this->input->post('member_id');
                if ($member_id):
                    $member_id = c_decode($member_id);

                    $result = $this->library_user->delete($member_id);
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
            }else
            {
                $this->layout->render(array('error' => '401'));
            }
        else:
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        endif;
        return 'Invalid request type.';
    }

    /**
     * 
     * @method
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   
     */
    public function print_library_card($id)
    {
        if ($id):
            $member_id = c_decode($id);
            $result = $this->library_user->get_library_member(null, array('member_id' => $member_id), 1);
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
                'fgcolor' => array(0, 0, 0),
                'bgcolor' => false, //array(255,255,255),
                'text' => false,
                'font' => 'helvetica',
                'fontsize' => 24,
                'stretchtext' => 20
            );
            ob_start();
            $this->load->library('Pdf');
            $pdf = new Pdf('L', 'mm', array(59, 98), true, 'UTF-8', false);
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
            $html = '<center><h1>Card Number: ' . $result[0]['card_no'] . '</h1>'
                    . '<b>Name: </b>' . $result[0]['user_id'] . '<br />'
                    . '<b>Date of Issue: </b>' . $result[0]['date_issue'] . '<br />'
                    . 'Expiry Date: ' . $result[0]['expiry_date'] . '<br />'
                    . '' . $pdf->write1DBarcode($result[0]['card_no'], 'C39E+', '', '', '120', 15, 0.4, $style, 'N') . '</center>';

            // output the HTML content
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output($result[0]['card_no'] . '.pdf', 'I');
        endif;
        return 0;
    }

    /**
     * 
     * @method generate_library_card
     * @param   NA
     * @desc    Used to generate barcode and qrcode and serve in ajax request to populate library card
     * @return JSON
     * @author  HimansuS                  
     * @since   
     */
    public function generate_library_card()
    {
        if ($this->input->is_ajax_request())
        {
            $member_id = $this->input->post('member_id');
            $result = $this->library_user->get_library_member(null, array('member_id' => c_decode($member_id)), 1);
            if (isset($result[0]))
            {
                $result = $result[0];
                //generate QR Code
                //generate Bar Code
                require_once APPPATH . 'libraries/Chm_qrcode.php';
                require_once APPPATH . 'libraries/Chm_barcode.php';
                $qrcode = new Chm_qrcode();
                $barcode = new Chm_barcode();
                $bar_code_details=array();
                
                $qr_data="Name:".ucfirst($result['first_name'].' '.$result['last_name']);
                $qr_data.="Card no".$result['card_no'];
                $qr_data.="Issue date".$result['date_issue'];
                $qr_data.="Expiry date".$result['expiry_date'];
                
                $qr_config = array(
                    'text' => $qr_data,
                    'size' => 3,
                );
                $qrcode_details = $qrcode->generate_qrcode($qr_config);
                $bar_code_details['qrcode_image']=base_url($qrcode_details['qrcode_image']);
                
                $bar_config = array(
                    'text' => ($result['card_no']) ? $result['card_no'] : $result['user_id']
                );                
                $barcode_details = $barcode->generate_barcode($bar_config);
                $bar_code_details['barcode_image'] = base_url($barcode_details['barcode_image']);
                $bar_code_details['user_name']=ucfirst($result['first_name'].' '.$result['last_name']);
                echo json_encode(array('status' => 'success', 'title' => 'Success', 'message' => '', 'data' => $bar_code_details));
            } else
            {
                echo json_encode(array('status' => 'error', 'title' => 'Print Library Card'));
            }
            exit;
        }
    }

    public function encode_id()
    {
        if ($this->input->is_ajax_request()):
            $id = $this->input->post('member_id');
            echo c_encode($id);
        else:
            $this->layout->data = array('status_code' => '403', 'message' => 'Request Forbidden.');
            $this->layout->render(array('error' => 'general'));
        endif;
    }

    public function unique_card_number()
    {
        $card_no = $this->input->post('card_no');
        $count = $this->library_user->unique_card_number($card_no);
        if ($count > 0)
        {
            echo 'false';
        } else
        {
            echo 'true';
        }
    }

    public function unique_user()
    {
        $user_id = $this->input->post('user_id');
        $count = $this->library_user->unique_user($user_id);
        if ($count > 0)
        {
            echo 'false';
        } else
        {
            echo 'true';
        }
    }

}

?>