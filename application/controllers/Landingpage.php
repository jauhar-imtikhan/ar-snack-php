<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * @property Product_m $Product_m
 * @property Seo_m $Seo_m
 * @property Configtoko_m $Configtoko_m
 */

class Landingpage extends CI_Controller
{

	public function index()
	{
		$this->load->model('Product_m');
		$this->load->model('Seo_m');
		$this->load->model('Configtoko_m');

		$data['products'] = $this->Product_m->findAndLimit(5);
		$data['data_seo'] = $this->Seo_m->findFirst();
		$data['data_toko'] = $this->Configtoko_m->findFirst('config_toko_id', '1');
		$this->load->view('landing_page/main_landing', $data);
	}

	public function produk()
	{
		$this->load->view('landing_page/main_produk');
	}
}
