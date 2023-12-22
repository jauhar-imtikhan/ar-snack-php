<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_create_table_seo extends CI_Migration
{

    public function __construct()
    {
        $this->load->dbforge();
    }

    public function up()
    {

        $this->dbforge->add_field([
            'seo_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'meta_title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'meta_description' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'meta_keyword' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'meta_author' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);
        $this->dbforge->add_key('seo_id', true);
        $this->dbforge->create_table('tbl_seo');
    }

    public function down()
    {
        $this->dbforge->drop_tablr('tbl_seo');
    }
}

/* End of file create_table_seo.php */
