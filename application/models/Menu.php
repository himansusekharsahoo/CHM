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
            $columns .= ',rm.name as "module_name",rm.code "module_code"';
            $columns .= ',ra.name as "action_name",ra.code "action_code"';
            $columns .= ',m.menu_id,m.name "text",m.menu_order,m.parent prnt,m.icon_class,m.menu_class,m.attribute';
            $columns .= ',m.permission_id,m.url,m.menu_type';
        }

        /*
          Table:-	rbac_permissions
          Columns:-	permission_id,module_id,action_id
          Table:-	rbac_roles
          Columns:-	role_id,name,code

         */

        if ($admin_flag) {
            $this->db->select($columns)->from('rbac_menu m')
                    ->join('rbac_permissions rp', 'rp.permission_id=m.permission_id')
                    ->join('rbac_modules rm', 'rm.module_id=rp.module_id')
                    ->join('rbac_actions ra', 'ra.action_id=rp.action_id');
                    //->where("rp.menu_name<>","")
                    //->group_by('rp.permission_id')
                    //->order_by('rp.module_id,rp.action_id');
            
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
        //pma($this->db->last_query(),1);        
        return $result;

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
