<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_users extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */
    public function up()
    {

        // Add Fields.
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'TINYINT',
                'constraint' => '4',
                'unsigned' => TRUE,
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '40',
            ),
            'nome' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'last_login' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'level' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'default' => '1',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table users
        $this->dbforge->create_table("users", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table users
        $this->dbforge->drop_table("users", TRUE);
    }

}
