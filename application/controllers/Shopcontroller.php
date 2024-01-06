<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property Product_m $Product_m
 * @property Seo_m $Seo_m
 * @property Configtoko_m $Configtoko_m
 * @property Cart_m $Cart_m
 * @property User_m $User_m
 * @property Checkout_m $Checkout_m
 * @property Invoice_m $Invoice_m
 * @property Db $db
 */


class Shopcontroller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Configtoko_m');
        $this->load->model('Seo_m');
        $this->load->model('Product_m');
        $this->load->model('Cart_m');
        $this->load->model('User_m');
        $this->load->model('Checkout_m');
        $this->load->model('Invoice_m');
    }

    public function index($id)
    {
        $data_seo = $this->Seo_m->findFirst();
        $data_toko = $this->Configtoko_m->findFirst('config_toko_id', '1');
        $data_produk = $this->Product_m->findViewById($id);
        $data = [
            'title' => 'Detail Produk',
            'page' => 'detail_produk',
            'data_seo' => $data_seo,
            'data_toko' => $data_toko,
            'product' => $data_produk,
        ];
        $this->load->view('shop/main', $data);
    }

    public function search_result()
    {
        $keyword = urlencode($_GET['keyword']);
        $data_seo = $this->Seo_m->findFirst();
        $data_toko = $this->Configtoko_m->findFirst('config_toko_id', '1');
        $sql = "SELECT * FROM result_product WHERE nama_produk LIKE '%" . $keyword . "%'";
        $data_product = $this->db->query($sql)->result_array();
        $data = [
            'title' => 'Hasil Pencarian',
            'page' => 'search_result',
            'data_seo' => $data_seo,
            'data_toko' => $data_toko,
            'data_product' => $data_product
        ];
        $this->load->view('shop/main', $data);
    }

    public function cart()
    {
        $data_seo = $this->Seo_m->findFirst();
        $data_toko = $this->Configtoko_m->findFirst('config_toko_id', '1');
        $data_cart = $this->Cart_m->findFirst('cart_user_id', $this->session->userdata('user_id'));
        $data_total_harga = $this->Cart_m->count_total($this->session->userdata('user_id'));
        $data_user = $this->User_m->findFirst($this->session->userdata('user_id'), 'user_id');
        $data_total_berat = $this->Cart_m->count_weight($this->session->userdata('user_id'));
        $data_checkout = $this->Checkout_m->cekStatusChekout($this->session->userdata('user_id'), 'pending');
        $data = [
            'title' => 'Keranjang Belanja',
            'page' => 'cart',
            'data_seo' => $data_seo,
            'data_toko' => $data_toko,
            'carts' => $data_cart,
            'users' => $data_user,
            'total_harga' => $data_total_harga,
            'total_berat' => $data_total_berat,
            'checkout' => $data_checkout,
        ];
        $this->load->view('shop/main', $data);
    }

    public function account()
    {
        $data_seo = $this->Seo_m->findFirst();
        $data_toko = $this->Configtoko_m->findFirst('config_toko_id', '1');
        $data_user = $this->User_m->findFirst($this->session->userdata('user_id'), 'user_id');
        $data_invoices = $this->Invoice_m->count_invoice($this->session->userdata('user_id'));
        $invoices = $this->db->get_where('tbl_invoice', ['invoice_user_id' => $this->session->userdata('user_id')])->row_array();
        $data = [
            'title' => 'Akun',
            'page' => 'account',
            'data_seo' => $data_seo,
            'data_toko' => $data_toko,
            'user' => $data_user,
            'notif_invoice' => $data_invoices,
            'invoices' => $invoices,
        ];
        $this->load->view('shop/main', $data);
    }
}

/* End of file Shopcontroller.php */
