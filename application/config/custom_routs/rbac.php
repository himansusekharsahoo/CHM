<?php
$route['user-list'] = 'rbac/rbac_users/index';
$route['manage_menu'] = 'rbac/rbac_menus/index';
$route['manage-users'] = 'rbac/rbac_users/index';
$route['manage-roles'] = 'rbac/rbac_roles/index';

//staff profile pages
$route['staff-list'] = 'rbac/manage_staffs/staff_list';
$route['create-staff-profile'] = 'rbac/manage_staffs/create';
$route['edit-staff-profile/(:any)'] = 'rbac/manage_staffs/edit/$1';
$route['edit-staff-profile-save'] = 'rbac/manage_staffs/edit';
$route['view-staff-profile/(:any)'] = 'rbac/manage_staffs/view/$1';
$route['delete-staff-profile'] = 'rbac/manage_staffs/delete';
$route['export-staff-profile'] = 'rbac/manage_staffs/export_grid_data';

//student profile pages
$route['student-list'] = 'rbac/manage_students/student_list';
$route['create-student-profile'] = 'rbac/manage_students/create';
$route['edit-student-profile/(:any)'] = 'rbac/manage_students/edit/$1';
$route['edit-student-profile-save'] = 'rbac/manage_students/edit';
$route['view-student-profile/(:any)'] = 'rbac/manage_students/view/$1';
$route['delete-student-profile'] = 'rbac/manage_students/delete';
$route['export-student-profile'] = 'rbac/manage_students/export_grid_data';