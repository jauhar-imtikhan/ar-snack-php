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
$route['kategori']['get'] = 'admincontroller/kategori';
$route['admin/produk']['get'] = 'admincontroller/produk';
$route['admin/tambah_produk']['get'] = 'admincontroller/add_produk';
$route['admin/edit_produk/(:any)']['get'] = 'admincontroller/update_product/$1';
$route['settings']['get'] = 'admincontroller/settings';


// Route Of Landingpage Produk
$route['produk']['get'] = 'landingpage/produk';

// Route Of Migrations
$route['migration']['get'] = 'migrate';


// Route Of Admin Rest API
$route['update_profile']['post'] = 'restadmincontroller/update_profile';
$route['update_password']['post'] = 'restadmincontroller/update_password';
$route['admin/create_product']['post'] = 'restadmincontroller/create_product';
$route['admin/get_product']['get'] = 'restadmincontroller/get_product';
$route['admin/update_product']['post'] = 'restadmincontroller/pro_update_product';


// Route Of Auth Rest API
$route['login']['post'] = 'restauthcontroller/login';
$route['register']['post'] = 'restauthcontroller/register';
$route['verify']['post'] = 'restauthcontroller/verify';
