<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_create_table_token extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'token_id' => array(
                'type' => 'char',
                'constraint' => 32,
                'unsigned' => TRUE,
                'auto_increment' => FALSE
            ),
            'token' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'created_at' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),

        ));
        $this->dbforge->add_key('token_id', TRUE);
        $this->dbforge->create_table('tbl_token');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_token');
    }
}
