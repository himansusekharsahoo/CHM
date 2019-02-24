<?php

/**
 * Library_member Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Library_member
 * @class      Library_member
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   11/08/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Library_member Class
 * 
 * @category   Library
 * @package    Library
 * @class      Library_member
 * @desc    
 * @author     HimansuS                  
 * @since   11/08/2018
 */
class Library_member extends CI_Model {

    /**
     * __construct Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('rbac/rbac_user');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * Get_library_member_datatable Method
     * 
     * @param   $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function get_library_member_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'member_id,card_no,date_issue,expiry_date,rbac_users.email,IF(user_role_id=1,"Staff","Student"),t1.status';
        }

        /*
         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)->from('library_members t1');
        $this->datatables->join('rbac_users','rbac_users.user_id=t1.user_id');
        $this->datatables->unset_column("member_id");
        if (isset($data['button_set'])):
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(member_id)', 1, 1);
        endif;
        if ($export):
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

    /**
     * Get_library_member Method
     * 
     * @param   $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function get_library_member($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 'member_id,card_no,date_issue,expiry_date, t1.user_id,user_role_id,t1.created,t1.created_by,t1.status';
        }

        /*
         */
        $this->db->select($columns)->from('library_members t1');
        $this->db->join('rbac_users u','t1.user_id=u.user_id');

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
     * Save Method
     * 
     * @param   $data
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function save($data) {
        if ($data):
            $this->db->insert("library_members", $data);
            $member_id_inserted_id = $this->db->insert_id();

            if ($member_id_inserted_id):
                return $member_id_inserted_id;
            endif;
            return 'No data found to store!';
        endif;
        return 'Unable to store the data, please try again later!';
    }

    /**
     * Update Method
     * 
     * @param   $data
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function update($data) {
        if ($data):
            $this->db->where("member_id", $data['member_id']);
            return $this->db->update('library_members', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * Delete Method
     * 
     * @param   $member_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function delete($member_id) {
        if ($member_id):
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('library_members', array('member_id' => $member_id));
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
     * Get_options Method
     * 
     * @param   $columns,$index=null, $conditions = null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function get_options($columns, $index = null, $conditions = null) {
        if (!$columns) {
            $columns = 'member_id';
        }
        if (!$index) {
            $index = 'member_id';
        }
        $this->db->select("$columns,$index")->from('library_members t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select library members';
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
    }

    public function record_count() {
        return $this->db->count_all('library_members');
    }

    public function get_user_list($columns, $index = null, $conditions = null) {
        return $this->rbac_user->get_options($columns, $index, $conditions);
    }
    
    public function unique_card_number($card_no) {
        $this->db->where('card_no', $card_no);
        $query = $this->db->get('library_members');
        return $query->num_rows();
    }
    
    public function unique_user($user_id) {
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('library_members');
        return $query->num_rows();
    }
}

?>