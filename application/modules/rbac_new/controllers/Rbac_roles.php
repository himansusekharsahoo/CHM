<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @class   : Rbac_roles
 * @desc    :
 * @author  : HimansuS
 * @created :05/17/2018
 */
class Rbac_roles extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('rbac_role');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * @param  : $export=0
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function index($export = 0) {

        $this->breadcrumbs->push('index', '/rbac_new/rbac_roles/index');
        $this->scripts_include->includePlugins(array('datatable'), 'css');
        $this->scripts_include->includePlugins(array('datatable'), 'js');
        $this->layout->navTitle = 'Rbac role list';
        $data = array();
        $data = array();
        $buttons[] = array(
            'btn_class' => 'btn-info',
            'btn_href' => base_url('rbac_new/rbac_roles/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('rbac_new/rbac_roles/edit'),
            'btn_icon' => 'fa-pencil',
            'btn_title' => 'edit record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );

        $buttons[] = array(
            'btn_class' => 'btn-danger delete-record',
            'btn_href' => '#',
            'btn_icon' => 'fa-remove',
            'btn_title' => 'delete record',
            'btn_separator' => '',
            'param' => array('$1'),
            'style' => '',
            'attr' => 'data-role_id="$1"'
        );
        $button_set = get_link_buttons($buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = '';
            $returned_list = $this->rbac_role->get_rbac_role_datatable($data);            
            echo $returned_list;
            exit();
        }
        if ($export) {
            $tableHeading = array('name' => 'name', 'code' => 'code', 'status' => 'status', 'created' => 'created', 'modified' => 'modified', 'created_by' => 'created_by', 'modified_by' => 'modified_by',);
            ;
            $this->rbac_role->get_rbac_role_datatable($data, $export, $tableHeading);
        }

        $config['grid_config'] = array(
            'table' => array(
                'columns' => array('name', 'code', 'status', 'created', 'modified', 'created_by', 'modified_by'),
                'columns_alias' => array('name', 'code', 'status', 'created', 'modified', 'created_by', 'modified_by', 'Action')
            ),
            'grid' => array(
                'ajax_source' => 'rbac_new/rbac_roles/index',
                'table_tools' => array('pdf', 'xls', 'csv'),
                'cfilter_columns' => array('name', 'code', 'status', 'created', 'modified', 'created_by', 'modified_by'),
                'sort_columns' => array('name', 'code', 'status', 'created', 'modified', 'created_by', 'modified_by'),
                'column_order' => array('0' => 'ASC'),
            //'cfilter_pos'=>'buttom'
            ),
            'table_tools' => array(
                'xls' => array(
                    'url' => 'rbac_new/rbac_roles/index/xls'
                ), 'csv' => array(
                    'url' => 'rbac_new/rbac_roles/index/csv'
                )
            )
        );
        $header = array(
            array(
                'db_column' => 'name',
                'title' => 'NAME',
                'class_name' => 'dt_name',
                'orderable' => 'true',
                'visible' => 'true',
                'searchable' => 'true'
            ),
            array(
                'db_column' => 'code',
                'title' => 'CODE',
                'class_name' => 'dt_cuid',
                'orderable' => 'true',
                'visible' => 'true'
            ),
            array(
                'db_column' => 'action',
                'title' => 'Action',
                'class_name' => 'dt_cuid',
                'orderable' => 'true',
                'visible' => 'true'
            )
        );
        $config = array(
            'dt_markup' => TRUE,
            'dt_id' => 'raw_cert_data_dt_table',
            'dt_header' => $header,
            //'dt_extra_header' => $dt_extra_head,
            //'dt_post_data' => 'filters',
            'dt_ajax' => array(
                'dt_url' => base_url('/rbac_new/rbac_roles/index')
            ),
            'custom_lengh_change' => true,
            'dt_dom' => '<<"row " <"col-md-3 no_rpad" <"col-sm-10 custom_length_box no_pad "><"col-sm-2 custom_length_box_all no_pad ">><"col-md-9 no-pad " <"col-md-12 no-pad" <" marginR20" f>>>><t><"row marginT10" <"col-md-12 no-pad" <"col-md-12 no-pad" <"page-jump pull-right col-sm-6" <"pull-right marginL20" p>>>>>',
            'options' => array(
                'iDisplayLength' => '5'
            )
        );
        $data['data'] = array('config'=>$config);
        $this->layout->render($data);
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function create() {
        $this->breadcrumbs->push('create', '/rbac_new/rbac_roles/create');

        $this->layout->navTitle = 'Rbac role create';
        $data = array();
        if ($this->input->post()):
            $config = array(
                array(
                    'field' => 'name',
                    'label' => 'name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'code',
                    'label' => 'code',
                    'rules' => 'required'
                )
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):

                $data['data'] = $this->input->post();
                $result = $this->rbac_role->save($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('/rbac_new/rbac_roles');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        endif;
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * @param  : $role_id=null
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function edit($role_id = null) {
        $this->breadcrumbs->push('edit', '/rbac_new/rbac_roles/edit');

        $this->layout->navTitle = 'Rbac role edit';
        $data = array(
            'status_list' => array('active' => 'active', 'inactive' => 'inactive')
        );
        if ($this->input->post()):
            $data['data'] = $this->input->post();
            $data['data']['modified'] = date('Y-m-d H:m:t');
            $config = array(
                array(
                    'field' => 'name',
                    'label' => 'name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'code',
                    'label' => 'code',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'status',
                    'label' => 'status',
                    'rules' => 'required'
                )
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):

                $result = $this->rbac_role->update($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully updated!');
                    redirect('/rbac_new/rbac_roles');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        else:
            $role_id = c_decode($role_id);
            $result = $this->rbac_role->get_rbac_role(null, array('role_id' => $role_id));
            if ($result):
                $result = current($result);
            endif;
            $data['data'] = $result;
        endif;
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * @param  : $role_id
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function view($role_id) {
        $this->breadcrumbs->push('view', '/rbac_new/rbac_roles/view');

        $data = array();
        if ($role_id):
            $role_id = c_decode($role_id);

            $this->layout->navTitle = 'Rbac role view';
            $result = $this->rbac_role->get_rbac_role(null, array('role_id' => $role_id), 1);
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
     * @param  : 
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function delete() {
        if ($this->input->is_ajax_request()):
            $role_id = $this->input->post('role_id');
            if ($role_id):
                $role_id = c_decode($role_id);

                $result = $this->rbac_role->delete($role_id);
                if ($result == 1):
                    echo '1';
                    exit();
                else:
                    echo '0';
                    exit();
                endif;
            endif;
            echo 'No data found to delete';
            exit();
        endif;
        return 'Invalid request type.';
    }

    /**
     * @param
     * @return
     * @desc get datatable dynamic code
     * @author
     */
    public function get_cert_dynamic_dt_code() {

        if ($this->input->is_ajax_request()) {
            $input_values = $this->session->userdata('TOP_CERTS_ANA_REPO_CHART_FILTER');
            $chart_data = $this->Certificate_analytical_report->get_top_cert($input_values['FILTER_DATA']);

            $certs = $header2 = array();
            if (isset($chart_data) && is_array($chart_data)) {
                foreach ($chart_data as $rec) {
                    $certs[$rec['SDP_CERTTITLE_ID']] = $rec['SDP_CERT_TITLE'];
                }
            }
            $certs_colspan = count($certs) * 2;
            $emp_det_header = array(
                array(
                    'db_column' => 'NAME',
                    'title' => $this->lang->line("SDP_CERT_ANA_REPO_RAWTB_NAME"),
                    'class_name' => 'dt_name',
                    'orderable' => 'true',
                    'visible' => 'true',
                    'searchable' => 'true'
                ),
                array(
                    'db_column' => 'CUID',
                    'title' => $this->lang->line("SDP_CERT_ANA_REPO_RAWTB_CUID"),
                    'class_name' => 'dt_cuid',
                    'orderable' => 'true',
                    'visible' => 'true'
                )
            );
            $cert_header = $cert_prof_header = array();
            $cert_header_flag = false;
            foreach ($certs as $cert_id => $cert_name) {
                $cert_prof_header[] = array(
                    'db_column' => 'SDP_CERTS_PROFICIENCY',
                    'title' => $this->lang->line("SDP_CERT_ANA_PROFICIENCY"),
                    'class_name' => 'dt_cert',
                    'orderable' => 'false',
                    'visible' => 'true',
                    'data' => 'function(item) {
                                if(item.' . $cert_id . '){
                                    return item.' . $cert_id . ';
                                }
                                return \'\';
                           }',
                    'cert_id' => $cert_id
                );
                $cert_prof_header[] = array(
                    'db_column' => 'SDP_CERT_VENDOR_NAME',
                    'title' => $this->lang->line("SDP_CERT_ANA_VENDOR"),
                    'class_name' => 'dt_cert',
                    'orderable' => 'false',
                    'visible' => 'true',
                    'data' => 'function(item) {
                            if(item.' . $cert_id . '_V){
                                return item.' . $cert_id . '_V;
                            }
                            return \'\';                                
                           }',
                    'cert_id' => $cert_id
                );
                $cert_header[] = array(
                    'class' => 'dt_top_head dt_cert',
                    'title' => $cert_name,
                    'colspan' => '2',
                    'style' => 'width:240px'
                );
                $cert_header_flag = true;
            }

            $mngr_det_header = array(
                array(
                    'db_column' => 'MANAGER_NAME',
                    'title' => $this->lang->line("SDP_CERT_ANA_REPO_RAWTB_MNGR_NAME"),
                    'class_name' => 'dt_name',
                    'orderable' => 'false',
                    'visible' => 'true'
                ), array(
                    'db_column' => 'MANAGER_CUID',
                    'title' => $this->lang->line("SDP_CERT_ANA_REPO_RAWTB_MNGR_CUID"),
                    'class_name' => 'dt_cuid',
                    'orderable' => 'false',
                    'visible' => 'true'
                ),
                array(
                    'db_column' => 'EQ_DEPT_DESCR80',
                    'title' => $this->lang->line("SDP_CERT_ANA_REPO_RAWTB_DEPT"),
                    'class_name' => 'dt_dept',
                    'orderable' => 'false',
                    'visible' => 'true'
                ),
                array(
                    'db_column' => 'EQ_P3_DESCR',
                    'title' => $this->lang->line("SDP_CERT_ANA_REPO_RAWTB_ENTITY"),
                    'class_name' => 'dt_entity',
                    'orderable' => 'false',
                    'visible' => 'true'
                ),
                array(
                    'db_column' => 'COUNTRY',
                    'title' => $this->lang->line("SDP_CERT_ANA_REPO_RAWTB_COUNTRY"),
                    'class_name' => 'dt_country',
                    'orderable' => 'false',
                    'visible' => 'true'
                )
            );
            $header = array_merge($emp_det_header, $cert_prof_header, $mngr_det_header);
            $this->session->set_userdata('TOP_CERTS_ANA_REPO_RAW_TB_DYNA_HEADER', $header);
            //pma($header,1);
            $extra_head_temp = array(
                array(
                    'class' => 'dt_top_head dt_emp middle_align',
                    'title' => $this->lang->line("SDP_CERT_ANA_REPO_RAWTB_EMP_DET"),
                    'colspan' => '2',
                    'rowspan' => ($cert_header_flag) ? '2' : "",
                ),
                array(
                    'class' => 'dt_top_head dt_emp',
                    'title' => $this->lang->line("SDP_CERT_ANA_REPO_RAWTB_TOP_CERT_HEAD"),
                    'colspan' => $certs_colspan
                ),
                array(
                    'class' => 'dt_top_head dt_mngr middle_align',
                    'title' => $this->lang->line("SDP_CERT_ANA_REPO_RAWTB_MNGR_DET"),
                    'colspan' => '2',
                    'rowspan' => ($cert_header_flag) ? '2' : ""
                ),
                array(
                    'class' => 'dt_top_head dt_hier middle_align',
                    'title' => $this->lang->line("SDP_CERT_ANA_REPO_RAWTB_HIERARCHY"),
                    'colspan' => '2',
                    'rowspan' => ($cert_header_flag) ? '2' : ""
                ),
                array(
                    'class' => 'dt_top_head dt_other middle_align',
                    'title' => $this->lang->line("SDP_CERT_ANA_REPO_RAWTB_LOCATION"),
                    'rowspan' => ($cert_header_flag) ? '2' : ""
                )
            );
            $dt_extra_head = array('markup' => array());
            //remove certification column
            if ($cert_header_flag === false) {
                unset($extra_head_temp[1]);
            }
            $dt_extra_head['markup'][] = $extra_head_temp;

            if ($cert_header_flag) {
                $dt_extra_head['markup'][] = $cert_header;
            }

            $this->session->set_userdata('TOP_CERT_ANA_REPO_RAW_TB_DYNA_EXTRA_HEADER', $dt_extra_head['markup']);

            $config = array(
                'dt_markup' => TRUE,
                'dt_id' => 'raw_cert_data_dt_table',
                'dt_header' => $header,
                'dt_extra_header' => $dt_extra_head,
                //'dt_post_data' => 'filters',
                'dt_ajax' => array(
                    'dt_url' => '/certificate_analytical_reports/get_cert_chart_raw_data_dt'
                ),
                'custom_lengh_change' => true,
                'dt_dom' => '<<"row " <"col-md-3 no_rpad" <"col-sm-10 custom_length_box no_pad "><"col-sm-2 custom_length_box_all no_pad ">><"col-md-9 no-pad " <"col-md-12 no-pad" <" marginR20" f>>>><t><"row marginT10" <"col-md-12 no-pad" <"col-md-12 no-pad" <"page-jump pull-right col-sm-6" <"pull-right marginL20" p>>>>>',
                'options' => array(
                    'iDisplayLength' => '5'
                )
            );

            $this->load->library('c_datatable');
            $dt_data = $this->c_datatable->generate_grid($config);
            echo json_encode(array("status" => 'success', 'data' => $dt_data));
            exit;
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

}

?>