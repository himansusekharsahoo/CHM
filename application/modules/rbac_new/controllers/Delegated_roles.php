<?php

                if (!defined('BASEPATH')) exit('No direct script access allowed');
               /**
                * @class   : Delegated_roles
                * @desc    :
                * @author  : HimansuS
                * @created :05/17/2018
                */
class Delegated_roles extends CI_Controller {
public function __construct(){
                    parent::__construct();                    
                
$this->load->model('delegated_role');$this->load->library('pagination');$this->load->library('form_validation');
        $this->layout->layout='admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag=1;
        $this->layout->rightControlFlag = 1; 
        $this->layout->navTitleFlag = 1;}/**
                * @param  : $export=0
                * @desc   :
                * @return :
                * @author :
                * @created:05/17/2018
                */
public function index($export=0){

        $this->breadcrumbs->push('index','/rbac_new/delegated_roles/index');
        $this->scripts_include->includePlugins(array('datatable'), 'css');
        $this->scripts_include->includePlugins(array('datatable'), 'js');
        $this->layout->navTitle='Delegated role list';
        $data=array();$data = array();
        $buttons[] = array(
            'btn_class' => 'btn-info',
            'btn_href' => base_url('rbac_new/delegated_roles/view'),
            'btn_icon' => 'fa-eye',
            'btn_title' => 'view record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );
        $buttons[] = array(
            'btn_class' => 'btn-primary',
            'btn_href' => base_url('rbac_new/delegated_roles/edit'),
            'btn_icon' => 'fa-pencil',
            'btn_title' => 'edit record',
            'btn_separator' => ' ',
            'param' => array('$1'),
            'style' => ''
        );

        $buttons[] = array(
            'btn_class'     => 'btn-danger delete-record',
            'btn_href'      => '#',
            'btn_icon'      => 'fa-remove',
            'btn_title'     => 'delete record',
            'btn_separator' => '',
            'param'         => array('$1'),
            'style'         => '',
            'attr'           => 'data-delegated_role_id="$1"'
        );
        $button_set = get_link_buttons($buttons);
        $data['button_set'] = $button_set;

        if ($this->input->is_ajax_request()) {
            $returned_list = '';
            $returned_list = $this->delegated_role->get_delegated_role_datatable($data);
            echo $returned_list;
            exit();
        }
        if ($export) {
            $tableHeading = array('role_id'=>'role_id','role_code'=>'role_code','user_id'=>'user_id','delegated_by'=>'delegated_by','created'=>'created','modified'=>'modified','status'=>'status',);;
            $this->delegated_role->get_delegated_role_datatable($data, $export, $tableHeading);
        }
        
        $config['grid_config'] = array(
            'table' => array(
                'columns' => array('role_id','role_code','user_id','delegated_by','created','modified','status'),
                'columns_alias' => array('role_id','role_code','user_id','delegated_by','created','modified','status' ,'Action')
            ),
            'grid' => array(
                'ajax_source' => 'rbac_new/delegated_roles/index',
                'table_tools' => array('pdf', 'xls', 'csv'),
                'cfilter_columns' => array('role_id','role_code','user_id','delegated_by','created','modified','status'),
                'sort_columns' => array('role_id','role_code','user_id','delegated_by','created','modified','status'),
                'column_order' => array('0' => 'ASC'),
            //'cfilter_pos'=>'buttom'
            ),
            'table_tools' => array(
                'xls' => array(
                    'url' => 'rbac_new/delegated_roles/index/xls'
                ), 'csv' => array(
                    'url' => 'rbac_new/delegated_roles/index/csv'
                )
            )
        );
        $data['data'] = $config;
        $this->layout->render($data);

}/**
                * @param  : 
                * @desc   :
                * @return :
                * @author :
                * @created:05/17/2018
                */
public function create(){
$this->breadcrumbs->push('create','/rbac_new/delegated_roles/create');

$this->layout->navTitle='Delegated role create';
$data=array();
	 if($this->input->post()):
	 $config = array(
array(
                        'field' => 'role_id',
                        'label' => 'role_id',
                        'rules' => 'required'
                    ),
array(
                        'field' => 'role_code',
                        'label' => 'role_code',
                        'rules' => 'required'
                    ),
array(
                        'field' => 'user_id',
                        'label' => 'user_id',
                        'rules' => 'required'
                    ),
array(
                        'field' => 'delegated_by',
                        'label' => 'delegated_by',
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
array(
                        'field' => 'status',
                        'label' => 'status',
                        'rules' => 'required'
                    ),
);
        $this->form_validation->set_rules($config);
        
	 if($this->form_validation->run()):
	 
                                $data['data']=$this->input->post();                        
                                $result=$this->delegated_role->save($data['data']);
                                
	 if($result>=1):
	 $this->session->set_flashdata('success', 'Record successfully saved!');
	 redirect('/rbac_new/delegated_roles');
	 else:
	 $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
	 endif;
	 endif;
	 endif;
$data['delegated_by_list'] = $this->delegated_role->get_rbac_users_options('user_id','user_id');
$data['role_id_list'] = $this->delegated_role->get_rbac_roles_options('role_id','role_id');
$this->layout->data = $data;
               $this->layout->render();

}/**
                * @param  : $delegated_role_id=null
                * @desc   :
                * @return :
                * @author :
                * @created:05/17/2018
                */
public function edit($delegated_role_id=null){
$this->breadcrumbs->push('edit','/rbac_new/delegated_roles/edit');

$this->layout->navTitle='Delegated role edit';$data=array();
	 if($this->input->post()):
	 $data['data']=$this->input->post();
	 $config = array(
array(
                        'field' => 'role_id',
                        'label' => 'role_id',
                        'rules' => 'required'
                    ),
array(
                        'field' => 'role_code',
                        'label' => 'role_code',
                        'rules' => 'required'
                    ),
array(
                        'field' => 'user_id',
                        'label' => 'user_id',
                        'rules' => 'required'
                    ),
array(
                        'field' => 'delegated_by',
                        'label' => 'delegated_by',
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
array(
                        'field' => 'status',
                        'label' => 'status',
                        'rules' => 'required'
                    ),
);
        $this->form_validation->set_rules($config);
        
	 if($this->form_validation->run()):
	                                                       
                                $result=$this->delegated_role->update($data['data']);
                                
	 if($result>=1):
	 $this->session->set_flashdata('success', 'Record successfully updated!');
	 redirect('/rbac_new/delegated_roles');
	 else:
	 $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
	 endif;
	 endif;
	 else:
	 $delegated_role_id=c_decode($delegated_role_id);
 $result = $this->delegated_role->get_delegated_role(null, array('delegated_role_id' => $delegated_role_id));
	 if($result):
	 $result = current($result);
	 endif;
$data['data'] = $result;
	 endif;
$data['delegated_by_list'] = $this->delegated_role->get_rbac_users_options('user_id','user_id');
$data['role_id_list'] = $this->delegated_role->get_rbac_roles_options('role_id','role_id');
$this->layout->data = $data;
               $this->layout->render();

}/**
                * @param  : $delegated_role_id
                * @desc   :
                * @return :
                * @author :
                * @created:05/17/2018
                */
public function view($delegated_role_id){
$this->breadcrumbs->push('view','/rbac_new/delegated_roles/view');

$data=array();
	 if($delegated_role_id):
	 $delegated_role_id=c_decode($delegated_role_id);

	 $this->layout->navTitle='Delegated role view';$result = $this->delegated_role->get_delegated_role(null, array('delegated_role_id' => $delegated_role_id),1);
	 if($result):
	 $result = current($result);
	 endif;

                     $data['data'] = $result;
                     $this->layout->data = $data;
                     $this->layout->render();
                     
	 endif;
return 0 ;

}/**
                * @param  : 
                * @desc   :
                * @return :
                * @author :
                * @created:05/17/2018
                */
public function delete(){
	 if($this->input->is_ajax_request()):
	 $delegated_role_id=  $this->input->post('delegated_role_id');
	 if($delegated_role_id):
	 $delegated_role_id=c_decode($delegated_role_id);

	 $result = $this->delegated_role->delete($delegated_role_id);
	 if($result ==1):
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
return 'Invalid request type.' ;

}
} ?>