<?php

/**
 * Requested_book Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Requested_book
 * @class      Requested_book
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Requested_book Class
 * 
 * @category   Library
 * @package    Library
 * @class      Requested_book
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Requested_book extends CI_Model {

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

        $this->load->model('book_ledger');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * Get_requested_book_datatable Method
     * 
     * @param   $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_requested_book_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'request_id,requested_by,requested_by_id,bledger_id,purchage_status,status,created,created_by';
        }

        /*
          Table:-	book_ledgers
          Columns:-	bledger_id,book_id,bcategory_id,bpublication_id,bauthor_id,blocation_id,page,mrp,isbn_no,edition,bar_code,qr_code,created,created_by,modified,midified_by

         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)->from('requested_books t1');

        $this->datatables->unset_column("request_id");
        if (isset($data['button_set'])):
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(request_id)', 1, 1);
        endif;
        if ($export):
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

    /**
     * Get_requested_book Method
     * 
     * @param   $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_requested_book($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 'request_id,requested_by,requested_by_id,bledger_id,purchage_status,status,created,created_by';
        }

        /*
          Table:-	book_ledgers
          Columns:-	bledger_id,book_id,bcategory_id,bpublication_id,bauthor_id,blocation_id,page,mrp,isbn_no,edition,bar_code,qr_code,created,created_by,modified,midified_by

         */
        $this->db->select($columns)->from('requested_books t1');

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
            $this->db->insert("requested_books", $data);
            $request_id_inserted_id = $this->db->insert_id();

            if ($request_id_inserted_id):
                return $request_id_inserted_id;
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
            $this->db->where("request_id", $data['request_id']);
            return $this->db->update('requested_books', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * Delete Method
     * 
     * @param   $request_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function delete($request_id) {
        if ($request_id):
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('requested_books', array('request_id' => $request_id));
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
            $columns = 'request_id';
        }
        if (!$index) {
            $index = 'request_id';
        }
        $this->db->select("$columns,$index")->from('requested_books t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select requested books';
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
    }

    /**
     * Get_book_ledgers_options Method
     * 
     * @param   $columns,$index=null, $conditions = null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_book_ledgers_options($columns, $index = null, $conditions = null) {
        return $this->book_ledger->get_options($columns, $index, $conditions);
    }

    public function record_count() {
        return $this->db->count_all('requested_books');
    }

}

?>