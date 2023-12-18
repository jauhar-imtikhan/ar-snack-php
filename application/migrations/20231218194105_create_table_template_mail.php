<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_create_table_template_mail extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'template_email_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'message' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'title_email' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'bg_card' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'bg_body' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'color_text' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'color_header' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'btn_header' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'color_btn' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'color_btn_hover' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'size_logo' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'text_align' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'image' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'color_divider' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'position_btn' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'action' => array(
                'type' => 'TEXT',
            ),
            'description' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
        ));
        $this->dbforge->add_key('template_email_id', TRUE);
        $this->dbforge->create_table('tbl_template_mail');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_template_mail');
    }
}
