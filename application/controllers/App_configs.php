<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App_configs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('app_config');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
    }

    public function index() {
        $this->breadcrumbs->push('edit', base_url('manage-app-configs'));
        $this->scripts_include->includePlugins(array('bs_timepicker'), 'css');
        $this->scripts_include->includePlugins(array('jq_validation', 'bs_timepicker'), 'js');
        $this->layout->navTitle = 'Manage App configs';
        $this->layout->title = 'Manage App configs';
        $db_data = $this->app_config->get_app_config();
        foreach ($db_data as $rec) {            
            $data['data'] = array_merge(json_decode($rec['configs'],true));
        }        
        $this->layout->data = $data;
        $this->layout->render();
    }

    public function save_configs() {
        $this->scripts_include->includePlugins(array('bs_timepicker'), 'css');
        $this->scripts_include->includePlugins(array('jq_validation', 'bs_timepicker'), 'js');
        $data = array();

        if ($this->input->post()):
            $post_data = $this->input->post();
            //pma($post_data,1);
            $result = $this->app_config->save_config($post_data);
            if ($result):
                $this->session->set_flashdata('success', 'Record successfully updated!');
                redirect(base_url('manage-app-configs'));
            else:
                $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
            endif;

        endif;

        $this->layout->data = $data;
        $this->layout->render();
    }

}
