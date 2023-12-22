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
$route['admin/tambah_kategori']['get'] = 'admincontroller/add_kategori';
$route['admin/edit_kategori/(:any)']['get'] = 'admincontroller/edit_kategori/$1';
$route['admin/stock']['get'] = 'admincontroller/stock';

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
$route['admin/hapus_produk/(:any)/(:any)']['get'] = 'restadmincontroller/delete_product/$1/$2';
$route['admin/proses_tambah_kategori']['post'] = 'restadmincontroller/proses_tambah_kategori';
$route['admin/prosess_edit_kategori']['post'] = 'restadmincontroller/prosess_edit_kategori';
$route['admin/hapus_kategori/(:any)/(:any)']['get'] = 'restadmincontroller/hapus_kategori/$1/$2';
$route['admin/update_toko']['post'] = 'restadmincontroller/update_toko';
$route['admin/update_seo']['post'] = 'restadmincontroller/update_seo';
$route['rest/get_stock']['get'] = 'restadmincontroller/get_stock';


// Route Of Auth Rest API
$route['login']['post'] = 'restauthcontroller/login';
$route['register']['post'] = 'restauthcontroller/register';
$route['verify']['post'] = 'restauthcontroller/verify';
