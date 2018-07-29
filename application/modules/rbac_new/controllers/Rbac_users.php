<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @class   : Rbac_users
 * @desc    :
 * @author  : HimansuS
 * @created :05/17/2018
 */
class Rbac_users extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('rbac_user');
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

        $this->breadcrumbs->push('index', '/rbac_new/rbac_users/index');
        $this->scripts_include->includePlugins(array('datatable'), 'css');
        $this->scripts_include->includePlugins(array('datatable'), 'js');
        $this->layout->navTitle = 'Rbac user list';
        $data = array();
        $data = array();
        $buttons[] = array(
            'btn_class' => 'btn-info',
            'btn_href' => base_url('rbac_new/rbac_users/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('rbac_new/rbac_users/edit'),
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
            'attr' => 'data-user_id="$1"'
        );
        $button_set = get_link_buttons($buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = '';
            $returned_list = $this->rbac_user->get_rbac_user_datatable($data);
            echo $returned_list;
            exit();
        }
        if ($export) {
            $tableHeading = array('first_name' => 'first_name', 'last_name' => 'last_name', 'login_id' => 'login_id', 'email' => 'email', 'password' => 'password', 'login_status' => 'login_status', 'mobile' => 'mobile', 'mobile_verified' => 'mobile_verified', 'emial_verified' => 'emial_verified', 'created' => 'created', 'modified' => 'modified', 'created_by' => 'created_by', 'modified_by' => 'modified_by', 'status' => 'status',);
            ;
            $this->rbac_user->get_rbac_user_datatable($data, $export, $tableHeading);
        }

        $config['grid_config'] = array(
            'table' => array(
                'columns' => array('first_name', 'last_name', 'login_id', 'email', 'mobile', 'status'),
                'columns_alias' => array('first_name', 'last_name', 'login_id', 'email', 'mobile', 'status', 'Action')
            ),
            'grid' => array(
                'ajax_source' => 'rbac_new/rbac_users/index',
                'table_tools' => array('pdf', 'xls', 'csv'),
                'cfilter_columns' => array('first_name', 'last_name', 'login_id', 'email', 'mobile', 'status'),
                'sort_columns' => array('first_name', 'last_name', 'login_id', 'email', 'mobile','status'),
                'column_order' => array('0' => 'ASC'),
            //'cfilter_pos'=>'buttom'
            ),
            'table_tools' => array(
                'xls' => array(
                    'url' => 'rbac_new/rbac_users/index/xls'
                ), 'csv' => array(
                    'url' => 'rbac_new/rbac_users/index/csv'
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
        $this->breadcrumbs->push('create', '/rbac_new/rbac_users/create');

        $this->layout->navTitle = 'Rbac user create';
        $data = array();
        if ($this->input->post()):
            $config = array(
                array(
                    'field' => 'first_name',
                    'label' => 'first_name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'last_name',
                    'label' => 'last_name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'login_id',
                    'label' => 'login_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'password',
                    'label' => 'password',
                    'rules' => 'required'
                ),                
                array(
                    'field' => 'mobile',
                    'label' => 'mobile',
                    'rules' => 'required'
                )
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):

                $data['data'] = $this->input->post();
                $result = $this->rbac_user->save($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('/rbac_new/rbac_users');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        endif;
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * @param  : $user_id=null
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function edit($user_id = null) {
        $this->breadcrumbs->push('edit', '/rbac_new/rbac_users/edit');

        $this->layout->navTitle = 'Rbac user edit';
        $data = array();
        if ($this->input->post()):
            $data['data'] = $this->input->post();
            $config = array(
                array(
                    'field' => 'first_name',
                    'label' => 'first_name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'last_name',
                    'label' => 'last_name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'login_id',
                    'label' => 'login_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'password',
                    'label' => 'password',
                    'rules' => 'required'
                ),                
                array(
                    'field' => 'mobile',
                    'label' => 'mobile',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'status',
                    'label' => 'status',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):

                $result = $this->rbac_user->update($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully updated!');
                    redirect('/rbac_new/rbac_users');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        else:
            $user_id = c_decode($user_id);
            $result = $this->rbac_user->get_rbac_user(null, array('user_id' => $user_id));
            if ($result):
                $result = current($result);
            endif;
            $data['data'] = $result;
        endif;
        $this->layout->data = $data;
        $this->layout->render();
    }

    /**
     * @param  : $user_id
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function view($user_id) {
        $this->breadcrumbs->push('view', '/rbac_new/rbac_users/view');

        $data = array();
        if ($user_id):
            $user_id = c_decode($user_id);

            $this->layout->navTitle = 'Rbac user view';
            $result = $this->rbac_user->get_rbac_user(null, array('user_id' => $user_id), 1);
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
            $user_id = $this->input->post('user_id');
            if ($user_id):
                $user_id = c_decode($user_id);

                $result = $this->rbac_user->delete($user_id);
                if ($result == 1):
                    echo 'success';
                    exit();
                else:
                    echo 'Data deletion error !';
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