<?php
$route['library-members'] = 'library/library_members/index';
$route['create-library-member'] = 'library/library_members/create';
$route['edit-library-member/(:any)'] = 'library/library_members/edit/$1';
$route['edit-library-member-save'] = 'library/library_members/edit';
$route['view-library-member/(:any)'] = 'library/library_members/view/$1';
$route['delete-library-member'] = 'library/library_members/delete';
$route['export-library-member'] = 'library/library_members/export_grid_data';
$route['add-library-member'] = 'library/library_members/add_member';