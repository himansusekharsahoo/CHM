<?php

/**
 * Book_publication_master Class File
 * PHP Version 7.1.1
 * 
 * @category   Library
 * @package    Library
 * @subpackage Book_publication_master
 * @class      Book_publication_master
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   10/28/2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Book_publication_master Class
 * 
 * @category   Library
 * @package    Library
 * @class      Book_publication_master
 * @desc    
 * @author     HimansuS                  
 * @since   10/28/2018
 */
class Book_publication_master extends CI_Model
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


        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;
    }

    /**
     * Get_book_publication_master_datatable Method
     * 
     * @param   $data=null,$export=null,$tableHeading=null,$columns=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_book_publication_master_datatable($data = null, $export = null, $tableHeading = null, $columns = null)
    {
        $this->load->library('datatables');
        if (!$columns)
        {
            $columns = 'publication_id,name,code,status,remarks,created,created_by_name';
        }
        $this->datatables->select('SQL_CALC_FOUND_ROWS ' . $columns, FALSE, FALSE)
                ->from('book_publication_list_view t1');

        $this->datatables->unset_column("publication_id");
        if (isset($data['button_set'])):
            $this->datatables->add_column("Action", $data['button_set'], 'c_encode(publication_id)', 1, 1);
        endif;
        if ($export):
            $data = $this->datatables->generate_export($export);
            return $data;
        endif;
        return $this->datatables->generate();
    }

    /**
     * Get_book_publication_master Method
     * 
     * @param   $columns=null,$conditions=null,$limit=null,$offset=null
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function get_book_publication_master($columns = null, $conditions = null, $limit = null, $offset = null)
    {
        if (!$columns)
        {
            $columns = 'publication_id,name,code,status,remarks,created,created_by';
        }

        /*
         */
        $this->db->select($columns)->from('book_publication_masters t1');

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
            $this->db->insert("book_publication_masters", $data);
            $publication_id_inserted_id = $this->db->insert_id();

            if ($publication_id_inserted_id):
                return $publication_id_inserted_id;
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
            $this->db->where("publication_id", $data['publication_id']);
            return $this->db->update('book_publication_masters', $data);
        endif;
        return 'Unable to update the data, please try again later!';
    }

    /**
     * Delete Method
     * 
     * @param   $publication_id
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   10/28/2018
     */
    public function delete($publication_id)
    {
        if ($publication_id):
            $this->db->trans_begin();
            $result = 0;
            $this->db->delete('book_publication_masters', array('publication_id' => $publication_id));
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
    public function get_options($columns, $index = null, $conditions = null, $chosen_flag = false)
    {
        if (!$columns)
        {
            $columns = 'publication_id';
        }
        if (!$index)
        {
            $index = 'publication_id';
        }
        $this->db->select("$columns,$index")->from('book_publication_masters t1');

        if ($conditions && is_array($conditions)):
            foreach ($conditions as $col => $val):
                $this->db->where("$col", $val);

            endforeach;
        endif;
        $result = $this->db->get()->result_array();

        $list = array();
        if ($chosen_flag)
        {
            $list[''] = '';
        } else
        {
            $list[''] = 'Select book publication masters';
        }

        foreach ($result as $key => $val):
            $list[$val[$index]] = $val[$columns];
        endforeach;
        return $list;
    }

    public function record_count()
    {
        return $this->db->count_all('book_publication_masters');
    }

    /**
     * @param  : string $condition
     * @desc   : used to check duplicacy of book category
     * @return : number 0/count value
     * @author : HimansuS
     * @created:
     */
    public function check_duplicate($condition)
    {
        $query = "select count(publication_id) count_rec from book_publication_masters where 1=1 $condition";
        $result = $this->db->query($query)->row();
        return $result->count_rec;
    }

}

?>