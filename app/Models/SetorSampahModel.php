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

    public function getTransaction(array $get,bool $isAdmin,?string $idNasabah): array
    {
        try {
            if ($isAdmin) {
                if (isset($get['id_nasabah'])) {
                    $id_nasabah  = $get['id_nasabah'];
                    $transaction = $this->db->query("SELECT setor_sampah.id AS id_transaksi,SUM(detil_setor_sampah.harga) AS total,setor_sampah.tgl_setor FROM setor_sampah JOIN detil_setor_sampah ON (setor_sampah.id = detil_setor_sampah.id_setor) WHERE setor_sampah.id_nasabah = '$id_nasabah' GROUP BY setor_sampah.id ORDER BY setor_sampah.tgl_setor DESC;")->getResultArray();
                } 
                else if (isset($get['id_transaksi']) && !isset($get['id_nasabah'])) {
                    $id_transaksi = $get['id_transaksi'];
                    $transaction  = $this->db->query("SELECT setor_sampah.id,setor_sampah.id_nasabah,setor_sampah.tgl_setor,sampah.jenis,detil_setor_sampah.jumlah,detil_setor_sampah.harga FROM setor_sampah JOIN detil_setor_sampah ON (setor_sampah.id = detil_setor_sampah.id_setor) JOIN sampah ON (detil_setor_sampah.id_sampah = sampah.id) WHERE setor_sampah.id = '$id_transaksi';")->getResultArray();
                } 
                else {
                    $transaction = $this->db->query("SELECT setor_sampah.id_nasabah,setor_sampah.id AS id_transaksi,SUM(detil_setor_sampah.harga) AS total,setor_sampah.tgl_setor FROM setor_sampah JOIN detil_setor_sampah ON (setor_sampah.id = detil_setor_sampah.id_setor) GROUP BY setor_sampah.id ORDER BY setor_sampah.tgl_setor DESC;")->getResultArray();
                }
            } 
            else {
                if (isset($get['id_transaksi'])) {
                    $id_transaksi = $get['id_transaksi'];
                    $transaction  = $this->db->query("SELECT setor_sampah.id,setor_sampah.id_nasabah,setor_sampah.tgl_setor,sampah.jenis,detil_setor_sampah.jumlah,detil_setor_sampah.harga FROM setor_sampah JOIN detil_setor_sampah ON (setor_sampah.id = detil_setor_sampah.id_setor) JOIN sampah ON (detil_setor_sampah.id_sampah = sampah.id) WHERE setor_sampah.id = '$id_transaksi' AND setor_sampah.id_nasabah = '$idNasabah';")->getResultArray();
                } 
                else {
                    $transaction = $this->db->query("SELECT setor_sampah.id AS id_transaksi,SUM(detil_setor_sampah.harga) AS total,setor_sampah.tgl_setor FROM setor_sampah JOIN detil_setor_sampah ON (setor_sampah.id = detil_setor_sampah.id_setor) WHERE setor_sampah.id_nasabah = '$idNasabah' GROUP BY setor_sampah.id ORDER BY setor_sampah.tgl_setor DESC;")->getResultArray();
                }
            }

            if (empty($transaction)) {    
                return [
                    'success' => false,
                    'message' => "transaction notfound",
                    'code'    => 404
                ];
            } 
            else {   
                return [
                    'success' => true,
                    'data'    => $transaction
                ];
            }
        } 
        catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

}
