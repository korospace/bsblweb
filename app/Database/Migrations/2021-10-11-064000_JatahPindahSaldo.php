<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JatahPindahSaldo extends Migration
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
                'null' => false,
            ],
            'date' => [
                'type' => 'bigint',
                'constraint' => 19,
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_nasabah','nasabah','id','CASCADE','CASCADE');
        $this->forge->createTable('jatah_pindah_saldo');
    }

    public function down()
    {
        //
    }
}
