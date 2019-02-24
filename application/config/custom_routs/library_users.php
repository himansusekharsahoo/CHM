<?php
$route['library-users'] = 'library/library_users/index';
$route['create-library-user'] = 'library/library_users/create';
$route['show-library-user-data'] = 'library/library_users/show_search_user_details';
$route['edit-library-user/(:any)'] = 'library/library_users/edit/$1';
$route['edit-library-user-save'] = 'library/library_users/edit';
$route['renew-library-user'] = 'library/library_users/renew_icard';
$route['view-library-user/(:any)'] = 'library/library_users/view/$1';
$route['delete-library-user'] = 'library/library_users/delete';
$route['export-library-user'] = 'library/library_users/export_grid_data';
$route['search-lib-user'] = 'library/library_users/search_user';

//will remove below list of routs
$route['add-library-user'] = 'library/library_users/add_member';
$route['print-library-card/(:any)'] = 'library/library_users/print_library_card/$1';
$route['encode-id'] = 'library/library_users/encode_id'; 
$route['unique-card-number'] = 'library/library_users/unique_card_number';
$route['unique-user'] = 'library/library_users/unique_user';
