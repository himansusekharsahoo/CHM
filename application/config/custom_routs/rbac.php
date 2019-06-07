<?php
//RBAC-ACTIONS
$route['rbac-actions-list'] = 'rbac/rbac_actions/index';
$route['create-rbac-action'] = 'rbac/rbac_actions/create';
$route['edit-rbac-action/(:any)'] = 'rbac/rbac_actions/edit/$1';
$route['edit-rbac-action-save'] = 'rbac/rbac_actions/edit';
$route['view-rbac-action/(:any)'] = 'rbac/rbac_actions/view/$1';
$route['delete-rbac-action'] = 'rbac/rbac_actions/delete';
$route['export-rbac-action'] = 'rbac/rbac_actions/export_grid_data';
//RBAC-MODULES
$route['rbac-modules-list'] = 'rbac/rbac_modules/index';
$route['create-rbac-module'] = 'rbac/rbac_modules/create';
$route['edit-rbac-module/(:any)'] = 'rbac/rbac_modules/edit/$1';
$route['edit-rbac-module-save'] = 'rbac/rbac_modules/edit';
$route['view-rbac-module/(:any)'] = 'rbac/rbac_modules/view/$1';
$route['delete-rbac-module'] = 'rbac/rbac_modules/delete';
$route['export-rbac-module'] = 'rbac/rbac_modules/export_grid_data';
//RBAC-ROLES
$route['rbac-roles-list'] = 'rbac/rbac_roles/index';
$route['create-rbac-role'] = 'rbac/rbac_roles/create';
$route['edit-rbac-role/(:any)'] = 'rbac/rbac_roles/edit/$1';
$route['edit-rbac-role-save'] = 'rbac/rbac_roles/edit';
$route['view-rbac-role/(:any)'] = 'rbac/rbac_roles/view/$1';
$route['delete-rbac-role'] = 'rbac/rbac_roles/delete';
$route['export-rbac-role'] = 'rbac/rbac_roles/export_grid_data';
//RBAC-MODULE-ACTION & RBAC-ROLES-PERMISSIONS
$route['rbac-module-permissions'] = 'rbac/rbac_permissions/module_permissions';
$route['rbac-role-permissions'] = 'rbac/rbac_role_permissions/role_permissions';

$route['manage_menu'] = 'rbac/rbac_menus/index';
$route['user-list'] = 'rbac/rbac_users/index';
$route['manage-users'] = 'rbac/rbac_users/index';


//staff profile pages
$route['employee-list'] = 'employee/manage_employees/index';
$route['create-employee-profile'] = 'employee/manage_employees/create';
$route['edit-employee-profile/(:any)'] = 'employee/manage_employees/edit/$1';
$route['edit-employee-profile-save'] = 'employee/manage_employees/edit';
$route['view-employee-profile/(:any)'] = 'employee/manage_employees/view/$1';
$route['delete-employee-profile'] = 'employee/manage_employees/delete';
$route['export-employee-profile'] = 'employee/manage_employees/export_grid_data';
$route['my-profile'] = 'employee/manage_employees/employee_profile';
$route['validate-my-password'] = 'employee/manage_employees/validate_my_password';
$route['update-my-password'] = 'employee/manage_employees/update_my_password';
$route['update-my-profile-pic'] = 'employee/manage_employees/update_my_profile_pic';

//student profile pages
$route['student-list'] = 'student/manage_students/index';
$route['create-student-profile'] = 'student/manage_students/create';
$route['edit-student-profile/(:any)'] = 'student/manage_students/edit/$1';
$route['edit-student-profile-save'] = 'student/manage_students/edit';
$route['view-student-profile/(:any)'] = 'student/manage_students/view/$1';
$route['delete-student-profile'] = 'student/manage_students/delete';
$route['export-student-profile'] = 'student/manage_students/export_grid_data';