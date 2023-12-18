<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Migration $migration
 */

class Migrate extends CI_Controller
{

    public function index()
    {
        $this->load->library('migration');
        if ($this->migration->current() === FALSE) {
            echo $this->migration->error_string();
        } else {
            echo "Table Migrated Successfully.";
        }
    }
}

/* End of file Migrate.php */
