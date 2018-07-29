<?php

class Menu extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    public function get_menu_data($columns = null, $conditions = null, $admin_flag = false) {
        if (!$columns) {
            //$columns = ',rp.permission_id,rp.module_id,rp.action_id,rp.position,rp.parent,rp.menu_name,rp.menu_header';
            $columns = ',rp.permission_id,rp.module_id,rp.action_id';
            $columns .= ',rm.name as "module_name",rm.code';
            $columns .= ',ra.name as "action_name"';
            $columns .= ',rp.order,rp.parent,rp.menu_name,rp.menu_header';
        }

        /*
          Table:-	rbac_permissions
          Columns:-	permission_id,module_id,action_id
          Table:-	rbac_roles
          Columns:-	role_id,name,code

         */

        if ($admin_flag) {
            $this->db->select($columns)->from('rbac_permissions_bak16may18 rp')
                    ->join('rbac_modules rm', 'rm.module_id=rp.module_id')
                    ->join('rbac_actions ra', 'ra.action_id=rp.action_id')
                    //->where("rp.menu_name<>","")
                    ->group_by('rp.permission_id')
                    ->order_by('rp.module_id,rp.action_id');
        } else {
            if (!$columns) {
                $columns .= 'rrp.role_permission_id,rrp.role_id,rrp.permission_id';
            }
            $this->db->select($columns)->from('rbac_role_permissions rrp')
                    ->join('rbac_permissions rp', 'rp.permission_id=rrp.permission_id')
                    ->join('rbac_modules rm', 'rm.module_id=rp.module_id')
                    ->join('rbac_actions ra', 'ra.action_id=rp.action_id')
                    ->group_by('rp.permission_id')
                    ->order_by('rp.module_id,rp.action_id');
        }

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where($col, $val);
            endforeach;

        elseif ($conditions):
            $this->db->where($conditions);
        endif;

        $result = $this->db->get()->result_array();
        //pma($this->db->last_query());
        return $result;

        //pma($result,1);
        //echo $this->db->last_query();

        /* $data = $action_list = $temp_data = array();
          $action_list = array_column($result, 'action_name');
          $action_list = array_values(array_unique($action_list));
          $temp_data['action_list'] = $action_list;

          foreach ($result as $permission) {
          $data[$permission['module_name']][$permission['action_name']] = $permission;
          }
          foreach ($data as $module => $permission) {
          $indx = 0;
          foreach ($action_list as $key => $action) {
          if (!isset($permission[$action])) {
          $temp_data[$module][$action] = array();
          } else {
          $temp_data[$module][$action] = $data[$module][$action];
          }
          }
          }

          return $temp_data; */
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    public function update_menu_parent($data) {
        $id = $data['id'];
        $parent = ($data['parent'])?$data['parent']:0;
        $order = ($data['position'])?$data['position']+1:0;
        if ($id) {
            $query = "UPDATE rbac_permissions SET `parent`=$parent, `order`=$order WHERE PERMISSION_ID='$id'";            
            $this->db->query($query);
            return TRUE;
        }
        return FALSE;
    }

}
