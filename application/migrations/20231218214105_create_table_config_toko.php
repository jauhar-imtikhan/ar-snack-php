<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_create_table_config_toko extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'config_toko_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => true
            ),
            'logo_toko' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'nama_toko' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'copyright' => array(
                'type' => 'TEXT',
            ),
            'deskripsi_toko' => array(
                'type' => 'TEXT',
            ),
            'alamat_toko' => array(
                'type' => 'TEXT',
            ),


        ));
        $this->dbforge->add_key('config_toko_id', TRUE);
        $this->dbforge->create_table('tbl_config_toko');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_config_toko');
    }
}
