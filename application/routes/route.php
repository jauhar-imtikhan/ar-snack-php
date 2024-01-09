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
$route['admin/wa_gateway']['get'] = 'admincontroller/wa';
$route['admin/wa_gateway/auto_reply']['get'] = 'admincontroller/wa_auto_reply';
$route['admin/hero_section']['get'] = 'admincontroller/hero_section';
$route['admin/social_link']['get'] = 'admincontroller/social_link';
$route['admin/social_link_edit']['get'] = 'admincontroller/social_link_edit';


// Route Of Landingpage Produk
$route['produk/(:any)']['get'] = 'landingpage/produk/$1';
$route['produk']['get'] = 'landingpage/produk';
$route['cart']['get'] = 'shopcontroller/cart';

// Route Of Shop
$route['produk/detail/(:any)']['get'] = 'shopcontroller/index/$1';
$route['user/search']['get'] = 'shopcontroller/search_result';
$route['user/account']['get'] = 'shopcontroller/account';

// Route Of Shop Rest API
$route['cek_ongkir']['post'] = 'api/restshopcontroller/cek_ongkir';
$route['rest/shop/countcart']['get'] = 'api/restshopcontroller/count_cart';
$route['rest/shop/addtocart']['post'] = 'api/restshopcontroller/add_to_cart';
$route['rest/shop/delete_cart']['post'] = 'api/restshopcontroller/delete_cart';
$route['rest/shop/get_province']['get'] = 'api/restshopcontroller/get_province';
$route['rest/shop/get_city/(:any)']['get'] = 'api/restshopcontroller/get_city/$1';
$route['rest/shop/update_alamat_pengiriman']['post'] = 'api/restshopcontroller/update_alamat';
$route['rest/shop/get_areas']['get'] = 'api/restshopcontroller/get_areas';
$route['rest/shop/cek_ongkir']['post'] = 'api/restshopcontroller/cek_ongkir';
$route['rest/shop/update_qty']['post'] = 'api/restshopcontroller/update_qty';
$route['rest/shop/create_order']['post'] = 'api/restshopcontroller/create_order';
$route['rest/shop/create_invoice']['post'] = 'api/restshopcontroller/create_invoice';
$route['rest/shop/payment']['post'] = 'api/restshopcontroller/midtranspayment';
$route['rest/shop/update_payment']['post'] = 'api/restshopcontroller/updateCheckout';
$route['rest/shop/updateProfile']['post'] = 'api/restshopcontroller/updateProfile';
$route['rest/shop/orderList']['get'] = 'api/restshopcontroller/orderList';
$route['rest/shop/tracking_paket/(:any)/(:any)']['get'] = 'api/restshopcontroller/tracking_paket/$1/$2';
$route['rest/shop/save_sales_data']['post'] = 'api/restshopcontroller/save_sales_data';
$route['rest/shop/delete_akun/(:any)/(:any)']['get'] = 'api/restshopcontroller/delete_akun/$1/$2';
// Route Of Admin Rest API
$route['update_profile']['post'] = 'api/restadmincontroller/update_profile';
$route['update_password']['post'] = 'api/restadmincontroller/update_password';
$route['admin/create_product']['post'] = 'api/restadmincontroller/create_product';
$route['admin/get_product']['get'] = 'api/restadmincontroller/get_product';
$route['admin/update_product']['post'] = 'api/restadmincontroller/pro_update_product';
$route['admin/hapus_produk/(:any)/(:any)']['get'] = 'api/restadmincontroller/delete_product/$1/$2';
$route['admin/proses_tambah_kategori']['post'] = 'api/restadmincontroller/proses_tambah_kategori';
$route['admin/prosess_edit_kategori']['post'] = 'api/restadmincontroller/prosess_edit_kategori';
$route['admin/hapus_kategori/(:any)/(:any)']['get'] = 'api/restadmincontroller/hapus_kategori/$1/$2';
$route['admin/update_toko']['post'] = 'api/restadmincontroller/update_toko';
$route['admin/update_seo']['post'] = 'api/restadmincontroller/update_seo';
$route['rest/get_stock']['get'] = 'api/restadmincontroller/get_stock';
$route['rest/search']['post'] = 'api/restadmincontroller/search';
$route['restadmincontroller/kategori']['get'] = 'api/restadmincontroller/kategori';
$route['admin/wa_gateway/add_auto_reply']['post'] = 'api/restadmincontroller/wa_auto_reply';
$route['admin/wa_gateway/get_pesan_triger']['get'] = 'api/restadmincontroller/get_auto_reply';
$route['admin/wa_gateway/update_auto_reply/(:any)']['post'] = 'api/restadmincontroller/update_auto_reply/$1';
$route['admin/wa_gateway/delete_auto_reply/(:any)']['post'] = 'api/restadmincontroller/delete_auto_reply/$1';
$route['admin/restadmincontroller/hero_section']['post'] = 'api/restadmincontroller/hero_section';
$route['admin/restadmincontroller/upload_image_hero_section']['post'] = 'api/restadmincontroller/image_hero_section';
$route['admin/get_variant/(:any)']['get'] = 'api/restadmincontroller/variant/$1';
$route['admin/get_variant_by_id/(:any)']['get'] = 'api/restadmincontroller/variant_by_id/$1';
$route['admin/create_variant']['post'] = 'api/restadmincontroller/create_variant';
$route['admin/delete_variant/(:any)/(:any)']['post'] = 'api/restadmincontroller/delete_variant/$1/$2';
$route['admin/update_variant']['post'] = 'api/restadmincontroller/update_variant';
$route['admin/update_favicon']['post'] = 'api/restadmincontroller/update_favicon';
$route['admin/get_icon/(:any)']['get'] = 'api/restadmincontroller/get_icon/$1';
$route['admin/social_media_link']['post'] = 'api/restadmincontroller/upload_icon';


// Route Of Auth Rest API
$route['login']['post'] = 'api/restauthcontroller/login';
$route['register']['post'] = 'api/restauthcontroller/register';
$route['verify']['post'] = 'api/restauthcontroller/verify';


// Route Of Webhook API
$route['webhook/biteship']['get'] = 'api/restwebhookapi/webhookBiteship';


// Route Of Migrations
$route['migration']['get'] = 'migrate';
