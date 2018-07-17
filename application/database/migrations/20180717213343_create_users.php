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
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '60',
                'default' => 'null',
                'null' => TRUE,
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
            'avatar' => array(
                'type' => 'BLOB',
                'null' => TRUE,
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("username", TRUE);

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
