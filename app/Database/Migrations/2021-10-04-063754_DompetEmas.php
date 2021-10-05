<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DompetEmas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'serial',
                'null' => false,
            ],
            'id_nasabah' => [
                'type' => 'character varying',
                'constraint' => 10,
                'unique' => true,
                'null' => false,
            ],
            'jumlah' => [
                'type' => 'text',
                'null' => false,
                'default' => '0',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('id_nasabah');
        $this->forge->addForeignKey('id_nasabah','nasabah','id','CASCADE','CASCADE');
        $this->forge->createTable('dompet_emas');
    }

    public function down()
    {
        //
    }
}
