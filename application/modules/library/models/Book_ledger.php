<?php

/**
 * Book_ledger Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Book_ledger
 * @class      Book_ledger
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Book_ledger Class
 * 
 * @category   Library
 * @package    Library
 * @class      Book_ledger
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Book_ledger extends CI_Model {

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

        $this->load->model('book_author_master');
        $this->load->model('book_category_master');
        $this->load->model('book');
        $this->load->model('book_location_master');
        $this->load->model('book_publication_master');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * Get_book_ledger_datatable Method
     * 
     * @param   $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_book_ledger_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'bledger_id,t2.name as book_name,t3.name as bcategory_name,t4.name as publicatoin_name,author_name,concat(floor," ",block," ",rack_no) as location,
                page,mrp,isbn_no,edition,bar_code,qr_code,t1.created,t1.created_by,t1.modified,t1.midified_by';
        }

        /*
          Table:-	book_author_masters
          Columns:-	bauthor_id,author_name,status,remarks,created,created_by

          Table:-	book_category_masters
          Columns:-	bcategory_id,name,code,status,parent_id,created,created_by

          Table:-	books
          Columns:-	book_id,name,code,status,created,created_by,modified,modified_by

          Table:-	book_location_masters
          Columns:-	blocation_id,floor,block,rack_no,self_no,remarks

          Table:-	book_publication_masters
          Columns:-	publication_id,name,code,status,remarks,created,created_by

         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)->from('book_ledgers t1')
                ->join('books t2', 't1.book_id=t2.book_id')
                ->join('book_category_masters t3', 't3.bcategory_id=t1.bcategory_id')
                ->join('book_publication_masters t4', 't4.publication_id=t1.bpublication_id')
                ->join('book_author_masters t5', 't5.bauthor_id=t1.bauthor_id')
                ->join('book_location_masters t6', 't6.blocation_id=t1.blocation_id');

        $this->datatables->unset_column("bledger_id");
        if (isset($data['button_set'])):
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(bledger_id)', 1, 1);
        endif;
        if ($export):
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

    /**
     * Get_book_ledger Method
     * 
     * @param   $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_book_ledger($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 'bledger_id,book_id,bcategory_id,bpublication_id,bauthor_id,blocation_id,page,mrp,isbn_no,edition,bar_code,qr_code,created,created_by,modified,midified_by';
        }

        /*
          Table:-	book_author_masters
          Columns:-	bauthor_id,author_name,status,remarks,created,created_by

          Table:-	book_category_masters
          Columns:-	bcategory_id,name,code,status,parent_id,created,created_by

          Table:-	books
          Columns:-	book_id,name,code,status,created,created_by,modified,modified_by

          Table:-	book_location_masters
          Columns:-	blocation_id,floor,block,rack_no,self_no,remarks

          Table:-	book_publication_masters
          Columns:-	publication_id,name,code,status,remarks,created,created_by

         */
        $this->db->select($columns)->from('book_ledgers t1');

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
            $this->db->insert("book_ledgers", $data);
            $bledger_id_inserted_id = $this->db->insert_id();

            if ($bledger_id_inserted_id):
                return $bledger_id_inserted_id;
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
            $this->db->where("bledger_id", $data['bledger_id']);
            return $this->db->update('book_ledgers', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * Delete Method
     * 
     * @param   $bledger_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function delete($bledger_id) {
        if ($bledger_id):
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('book_ledgers', array('bledger_id' => $bledger_id));
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
            $columns = 'bledger_id';
        }
        if (!$index) {
            $index = 'bledger_id';
        }
        $this->db->select("$columns,$index")->from('book_ledgers t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select book ledgers';
        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
    }

    /**
     * Get_book_author_masters_options Method
     * 
     * @param   $columns,$index=null, $conditions = null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_book_author_masters_options($columns, $index = null, $conditions = null) {
        return $this->book_author_master->get_options($columns, $index, $conditions);
    }

    /**
     * Get_book_category_masters_options Method
     * 
     * @param   $columns,$index=null, $conditions = null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_book_category_masters_options($columns, $index = null, $conditions = null) {
        return $this->book_category_master->get_options($columns, $index, $conditions);
    }

    /**
     * Get_books_options Method
     * 
     * @param   $columns,$index=null, $conditions = null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_books_options($columns, $index = null, $conditions = null) {
        return $this->book->get_options($columns, $index, $conditions);
    }

    /**
     * Get_book_location_masters_options Method
     * 
     * @param   $columns,$index=null, $conditions = null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_book_location_masters_options($columns, $index = null, $conditions = null) {
        return $this->book_location_master->get_options($columns, $index, $conditions);
    }

    /**
     * Get_book_publication_masters_options Method
     * 
     * @param   $columns,$index=null, $conditions = null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_book_publication_masters_options($columns, $index = null, $conditions = null) {
        return $this->book_publication_master->get_options($columns, $index, $conditions);
    }

    public function record_count() {
        return $this->db->count_all('book_ledgers');
    }

}

?>