<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @class   : Rbac_permissions
 * @desc    :
 * @author  : HimansuS
 * @created :05/17/2018
 */
class Rbac_permissions extends CI_Controller { 

    public function __construct() {
        parent::__construct();

        $this->load->model('rbac_permission');
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
     * @author : HimansuS
     * @created:05/17/2018
     */
    public function index($export = 0) {

        $this->breadcrumbs->push('index', '/rbac_new/rbac_permissions/index');
        $this->scripts_include->includePlugins(array('datatable'), 'css');
        $this->scripts_include->includePlugins(array('datatable'), 'js');
        $this->layout->navTitle = 'Rbac permission list';
        $data = array();
        $data = array();
        $buttons[] = array(
            'btn_class' => 'btn-info',
            'btn_href' => base_url('rbac_new/rbac_permissions/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('rbac_new/rbac_permissions/edit'),
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
            'attr' => 'data-permission_id="$1"'
        );
        $button_set = get_link_buttons($buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = '';
            $returned_list = $this->rbac_permission->get_rbac_permission_datatable($data);
            echo $returned_list;
            exit();
        }
        if ($export) {
            $tableHeading = array('module_id' => 'module_id', 'action_id' => 'action_id', 'status' => 'status', 'created' => 'created', 'modified' => 'modified',);
            ;
            $this->rbac_permission->get_rbac_permission_datatable($data, $export, $tableHeading);
        }

        $config['grid_config'] = array(
            'table' => array(
                'columns' => array('module_id', 'action_id', 'status', 'created', 'modified'),
                'columns_alias' => array('module_id', 'action_id', 'status', 'created', 'modified', 'Action')
            ),
            'grid' => array(
                'ajax_source' => 'rbac_new/rbac_permissions/index',
                'table_tools' => array('pdf', 'xls', 'csv'),
                'cfilter_columns' => array('module_id', 'action_id', 'status', 'created', 'modified'),
                'sort_columns' => array('module_id', 'action_id', 'status', 'created', 'modified'),
                'column_order' => array('0' => 'ASC'),
            //'cfilter_pos'=>'buttom'
            ),
            'table_tools' => array(
                'xls' => array(
                    'url' => 'rbac_new/rbac_permissions/index/xls'
                ), 'csv' => array(
                    'url' => 'rbac_new/rbac_permissions/index/csv'
                )
            )
        );
        $data['data'] = $config;
        $this->layout->render($data);
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:05/17/2018
     */
    public function create() {
        $this->breadcrumbs->push('create', '/rbac_new/rbac_permissions/create');

        $this->layout->navTitle = 'Rbac permission create';
        $data = array();
        if ($this->input->post()):
            $config = array(
                array(
                    'field' => 'module_id',
                    'label' => 'module_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'action_id',
                    'label' => 'action_id',
                    'rules' => 'required'
                )
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):

                $data['data'] = $this->input->post();
                $result = $this->rbac_permission->save($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('/rbac_new/rbac_permissions');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        endif;
        $data['action_id_list'] = $this->rbac_permission->get_rbac_actions_options('action_id', 'action_id');
        $data['module_id_list'] = $this->rbac_permission->get_rbac_modules_options('module_id', 'module_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * @param  : $permission_id=null
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:05/17/2018
     */
    public function edit($permission_id = null) {
        $this->breadcrumbs->push('edit', '/rbac_new/rbac_permissions/edit');

        $this->layout->navTitle = 'Rbac permission edit';
        $data = array(
            'status_list' => array('active' => 'active', 'inactive' => 'inactive')
        );
        if ($this->input->post()):
            $data['data'] = $this->input->post();
            $data['data']['modified'] = date('Y-m-d H:m:t');
            $config = array(
                array(
                    'field' => 'module_id',
                    'label' => 'module_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'action_id',
                    'label' => 'action_id',
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

                $result = $this->rbac_permission->update($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully updated!');
                    redirect('/rbac_new/rbac_permissions');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        else:
            $permission_id = c_decode($permission_id);
            $result = $this->rbac_permission->get_rbac_permission(null, array('permission_id' => $permission_id));
            if ($result):
                $result = current($result);
            endif;
            $data['data'] = $result;
        endif;
        $data['action_id_list'] = $this->rbac_permission->get_rbac_actions_options('action_id', 'action_id');
        $data['module_id_list'] = $this->rbac_permission->get_rbac_modules_options('module_id', 'module_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * @param  : $permission_id
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:05/17/2018
     */
    public function view($permission_id) {
        $this->breadcrumbs->push('view', '/rbac_new/rbac_permissions/view');

        $data = array();
        if ($permission_id):
            $permission_id = c_decode($permission_id);

            $this->layout->navTitle = 'Rbac permission view';
            $result = $this->rbac_permission->get_rbac_permission(null, array('permission_id' => $permission_id), 1);
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
     * @author : HimansuS
     * @created:05/17/2018
     */
    public function delete() {
        if ($this->input->is_ajax_request()):
            $permission_id = $this->input->post('permission_id');
            if ($permission_id):
                $permission_id = c_decode($permission_id);

                $result = $this->rbac_permission->delete($permission_id);
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
     * @desc
     * @author: HimansuS
     */
    public function module_action() {
        $data = array(
            'criteria' => array(),
            'module_options' => $this->rbac_permission->get_rbac_modules_options('name'),
            'actions' => $this->rbac_permission->get_rbac_actions_options('name'),
        );
        if ($this->input->post()) {
            pma($this->input->post());
        }
        $this->layout->data = $data;
        $this->layout->render();
    }
    /**
     * @param
     * @return
     * @desc
     * @author
     */
    public function assign_module_action() {
        $data = array(
            'criteria' => array(),
            'module_options' => $this->rbac_permission->get_rbac_modules_options('name'),
            'module_options_json' => json_encode($this->rbac_permission->get_rbac_modules_options('name')),
            'actions' => $this->rbac_permission->get_rbac_actions_options('name'),
        );
        if ($this->input->post()) {
            pma($this->input->post());
        }
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * @param
     * @return
     * @desc
     * @author: HimansuS
     */
    public function new_module_action() {
        //app_log('CUSTOM','APP','TEST LOGGING');
        $this->layout->navTitle='test page';
        $module_codes=$this->rbac_permission->get_rbac_modules_options('code');        
        $action_codes=$this->rbac_permission->get_rbac_actions_options('code');            
        $module_codes=array_slice($module_codes,1);
        $action_codes=array_slice($action_codes,1);        
        $actions=$this->rbac_permission->get_rbac_actions_options('name');
        $actions=array_slice($actions,1,null,true);
        $conditions=array('t1.status'=>'active');
        $existing_perms=  $this->rbac_permission->get_rbac_permission(null,$conditions);
        //pma($existing_perms);
        $existing_perms=  tree_on_key_column($existing_perms,'module_id');
        
        $data = array(
            'criteria' => array(),
            'module_options' => $this->rbac_permission->get_rbac_modules_options('name'),
            'module_codes_json' => json_encode($module_codes),
            'action_codes_json' => json_encode($action_codes),
            'action_json' => json_encode($actions),
            'actions' => $actions,
            'existing_perms'=>$existing_perms
        );
        
        //pma($data['existing_perms'],1);
        if ($this->input->post()) {
            $permissions=$this->input->post('permission');            
            //pma($permissions,1);
            if($this->rbac_permission->save_module_action($permissions)){
                redirect('/rbac_new/rbac_permissions/new_module_action');
            }else{
                
            }            
        }
        $this->layout->data = $data;
        $this->layout->render();
    }

}

?>