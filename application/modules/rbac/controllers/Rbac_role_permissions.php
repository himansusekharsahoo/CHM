<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @class   : Rbac_role_permissions
 * @desc    :
 * @author  : HimansuS
 * @created :09/29/2018
 */
class Rbac_role_permissions extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('rbac_role_permission');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * @param              : 
     * @desc               :
     * @return             :
     * @author             :
     * @created:09/29/2018
     */
    public function index()
    {
        redirect('/rbac/rbac_role_permissions/role_permissions');
    }

    /**
     * @param
     * @return
     * @desc   used to assign action to module
     * @author
     */
    public function role_permissions()
    {
        $this->layout->navTitle = 'Role Permissions';
        $data = array();
        $role_options = $this->rbac_role_permission->get_rbac_roles_options('name');
        $role_options = array_slice($role_options, 1, null, true);
        $role_codes = $this->rbac_role_permission->get_rbac_roles_options('code');
        $role_codes = array_slice($role_codes, 1, null, true);
        
        $condition=array('t1.status'=>'active');
        $permission_masters=  $this->rbac_role_permission->get_rbac_permissions_options('permission_id', 'permission_id', $condition);
        //$permission_masters=  flattenArray($permission_masters);
        $permission_masters_all=  $this->rbac_role_permission->get_rbac_permissions(null, $condition);
        $existing_role_permissions=$this->rbac_role_permission->get_rbac_role_permission();
        
        
        $action_options=$action_codes=$existing_perms=array();
        $data = array(            
            'role_options' => $role_options,
            'permission_master_ids' => $permission_masters,
            'permission_master_all' => $permission_masters_all,
            'existing_role_permissions' => $existing_role_permissions
        );
        //pma($data,1);
        if ($this->input->post()) {
            $permissions = $this->input->post();            
            $perms = array();

            foreach ($permissions['permission'] as $perm) {                
                if (isset($perm['role_id'])) {
                    foreach ($perm['permission_id'] as $perm_id) {
                        $perms[] = array(
                            'role_id' => $perm['role_id'],
                            'permission_id' => $perm_id
                        );
                    }
                }
            }

            if ($this->rbac_role_permission->save_role_permissions($perms)) {
                $this->session->set_flashdata('success', 'Record successfully saved!');
                redirect('/rbac/rbac_role_permissions/role_permissions');
            } else {
                $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
            }
        }
        $this->layout->data = $data;
        $this->layout->render();
    }
}

?>