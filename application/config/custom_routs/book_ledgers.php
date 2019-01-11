<?php
$route['manage-book-ledger'] = 'library/book_ledgers/index';
$route['create-book-ledger'] = 'library/book_ledgers/create';
$route['edit-book-ledger/(:any)'] = 'library/book_ledgers/edit/$1';
$route['view-book-ledger/(:any)'] = 'library/book_ledgers/view/$1';
$route['delete-book-ledger'] = 'library/book_ledgers/delete';
$route['export-book-ledger'] = 'library/book_ledgers/export_grid_data';