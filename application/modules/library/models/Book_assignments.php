<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Book_assignments
 *
 * @author Shivaraj
 */
class Book_assignments extends CI_Model {

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

        $this->load->model('book_ledger');
        $this->load->model('library_member');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * Get_book_assign_datatable Method
     * 
     * @param   $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function get_book_assign_datatable($data = null, $export = null, $tableHeading = null, $columns = null) {
        $this->load->library('datatables');
        if (!$columns) {
            $columns = 'bassign_id,isbn_no,card_no,issue_date,due_date,return_date,return_delay_fine,book_return_condition,remarks,user_type';
        }

        /*
          Table:-	book_ledgers
          Columns:-	bledger_id,book_id,bcategory_id,bpublication_id,bauthor_id,blocation_id,page,mrp,isbn_no,edition,bar_code,qr_code,created,created_by,modified,midified_by

          Table:-	library_members
          Columns:-	member_id,card_no,date_issue,expiry_date,user_id,user_role_id,created,created_by,status

         */
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)->from('book_assigns t1')
                ->join('library_members', 't1.member_id=library_members.member_id')
                ->join('book_ledgers', 't1.bledger_id=book_ledgers.bledger_id');

        $this->datatables->unset_column("bassign_id");
        if (isset($data['button_set'])):
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(bassign_id)', 1, 1);
        endif;
        if ($export):
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

    /**
     * Get_book_assign Method
     * 
     * @param   $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function get_book_assign($columns = null, $conditions = null, $limit = null, $offset = null) {
        if (!$columns) {
            $columns = 'bassign_id,bledger_id,member_id,issue_date,due_date,return_date,return_delay_fine,book_return_condition,book_lost_fine,remarks,created,created_by,user_type';
        }

        /*
          Table:-	book_ledgers
          Columns:-	bledger_id,book_id,bcategory_id,bpublication_id,bauthor_id,blocation_id,page,mrp,isbn_no,edition,bar_code,qr_code,created,created_by,modified,midified_by

          Table:-	library_members
          Columns:-	member_id,card_no,date_issue,expiry_date,user_id,user_role_id,created,created_by,status

         */
        $this->db->select($columns)->from('book_assigns t1');

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
    public function save($data) {
        if ($data):
            //$data[''] = $data
            $this->db->insert("book_assigns", $data);
            $bassign_id_inserted_id = $this->db->insert_id();

            if ($bassign_id_inserted_id):
                return $bassign_id_inserted_id;
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
     * @since   11/08/2018
     */
    public function update($data) {
        if ($data):
            $this->db->where("bassign_id", $data['bassign_id']);
            return $this->db->update('book_assigns', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * Delete Method
     * 
     * @param   $bassign_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function delete($bassign_id) {
        if ($bassign_id):
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('book_assigns', array('bassign_id' => $bassign_id));
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
            $columns = 'bassign_id';
        }
        if (!$index) {
            $index = 'bassign_id';
        }
        $this->db->select("$columns,$index")->from('book_assigns t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        $list[''] = 'Select book assigns';
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
     * @since   11/08/2018
     */
    public function get_book_ledgers_options($columns, $index = null, $conditions = null) {
        return $this->book_ledger->get_options($columns, $index, $conditions);
    }

    /**
     * Get_library_members_options Method
     * 
     * @param   $columns,$index=null, $conditions = null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   11/08/2018
     */
    public function get_library_members_options($columns, $index = null, $conditions = null) {
        return $this->library_member->get_options($columns, $index, $conditions);
    }

    public function record_count() {
        return $this->db->count_all('book_assigns');
    }

    public function enroll_member($data) {
        if ($data):
            $this->db->insert("library_members", $data);
            $member_id = $this->db->insert_id();

            if ($member_id):
                return true;
            endif;
            return 'No data found to store!';
        endif;
        return 'Unable to store the data, please try again later!';
    }

    public function isbn_status($bledger_id) {
        $this->db->where('bledger_id', $bledger_id);
        $this->db->where('return_date', 0);
        $query = $this->db->get('book_assigns');
        return $query->num_rows();
    }

    public function get_book_details($key = '') {
        $columns = array(
            'b.book_id', 'b.name', 'bl.isbn_no', 'bl.edition', 'bam.author_name', 'bpm.name as publication', 'bl.bledger_id'
        );
        $query = "SELECT " . implode(',', $columns) . " FROM books b 
            JOIN book_ledgers bl ON b.book_id=bl.book_id 
            JOIN book_author_masters bam ON bl.bauthor_id=bam.bauthor_id
            JOIN book_publication_masters bpm ON bl.bpublication_id=bpm.publication_id
            WHERE b.status='active' AND (
            b.name like '%$key%' OR bl.isbn_no like '%$key%') order by b.name";
        return $this->db->query($query)->result_array();
    }

    function store_book_assignment_info($form_data) {
        return $this->db->insert('book_assigns', $form_data);
    }

    function get_member_id_user($user_id) {
        $this->db->select('member_id');
        $member_id = $this->db->get_where('library_members', array('user_id' => $user_id))->row_array();
        if (!empty($member_id)) {
            return $member_id['member_id'];
        } else {
            return null;
        }
    }

    function check_if_same_book_assigned($ledger_id, $member_id) {
        $where = array(
            'bledger_id' => $ledger_id,
            'member_id' => $member_id
        );
        $this->db->where($where);
        $this->db->where('return_date IS NULL', NULL, FALSE);
        return $this->db->get('book_assigns')->num_rows();
    }

    function get_total_assign_books_data_by_member($member_id, $count = true) {
        $this->db->where('member_id', $member_id);
        $this->db->where('return_date IS NULL', NULL, FALSE);
        $return = $this->db->get('book_assigns');
        if ($count) {
            return $return->num_rows();
        } else {
            return $return->result_array();
        }
    }

}