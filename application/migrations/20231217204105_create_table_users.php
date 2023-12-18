<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_create_table_users extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'user_id' => array(
                'type' => 'char',
                'constraint' => 32,
                'unsigned' => TRUE,
                'auto_increment' => FALSE
            ),
            'nama_lengkap' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'no_whatsapp' => array(
                'type' => 'INT',
                'constraint' => 15
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'alamat' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => TRUE,
            ),
            'created_at' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
        ));
        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table('tbl_users');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_users');
    }
}
