<?php

/**
 * Book_assign_log Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Book_assign_log
 * @class      Book_assign_log
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Book_assign_log Class
 * 
 * @category   Library
 * @package    Library
 * @class      Book_assign_log
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Course_academic_batch_utility extends CI_Model {

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
    }

    /**
     * get_temp_table_data_dt Method
     * 
     * @param   string $columns,
     * @param   string $table_name
     * @param   array $data
     * @param   string $condition
     * @param   boolean $export
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_temp_table_data_dt($columns, $table_name, $data = null, $condition = null, $export = null) {
        $this->load->library('datatables');

        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)
                ->from("$table_name t1");
        if ($condition && is_string($condition)) {
            $this->datatables->where(null, null, false, $condition);
        }
        if (!$export) {
            $this->datatables->unset_column("record_no");
        }
        if (isset($data['button_set'])):
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(record_no)', 1, 1);
        endif;
        if ($export):
            $data = $this->datatables->generate_export($export);            
            return $data;
        endif;
        return $this->datatables->generate();
    }

    /**
     * @param   INT $row_id
     * @param   string $table_name
     * @desc   : used to delete one record form temp table
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function delete_temp_row($row_id, $table_name) {
        if ($row_id):
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete($table_name, array('RECORD_NO' => $row_id));
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
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function save_import_data_db() {
        $user_id = $this->rbac->get_user_id();
        $temp_table_name = 'temp_course_a_b_m_' . $user_id;

        $this->db->trans_begin();
        $this->db->query("call upload_course_aca_batch('" . $temp_table_name . "',$user_id)");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

}

?>