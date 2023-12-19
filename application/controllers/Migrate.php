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
            show_error($this->migration->error_string(), 500, 'Migration failed!');
        }
        echo "Table Migrated Successfully.";
    }
}

/* End of file Migrate.php */
