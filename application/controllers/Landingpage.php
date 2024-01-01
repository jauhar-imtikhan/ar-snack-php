<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * @property Product_m $Product_m
 * @property Seo_m $Seo_m
 * @property Configtoko_m $Configtoko_m
 * @property Pagination $pagination
 * @property Cart_m $Cart_m
 */

class Landingpage extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_m');
		$this->load->model('Seo_m');
		$this->load->model('Configtoko_m');
		$this->load->model('Cart_m');
	}

	public function index()
	{


		$data['products'] = $this->Product_m->findAndLimit(5);
		$data['data_seo'] = $this->Seo_m->findFirst();
		$data['data_toko'] = $this->Configtoko_m->findFirst('config_toko_id', '1');
		$this->load->view('landing_page/main_landing', $data);
	}

	public function produk()
	{
		$config['base_url'] = base_url('produk');
		$config['total_rows'] = $this->Product_m->count_product();
		$config['per_page'] = 2;
		$config['uri_segment'] = 2;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close'] = '</span></li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		$data['data_seo'] = $this->Seo_m->findFirst();
		$data['data_toko'] = $this->Configtoko_m->findFirst('config_toko_id', '1');
		$pagination = $this->pagination->create_links();
		$this->pagination->initialize($config);
		$data['pagination'] = $pagination;
		$data['count_cart'] = $this->Cart_m->count_cart($this->session->userdata('user_id') ?? '');
		if (!isset($_GET['keyword'])) {
			$data['products'] = $this->Product_m->paginate($config['per_page'], $this->uri->segment(2));
			$this->load->view('landing_page/main_produk', $data);
		} else {
			error_reporting(0);
			$data['products'] = $this->Product_m->search($_GET['keyword']);
			$this->load->view('landing_page/main_produk', $data);
		}
	}
}
