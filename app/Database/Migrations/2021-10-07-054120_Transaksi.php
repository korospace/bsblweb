<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'text',
                'null' => false,
            ],
            'id_nasabah' => [
                'type' => 'text',
                'null' => false,
            ],
            'type' => [
                'type' => 'character varying',
                'constraint' => 5,
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_nasabah','nasabah','id','CASCADE','CASCADE');
        $this->forge->addField("date TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        //
    }
}
