<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PindahSaldo extends Migration
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
            'id_transaksi' => [
                // 'type'       => 'text', // postgre
                'type'       => 'varchar', // mysql
                'constraint' => 200,       // mysql
                'null'       => false,
            ],
            'jumlah' => [
                // 'type'    => 'integer', // postgre
                'type'       => 'int', // mysql
                'null'       => false,
            ],
            'harga_emas' => [
                // 'type'    => 'integer', // postgre
                'type'       => 'int', // mysql
                'default'    => 0,
                'null'       => false,
            ],
            'hasil_konversi' => [
                // 'type'    => 'numeric', // postgre
                'type'       => 'DECIMAL', // mysql
                'constraint' => '65,4',   // mysql
                'null'       => false,
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
