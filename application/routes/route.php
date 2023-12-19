<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'landingpage';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Route Of Authentication
$route['login']['get'] = 'auth';
$route['logout']['get'] = 'auth/logout';
$route['auth/verify']['get'] = 'auth/verify';

// Route Of Admin Page
$route['admin']['get'] = 'admincontroller';
$route['profile']['get'] = 'admincontroller/profile';


// Route Of Landingpage Produk
$route['produk']['get'] = 'landingpage/produk';

// Route Of Migrations
$route['migration']['get'] = 'migrate';


// Route Of Admin Rest API
$route['update_profile']['post'] = 'restadmincontroller/update_profile';
$route['update_password']['post'] = 'restadmincontroller/update_password';

// Route Of Auth Rest API
$route['login']['post'] = 'restauthcontroller/login';
$route['register']['post'] = 'restauthcontroller/register';
$route['verify']['post'] = 'restauthcontroller/verify';
