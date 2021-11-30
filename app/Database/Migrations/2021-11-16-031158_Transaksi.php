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
            'id_user' => [
                'type' => 'text',
                'null' => false,
            ],
            'jenis_transaksi' => [
                'type' => 'text',
                'null' => false,
            ],
            'date' => [
                'type' => 'bigint',
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_user','users','id','CASCADE','CASCADE');
        // $this->forge->addField("date TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        //
    }
}
