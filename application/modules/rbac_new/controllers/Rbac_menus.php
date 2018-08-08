<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @class   : Rbac_menus
 * @desc    :
 * @author  : HimansuS
 * @created :05/17/2018
 */
class Rbac_menus extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('rbac_menu');
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

        $this->breadcrumbs->push('index', '/rbac_new/rbac_menus/index');
        $this->scripts_include->includePlugins(array('datatable'), 'css');
        $this->scripts_include->includePlugins(array('datatable'), 'js');
        $this->layout->navTitle = 'Rbac menu list';
        $data = array();
        $data = array();
        $buttons[] = array(
            'btn_class' => 'btn-info',
            'btn_href' => base_url('rbac_new/rbac_menus/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('rbac_new/rbac_menus/edit'),
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
            'attr' => 'data-menu_id="$1"'
        );
        $button_set = get_link_buttons($buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = '';
            $returned_list = $this->rbac_menu->get_rbac_menu_datatable($data);
            echo $returned_list;
            exit();
        }
        if ($export) {
            $tableHeading = array('name' => 'name', 'menu_order' => 'menu_order', 'parent' => 'parent', 'icon_class' => 'icon_class', 'menu_class' => 'menu_class', 'attribute' => 'attribute', 'permission_id' => 'permission_id', 'url' => 'url', 'menu_type' => 'menu_type', 'status' => 'status', 'created' => 'created', 'modified' => 'modified',);
            ;
            $this->rbac_menu->get_rbac_menu_datatable($data, $export, $tableHeading);
        }

        $config['grid_config'] = array(
            'table' => array(
                'columns' => array('name', 'menu_order', 'parent', 'icon_class', 'menu_class', 'attribute', 'permission_id', 'url', 'menu_type', 'status', 'created', 'modified'),
                'columns_alias' => array('name', 'menu_order', 'parent', 'icon_class', 'menu_class', 'attribute', 'permission_id', 'url', 'menu_type', 'status', 'created', 'modified', 'Action')
            ),
            'grid' => array(
                'ajax_source' => 'rbac_new/rbac_menus/index',
                'table_tools' => array('pdf', 'xls', 'csv'),
                'cfilter_columns' => array('name', 'menu_order', 'parent', 'icon_class', 'menu_class', 'attribute', 'permission_id', 'url', 'menu_type', 'status', 'created', 'modified'),
                'sort_columns' => array('name', 'menu_order', 'parent', 'icon_class', 'menu_class', 'attribute', 'permission_id', 'url', 'menu_type', 'status', 'created', 'modified'),
                'column_order' => array('0' => 'ASC'),
            //'cfilter_pos'=>'buttom'
            ),
            'table_tools' => array(
                'xls' => array(
                    'url' => 'rbac_new/rbac_menus/index/xls'
                ), 'csv' => array(
                    'url' => 'rbac_new/rbac_menus/index/csv'
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
        $this->breadcrumbs->push('create', '/rbac_new/rbac_menus/create');

        $this->layout->navTitle = 'Rbac menu create';
        $data = array();
        if ($this->input->post()):
            $config = array(
                array(
                    'field' => 'name',
                    'label' => 'name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'menu_order',
                    'label' => 'menu_order',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'parent',
                    'label' => 'parent',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'icon_class',
                    'label' => 'icon_class',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'menu_class',
                    'label' => 'menu_class',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'attribute',
                    'label' => 'attribute',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'permission_id',
                    'label' => 'permission_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'url',
                    'label' => 'url',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'menu_type',
                    'label' => 'menu_type',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'status',
                    'label' => 'status',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'created',
                    'label' => 'created',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'modified',
                    'label' => 'modified',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):

                $data['data'] = $this->input->post();
                $result = $this->rbac_menu->save($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully saved!');
                    redirect('/rbac_new/rbac_menus');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        endif;
        $data['permission_id_list'] = $this->rbac_menu->get_rbac_permissions_options('permission_id', 'permission_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

/**
     * @param  : $menu_id=null
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */

    public function edit($menu_id = null) {
        $this->breadcrumbs->push('edit', '/rbac_new/rbac_menus/edit');

        $this->layout->navTitle = 'Rbac menu edit';
        $data = array();
        if ($this->input->post()):
            $data['data'] = $this->input->post();
            $config = array(
                array(
                    'field' => 'name',
                    'label' => 'name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'menu_order',
                    'label' => 'menu_order',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'parent',
                    'label' => 'parent',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'icon_class',
                    'label' => 'icon_class',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'menu_class',
                    'label' => 'menu_class',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'attribute',
                    'label' => 'attribute',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'permission_id',
                    'label' => 'permission_id',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'url',
                    'label' => 'url',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'menu_type',
                    'label' => 'menu_type',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'status',
                    'label' => 'status',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'created',
                    'label' => 'created',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'modified',
                    'label' => 'modified',
                    'rules' => 'required'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()):

                $result = $this->rbac_menu->update($data['data']);

                if ($result >= 1):
                    $this->session->set_flashdata('success', 'Record successfully updated!');
                    redirect('/rbac_new/rbac_menus');
                else:
                    $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
                endif;
            endif;
        else:
            $menu_id = c_decode($menu_id);
            $result = $this->rbac_menu->get_rbac_menu(null, array('menu_id' => $menu_id));
            if ($result):
                $result = current($result);
            endif;
            $data['data'] = $result;
        endif;
        $data['permission_id_list'] = $this->rbac_menu->get_rbac_permissions_options('permission_id', 'permission_id');
        $this->layout->data = $data;
        $this->layout->render();
    }

/**
     * @param  : $menu_id
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */

    public function view($menu_id) {
        $this->breadcrumbs->push('view', '/rbac_new/rbac_menus/view');

        $data = array();
        if ($menu_id):
            $menu_id = c_decode($menu_id);

            $this->layout->navTitle = 'Rbac menu view';
            $result = $this->rbac_menu->get_rbac_menu(null, array('menu_id' => $menu_id), 1);
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
            $menu_id = $this->input->post('menu_id');
            if ($menu_id):
                $menu_id = c_decode($menu_id);

                $result = $this->rbac_menu->delete($menu_id);
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