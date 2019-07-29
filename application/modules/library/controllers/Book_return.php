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
        $this->layout->breadcrumbsFlag = 1;
        $this->layout->navTitle = 'Book return <small>Return borrowed books</small>';

        $this->load->model('library/book_returns');
    }

    function index() {
        $this->scripts_include->includePlugins(array('jq_validation', 'bs_datepicker', 'jq_typehead', 'datatable','chosen'), 'js');
        $this->scripts_include->includePlugins(array('bs_datepicker', 'jq_typehead', 'datatable'), 'css');
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
        $input_array = array();
        $input_array['card_no'] = $this->input->post('card_no');
        $input_array['start'] = $this->input->post('start');
        $input_array['length'] = $this->input->post('length');
        $input_array['order'] = $this->input->post('order');
        $data = $this->book_returns->get_book_details($input_array);
        $response = array("recordsTotal" => $data['total_rows'], "recordsFiltered" => $data['found_rows'], 'data' => $data['data']);
        echo json_encode($response);
    }

    function get_book_assigns_old() {
        if ($this->input->is_ajax_request()) {
            $assigned_books = $this->book_returns->get_book_details();
            $mark_up = '<div class="col-md-12">'
                    . '<div class="row"><div class="col-md-6"><h4>Card number: ' . $this->input->post('card_no') . '</h4></div><div class="col-md-6">' .
                    '<button class="btn btn-primary pull-right btn_return_book" style="margin-right:2% !important;">Return books</button></div></div>';
            if (!empty($assigned_books)) {
                $mark_up .= '<table class="table table-bordered">';
                $mark_up .= '<thead><tr><th>#</th><th>Book Name</th><th>Author</th><th>Edition</th><th>Issued on</th><th>Due date</th></tr></thead>';
                $mark_up .= '<tbody>';
                foreach ($assigned_books as $books) {
                    $mark_up .= '<tr>';
                    $mark_up .= '<td><center><input type="checkbox" name="chkbooks[]" id="chkbooks" class="chkbooks" value="' . $books['bassign_id'] . '"/>'
                            . '<input type="hidden" name="bassign_id[]" id="bassign_id" value="' . $books['bassign_id'] . '"/></center></td>';
                    $mark_up .= '<td>' . $books['name'] . '</td>';
                    $mark_up .= '<td>' . $books['author_name'] . '</td>';
                    $mark_up .= '<td>' . $books['edition'] . '</td>';
                    $mark_up .= '<td>' . $books['date_issue'] . '</td>';
                    $mark_up .= '<td>' . $books['due_date'] . '</td>';
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

    function return_borrowed_books() {
        $is_updated = $this->book_returns->return_borrowed_book($this->input->post());
        if ($is_updated) {
            echo json_encode(array('status' => TRUE));
        } else {
            echo json_encode(array('status' => FALSE));
        }
    }

    function get_delayed_fine() {
        $data = $this->book_returns->calculate_return_delay_fine($this->input->post());
        echo json_encode(array('status' => true, 'data' => $data));
    }

    function get_book_lost_fine() {
        $book_lost_fine = $this->rbac->get_app_config_item('library/role_config/default/book_lost_fine');
        $book_lost_fine = (string) $book_lost_fine[0];
        $book_lost_fine = explode(',', $book_lost_fine);
        $fine = (isset($book_lost_fine[0])) ? $book_lost_fine[0] : 0; //return book lost fine
        echo json_encode(array('status' => true, 'book_lost_fine' => $fine));
    }

}
