<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TarikSaldo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'serial',
                'null' => false,
            ],
            'id_transaksi' => [
                'type' => 'text',
                'null' => false,
            ],
            'jenis' => [
                'type' => 'character varying',
                'constraint' => 8,
                'null' => false,
            ],
            'jumlah' => [
                'type' => 'numeric',
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_transaksi','transaksi','id','CASCADE','CASCADE');
        $this->forge->createTable('tarik_saldo');
    }

    public function down()
    {
        //
    }
}
