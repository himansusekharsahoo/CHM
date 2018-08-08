<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @class   : Rbac_permission
 * @desc    :
 * @author  : HimansuS
 * @created :05/17/2018
 */
class Rbac_permission extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->model('rbac_action');
        $this->load->model('rbac_module');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * @param  : $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function get_rbac_permission_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        if (!$columns) {
            $columns = 'permission_id,module_id,action_id,status,created,modified';
        }

        /*
          Table:-	rbac_actions
          Columns:-	action_id,name,status,created,modified,code

          Table:-	rbac_modules
          Columns:-	module_id,name,code,status,created,modified

         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)->from('rbac_permissions t1');

        $this->datatables->unset_column("permission_id")
                ->add_column("Action", $data['button_set'], 'c_encode(permission_id)', 1, 1);
        if ($export):
            $data = $this->datatables->generate_export($export);
            export_data($data['aaData'], $export, rbac_permissions, $tableHeading);
        endif;
        return $this->datatables->generate();
    }

    /**
     * @param  : $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function get_rbac_permission($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 't1.permission_id,rm.module_id,ra.action_id,t1.status,t1.created,t1.modified'
                    . ',rm.name module_name,rm.code module_code,ra.name action_name,ra.code action_code';
        }

        /*
          Table:-	rbac_actions
          Columns:-	action_id,name,status,created,modified,code

          Table:-	rbac_modules
          Columns:-	module_id,name,code,status,created,modified

         */
        /* $this->db->select($columns)->from('rbac_permissions t1')
          ->join('rbac_modules rm','rm.module_id=t1.module_id','LEFT')
          ->join('rbac_actions ra','ra.action_id=t1.action_id','LEFT')
          ->order_by('t1.module_id','asc')
          ->order_by('ra.name','dsc'); */
        $this->db->select($columns)->from('rbac_modules rm')
                ->join('rbac_permissions t1', 'rm.module_id=t1.module_id', 'LEFT')
                ->join('rbac_actions ra', 'ra.action_id=t1.action_id', 'LEFT')
                ->where('trim(rm.name)!=', '')
                ->where('trim(rm.code)!=', '')
                ->order_by('rm.name', 'asc')
                ->order_by('ra.name', 'dsc');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where($col, $val);
            endforeach;
        endif;
        if ($limit > 0):
            $this->db->limit($limit, $offset);

        endif;
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    /**
     * @param  : $data
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function save($data) {
        if ($data):
            $this->db->insert("rbac_permissions", $data);
            $permission_id_inserted_id = $this->db->insert_id();

            if ($permission_id_inserted_id):
                return $permission_id_inserted_id;
            endif;
            return 'No data found to store!';
        endif;
        return 'Unable to store the data, please try again later!';
    }

    /**
     * @param  : $data
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function update($data) {
        if ($data):
            $this->db->where("permission_id", $data['permission_id']);
            return $this->db->update('rbac_permissions', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * @param  : $permission_id
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function delete($permission_id) {
        if ($permission_id):
            $result = 0;
            $result = $this->db->delete('rbac_permissions', array('permission_id' => $permission_id));
            return $result;

        endif;
        return 'No data found to delete!';
    }

    /**
     * @param  : $columns,$index=null, $conditions = null
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function get_options($columns, $index = null, $conditions = null) {
        if (!$columns) {
            $columns = 'permission_id';
        }
        if (!$index) {
            $index = 'permission_id';
        }
        $this->db->select("$columns,$index")->from('rbac_permissions t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select rbac permissions';
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
    }

    /**
     * @param  : $columns,$index=null, $conditions = null
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function get_rbac_actions_options($columns, $index = null, $conditions = null) {
        return $this->rbac_action->get_options($columns, $index, $conditions);
    }

    /**
     * @param  : $columns,$index=null, $conditions = null
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function get_rbac_modules_options($columns, $index = null, $conditions = null) {
        return $this->rbac_module->get_options($columns, $index, $conditions);
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    public function record_count() {
        return $this->db->count_all('rbac_permissions');
    }

    /**
     * @param
     * @return
     * @desc TODO:: should be incorporated the old modules
     * @author
     */
    public function save_module_action($post_data) {
        $this->db->trans_begin();
        $new_actions = $new_action_codes = $new_modules = $new_module_codes = array();
        $upd_modules = array();


        foreach ($post_data as $perms) {
            //get new actions
            foreach ($perms['action_code'] as $key => $act_code) {
                if ($act_code) {
                    $new_actions[$act_code] = array(
                        'code' => strtoupper($act_code),
                        'name' => ucfirst($perms['action_name'][$key]),
                        'status' => 'active'
                    );
                }
            }
            //get new modules
            if (!isset($perms['module_id']) || $perms['module_id'] == '') {
                $new_module_codes[] = $perms['module_code'];
                $new_modules[] = array(
                    'name' => ucfirst($perms['module_name']),
                    'code' => strtoupper($perms['module_code']),
                    'status' => 'active'
                );
            }
            //find existing modules to update
            if (isset($perms['module_id']) && $perms['module_id'] != '') {
                $upd_modules[] = array(
                    'module_id' => $perms['module_id'],
                    'name' => $perms['module_name'],
                    'code' => $perms['module_code'],
                );

                if (isset($perms['permission_id']) && is_array($perms['permission_id'])) {
                    //find existing permissions to inactive
                    $cond = " AND module_id='" . $perms['module_id'] . "' AND lower(status)='active'";
                    $exist_perm_ids = $this->_get_existing_module_perms('permission_id', $cond);
                    $flatten_ids = flattenArray($perms['permission_id']);
                    $flatten_exist_ids = flattenArray($exist_perm_ids);
                    $inactive_perms = array_diff($flatten_exist_ids, $flatten_ids);
                    //pma($inactive_perms,1);
                    if ($inactive_perms) {
                        $this->_update_perm_status($inactive_perms, 'inactive');
                    }
                    //find existing permissions to active
                    $cond=" AND module_id='".$perms['module_id']."' AND lower(status)='inactive'";
                    $exist_perm_ids = $this->_get_existing_module_perms('permission_id',$cond );                    
                    $flatten_ids = flattenArray($perms['permission_id']);
                    $flatten_exist_ids = flattenArray($exist_perm_ids);
                    $inactive_perms=  array_diff($flatten_exist_ids,$flatten_ids);
                     if ($inactive_perms) {
                        $this->_update_perm_status($inactive_perms, 'active');
                    }
                }
            }
        }

        //find new action to save
        $db_action = $this->get_rbac_actions_options('code', 'code');
        array_shift($db_action);
        $diff = array_diff_key($new_actions, $db_action);
        $save_act = array();

        foreach ($diff as $key => $code) {
            if ($key && is_string($key)) {
                $new_action_codes[] = $key;
                $save_act[] = $new_actions[$key];
            }
        }
        //pma($save_act,1);
        if ($this->_save_actions($save_act)) {
            $cond = "code in('" . implode('\',\'', $new_action_codes) . "')";
            $db_actions = $this->rbac_action->get_rbac_action('code,action_id', $cond);
            
            //insert new modules
            if ($this->_save_modules($new_modules)) {
                //get module ids
                $cond = "code in('" . implode('\',\'', $new_module_codes) . "')";
                $db_modules = $this->rbac_module->get_rbac_module('code,module_id', $cond);
                //insert module actions
                $module_actions = array();
                foreach ($db_modules as $key => $mod) {
                    foreach ($post_data as $perms) {
                        if ($mod['code'] == $perms['module_code']) {
                            $module_id = $mod['module_id'];
                            foreach ($db_actions as $aky => $action) {
                                foreach ($perms['action_code'] as $key => $act_code) {
                                    if ($action['code'] == $act_code && $module_id != '' && $action['action_id'] != '') {
                                        $module_actions[] = array(
                                            'module_id' => $module_id,
                                            'action_id' => $action['action_id']
                                        );
                                    }
                                }
                            }
                            //pre stored action
                            if (isset($perms['action_id'])) {
                                //pma($perms['action_id'],1);
                                foreach ($perms['action_id'] as $key => $act_id) {
                                    if (isset($module_id) && isset($act_id)) {
                                        $module_actions[] = array(
                                            'module_id' => $module_id,
                                            'action_id' => $act_id
                                        );
                                    }
                                }
                            }
                        }
                    }
                }
                //pma($module_actions,1);
                if ($module_actions) {
                    //pma($module_actions, 1);
                    $this->_save_module_actions($module_actions);
                }
            }
        }
        //pma($module_actions,1);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _save_actions($new_actions) {
        if ($new_actions)
            return $this->db->insert_batch('rbac_actions', $new_actions);
        return true;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _save_modules($new_modules) {
        if ($new_modules)
            return $this->db->insert_batch('rbac_modules', $new_modules);
        return true;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _save_module_actions($new_module_actions) {
        return $this->db->insert_batch('rbac_permissions', $new_module_actions);
    }

    /**
     * @param
     * @return
     * @desc get existing module permissions
     * @author
     */
    private function _get_existing_module_perms($columns = '*', $cond = "") {
        $query = "SELECT $columns FROM rbac_permissions WHERE 1=1 $cond";
        $result = $this->db->query($query)->result_array();
        return $result;
    }

    /**
     * @param
     * @return
     * @desc update permission status
     * @author
     */
    private function _update_perm_status($perm_ids, $status = 'active') {
        $data = array(
            'status' => $status,
            'modified' => date('Y-m-d H:i:s')
        );

        $this->db->where_in('permission_id', $perm_ids);
        $this->db->update('rbac_permissions', $data);
    }

}

?>