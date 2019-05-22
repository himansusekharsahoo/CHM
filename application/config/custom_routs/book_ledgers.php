<?php
$route['manage-book-ledger'] = 'library/book_ledgers/index';
$route['create-book-ledger'] = 'library/book_ledgers/create';
$route['edit-book-ledger/(:any)'] = 'library/book_ledgers/edit/$1';
$route['edit-book-ledger-save'] = 'library/book_ledgers/edit';
$route['view-book-ledger/(:any)'] = 'library/book_ledgers/view/$1';
$route['delete-book-ledger'] = 'library/book_ledgers/delete';
$route['export-book-ledger'] = 'library/book_ledgers/export_grid_data';
$route['popup-qr-code'] = 'library/book_ledgers/get_bar_qr_code';
$route['book-ledger-purchase-details'] = 'library/book_ledgers/get_purchage_details_grid';
$route['export-book-ledger-purchase-details'] = 'library/book_purchage_detail_logs/export_grid_data';
$route['delete-book-ledger-purchase-details'] = 'library/book_purchage_detail_logs/delete';
$route['book-ledger-purchase-details-save'] = 'library/book_ledgers/save_book_purchase_details';

//Manage book category
$route['manage-book-category'] = 'library/book_category_masters/index';
$route['create-book-category'] = 'library/book_category_masters/create';
$route['edit-book-category/(:any)'] = 'library/book_category_masters/edit/$1';
$route['edit-book-category-save'] = 'library/book_category_masters/edit';
$route['view-book-category/(:any)'] = 'library/book_category_masters/view/$1';
$route['delete-book-category'] = 'library/book_category_masters/delete';
$route['export-book-category'] = 'library/book_category_masters/export_grid_data';
//Manage book publication
$route['manage-book-publication'] = 'library/book_publication_masters/index';
$route['create-book-publication'] = 'library/book_publication_masters/create';
$route['edit-book-publication/(:any)'] = 'library/book_publication_masters/edit/$1';
$route['edit-book-publication-save'] = 'library/book_publication_masters/edit';
$route['view-book-publication/(:any)'] = 'library/book_publication_masters/view/$1';
$route['delete-book-publication'] = 'library/book_publication_masters/delete';
$route['export-book-publication'] = 'library/book_publication_masters/export_grid_data';
//Manage book author
$route['manage-book-author'] = 'library/book_author_masters/index';
$route['create-book-author'] = 'library/book_author_masters/create';
$route['edit-book-author/(:any)'] = 'library/book_author_masters/edit/$1';
$route['edit-book-author-save'] = 'library/book_author_masters/edit';
$route['view-book-author/(:any)'] = 'library/book_author_masters/view/$1';
$route['delete-book-author'] = 'library/book_author_masters/delete';
$route['export-book-author'] = 'library/book_author_masters/export_grid_data';
//Manage book location
$route['manage-book-location'] = 'library/book_location_masters/index';
$route['create-book-location'] = 'library/book_location_masters/create';
$route['edit-book-location/(:any)'] = 'library/book_location_masters/edit/$1';
$route['edit-book-location-save'] = 'library/book_location_masters/edit';
$route['view-book-location/(:any)'] = 'library/book_location_masters/view/$1';
$route['delete-book-location'] = 'library/book_location_masters/delete';
$route['export-book-location'] = 'library/book_location_masters/export_grid_data';
