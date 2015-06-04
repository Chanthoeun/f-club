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
$route['view/(:any)'] = 'home_page/view/$1';
$route['videos'] = 'home/videos';

$route['videos'] = 'home_page/videos';
$route['videos/page'] = 'home_page/videos/page';
$route['videos/page/(:num)'] = 'home_page/videos/page/$1';

$route['videos/(:any)']    = 'home_page/videos/$1';
$route['videos/(:any)/videos']    = 'home_page/videos/$1/page';
$route['videos/(:any)/videos/(:num)']    = 'home_page/videos/$1/page/$2';

$route['about-us'] = 'home_page/about_us';
$route['contact-us'] = 'home_page/contact_us';
$route['policy'] = 'home_page/policy';
$route['condition'] = 'home_page/condition';
$route['search'] = 'home_page/search';

$route['default_controller'] = 'home_page';
$route['404_override'] = 'home/blank';
$route['translate_uri_dashes'] = FALSE;
