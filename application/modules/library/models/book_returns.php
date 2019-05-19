<?php

/**
 * Description of book_returns
 *
 * @author Shivaraj
 */
class book_returns extends CI_Model {

    function get_library_card_details($card_no = '') {
        $columns = array(
            'l.card_no', 'l.member_id', 'CONCAT(l.card_no," - ",ru.first_name," ",ru.last_name) as card_info'
        );
        $query = "SELECT " . implode(',', $columns) . " FROM library_members l 
            JOIN rbac_users ru ON l.user_id=ru.user_id
            WHERE LOWER(card_no) LIKE LOWER('%" . $card_no . "%')";
        return $this->db->query($query)->result_array();
    }

    function get_book_details($conditions, $export_flag = false) {
        $columns = array(
            'bassign_id', 'card_no', 'date_issue', 'expiry_date', 'isbn_no', 'edition', 'name', 'author_name', 'due_date'
        );
        $limit = '';
        if (!$export_flag) {
            $start = (isset($conditions['start'])) ? $conditions['start'] : 0;
            $length = (isset($conditions['length'])) ? $conditions['length'] : 25;
            $limit = ' LIMIT ' . $start . ',' . ($length);
            unset($conditions['start'], $conditions['length'], $conditions['order']);
        }

        $where = "WHERE TRIM(LOWER(lm.card_no))=TRIM(LOWER('" . $conditions['card_no'] . "')) AND return_date is null AND is_book_lost <> 1 ";

        $query = "SELECT " . implode(',', $columns) . " FROM book_assigns ba 
            JOIN library_members lm ON ba.member_id=lm.member_id 
            JOIN book_ledgers bl ON ba.bledger_id=bl.bledger_id 
            JOIN books b ON b.book_id=bl.book_id 
            JOIN book_author_masters bam ON bl.bauthor_id=bam.bauthor_id 
            $where
            ";
        $result = $this->db->query($query);
        $return['data'] = $result->result_array();
        $return['found_rows'] = $this->db->query($query)->num_rows();
        $return['total_rows'] = $result->num_rows();
        return $return;
    }

    function return_borrowed_book($post_values = null) {
        $update_data = array();
        if (isset($post_values['book_lost']) && $post_values['book_lost'] == '1') {
            $update_data = array(
                'is_book_lost' => 1,
                'book_lost_fine' => $post_values['book_lost_fine'],
                'book_return_condition' => $post_values['book_condition']
            );
        } else {
            $return_delay_fine = $this->rbac->get_app_config_item('library/library/role_config/default/return_delay_fine');
            $return_delay_fine = (string) $return_delay_fine[0];
            $return_delay_fine = explode(',', $return_delay_fine);
            $fine = (isset($return_delay_fine[0])) ? $return_delay_fine[0] : 1; //return days
            $cur_date = date('Y-m-d h:m:s');

            $query = "SELECT DATEDIFF(CURDATE(),due_date) as date_different FROM book_assigns where bassign_id='" . $post_values['book_assign_id'] . "'";
            $date_diff = $this->db->query($query)->row()->date_different;
            $return_delay_fine = NULL;

            if ($date_diff > 0) {
                $return_delay_fine = $date_diff * $fine;
            }
            $update_data = array(
                'return_date' => $cur_date,
                'return_delay_fine' => $return_delay_fine,
                'book_return_condition' => $post_values['book_condition']
            );
        }
        $this->db->where('bassign_id', $post_values['book_assign_id']);
        return $this->db->update('book_assigns', $update_data);
    }

    function calculate_return_delay_fine($assigned_id = '') {
        $return_delay_fine = $this->rbac->get_app_config_item('library/library/role_config/default/return_delay_fine');
        $return_delay_fine = (string) $return_delay_fine[0];
        $return_delay_fine = explode(',', $return_delay_fine);
        $fine = (isset($return_delay_fine[0])) ? $return_delay_fine[0] : 1; //return days
        $query = "SELECT DATEDIFF(CURDATE(),due_date) as date_different FROM book_assigns where bassign_id='" . $assigned_id . "'";
        $date_diff = $this->db->query($query)->row()->date_different;
        $return_delay_fine = NULL;
        if ($date_diff > 0) {
            $return_delay_fine = $date_diff * $fine;
        }
        $return['fine_amount'] = $return_delay_fine;
        $return['date_diff'] = $date_diff;
        return $return;
    }

}
