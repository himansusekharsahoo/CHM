<?php

/**
 * Course_department_master Class File
 * PHP Version 7.1.1
 * 
 * @category   Academic
 * @package    Academic
 * @subpackage Course_department_master
 * @class      Course_department_master
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Course_department_master Class
 * 
 * @category   Academic
 * @package    Academic
 * @class      Course_department_master
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Course_department_master extends CI_Model {

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

        $this->load->model('course_category_master');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * Get_course_department_master_datatable Method
     * 
     * @param   $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_course_department_master_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'course_dept_id,name,code,status,created,created_by,course_category_id';
        }

        /*
          Table:-	course_category_masters
          Columns:-	course_category_id,name,code,description,status,created,created_by

         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)->from('course_department_masters t1');

        $this->datatables->unset_column("course_dept_id");
        if (isset($data['button_set'])):
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(course_dept_id)', 1, 1);
        endif;
        if ($export):
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

    /**
     * Get_course_department_master Method
     * 
     * @param   $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_course_department_master($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 'course_dept_id,name,code,status,created,created_by,course_category_id';
        }

        /*
          Table:-	course_category_masters
          Columns:-	course_category_id,name,code,description,status,created,created_by

         */
        $this->db->select($columns)->from('course_department_masters t1');

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
            $this->db->insert("course_department_masters", $data);
            $course_dept_id_inserted_id = $this->db->insert_id();

            if ($course_dept_id_inserted_id):
                return $course_dept_id_inserted_id;
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
            $this->db->where("course_dept_id", $data['course_dept_id']);
            return $this->db->update('course_department_masters', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * Delete Method
     * 
     * @param   $course_dept_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function delete($course_dept_id) {
        if ($course_dept_id):
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('course_department_masters', array('course_dept_id' => $course_dept_id));
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
            $columns = 'course_dept_id';
        }
        if (!$index) {
            $index = 'course_dept_id';
        }
        $this->db->select("$columns,$index")->from('course_department_masters t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select course department masters';
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
    }

    /**
     * Get_course_category_masters_options Method
     * 
     * @param   $columns,$index=null, $conditions = null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_course_category_masters_options($columns, $index = null, $conditions = null) {
        return $this->course_category_master->get_options($columns, $index, $conditions);
    }

    public function record_count() {
        return $this->db->count_all('course_department_masters');
    }

}

?>