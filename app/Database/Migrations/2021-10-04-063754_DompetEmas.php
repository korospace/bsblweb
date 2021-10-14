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
                'type' => 'text',
                'unique' => true,
                'null' => false,
            ],
            'jumlah_galery24' => [
                'type' => 'numeric',
                'null' => false,
                'default' => 0,
            ],
            'jumlah_ubs' => [
                'type' => 'numeric',
                'null' => false,
                'default' => 0,
            ],
            'jumlah_antam' => [
                'type' => 'numeric',
                'null' => false,
                'default' => 0,
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
