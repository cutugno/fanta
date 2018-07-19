<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_giornate extends CI_Migration
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
                'constraint' => '2',
                'unsigned' => TRUE,
            ),
            'descr' => array(
                'type' => 'VARCHAR',
                'constraint' => '60',
            ),
            'inizio' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'fine' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table giornate
        $this->dbforge->create_table("giornate", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table giornate
        $this->dbforge->drop_table("giornate", TRUE);
    }

}
