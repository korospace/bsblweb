<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Wilayah extends Migration
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
                'null'   => false,
                'unique' => true,
            ],
            'kodepos' => [
                'type'       => 'character varying',
                'constraint' => 10,
                'null'       => false,
            ],
            'kelurahan' => [
                'type'       => 'character varying',
                'constraint' => 200,
                'null'       => false,
            ],
            'kecamatan' => [
                'type'       => 'character varying',
                'constraint' => 200,
                'null'       => false,
            ],
            'kota' => [
                'type'       => 'character varying',
                'constraint' => 200,
                'null'       => false,
            ],
            'provinsi' => [
                'type'       => 'character varying',
                'constraint' => 200,
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_user','users','id','CASCADE','CASCADE');
        $this->forge->createTable('wilayah');
    }

    public function down()
    {
        //
    }
}
