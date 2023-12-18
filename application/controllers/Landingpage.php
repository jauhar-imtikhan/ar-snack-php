<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landingpage extends CI_Controller
{

	public function index()
	{
		$this->load->view('landing_page/main_landing');
	}

	public function produk()
	{
		$this->load->view('landing_page/main_produk');
	}
}
