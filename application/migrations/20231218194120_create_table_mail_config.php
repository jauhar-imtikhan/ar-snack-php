<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_create_table_mail_config extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'key_email' => [
                'type' => 'CHAR',
                'constraint' => '100',
            ],
            'send_email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'name_email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
        ));
        $this->dbforge->add_key('key_email', TRUE);
        $this->dbforge->create_table('tbl_config_email');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_config_email');
    }
}
