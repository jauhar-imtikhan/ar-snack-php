<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Migration_create_table_products extends CI_Migration
{

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->database();
    }

    public function up()
    {
        $this->dbforge->add_field(array(
            'product_id' => array(
                'type' => 'CHAR',
                'constraint' => 32,
            ),
            'product_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'product_price_sell' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'product_price_buy' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'product_category' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'product_barcode' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'product_imag' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
            ),
        ));

        $this->dbforge->add_key('product_id', TRUE);
        $this->dbforge->create_table('tbl_products');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_products');
    }
}

/* End of file create_table_products.php */
