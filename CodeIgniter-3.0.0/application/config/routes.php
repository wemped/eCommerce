<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'albums';

//Users - Login and Registration
$route['login'] = 'users/login';
$route['register'] = 'users/register';

/*User functionality*/
$route['album_table_search'] = 'albums/search';

/*Admin functionality*/
$route['admin_home'] = 'albums/admin';
$route['admin_table_search'] = 'albums/admin_search';
$route['add_album_page'] = 'albums/add_album_page';
$route['add_album'] = 'albums/add_album';
$route['edit_album_page/(:any)'] = 'albums/edit_album_page/$1';
$route['edit_album_page/edit_album'] = 'albums/edit_album';
$route['delete_album_page/(:any)'] = 'albums/delete_album_page/$1';
$route['delete_album/(:any)'] = 'albums/delete_album/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//checkout
$route['cart'] = 'orders/details';
$route['charge'] = 'orders/validate_order';

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
