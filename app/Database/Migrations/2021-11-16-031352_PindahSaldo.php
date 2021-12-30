<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PindahSaldo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'serial', // postgre,
                // 'type'           => 'int', // mysql
                // 'auto_increment' => true,
                'null'           => false,
            ],
            'id_transaksi' => [
                'type'       => 'text', // postgre
                // 'type'       => 'varchar', // mysql
                // 'constraint' => 200,       // mysql
                'null'       => false,
            ],
            'jumlah' => [
                'type' => 'numeric',
                'null' => false,
            ],
            'saldo_tujuan' => [
                'type'       => 'character varying', // postgre
                // 'type'       => 'varchar', // mysql
                'constraint' => 8,
                'null'       => false,
            ],
            'harga_emas' => [
                'type'    => 'numeric',
                'default' => 0,
                'null'    => false,
            ],
            'hasil_konversi' => [
                'type' => 'numeric',
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
