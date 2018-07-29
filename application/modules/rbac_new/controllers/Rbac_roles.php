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
        $data['data'] = $config;
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
            $data['data']['modified']=date('Y-m-d H:m:t');
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

}

?>