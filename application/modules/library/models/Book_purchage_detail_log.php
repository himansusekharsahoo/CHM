<?php

/**
 * Book_purchage_detail_log Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Book_purchage_detail_log
 * @class      Book_purchage_detail_log
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Book_purchage_detail_log Class
 * 
 * @category   Library
 * @package    Library
 * @class      Book_purchage_detail_log
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Book_purchage_detail_log extends CI_Model
{

    /**
     * __construct Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('book_ledger');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * Get_book_purchage_detail_log_datatable Method
     * 
     * @param   $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_book_purchage_detail_log_datatable($data = null, $export = null, $condition = null, $columns = null)
    {
        $this->load->library('datatables');
        if (!$columns)
        {
            $columns = 'bpurchase_id,bledger_id,bill_number,DATE_FORMAT(purchase_date, "%d-%m-%Y") purchase_date,price,vendor_name,remarks';
        }

        /*
          Table:-	book_ledgers
          Columns:-	bledger_id,book_id,bcategory_id,bpublication_id,bauthor_id,blocation_id,page,mrp,isbn_no,edition,bar_code,qr_code,created,created_by,modified,midified_by

         */
        
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)
                ->from('book_purchage_detail_logs t1');
        
        if(is_array($condition)){
            foreach($condition as $col=>$val){
                $this->datatables->where($col,$val);
            }
        }
        $this->datatables->unset_column("bpurchase_id");
        $this->datatables->unset_column("bledger_id");
        if (isset($data['button_set'])):
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(bpurchase_id)', 1, 1);
        endif;
        if ($export):
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

    /**
     * Get_book_purchage_detail_log Method
     * 
     * @param   $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_book_purchage_detail_log($columns = null, $conditions = null, $limit = null, $offset = null)
    {
        if (!$columns)
        {
            $columns = 'bpurchase_id,bledger_id,bill_number,purchase_date,price,vendor_name,remarks';
        }

        /*
          Table:-	book_ledgers
          Columns:-	bledger_id,book_id,bcategory_id,bpublication_id,bauthor_id,blocation_id,page,mrp,isbn_no,edition,bar_code,qr_code,created,created_by,modified,midified_by

         */
        $this->db->select($columns)->from('book_purchage_detail_logs t1');

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
    public function save($data)
    {
        if ($data):
            $this->db->insert("book_purchage_detail_logs", $data);
            $bpurchase_id_inserted_id = $this->db->insert_id();

            if ($bpurchase_id_inserted_id):
                return $bpurchase_id_inserted_id;
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
    public function update($data)
    {
        if ($data):
            $this->db->where("bpurchase_id", $data['bpurchase_id']);
            return $this->db->update('book_purchage_detail_logs', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * Delete Method
     * 
     * @param   $bpurchase_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function delete($bpurchase_id)
    {
        if ($bpurchase_id):
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('book_purchage_detail_logs', array('bpurchase_id' => $bpurchase_id));
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                return false;
            } else
            {
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
    public function get_options($columns, $index = null, $conditions = null)
    {
        if (!$columns)
        {
            $columns = 'bpurchase_id';
        }
        if (!$index)
        {
            $index = 'bpurchase_id';
        }
        $this->db->select("$columns,$index")->from('book_purchage_detail_logs t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select book purchage detail logs';
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
    public function get_book_ledgers_options($columns, $index = null, $conditions = null)
    {
        return $this->book_ledger->get_options($columns, $index, $conditions);
    }

    public function record_count()
    {
        return $this->db->count_all('book_purchage_detail_logs');
    }

}

?>