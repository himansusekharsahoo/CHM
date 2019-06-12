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
            $columns = 'bledger_id,book_name,bcategory_name,publicatoin_name
                ,author_name,location,page,mrp,isbn_no,edition,ledger_total_copies,created,created_by';
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


        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)
                ->from('book_ledger_list_view');

        //$this->datatables->unset_column("bledger_id");
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
            $columns = 'book_name,bcategory_name,publicatoin_name
                ,author_name,location,page,mrp,isbn_no,edition,created,created_by,modified,midified_by
                ,bill_number,purchase_date,price,vendor_name,remarks,t1.bledger_id,book_id,bcategory_id
                ,bpublication_id,bauthor_id,blocation_id,bpurchase_id,ledger_total_copies';
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

        $this->db->select($columns)
                ->from('book_ledger_list_view t1')
                ->join('book_purchage_detail_logs bp', 'bp.bledger_id=t1.bledger_id', 'LEFT');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where($col, $val);
            endforeach;
        endif;
        if ($limit > 0):
            $this->db->limit($limit, $offset);

        endif;
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
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
            $this->db->trans_begin();
            $ledger_data = array(
                'book_id' => $data['book_id'],
                'bcategory_id' => $data['bcategory_id'],
                'bpublication_id' => $data['bpublication_id'],
                'bauthor_id' => $data['bauthor_id'],
                'blocation_id' => $data['blocation_id'],
                'page' => $data['page'],
                'mrp' => $data['mrp'],
                'isbn_no' => $data['isbn_no'],
                'edition' => $data['edition'],
                'total_copies' => $data['total_copies'],
                'created_by' => $data['created_by']
            );
            $this->db->insert("book_ledgers", $ledger_data);
            $bledger_id_inserted_id = $this->db->insert_id();
            //store puchage details
            if ($bledger_id_inserted_id) {
                $purchase_data = array(
                    'bledger_id' => $bledger_id_inserted_id,
                    'bill_number' => $data['bill_number'],
                    'purchase_date' => date('Y-m-d', strtotime($data['purchase_date'])),
                    'price' => $data['price'],
                    'vendor_name' => $data['vendor_name'],
                    'total_copies' => $data['total_copies'],
                    'remarks' => $data['remarks']
                );
                $this->db->insert("book_purchage_detail_logs", $purchase_data);

                $insert_batch = array();
                $book_info = $this->db->query("SELECT isbn_no FROM book_ledgers where bledger_id='$bledger_id_inserted_id'")->row();
                for ($i = 1; $i <= $data['total_copies']; $i++) {
                    $barcode_data = $book_info->isbn_no . '-' . $i;
                    $single_data = array(
                        'bledger_id' => $bledger_id_inserted_id,
                        'book_barcode_info' => $barcode_data,
                        'book_copy_count' => $i
                    );
                    array_push($insert_batch, $single_data);
                }
                $this->db->insert_batch('book_copies_info', $insert_batch);
            }

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
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
            $this->db->trans_begin();
            $ledger_data = array(
                'bledger_id' => c_decode($data['bledger_id']),
                'blocation_id' => $data['blocation_id'],
                'page' => $data['page'],
                'mrp' => $data['mrp'],
                'isbn_no' => $data['isbn_no'],
                'edition' => $data['edition'],
                'midified_by' => $data['modified_by'],
            );
            if (isset($data['book_id'])) {
                $ledger_data['book_id'] = $data['book_id'];
            }
            if (isset($data['bcategory_id'])) {
                $ledger_data['bcategory_id'] = $data['bcategory_id'];
            }
            if (isset($data['bpublication_id'])) {
                $ledger_data['bpublication_id'] = $data['bpublication_id'];
            }
            if (isset($data['bauthor_id'])) {
                $ledger_data['bauthor_id'] = $data['bauthor_id'];
            }
            $this->db->where("bledger_id", $ledger_data['bledger_id']);
            if ($this->db->update('book_ledgers', $ledger_data)) {

                /* $purchase_data = array(
                  'bpurchase_id' => $data['bpurchase_id'],
                  'bledger_id' => $data['bledger_id'],
                  'bill_number' => $data['bill_number'],
                  'purchase_date' => date('Y-m-d',  strtotime($data['purchase_date'])),
                  'price' => $data['price'],
                  'vendor_name' => $data['vendor_name'],
                  'remarks' => $data['remarks']
                  ); */

                //$this->db->where("bpurchase_id", $purchase_data['bpurchase_id']);
                //$this->db->update('book_purchage_detail_logs', $purchase_data);
            }
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
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
            $this->db->delete('book_purchage_detail_logs', array('bledger_id' => $bledger_id));
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
    public function get_book_author_masters_options($columns, $index = null, $conditions = null, $chosen_flag = false) {
        return $this->book_author_master->get_options($columns, $index, $conditions, $chosen_flag);
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
    public function get_book_category_masters_options($columns, $index = null, $conditions = null, $chosen_flag = false) {
        return $this->book_category_master->get_options($columns, $index, $conditions, $chosen_flag);
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
    public function get_books_options($columns, $index = null, $conditions = null, $chosen_flag = false) {
        return $this->book->get_options($columns, $index, $conditions, $chosen_flag);
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
    public function get_book_location_masters_options($columns, $index = null, $conditions = null, $chosen_flag = false) {
        return $this->book_location_master->get_options($columns, $index, $conditions, $chosen_flag);
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
    public function get_book_publication_masters_options($columns, $index = null, $conditions = null, $chosen_flag = false) {
        return $this->book_publication_master->get_options($columns, $index, $conditions, $chosen_flag);
    }

    /**
     * 
     * @method
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   
     */
    public function record_count() {
        return $this->db->count_all('book_ledgers');
    }

    /**
     * 
     * @method save_book_purchase_details
     * @param   Array $post_data
     * @desc    used to store book purchase details
     * @return boolean
     * @author  HimansuS                  
     * @since   22/05/2019
     */
    public function save_book_purchase_details($post_data) {
        if ($post_data):
            //pma($post_data,1);
            $bledger_id = c_decode($post_data['book_ledger_id']);

            $db_data = array(
                'bledger_id' => $bledger_id,
                'bill_number' => $post_data['bill_number'],
                'purchase_date' => date('Y-m-d', strtotime($post_data['purchase_date'])),
                'price' => $post_data['price'],
                'total_copies' => $post_data['total_copies'],
                'vendor_name' => $post_data['vendor_name'],
                'remarks' => $post_data['remarks']
            );
            $this->db->trans_begin();
            $this->db->insert("book_purchage_detail_logs", $db_data);
            $bpurchase_id_inserted_id = $this->db->insert_id();
            //get book ledger details
            $this->_update_ledger_book_copies($bledger_id, $post_data['total_copies']);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 0;
            } else {
                $this->db->trans_commit();
                return $bpurchase_id_inserted_id;
            }
        endif;
    }

    /**
     * 
     * @method
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   
     */
    private function _update_ledger_book_copies($bledger_id, $no_of_copy, $delete_flag = false) {
        $query = "SELECT total_copies,isbn_no from book_ledgers where bledger_id=$bledger_id";
        $result = $this->db->query($query)->row();

        if ($delete_flag === TRUE) {
            $total_copies = $result->total_copies - $no_of_copy;
        } else {
            $total_copies = $result->total_copies + $no_of_copy;
        }

        $j = $total_copies - $no_of_copy;
        $insert_batch = array();
        for ($i = ($j + 1); $i <= $total_copies; $i++) {
            $barcode_data = $result->isbn_no . '-' . $i;
            $single_data = array(
                'bledger_id' => $bledger_id,
                'book_barcode_info' => $barcode_data,
                'book_copy_count' => $i
            );
            array_push($insert_batch, $single_data);
        }

        $status = $this->db->insert_batch('book_copies_info', $insert_batch);
        if ($status) {
            $query = "UPDATE book_ledgers SET total_copies=$total_copies WHERE bledger_id=$bledger_id";
            $this->db->query($query);
        }
    }

    /**
     * @param  : string $condition
     * @desc   : used to check duplicacy of book author name
     * @return : number 0/count value
     * @author : HimansuS
     * @created:
     */
    public function check_duplicate($condition) {
        $query = "select count(*) count_rec from book_ledgers where 1=1 $condition";
        $result = $this->db->query($query)->row();
        return $result->count_rec;
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
    public function get_book_purchage_detail_log_datatable($data = null, $export = null, $condition = null, $columns = null) {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'bpurchase_id,bledger_id,bill_number,DATE_FORMAT(purchase_date, "%d-%m-%Y") purchase_date,price,total_copies,vendor_name,remarks';
        }

        /*
          Table:-	book_ledgers
          Columns:-	bledger_id,book_id,bcategory_id,bpublication_id,bauthor_id,blocation_id,page,mrp,isbn_no,edition,bar_code,qr_code,created,created_by,modified,midified_by

         */

        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)
                ->from('book_purchage_detail_logs t1');

        if (is_array($condition)) {
            foreach ($condition as $col => $val) {
                $this->datatables->where($col, $val);
            }
        }
        $this->datatables->unset_column("bpurchase_id");
        $this->datatables->unset_column("bledger_id");
        if (isset($data['button_set'])):
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(bpurchase_id),total_copies', 1, 1);
        endif;
        if ($export):
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
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
    public function delete_purchase_detail($bpurchase_id) {
        if ($bpurchase_id):
            $this->db->trans_begin();
            $result = 0;
            //fetch existing data
            $query = "select bledger_id,total_copies from book_purchage_detail_logs where bpurchase_id=$bpurchase_id";
            $result = $this->db->query($query)->row();
            $this->db->delete('book_purchage_detail_logs', array('bpurchase_id' => $bpurchase_id));
            $this->_update_ledger_book_copies($result->bledger_id, $result->total_copies, TRUE);

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

}

?>