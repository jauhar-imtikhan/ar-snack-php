<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Migration_create_table_kategori extends CI_Migration
{

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up()
    {
        $this->dbforge->add_field(array(
            'kategori_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'kategori_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'kategori_deskripsi' => array(
                'type' => 'TEXT',
            )
        ));

        $this->dbforge->add_key('kategori_id', TRUE);
        $this->dbforge->create_table('tbl_kategori');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_kategori');
    }
}

/* End of file create_table_kategori.php */
