<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tree extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
        $this->load->model('menu');
    }

    public function index() {
        $this->scripts_include->includePlugins(array('jstree', 'js'));
        $column = "rp.permission_id id,rp.order,rp.parent prnt,
                case when length(rp.menu_name)>1 then rp.menu_name else concat(rm.name,'-',ra.name) end text,rp.menu_header,rm.code,rp.action_id";
//        $permission_list = $this->menu->get_menu_data($column, null, true);
//        $permission_list = $this->rbac->tree_view2($permission_list, 0, 'id', 'prnt', true); 
//        pma($permission_list,1);    
//        //echo json_encode(array_values($permission_list));
        $this->layout->render();
    }

    public function get_tree_data() {
        $column = "rp.permission_id id,rp.order,rp.parent prnt,
                case when length(rp.menu_name)>1 then rp.menu_name else concat(rm.name,'-',ra.name) end text,rp.menu_header,rm.code,rp.action_id";
        $column = null;
        $permission_list = $this->menu->get_menu_data($column, null, true);
        if ($permission_list) {
            $permission_list = $this->rbac->tree_view2($permission_list, 0, 'menu_id', 'prnt', true);
        }
        echo json_encode(array_values($permission_list));
        exit;
    }

    public function get_menu_details_form() {
        if ($this->input->is_ajax_request()) {
            $view = $this->layout->render(array('view' => 'tree/menu_details_form'), true);
            echo $view;
        }
    }

    public function update_parent_and_order() {
        if ($this->input->is_ajax_request()) {
            $data = $this->input->post();
            $this->menu->update_menu_parent($data);
            exit;
        }
    }

    /**
     * @method 
     * @param
     * @desc
     * @author
     * @date
     */
    public function save_menu_details() {
        if ($this->input->is_ajax_request()) {
            $post_data = $this->input->post('menu_data');
            if($this->menu->save_menu_details($post_data)){
                echo "success";
            }else{
                echo "error";
            }
        } else {
            echo "invalid request type";
        }
    }

}

?>