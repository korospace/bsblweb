<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class TransaksiModel extends Model
{
    protected $table         = 'transaksi';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id','id_nasabah','type'];

    public function setorSampah(array $data): array
    {
        try {
            $idtransaksi = $data['idtransaksi'];
            $idnasabah   = $data['id_nasabah'];
            $totalHarga  = 0;
            $queryDetilSetor = "INSERT INTO setor_sampah (id_transaksi,id_sampah,jumlah,harga) VALUES";

            foreach ($data['transaksi'] as $t) {
                $idsampah   = $t['id_sampah'];
                $jumlah     = $t['jumlah'];
                $hargaAsli  = $this->db->table('sampah')->select("harga")->where("id",$idsampah)->get()->getResultArray();
                $harga      = (int)$hargaAsli[0]['harga']*(float)$jumlah;
                $totalHarga = $totalHarga+$harga;

                $queryDetilSetor .= "('$idtransaksi','$idsampah',$jumlah,$harga),";
            }

            $queryDetilSetor  = rtrim($queryDetilSetor, ",");
            $queryDetilSetor .= ';';

            $this->db->transBegin();
            $this->db->query("INSERT INTO transaksi (id,id_nasabah,type) VALUES('$idtransaksi','$idnasabah','setor');");
            $this->db->query("UPDATE dompet_uang SET jumlah=jumlah+$totalHarga WHERE id_nasabah='$idnasabah';");
            $this->db->query($queryDetilSetor);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return [
                    'success' => false,
                    'message' => "setor sampah is failed",
                    'code'    => 500
                ];
            } 
            else {
                $this->db->transCommit();
                return [
                    "success"  => true,
                    'message' => 'setor sampah is success',
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

    public function getSaldo(array $data): string
    {
        try {
            $tableDompet = ($data['jenis_dompet'] == 'uang') ? 'dompet_uang' : 'dompet_emas';
            $saldo       = $this->db->table($tableDompet)->select('jumlah')->where('id_nasabah',$data['id_nasabah'])->get()->getResultArray();

            return $saldo[0]['jumlah'];
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

    public function tarikSaldo(array $data): array
    {
        try {
            $idtransaksi = $data['idtransaksi'];
            $idnasabah   = $data['id_nasabah'];
            $jenisDompet = $data['jenis_dompet'];
            $tableDompet = ($data['jenis_dompet'] == 'uang') ? 'dompet_uang' : 'dompet_emas';
            $jumlahTarik = $data['jumlah'];

            $this->db->transBegin();
            $this->db->query("INSERT INTO transaksi (id,id_nasabah,type) VALUES('$idtransaksi','$idnasabah','tarik');");
            $this->db->query("UPDATE $tableDompet SET jumlah=jumlah-$jumlahTarik WHERE id_nasabah='$idnasabah';");
            $this->db->query("INSERT INTO tarik_saldo (id_transaksi,jenis_dompet,jumlah) VALUES('$idtransaksi','$jenisDompet',$jumlahTarik)");

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return [
                    'success' => false,
                    'message' => "tarik saldo is failed",
                    'code'    => 500
                ];
            } 
            else {
                $this->db->transCommit();
                return [
                    "success"  => true,
                    'message' => 'tarik saldo is success',
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

    public function makeDetilTransaksi(array $data): array
    {
        $detil  = [];
        $barang = [];

        foreach ($data as $d) {
            $id_transaksi = $d['id_transaksi'];
            $id_nasabah   = $d['id_nasabah'];
            $date         = $d['date'];
            unset($d['id_transaksi']);
            unset($d['id_nasabah']);
            unset($d['date']);
            $barang[] = $d;
        }

        $detil['id_transaksi'] = $id_transaksi;
        $detil['id_nasabah']   = $id_nasabah;
        $detil['date']         = $date;
        $detil['barang']       = $barang;

        return $detil;
    }

    public function filterData(array $data): array
    {
        $transaction = [];

        foreach ($data as $d) {
            if ($d['total_setor'] == null) {
                unset($d['total_setor']);
            }
            if ($d['total_tarik'] == null) {
                unset($d['total_tarik']);
            }

            $transaction[] = $d;
        }

        return $transaction;
    }

    public function getData(array $get,bool $isAdmin,?string $idNasabah): array
    {
        try {
            if ($isAdmin) {
                if (isset($get['id_nasabah'])) {
                    $id_nasabah  = $get['id_nasabah'];
                    $transaction = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.type,(SELECT SUM(harga) from setor_sampah WHERE setor_sampah.id_transaksi = transaksi.id) AS total_setor,(SELECT SUM(jumlah) from tarik_saldo WHERE tarik_saldo.id_transaksi = transaksi.id) AS total_tarik,transaksi.date FROM transaksi WHERE transaksi.id_nasabah = '$id_nasabah' ORDER BY transaksi.date DESC;")->getResultArray();

                    $transaction = $this->filterData($transaction);
                } 
                else if (isset($get['id_transaksi']) && !isset($get['id_nasabah'])) {
                    $id_transaksi = $get['id_transaksi'];

                    if ($get['type'] == 'setor') {
                        $transaction  = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.id_nasabah,sampah.jenis,setor_sampah.jumlah,setor_sampah.harga,transaksi.date FROM transaksi JOIN setor_sampah ON (transaksi.id = setor_sampah.id_transaksi) JOIN sampah ON (setor_sampah.id_sampah = sampah.id) WHERE transaksi.id = '$id_transaksi';")->getResultArray();

                        $transaction = $this->makeDetilTransaksi($transaction);
                    } 
                    else {
                        $transaction  = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.id_nasabah,tarik_saldo.jenis_dompet,tarik_saldo.jumlah,transaksi.date FROM transaksi JOIN tarik_saldo ON (transaksi.id = tarik_saldo.id_transaksi) WHERE transaksi.id = '$id_transaksi';")->getResultArray()[0];
                    }
                } 
                else {
                    $transaction = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.type,(SELECT SUM(harga) from setor_sampah WHERE setor_sampah.id_transaksi = transaksi.id) AS total_setor,(SELECT SUM(jumlah) from tarik_saldo WHERE tarik_saldo.id_transaksi = transaksi.id) AS total_tarik,transaksi.date FROM transaksi ORDER BY transaksi.date DESC;")->getResultArray();

                    $transaction = $this->filterData($transaction);
                }
            } 
            else {
                if (isset($get['id_transaksi'])) {
                    $id_transaksi = $get['id_transaksi'];

                    if ($get['type'] == 'setor') {
                        $transaction  = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.id_nasabah,sampah.jenis,setor_sampah.jumlah,setor_sampah.harga,transaksi.date FROM transaksi JOIN setor_sampah ON (transaksi.id = setor_sampah.id_transaksi) JOIN sampah ON (setor_sampah.id_sampah = sampah.id) WHERE transaksi.id = '$id_transaksi' AND transaksi.id_nasabah = '$idNasabah';")->getResultArray();

                        $transaction = $this->makeDetilTransaksi($transaction);
                    } 
                    else {
                        $transaction  = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.id_nasabah,tarik_saldo.jenis_dompet,tarik_saldo.jumlah,transaksi.date FROM transaksi JOIN tarik_saldo ON (transaksi.id = tarik_saldo.id_transaksi) WHERE transaksi.id = '$id_transaksi' AND transaksi.id_nasabah = '$idNasabah';")->getResultArray()[0];
                    }
                } 
                else {
                    $transaction = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.type,(SELECT SUM(harga) from setor_sampah WHERE setor_sampah.id_transaksi = transaksi.id) AS total_setor,(SELECT SUM(jumlah) from tarik_saldo WHERE tarik_saldo.id_transaksi = transaksi.id) AS total_tarik,transaksi.date FROM transaksi WHERE transaksi.id_nasabah = '$idNasabah' ORDER BY transaksi.date DESC;")->getResultArray();

                    $transaction = $this->filterData($transaction);
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
