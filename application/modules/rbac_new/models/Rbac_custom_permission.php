<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @class   : Rbac_custom_permission
 * @desc    :
 * @author  : HimansuS
 * @created :09/29/2018
 */
class Rbac_custom_permission extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->model('rbac_user');
        $this->load->model('rbac_permission');
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
     * @created:09/29/2018
     */
    public function get_rbac_custom_permission_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'custom_permission_id,user_id,permission_id,assigned_by,status,created,modified';
        }

        /*
          Table:-	rbac_users
          Columns:-	user_id,first_name,last_name,login_id,email,password,login_status,mobile,mobile_verified,emial_verified,created,modified,created_by,modified_by,status

          Table:-	rbac_permissions
          Columns:-	permission_id,module_id,action_id,status,created,modified

         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)->from('rbac_custom_permissions t1');

        $this->datatables->unset_column("custom_permission_id");
        if (isset($data['button_set'])):
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(custom_permission_id)', 1, 1);
        endif;
        if ($export):
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

    /**
     * @param  : $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc   :
     * @return :
     * @author :
     * @created:09/29/2018
     */
    public function get_rbac_custom_permission($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 'custom_permission_id,user_id,permission_id,assigned_by,status,created,modified';
        }

        /*
          Table:-	rbac_users
          Columns:-	user_id,first_name,last_name,login_id,email,password,login_status,mobile,mobile_verified,emial_verified,created,modified,created_by,modified_by,status

          Table:-	rbac_permissions
          Columns:-	permission_id,module_id,action_id,status,created,modified

         */
        $this->db->select($columns)->from('rbac_custom_permissions t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where($col, $val);
            endforeach;
        endif;
        if ($limit > 0):
            $this->db->limit($limit, $offset);

        endif;
        $result = $this->db->get()->result_array();

        return $result;
    }

    /**
     * @param  : $data
     * @desc   :
     * @return :
     * @author :
     * @created:09/29/2018
     */
    public function save($data) {
        if ($data):
            $this->db->insert("rbac_custom_permissions", $data);
            $custom_permission_id_inserted_id = $this->db->insert_id();

            if ($custom_permission_id_inserted_id):
                return $custom_permission_id_inserted_id;
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
     * @created:09/29/2018
     */
    public function update($data) {
        if ($data):
            $this->db->where("custom_permission_id", $data['custom_permission_id']);
            return $this->db->update('rbac_custom_permissions', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * @param  : $custom_permission_id
     * @desc   :
     * @return :
     * @author :
     * @created:09/29/2018
     */
    public function delete($custom_permission_id) {
        if ($custom_permission_id):
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('rbac_custom_permissions', array('custom_permission_id' => $custom_permission_id));
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }

        endif;
        return 'No data found to delete!';
    }

    /**
     * @param  : $columns,$index=null, $conditions = null
     * @desc   :
     * @return :
     * @author :
     * @created:09/29/2018
     */
    public function get_options($columns, $index = null, $conditions = null) {
        if (!$columns) {
            $columns = 'custom_permission_id';
        }
        if (!$index) {
            $index = 'custom_permission_id';
        }
        $this->db->select("$columns,$index")->from('rbac_custom_permissions t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select rbac custom permissions';
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
     * @created:09/29/2018
     */
    public function get_rbac_users_options($columns, $index = null, $conditions = null) {
        return $this->rbac_user->get_options($columns, $index, $conditions);
    }

    /**
     * @param  : $columns,$index=null, $conditions = null
     * @desc   :
     * @return :
     * @author :
     * @created:09/29/2018
     */
    public function get_rbac_permissions_options($columns, $index = null, $conditions = null) {
        return $this->rbac_permission->get_options($columns, $index, $conditions);
    }

    public function record_count() {
        return $this->db->count_all('rbac_custom_permissions');
    }

}

?>