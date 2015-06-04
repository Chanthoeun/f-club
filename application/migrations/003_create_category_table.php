<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_category_table extends CI_Migration {

    public function up()
    {
        // set default engine
        $this->db->query('SET storage_engine=MYISAM;');

        // Drop table 'category' if it exists		
        if ($this->db->table_exists('category'))
        {
            $this->dbforge->drop_table('category');
        }

        // Table structure for table 'category'
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'caption' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'slug'  => array(
                'type'  => 'VARCHAR',
                'constraint'    => '25'
            ),
            'order' => array(
                'type'  => 'TINYINT',
                'constraint' => '6',
                'unsigned'  => TRUE,
                'default'   => 0,
            ),
            'status' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1
            ),
            'created_at' => array(
                'type'  => 'INT',
                'constraint' => '11'
            ),
            'updated_at'   => array(
               'type'  => 'INT',
                'constraint' => '11'
            )

        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('category');
        
        // insert data
        $data = array(
            array(
                'caption' => 'Movie Trailer',
                'slug'  => str_replace(' ', '-', strtolower('Movie Trailer')),
                'order' => 1,
		'status'=> 1,
                'created_at' => time(),
                'updated_at' => time()
            ),
            array(
                'caption' => 'Kid Eduction',
                'slug'  => str_replace(' ', '-', strtolower('Kid Eduction')),
                'order' => 2,
		'status'=> 1,
                'created_at' => time(),
                'updated_at' => time()
            ),
            array(
                'caption' => 'Cartoon',
                'slug'  => str_replace(' ', '-', strtolower('Cartoon')),
                'order' => 3,
		'status'=> 1,
                'created_at' => time(),
                'updated_at' => time()
            ),
            array(
                'caption' => 'Health',
                'slug'  => str_replace(' ', '-', strtolower('Health')),
                'order' => 4,
		'status'=> 1,
                'created_at' => time(),
                'updated_at' => time()
            ),
            array(
                'caption' => 'Learning English',
                'slug'  => str_replace(' ', '-', strtolower('Learning English')),
                'order' => 5,
		'status'=> 1,
                'created_at' => time(),
                'updated_at' => time()
            ),
            array(
                'caption' => 'Funny Clip',
                'slug'  => str_replace(' ', '-', strtolower('Funny Clip')),
                'order' => 6,
		'status'=> 1,
                'created_at' => time(),
                'updated_at' => time()
            ),
            array(
                'caption' => 'Others',
                'slug'  => str_replace(' ', '-', strtolower('Others')),
                'order' => 7,
		'status'=> 1,
                'created_at' => time(),
                'updated_at' => time()
            ),
        );
        $this->db->insert_batch('category', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('category');
    }
}