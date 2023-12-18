<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'landingpage';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Route Of Login Page
$route['login']['get'] = 'auth';
$route['tes']['get'] = 'auth/tes';
$route['auth/verify']['get'] = 'auth/verify';

// Route Of Admin Page
$route['admin']['get'] = 'admincontroller';

// Route Of Landingpage Produk
$route['produk']['get'] = 'landingpage/produk';

// Route Of Migrations
$route['migrate']['get'] = 'migrate';


// Route Of Rest API
$route['login']['post'] = 'restauthcontroller/login';
$route['register']['post'] = 'restauthcontroller/register';
$route['verify']['post'] = 'restauthcontroller/verify';
