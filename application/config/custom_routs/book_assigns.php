<?php

$route['book-assigns'] = 'library/book_assignment/index';
$route['create-book-assign'] = 'library/book_assignment/create';
$route['edit-book-assign/(:any)'] = 'library/book_assignment/edit/$1';
$route['edit-book-assign-save'] = 'library/book_assignment/edit';
$route['view-book-assign/(:any)'] = 'library/book_assignment/view/$1';
$route['delete-book-assign'] = 'library/book_assignment/delete';
$route['export-book-assigns'] = 'library/book_assignment/export_grid_data';
$route['add-library-member'] = 'library/book_assignment/add_member';
$route['isbn-status'] = 'library/book_assignment/isbn_status';
$route['show-user-data'] = 'library/book_assignment/show_search_user_details';
$route['search-book-data'] = 'library/book_assignment/search_book_details';
$route['assign-book'] = 'library/book_assignment/assign_book';
$route['get-books-list'] = 'library/book_assignment/fetch_books_list';
