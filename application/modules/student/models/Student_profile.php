<?php

/**
 * Student_profile Class File
 * PHP Version 7.1.1
 * 
 * @category   Student
 * @package    Student
 * @subpackage Student_profile
 * @class      Student_profile
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Student_profile Class
 * 
 * @category   Student
 * @package    Student
 * @class      Student_profile
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Student_profile extends CI_Model {

    /**
     * __construct Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('student_user');
        //$this->load->model('course_aca_batch_master');
        //$this->load->model('course_semister_master');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * Get_student_profile_datatable Method
     * 
     * @param   $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_student_profile_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'sprofile_id,first_name,last_name,user_id,course_aca_batch_id,course_semister_id,photo,sign';
        }

        /*
          Table:-	student_users
          Columns:-	user_id,first_name,last_name,login_id,email,password,temp_registration_no,registration_no,login_status,mobile,mobile_verified,email_verified,created,modified,created_by,modified_by,status

          Table:-	course_aca_batch_masters
          Columns:-	course_aca_batch_id,name,description,start_year,end_year,terms,status,created,created_by,course_dept_id

          Table:-	course_semister_master
          Columns:-	semister_id,name,code,created

         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)->from('student_profiles t1');

        $this->datatables->unset_column("sprofile_id");
        if (isset($data['button_set'])):
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(sprofile_id)', 1, 1);
        endif;
        if ($export):
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

    /**
     * Get_student_profile Method
     * 
     * @param   $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_student_profile($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 'sprofile_id,first_name,last_name,user_id,course_aca_batch_id,course_semister_id,photo,sign';
        }

        /*
          Table:-	student_users
          Columns:-	user_id,first_name,last_name,login_id,email,password,temp_registration_no,registration_no,login_status,mobile,mobile_verified,email_verified,created,modified,created_by,modified_by,status

          Table:-	course_aca_batch_masters
          Columns:-	course_aca_batch_id,name,description,start_year,end_year,terms,status,created,created_by,course_dept_id

          Table:-	course_semister_master
          Columns:-	semister_id,name,code,created

         */
        $this->db->select($columns)->from('student_profiles t1');

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
     * @since   10/28/2018
     */
    public function save($data) {
        if ($data):
            $this->db->insert("student_profiles", $data);
            $sprofile_id_inserted_id = $this->db->insert_id();

            if ($sprofile_id_inserted_id):
                return $sprofile_id_inserted_id;
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
     * @since   10/28/2018
     */
    public function update($data) {
        if ($data):
            $this->db->where("sprofile_id", $data['sprofile_id']);
            return $this->db->update('student_profiles', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * Delete Method
     * 
     * @param   $sprofile_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function delete($sprofile_id) {
        if ($sprofile_id):
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('student_profiles', array('sprofile_id' => $sprofile_id));
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
     * @since   10/28/2018
     */
    public function get_options($columns, $index = null, $conditions = null) {
        if (!$columns) {
            $columns = 'sprofile_id';
        }
        if (!$index) {
            $index = 'sprofile_id';
        }
        $this->db->select("$columns,$index")->from('student_profiles t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select student profiles';
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
    }

    /**
     * Get_student_users_options Method
     * 
     * @param   $columns,$index=null, $conditions = null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_student_users_options($columns, $index = null, $conditions = null) {
        return $this->student_user->get_options($columns, $index, $conditions);
    }

    /**
     * Get_course_aca_batch_masters_options Method
     * 
     * @param   $columns,$index=null, $conditions = null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_course_aca_batch_masters_options($columns, $index = null, $conditions = null) {
        return $this->course_aca_batch_master->get_options($columns, $index, $conditions);
    }

    /**
     * Get_course_semister_master_options Method
     * 
     * @param   $columns,$index=null, $conditions = null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_course_semister_master_options($columns, $index = null, $conditions = null) {
        return $this->course_semister_master->get_options($columns, $index, $conditions);
    }

    public function record_count() {
        return $this->db->count_all('student_profiles');
    }

}

?>