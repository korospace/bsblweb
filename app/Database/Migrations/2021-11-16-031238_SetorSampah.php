<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SetorSampah extends Migration
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
            'id_sampah' => [
                'type'       => 'text', // postgre
                // 'type'       => 'varchar', // mysql
                // 'constraint' => 200,       // mysql
                'null'       => false,
            ],
            'jumlah_kg' => [
                'type' => 'numeric',
                'null' => false,
            ],
            'jumlah_rp' => [
                'type' => 'numeric',
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_transaksi','transaksi','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('id_sampah','sampah','id','CASCADE','CASCADE');
        $this->forge->createTable('setor_sampah');
    }

    public function down()
    {
        //
    }
}
