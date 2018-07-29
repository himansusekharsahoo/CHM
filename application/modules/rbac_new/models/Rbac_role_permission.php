<?php

                if (!defined('BASEPATH')) exit('No direct script access allowed');
               /**
                * @class   : Rbac_role_permission
                * @desc    :
                * @author  : HimansuS
                * @created :05/17/2018
                */
class Rbac_role_permission extends CI_Model {
public function __construct(){
                    parent::__construct();                    
                
$this->load->model('rbac_permission');$this->load->model('rbac_role');
        $this->layout->layout='admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag=1;
        $this->layout->rightControlFlag = 1; 
        $this->layout->navTitleFlag = 1;}/**
                * @param  : $data=null,$export=null,$tableHeading=null,$columns=null
                * @desc   :
                * @return :
                * @author :
                * @created:05/17/2018
                */
public function get_rbac_role_permission_datatable($data=null,$export=null,$tableHeading=null,$columns=null){
if(!$columns){            
            $columns='role_permission_id,role_id,permission_id,status,created,modified';
            }

/*
Table:-	rbac_permissions
Columns:-	permission_id,module_id,action_id,status,created,modified

Table:-	rbac_roles
Columns:-	role_id,name,code,status,created,modified,created_by,modified_by

*/
$this->datatables->select('SQL_CALC_FOUND_ROWS '. $columns,FALSE,FALSE)->from('rbac_role_permissions t1');

$this->datatables->unset_column("role_permission_id")
->add_column("Action", $data['button_set'], 'c_encode(role_permission_id)', 1, 1);
	 if($export):
	 $data = $this->datatables->generate_export($export);
	 export_data($data['aaData'], $export, rbac_role_permissions, $tableHeading);
	 endif;
return $this->datatables->generate() ;

}/**
                * @param  : $columns=null,$conditions=null,$limit=null,$offset=null
                * @desc   :
                * @return :
                * @author :
                * @created:05/17/2018
                */
public function get_rbac_role_permission($columns=null,$conditions=null,$limit=null,$offset=null){
if(!$columns){            
            $columns='role_permission_id,role_id,permission_id,status,created,modified';
            }

/*
Table:-	rbac_permissions
Columns:-	permission_id,module_id,action_id,status,created,modified

Table:-	rbac_roles
Columns:-	role_id,name,code,status,created,modified,created_by,modified_by

*/
$this->db->select($columns)->from('rbac_role_permissions t1');

	 if($conditions && is_array($conditions)):
	 foreach($conditions as $col => $val):
	 $this->db->where($col, $val);
	endforeach;	 endif;
	 if($limit>0):
	 	$this->db->limit($limit,$offset);

	 endif;
	 $result=$this->db->get()->result_array();

return $result ;

}/**
                * @param  : $data
                * @desc   :
                * @return :
                * @author :
                * @created:05/17/2018
                */
public function save($data){
	 if($data):
	 $this->db->insert("rbac_role_permissions",$data);
$role_permission_id_inserted_id=$this->db->insert_id();

	 if($role_permission_id_inserted_id):
return $role_permission_id_inserted_id ;
	 endif;
return 'No data found to store!' ;
	 endif;
return 'Unable to store the data, please try again later!' ;

}/**
                * @param  : $data
                * @desc   :
                * @return :
                * @author :
                * @created:05/17/2018
                */
public function update($data){
	 if($data):
	 $this->db->where("role_permission_id", $data['role_permission_id']);
return $this->db->update('rbac_role_permissions',$data);
	 endif;
return 'Unable to update the data, please try again later!' ;

}/**
                * @param  : $role_permission_id
                * @desc   :
                * @return :
                * @author :
                * @created:05/17/2018
                */
public function delete($role_permission_id){
	 if($role_permission_id):
	 $result=0;
            $result=$this->db->delete('rbac_role_permissions', array('role_permission_id'=>$role_permission_id));
return $result;

	 endif;
return 'No data found to delete!' ;

}/**
                * @param  : $columns,$index=null, $conditions = null
                * @desc   :
                * @return :
                * @author :
                * @created:05/17/2018
                */
public function get_options($columns,$index=null, $conditions = null){
if(!$columns){
                $columns='role_permission_id';
            }
if(!$index){
                $index='role_permission_id';
            }
$this->db->select("$columns,$index")->from('rbac_role_permissions t1');

	 if($conditions && is_array($conditions)):
	 foreach($conditions as $col => $val):
	 $this->db->where("$col", $val);

	endforeach;	 endif;
	 $result=$this->db->get()->result_array();

$list = array();
                       $list[''] = 'Select rbac role permissions';
	 foreach($result as $key => $val):
	 $list[$val[$index]] = $val[$columns];
	endforeach;return $list ;

}/**
                * @param  : $columns,$index=null, $conditions = null
                * @desc   :
                * @return :
                * @author :
                * @created:05/17/2018
                */
public function get_rbac_permissions_options($columns,$index=null, $conditions = null){
return $this->rbac_permission->get_options($columns,$index,$conditions) ;

}/**
                * @param  : $columns,$index=null, $conditions = null
                * @desc   :
                * @return :
                * @author :
                * @created:05/17/2018
                */
public function get_rbac_roles_options($columns,$index=null, $conditions = null){
return $this->rbac_role->get_options($columns,$index,$conditions) ;

}public function record_count(){
                        return $this->db->count_all('rbac_role_permissions');        
                    }
} ?>