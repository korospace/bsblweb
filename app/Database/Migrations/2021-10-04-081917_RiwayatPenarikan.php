<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RiwayatPenarikan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'serial',
                'null' => false,
            ],
            'id_nasabah' => [
                'type' => 'character varying',
                'constraint' => 10,
                'null' => false,
            ],
            'jenis_dompet' => [
                'type' => 'character varying',
                'constraint' => 4,
                'null' => false,
            ],
            'jumlah' => [
                'type' => 'text',
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_nasabah','nasabah','id','CASCADE','CASCADE');
        $this->forge->addField("tgl_tarik TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->forge->createTable('riwayat_penarikan');
    }

    public function down()
    {
        //
    }
}
