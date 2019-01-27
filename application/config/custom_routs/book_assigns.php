<?php
$route['book-assigns'] = 'library/book_assigns/index';
$route['create-book-assign'] = 'library/book_assigns/create';
$route['edit-book-assign/(:any)'] = 'library/book_assigns/edit/$1';
$route['edit-book-assign-save'] = 'library/book_assigns/edit';
$route['view-book-assign/(:any)'] = 'library/book_assigns/view/$1';
$route['delete-book-assign'] = 'library/book_assigns/delete';
$route['export-book-assigns'] = 'library/book_assigns/export_grid_data';
$route['add-library-member'] = 'library/book_assigns/add_member';
