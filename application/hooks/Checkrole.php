<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Checkrole
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function check()
    {
        $dataLoggedIn = $this->ci->session->userdata('role');
        if ($dataLoggedIn !== 'administrator') {
            return true;
        }
    }
}
