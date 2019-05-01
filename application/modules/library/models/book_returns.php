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

    function get_book_details($card_no = '') {
        $columns = array(
            'bassign_id', 'card_no', 'date_issue', 'expiry_date', 'isbn_no', 'edition,name', 'author_name','due_date'
        );
        $query = "SELECT " . implode(',', $columns) . " FROM book_assigns ba 
            JOIN library_members lm ON ba.member_id=lm.member_id 
            JOIN book_ledgers bl ON ba.bledger_id=bl.bledger_id 
            JOIN books b ON b.book_id=bl.book_id 
            JOIN book_author_masters bam ON bl.bauthor_id=bam.bauthor_id 
            WHERE TRIM(LOWER(lm.card_no))=TRIM(LOWER('$card_no')) AND return_date is null";
        return $this->db->query($query)->result_array();
    }

}
