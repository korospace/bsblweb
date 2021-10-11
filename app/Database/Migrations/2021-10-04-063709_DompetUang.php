<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DompetUang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'serial',
                'null' => false,
            ],
            'id_nasabah' => [
                'type' => 'text',
                'unique' => true,
                'null' => false,
            ],
            'jumlah' => [
                'type' => 'integer',
                'null' => false,
                'default' => 0,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('id_nasabah');
        $this->forge->addForeignKey('id_nasabah','nasabah','id','CASCADE','CASCADE');
        $this->forge->createTable('dompet_uang');
    }

    public function down()
    {
        //
    }
}
