<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class SetorSampahModel extends Model
{
    protected $table         = 'setor_sampah';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id','id_nasabah'];

    public function addTransaction(array $data): array
    {
        try {
            $idsetor    = $data['idsetor'];
            $idnasabah  = $data['id_nasabah'];
            $totalHarga = 0;
            $queryDetilSetor = "INSERT INTO detil_setor_sampah (id_setor,id_sampah,jumlah,harga) VALUES";

            foreach ($data['transaction'] as $t) {
                $idsampah   = $t['id_sampah'];
                $jumlah     = $t['jumlah'];
                $hargaAsli  = $this->db->table('sampah')->select("harga")->where("id",$idsampah)->get()->getResultArray();
                $harga      = (int)$hargaAsli[0]['harga']*(float)$jumlah;
                $totalHarga = $totalHarga+$harga;

                $queryDetilSetor .= "('$idsetor','$idsampah',$jumlah,$harga),";
            }

            $queryDetilSetor  = rtrim($queryDetilSetor, ",");
            $queryDetilSetor .= ';';
            // var_dump($queryDetilSetor);
            // var_dump($totalHarga);
            // die;

            $this->db->transBegin();
            $this->db->query("INSERT INTO setor_sampah (id,id_nasabah) VALUES('$idsetor','$idnasabah');");
            $this->db->query("UPDATE dompet_uang SET jumlah=jumlah+$totalHarga WHERE id_nasabah='$idnasabah';");
            $this->db->query($queryDetilSetor);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return [
                    'success' => false,
                    'message' => "add new transaction failed",
                    'code'    => 500
                ];
            } 
            else {
                $this->db->transCommit();
                return [
                    "success"  => true,
                    'message' => 'add new transaction success',
                ];
            }
        } 
        catch (Exception $e) {
            $this->db->transRollback();
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

}
