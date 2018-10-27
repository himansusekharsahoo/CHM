<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
    }

    /**
     * @param  : NA
     * @desc   : lising the users
     * @return : NA
     * @author : himansus
     */
    public function index() {
        if (!$this->rbac->is_login()) {
            redirect(APP_BASE . 'admin_users/sign_in');
        } else {
            
        }
        $this->layout->render();
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author :
     */
    public function sign_in() {
        $this->scripts_include->includePlugins(array('jq_validation'),'js');
        
        $this->layout->layout = 'blank_layout';
        if ($this->input->post()) {
            //server side validation
            $rules = array(
                array(
                    'field' => 'user_email',
                    'label' => 'Email',
                    'rules' => 'required|valid_email'
                ),
                array(
                    'field' => 'user_pass',
                    'label' => 'Password',
                    'rules' => 'required'
                )
            );
            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() == TRUE) {

                $email = $this->input->post('user_email');
                $pass = $this->input->post('user_pass');
                $condition = array('email' => $email, 'password' => $pass);
                $user_detail = $this->user->get_user_detail(null, $condition);

                if ($user_detail) {
                    $admin_flag = FALSE;
                    $menus = $permissions = array();
                    if (in_array('ADMIN', $user_detail['role_codes'])) {
                        //fetch all the permissions
                        //$condition = 'rp.menu_type="l"';
                        $permissions = $this->rbac_role_permission->get_rbac_role_permission_lib(null, null, TRUE);
                        $menus = $this->rbac_role_permission->get_rbac_role_permission_lib(null, $condition, TRUE);
                        //pma($menus,1);
                    } else {
                        //fetch only assigned permissions
                        $role_ids = array_column($user_detail['roles'], 'role_id');
                        if ($role_ids) {
                            $condition = 'rrp.role_id IN(' . implode(',', $role_ids) . ')';
                            $permissions = $this->rbac_role_permission->get_rbac_role_permission_lib(null, $condition);
                            $condition = 'rrp.role_id IN(' . implode(',', $role_ids) . ')';
                            $menus = $this->rbac_role_permission->get_rbac_role_permission_lib(null, $condition);
                        }
                    }
                    //remove action list, does not required her..
                    unset($permissions['action_list']);
                    $user_detail['permissions'] = $permissions;
                    $user_detail['menus'] = $menus;
                    $user_detail['permission_modules'] = array_keys($permissions);
                    $this->session->set_userdata('user_data', $user_detail);
                    redirect('admin-dashboard');
                } else {
                    $this->session->set_flashdata('error', 'Invalid login credentials.');
                }
            }
        }
        $this->layout->render();
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author :
     */
    public function dashboard() {
        if (!$this->rbac->is_login()) {
            redirect(APP_BASE . 'admin_users/sign_in');
        } else {
            //pma($this->session->all_userdata(),1);
            //$this->layout->navTitle='test title';
            $this->layout->layout = 'admin_layout';
            $this->layout->title = 'test page title';
            $data = array();
            $this->layout->data = $data;
            $this->breadcrumbs->push('dashboard', '/admin_users/dashboard');
            //$this->layout->navTitleFlag=0;
            $this->layout->breadcrumbsFlag = 0;
            $this->layout->render();
        }
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author :
     */
    public function log_out() {
        $this->session->unset_userdata('user_data');
        $this->session->unset_userdata('selected_left_menu');
        redirect('admin-login');
    }

}
