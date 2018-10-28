<?php

/**
 * Book_log Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Book_log
 * @class      Book_log
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Book_log Class
 * 
 * @category   Library
 * @package    Library
 * @class      Book_log
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Book_log extends CI_Model {

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


        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * Get_book_log_datatable Method
     * 
     * @param   $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_book_log_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'book_log_id,category_name,category_code,category_parent_id,publication_name,publication_code,publication_remarks,author_name,author_remarks,location_floor,location_block,location_rack_no,location_self_no,ledger_id,ledger_page,ledger_mrp,ledger_isbn,ledger_edition,ledger_bar_code,ledger_qr_code,ledger_created,ledger_created_by,ledger_modified,ledger_modified_by,book_id,book_name,book_code,book_status,book_created,book_created_by,book_modified,book_modified_by,created';
        }

        /*
         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)->from('book_logs t1');

        $this->datatables->unset_column("book_log_id");
        if (isset($data['button_set'])):
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(book_log_id)', 1, 1);
        endif;
        if ($export):
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

    /**
     * Get_book_log Method
     * 
     * @param   $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_book_log($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 'book_log_id,category_name,category_code,category_parent_id,publication_name,publication_code,publication_remarks,author_name,author_remarks,location_floor,location_block,location_rack_no,location_self_no,ledger_id,ledger_page,ledger_mrp,ledger_isbn,ledger_edition,ledger_bar_code,ledger_qr_code,ledger_created,ledger_created_by,ledger_modified,ledger_modified_by,book_id,book_name,book_code,book_status,book_created,book_created_by,book_modified,book_modified_by,created';
        }

        /*
         */
        $this->db->select($columns)->from('book_logs t1');

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
            $this->db->insert("book_logs", $data);
            $book_log_id_inserted_id = $this->db->insert_id();

            if ($book_log_id_inserted_id):
                return $book_log_id_inserted_id;
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
            $this->db->where("book_log_id", $data['book_log_id']);
            return $this->db->update('book_logs', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * Delete Method
     * 
     * @param   $book_log_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function delete($book_log_id) {
        if ($book_log_id):
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('book_logs', array('book_log_id' => $book_log_id));
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
            $columns = 'book_log_id';
        }
        if (!$index) {
            $index = 'book_log_id';
        }
        $this->db->select("$columns,$index")->from('book_logs t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select book logs';
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
    }

    public function record_count() {
        return $this->db->count_all('book_logs');
    }

}

?>