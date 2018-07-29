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
        if (!$this->rbac->is_login()) {
            redirect(APP_BASE . 'users/sign_in');
        } else {
            redirect(APP_BASE . 'users/dashboard');
        }
        $this->layout->render();
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
                    $this->session->set_userdata('user_data', $user_detail);
                    redirect('users/dashboard');
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
            redirect(APP_BASE . 'users/sign_in');
        } else {
            $this->layout->title = 'test page title';
            $this->breadcrumbs->push('dashboard', '/users/dashboard');
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
        redirect('users/log_in');
    }

}
