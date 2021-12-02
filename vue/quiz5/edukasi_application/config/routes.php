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
|	http://codeigniter.com/user_guide/general/routing.html
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
//$route['default_controller'] = 'welcome';

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Modul User
$route['ujian_online'] = 'ci_ujian/ujian_online';
$route['ujian_online/(:any)'] = 'ci_ujian/ujian_online/$1';

$route['ujian_soal_all'] = 'ci_ujian/ujian_soal_all';
$route['ujian_soal_all/(:any)'] = 'ci_ujian/ujian_soal_all/$1';

$route['ujian_soal_one'] = 'ci_ujian/ujian_soal_one';
$route['ujian_soal_one/(:any)'] = 'ci_ujian/ujian_soal_one/$1';

//Modul Admin
$route['siswa'] = 'ci_admin/siswa';
$route['siswa/(:any)'] = 'ci_admin/siswa/$1';

$route['studi'] = 'ci_admin/studi';
$route['studi/(:any)'] = 'ci_admin/studi/$1';

$route['ujian_upload'] = 'ci_admin/ujian_upload';
$route['ujian_upload/(:any)'] = 'ci_admin/ujian_upload/$1';

$route['ujian_soal'] = 'ci_admin/ujian_soal';
$route['ujian_soal/(:any)'] = 'ci_admin/ujian_soal/$1';

$route['ujian_judul'] = 'ci_admin/ujian_judul';
$route['ujian_judul/(:any)'] = 'ci_admin/ujian_judul/$1';

$route['ujian_hasil'] = 'ci_admin/ujian_hasil';
$route['ujian_hasil/(:any)'] = 'ci_admin/ujian_hasil/$1';