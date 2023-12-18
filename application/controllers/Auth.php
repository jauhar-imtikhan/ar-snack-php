<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_already_login();
    }

    public function index()
    {
        $this->load->view('auth/login');
    }

    public function register()
    {

        $this->load->view('auth/register');
    }

    public function verify()
    {
        $this->load->view('auth/verify');
    }
}

/* End of file Auth.php */
