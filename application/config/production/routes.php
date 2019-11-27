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

$route['auth/checkin']		= SYS_AUTH.'/site/checkin';
$route['auth/checkout']		= SYS_AUTH.'/site/checkout';
$route[SYS_AUTH.'/applicant/detail-test'] = SYS_AUTH.'/applicant/detail_test';
$route[SYS_AUTH.'/reporting/candidat-progress'] = SYS_AUTH.'/reporting/candidat_progress';
$route[SYS_AUTH.'/applicant/new-candidat/(:any)'] = SYS_AUTH.'/applicant/new_candidat/$1';
$route[SYS_AUTH.'/applicant/new-create-candidate'] = SYS_AUTH.'/applicant/create_candidat_step_one';
$route[SYS_AUTH.'/applicant/process-cpi'] = SYS_AUTH.'/applicant/cpi_proses';
$route[SYS_AUTH.'/applicant/process-cfi'] = SYS_AUTH.'/applicant/cfi_proses';
$route[SYS_AUTH.'/applicant/process-cei'] = SYS_AUTH.'/applicant/cei_proses';
$route[SYS_AUTH.'/applicant/process-ceb'] = SYS_AUTH.'/applicant/ceb_proses';
$route[SYS_AUTH.'/applicant/process-ai'] = SYS_AUTH.'/applicant/ai_proses';

$route['default_controller'] = 'site';
$route['404_override'] = 'site/page_404';
$route['translate_uri_dashes'] = FALSE;