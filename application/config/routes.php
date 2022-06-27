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
$route['default_controller'] 							= 'front';

$route['login-register']								= 'front/login_register';
$route['complete-process']								= 'front/complete_process';
$route['reset-password']								= 'front/reset_password';
$route['calendar']										= 'front/calendar';
$route['calendar/(:any)']								= 'front/calendar/$1';
$route['todo']											= 'front/taskboard';
$route['todo/(:any)']									= 'front/taskboard/$1';
$route['profile']										= 'front/profile_completion';
$route['account-verification/(:num)/(:any)/(:any)']		= 'front/account_verify/$1/$1/$1';
$route['change-password/(:num)/(:any)/(:any)']			= 'front/change_password/$1/$1/$1';
$route['callback']										= 'front/callback';
$route['privacy-policy']								= 'front/privacy_policy';
$route['videos']										= 'front/videos';
$route['study-blocks/(:num)']							= 'front/study_blocks/$1';
$route['view-study-block/(:num)']						= 'front/view_study_block/$1';
$route['accept-study-block-request/(:num)/(:num)/(:num)']='front/accept_study_block/$1/$1/$1';
$route['reject-study-block-request/(:num)/(:num)/(:num)']= 'front/reject_study_block/$1/$1/$1';
$route['planner']										= 'front/planner';
$route['subscribe']										= 'front/subscribe';
$route['settings']										= 'front/settings';
$route['my-profile']									= 'front/profile';


$route['super-admin']									= 'superadmin/index';
$route['super-admin/dashboard']							= 'superadmin/dashboard';
$route['super-admin/registered-users']					= 'superadmin/registered_users';
$route['super-admin/user-detail/(:num)']				= 'superadmin/user_detail/$1';
$route['super-admin/motivator']							= 'superadmin/motivator';
$route['super-admin/programs']							= 'superadmin/program';
$route['super-admin/view-program/(:num)']				= 'superadmin/view_program/$1';
$route['super-admin/step1-cycle']						= 'superadmin/step1_cycle';
$route['super-admin/holiday']							= 'superadmin/holiday';
$route['super-admin/calendar']							= 'superadmin/calendar';
$route['super-admin/calendar/(:any)']					= 'superadmin/calendar/$1';

$route['logout']										= 'front/logout';
$route['404_override'] 									= 'front/error_404';
$route['translate_uri_dashes'] 							= FALSE;