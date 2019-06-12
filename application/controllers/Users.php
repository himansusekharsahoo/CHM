<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user');
        $this->load->library('form_validation');
        $this->layout->layout = 'ecom_layout';
        $this->layout->layoutsFolder = 'layouts/ecom';
        
    }

    /**
     * @param  : NA
     * @desc   : lising the users
     * @return : NA
     * @author : himansus
     */
    public function index() {  
        $this->layout->render(array('error' => 'under_construction'));
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author :
     */
    public function sign_up() {
        $this->layout->render();
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author :
     */
    public function sign_in() {
        if ($this->input->post()) {
            //server side validation
            $rules = array(
                array(
                    'field' => 'user_email',
                    'label' => 'Email',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Please login with Email/Library Card Number'                        
                    ),
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
                //$condition = array('email' => $email, 'password' => c_encode($pass),'user_type'=>'student','library_member');
                $condition =" (email='$email' OR login_id='$email') AND  password='".c_encode($pass)."' AND user_type IN('student','library_member')";
                $user_detail = $this->user->get_user_detail(null, $condition);                
                if ($user_detail) {
                    if (isset($user_detail['status']) && $user_detail['status'] == 'active') {
                        $menus = $permissions = array();
                        if (in_array('DEVELOPER', $user_detail['role_codes'])) {
                            //fetch all the permissions
                            $condition = '';
                            $permissions = $this->rbac_role_permission->get_rbac_role_permission_lib(null, null, TRUE);
                        } else {
                            //fetch only assigned permissions
                            $role_ids = array_column($user_detail['roles'], 'role_id');
                            if ($role_ids) {
                                $condition = 'rrp.role_id IN(' . implode(',', $role_ids) . ')';
                                $permissions = $this->rbac_role_permission->get_rbac_role_permission_lib(null, $condition);
                            }
                        }
                        //get app configs
                        $app_configs = $this->user->get_app_configs();
                        //remove action list, does not required her..
                        unset($permissions['action_list']);
                        $user_detail['permissions'] = $permissions;
                        $user_detail['permission_modules'] = array_keys($permissions);
                        $user_detail['app_configs'] = $app_configs;
                        $this->session->set_userdata('user_data', $user_detail);
                        redirect('user-dashboard');
                    }else {
                        $this->session->set_flashdata('error', 'You are not authorised to access the application.');
                    }
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
            redirect(base_url('user-login'));
        } else {
            $this->layout->title = 'Dashboard';
            $this->breadcrumbs->push('dashboard', base_url('user-dashboard'));
            $data = array();
            $this->layout->data = $data;
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
        redirect(base_url('user-login'));
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function set_selected_lmenu() {
        if ($this->input->is_ajax_request()) {
            $menu_ids = $this->input->post('menu_ids');
            if ($menu_ids) {
                $menu_ids = explode("_", $menu_ids);
                $menu_ids = array_unique($menu_ids);
                $this->session->set_userdata('selected_left_menu', $menu_ids);
                
                echo json_encode(array('status'=>'success'));
            } else {
                echo json_encode(array('status'=>'menu set error'));
            }
            exit;
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

}
