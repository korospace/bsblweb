<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dompet extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                // 'type'           => 'serial', // postgre,
                'type'           => 'int', // mysql
                'auto_increment' => true,  // mysql
                'null'           => false,
            ],
            'id_user' => [
                // 'type'       => 'text', // postgre
                'type'       => 'varchar', // mysql
                'constraint' => 200,       // mysql
                'null'       => false,
            ],
            'uang' => [
                // 'type'    => 'integer', // postgre
                'type'    => 'int', // mysql
                'null'    => false,
                'default' => 0,
            ],
            'emas' => [
                // 'type'    => 'numeric', // postgre
                'type'       => 'DECIMAL', // mysql
                'constraint' => '65,4',   // mysql
                'null'    => false,
                'default' => 0,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('id_user');
        $this->forge->addForeignKey('id_user','users','id','CASCADE','CASCADE');
        $this->forge->createTable('dompet');
    }

    public function down()
    {
        $this->forge->dropTable('dompet');
    }
}
