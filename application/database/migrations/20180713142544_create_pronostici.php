<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_pronostici extends CI_Migration
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
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
            'id_user' => array(
                'type' => 'TINYINT',
                'constraint' => '4',
            ),
            'id_partita' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'pronostico' => array(
                'type' => 'VARCHAR',
                'constraint' => '5',
                'null' => TRUE,
            ),
            'punteggio' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'null' => TRUE,
            ),
            'last_edit' => array(
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table pronostici
        $this->dbforge->create_table("pronostici", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table pronostici
        $this->dbforge->drop_table("pronostici", TRUE);
    }

}
