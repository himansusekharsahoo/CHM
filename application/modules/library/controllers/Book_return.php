<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Book_return
 *
 * @author Shivaraj
 */
class Book_return extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->layout->lMmenuFlag = 1;
        $this->layout->rightControlFlag = 1;
        $this->layout->navTitleFlag = 1;

        $this->load->model('library/book_returns');
    }

    function index() {
        $this->scripts_include->includePlugins(array('jq_validation', 'bs_datepicker', 'jq_typehead'), 'js');
        $this->scripts_include->includePlugins(array('bs_datepicker', 'jq_typehead'), 'css');
        $data = array();
        $this->layout->render($data);
    }

    function search_card_details() {
        if ($this->input->is_ajax_request()) {
            $search_text = $this->input->post('search_text');
            $result = $this->book_returns->get_library_card_details($search_text);
            echo json_encode(array(
                "status" => true,
                "error" => null,
                "data" => $result
            ));
            exit;
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    function get_book_assigns() {
        if ($this->input->is_ajax_request()) {
            $assigned_books = $this->book_returns->get_book_details($this->input->post('card_no'));
            $mark_up = '<div class="col-md-12"><h4>Card number: ' . $this->input->post('card_no') . '</h4>';
            if (!empty($assigned_books)) {
                $mark_up .= '<table class="table table-bordered">';
                $mark_up .= '<thead><tr><th>Book Name</th><th>Author</th><th>Edition</th><th>Issued on</th><th>Due date</th><th>Return</th></tr></thead>';
                $mark_up .= '<tbody>';
                foreach ($assigned_books as $books) {
                    $mark_up .= '<tr>';
                    $mark_up .= '<td>' . $books['name'] . '</td>';
                    $mark_up .= '<td>' . $books['author_name'] . '</td>';
                    $mark_up .= '<td>' . $books['edition'] . '</td>';
                    $mark_up .= '<td>' . $books['date_issue'] . '</td>';
                    $mark_up .= '<td>' . $books['due_date'] . '</td>';
                    $mark_up .= '<td><button class="btn btn-primary btn_return_book" data-assign_id="' . $books['bassign_id'] . '">Return book</button></td>';
                    $mark_up .= '</tr>';
                }
                $mark_up .= '</tbody>';
                $mark_up .= '</table>';
            } else {
                $mark_up .= '<p>No books assigned for this card number</p>';
            }
            $mark_up .= '</div>';
            echo json_encode(array(
                "status" => true,
                "error" => null,
                "data" => $mark_up
            ));
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

}
