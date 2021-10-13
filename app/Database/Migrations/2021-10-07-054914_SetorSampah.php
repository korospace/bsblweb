<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SetorSampah extends Migration
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
            'id_sampah' => [
                'type' => 'character varying',
                'constraint' => 10,
                'null' => true,
            ],
            'jumlah' => [
                'type' => 'numeric',
                'null' => false,
            ],
            'harga' => [
                'type' => 'integer',
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_transaksi','transaksi','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('id_sampah','sampah','id','NO ACTION','NO ACTION');
        $this->forge->createTable('setor_sampah');
    }

    public function down()
    {
        //
    }
}
