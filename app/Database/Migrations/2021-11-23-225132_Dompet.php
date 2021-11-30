<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dompet extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'serial',
                'null' => false,
            ],
            'id_user' => [
                'type'   => 'text',
                'unique' => true,
                'null'   => false,
            ],
            'uang' => [
                'type'    => 'numeric',
                'null'    => false,
                'default' => 0,
            ],
            'ubs' => [
                'type'    => 'numeric',
                'null'    => false,
                'default' => 0,
            ],
            'antam' => [
                'type'    => 'numeric',
                'null'    => false,
                'default' => 0,
            ],
            'galery24' => [
                'type'    => 'numeric',
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
        //
    }
}
