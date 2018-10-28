<?php

/**
 * Academic_course Class File
 * PHP Version 7.1.1
 * 
 * @category   Academic
 * @package    Academic
 * @subpackage Academic_course
 * @class      Academic_course
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Academic_course Class
 * 
 * @category   Academic
 * @package    Academic
 * @class      Academic_course
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Academic_course extends CI_Model {

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

        $this->load->model('course_aca_batch_master');
        $this->load->model('course_master');
        $this->load->model('course_semister_master');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * Get_academic_course_datatable Method
     * 
     * @param   $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_academic_course_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'academic_course_id,course_id,semister_id,course_aca_batch_id,status,created,created_by';
        }

        /*
          Table:-	course_aca_batch_masters
          Columns:-	course_aca_batch_id,name,description,start_year,end_year,terms,status,created,created_by,course_dept_id

          Table:-	course_masters
          Columns:-	course_id,name,code,description,status,created,created_by

          Table:-	course_semister_master
          Columns:-	semister_id,name,code,created

         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)->from('academic_courses t1');

        $this->datatables->unset_column("academic_course_id");
        if (isset($data['button_set'])):
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(academic_course_id)', 1, 1);
        endif;
        if ($export):
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

    /**
     * Get_academic_course Method
     * 
     * @param   $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_academic_course($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 'academic_course_id,course_id,semister_id,course_aca_batch_id,status,created,created_by';
        }

        /*
          Table:-	course_aca_batch_masters
          Columns:-	course_aca_batch_id,name,description,start_year,end_year,terms,status,created,created_by,course_dept_id

          Table:-	course_masters
          Columns:-	course_id,name,code,description,status,created,created_by

          Table:-	course_semister_master
          Columns:-	semister_id,name,code,created

         */
        $this->db->select($columns)->from('academic_courses t1');

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
            $this->db->insert("academic_courses", $data);
            $academic_course_id_inserted_id = $this->db->insert_id();

            if ($academic_course_id_inserted_id):
                return $academic_course_id_inserted_id;
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
            $this->db->where("academic_course_id", $data['academic_course_id']);
            return $this->db->update('academic_courses', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * Delete Method
     * 
     * @param   $academic_course_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function delete($academic_course_id) {
        if ($academic_course_id):
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('academic_courses', array('academic_course_id' => $academic_course_id));
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
            $columns = 'academic_course_id';
        }
        if (!$index) {
            $index = 'academic_course_id';
        }
        $this->db->select("$columns,$index")->from('academic_courses t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select academic courses';
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
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
     * Get_course_masters_options Method
     * 
     * @param   $columns,$index=null, $conditions = null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_course_masters_options($columns, $index = null, $conditions = null) {
        return $this->course_master->get_options($columns, $index, $conditions);
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
        return $this->db->count_all('academic_courses');
    }

}

?>