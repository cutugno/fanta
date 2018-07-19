<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_partite extends CI_Migration
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
            'id_giornata' => array(
                'type' => 'TINYINT',
                'constraint' => '2',
            ),
            'partita' => array(
                'type' => 'VARCHAR',
                'constraint' => '60',
            ),
            'risultato' => array(
                'type' => 'VARCHAR',
                'constraint' => '5',
                'null' => TRUE,
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table partite
        $this->dbforge->create_table("partite", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table partite
        $this->dbforge->drop_table("partite", TRUE);
    }

}
