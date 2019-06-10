<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'users';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//student user login
$route['user-login'] = 'users/sign_in';
$route['user-logout'] = 'users/log_out';
$route['user-dashboard'] = 'users/dashboard';

//student user login
$route['employee-login'] = 'admin_users/sign_in';
$route['employee-logout'] = 'admin_users/log_out';
$route['employee-dashboard'] = 'admin_users/dashboard';


//custom routing
$route['admin-login'] = 'admin_users/sign_in';
$route['admin-dashboard'] = 'admin_users/dashboard';

require_once 'custom_routs/rbac.php';
require_once 'custom_routs/upload_utilities.php';
require_once 'custom_routs/book_ledgers.php';
require_once 'custom_routs/book_assigns.php';
require_once 'custom_routs/app_configs.php';
require_once 'custom_routs/library_members.php';
require_once 'custom_routs/library_users.php';
require_once 'custom_routs/book_return.php';
require_once 'custom_routs/books.php';
