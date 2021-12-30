<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TarikSaldo extends Migration
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
            'jenis_saldo' => [
                'type'       => 'character varying', // postgre
                // 'type'       => 'varchar', // mysql
                'constraint' => 8,
                'null'       => false,
            ],
            'jumlah_tarik' => [
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
