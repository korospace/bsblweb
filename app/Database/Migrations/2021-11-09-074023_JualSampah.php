<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JualSampah extends Migration
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
            'jenis_sampah' => [
                'type' => 'character varying',
                'constraint' => 40,
                'null' => false,
            ],
            'jumlah' => [
                'type' => 'numeric',
                'null' => false,
            ],
            'harga' => [
                'type' => 'numeric',
                'null' => false,
            ],
            'date' => [
                'type' => 'bigint',
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        // $this->forge->addForeignKey('id_transaksi','transaksi','id','CASCADE','CASCADE');
        // $this->forge->addForeignKey('jenis_sampah','jenis','id','SET NULL','SET NULL');
        $this->forge->createTable('jual_sampah');
    }

    public function down()
    {
        //
    }
}
