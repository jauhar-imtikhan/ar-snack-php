<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Session $session
 */

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        check_already_login();
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

    public function logout()
    {
        $param = [
            'user_id'
        ];
        $this->session->unset_userdata($param);
        redirect('login');
    }
}

/* End of file Auth.php */
