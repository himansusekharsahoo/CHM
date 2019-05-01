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
class Library_user extends CI_Model {

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
            //$columns = 'member_id,card_no,date_issue,expiry_date,rbac_users.email,IF(user_role_id=1,"Staff","Student"),t1.status';
            $columns ='member_id,user_name,card_no,date_issue,expiry_date,email,status,created,created_by_name,mobile,user_type,code_list';
        }

        
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)->from('library_members_view t1');
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
            $columns = 'member_id,card_no,date_issue,expiry_date,user_id,user_role_id,created,created_by,status
                        ,first_name,last_name,user_name,email,mobile,user_type
                        ,code_list,created_by_name';
        }
        $this->db->select($columns)->from('library_members_view t1');

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
    public function save($data, $user_type = 'old_user') {
        $this->db->trans_begin();
        if ($user_type == 'new_user') {
            $this->save_new_lib_member($data);
        } else {
            $this->create_library_member($data['user_id'], $user_type);
        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function save_new_lib_member($data) {

        $new_lib_card_no = $this->populate_new_lib_card_no();

        $login_userid = $this->rbac->get_user_id();
        $user_data = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'login_id' => $new_lib_card_no,
            'email' => $data['email'],
            'password' => c_encode($new_lib_card_no),
            'mobile' => $data['mobile'],
            'user_type' => 'library_member',
            'created_by' => $login_userid,
            'status' => 'active'
        );
        $this->db->insert("rbac_users", $user_data);
        $user_id_inserted_id = $this->db->insert_id();
        $this->create_library_member($user_id_inserted_id, 'new_user', $new_lib_card_no);
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

    /**
     * @param  : 
     * @desc   : generate new library card no with prefix
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function populate_new_lib_card_no() {
        //card string pre-fix
        $card_prefix = '';
        $card_prefix_config = $this->rbac->get_app_config_item('library/lib_card_num_prefix');

        if ($card_prefix_config) {
            $card_prefix = trim($card_prefix_config[0]);
        }
        //card number trailing zero
        $card_prefix_config = $this->rbac->get_app_config_item('library/lib_card_num_zero_prefix');
        $card_zero_prefix = 5;
        if ($card_prefix_config) {
            $card_zero_prefix = trim($card_prefix_config[0]);
        }

        $today = date('Ym');
        $prefix_length = strlen($card_prefix) + 7; //6+1 for YYYYMM
        $query = "SELECT MAX(card_no) max_card_no from (SELECT (CAST(substring(card_no,$prefix_length) AS CHAR)+0) card_no FROM library_members)a";
        $result = $this->db->query($query)->row();

        if ($result->max_card_no) {
            return $card_prefix . $today . str_pad(($result->max_card_no + 1), $card_zero_prefix, '0', STR_PAD_LEFT);
        }
        return $card_prefix . $today . str_pad(1, $card_zero_prefix, '0', STR_PAD_LEFT);
    }

    /**
     * @param  : string $condition
     * @desc   : used to check duplicacy of user column
     * @return : number 0/count value
     * @author : HimansuS
     * @created:
     */
    public function check_duplicate($condition) {
        $query = "select count(user_id) count_rec from rbac_users where 1=1 $condition";
        $result = $this->db->query($query)->row();
        return $result->count_rec;
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_guest_role_id() {
        $query = "SELECT role_id FROM rbac_roles WHERE code='GUEST'";
        $result = $this->db->query($query)->row();
        if ($result->role_id) {
            return $result->role_id;
        }
        return 0;
    }

    /**
     * @param  : 
     * @desc   : used to search the user
     * @return :
     * @author : HimansuS
     * @created:
     */
    function search_lib_user($user_type, $search_text) {
        if ($user_type == 'employee') {
            $query = "select concat(first_name,' ',last_name,'-',email) name,first_name,last_name
                    ,email,user_id id from rbac_users 
                    where user_type='employee' 
                    and (
                        lower(login_id) like '%" . strtolower($search_text) . "%' or
                        lower(email) like '%" . strtolower($search_text) . "%' 
                    )";
        } else {
            $query = "select concat(first_name,' ',last_name,'-',email) name,first_name,last_name
                    ,email,user_id id from rbac_users 
                    where user_type='student' 
                    and (
                        lower(login_id) like '%" . strtolower($search_text) . "%' or
                        lower(email) like '%" . strtolower($search_text) . "%' 
                    )";
        }
        $result = $this->db->query($query)->result_array();
        return $result;
    }

    /**
     * @param  : 
     * @desc   : used to fetch searched user details
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function searched_user_details($condition) {
        $query = "select * from user_details_view where 1=1 $condition";
        $result = $this->db->query($query)->result_array();
        return $result;
    }

    /**
     * @param  : 
     * @desc   : create library member by user id
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function create_library_member($user_id, $user_type, $card_no = null) {
        $new_lib_card_no = $card_no;
        if (!$card_no) {
            $new_lib_card_no = $this->populate_new_lib_card_no();
        }
        $login_userid = $this->rbac->get_user_id();

        //generate library member
        $expir_period = $this->rbac->get_app_config_item('library/lib_card_expire_month');
        $expir_month = '';
        if ($expir_period) {
            $expir_month = trim($expir_period[0]);
        }
        $lib_member = array(
            'card_no' => $new_lib_card_no,
            'date_issue' => date('Y-m-d'),
            'expiry_date' => date('Y-m-d', strtotime("+$expir_month months", strtotime(date('Y-m-d')))),
            'user_id' => $user_id,
            'user_role_id' => $this->get_guest_role_id(),
            'created_by' => $login_userid,
            'status' => 'active'
        );
        $this->db->insert('library_members', $lib_member);
    }

    /**
     * @param  : 
     * @desc   : used to renew the library card
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function renew_library_card($member_id) {
        $this->db->trans_begin();
        $expir_period = $this->rbac->get_app_config_item('library/lib_card_expire_month');
        $expir_month = '';
        if ($expir_period) {
            $expir_month = trim($expir_period[0]);
        }
        $query = "select * from library_members where member_id=$member_id";
        $details = $this->db->query($query)->row();
        $new_expiry_date = date('Y-m-d', strtotime("+$expir_month months", strtotime($details->expiry_date)));
        $lib_member = array(
            'expiry_date' => $new_expiry_date,
            'status' => 'active'
        );
        $this->db->update('library_members', $lib_member, array('member_id' => $member_id));
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_user_roles($condition1 = '',$condition2 = '') {
        $query = "select rr.name role_name from rbac_user_roles rur
                left join rbac_roles rr on rr.role_id=rur.role_id
                where 1=1 $condition1
                union all
                select rr.name role_name from library_members lm
                left join rbac_roles rr on rr.role_id=lm.user_role_id
                where 1=1 $condition2
                ";        
        $result = $this->db->query($query)->result_array();
        return $result;
    }

}

?>