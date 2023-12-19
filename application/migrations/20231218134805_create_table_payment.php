<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_create_table_payment extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'payment_id' => array(
                'type' => 'char',
                'constraint' => 32,
                'unsigned' => TRUE,
                'auto_increment' => FALSE
            ),
            'user_id_payment' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'product_payment' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'date_payment' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'total_payment' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'method_payment' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),

        ));
        $this->dbforge->add_key('payment_id', TRUE);
        $this->dbforge->create_table('tbl_payment');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_payment');
    }
}
