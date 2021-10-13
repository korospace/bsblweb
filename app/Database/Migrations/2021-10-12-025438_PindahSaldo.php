<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PindahSaldo extends Migration
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
            'dompet_asal' => [
                'type' => 'character varying',
                'constraint' => 4,
                'null' => false,
            ],
            'jumlah' => [
                'type' => 'numeric',
                'null' => false,
            ],
            'dompet_tujuan' => [
                'type' => 'character varying',
                'constraint' => 4,
                'null' => false,
            ],
            'hasil_konversi' => [
                'type' => 'numeric',
                'null' => false,
            ],
            'harga_emas' => [
                'type' => 'numeric',
                'default' => 0,
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_transaksi','transaksi','id','CASCADE','CASCADE');
        $this->forge->createTable('pindah_saldo');
    }

    public function down()
    {
        //
    }
}
