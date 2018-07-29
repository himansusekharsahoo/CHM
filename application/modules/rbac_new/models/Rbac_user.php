<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @class   : Rbac_user
 * @desc    :
 * @author  : HimansuS
 * @created :05/17/2018
 */
class Rbac_user extends CI_Model {

    public function __construct() {
        parent::__construct();


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
    public function get_rbac_user_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        if (!$columns) {
            $columns = 'user_id,first_name,last_name,login_id,email,mobile,status';
        }
        /*
         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)->from('rbac_users t1');

        $this->datatables->unset_column("user_id")
                ->add_column("Action", $data['button_set'], 'c_encode(user_id)', 1, 1);
        if ($export):
            $data = $this->datatables->generate_export($export);
            export_data($data['aaData'], $export, rbac_users, $tableHeading);
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
    public function get_rbac_user($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 'user_id,first_name,last_name,login_id,email,password,login_status,mobile,mobile_verified,emial_verified,created,modified,created_by,modified_by,status';
        }

        /*
         */
        $this->db->select($columns)->from('rbac_users t1');

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
     * @created:05/17/2018
     */
    public function save($data) {
        if ($data):
            $this->db->insert("rbac_users", $data);
            $user_id_inserted_id = $this->db->insert_id();

            if ($user_id_inserted_id):
                return $user_id_inserted_id;
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
            $this->db->where("user_id", $data['user_id']);
            $data['password']=  c_encode(trim($data['password']));
            //pma($data,1);
            return $this->db->update('rbac_users', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * @param  : $user_id
     * @desc   :
     * @return :
     * @author :
     * @created:05/17/2018
     */
    public function delete($user_id) {
        if ($user_id):
            $result = 0;
            $result = $this->db->delete('rbac_users', array('user_id' => $user_id));
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
            $columns = 'user_id';
        }
        if (!$index) {
            $index = 'user_id';
        }
        $this->db->select("$columns,$index")->from('rbac_users t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select rbac users';
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
    }

    public function record_count() {
        return $this->db->count_all('rbac_users');
    }

}

?>