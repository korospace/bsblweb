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
            $date        = (int)strtotime($data['date']);
            $idtransaksi = $data['idtransaksi'];
            $idnasabah   = $data['id_nasabah'];
            $totalHarga  = 0;
            $queryDetilSetor   = "INSERT INTO setor_sampah (id_transaksi,jenis_sampah,jumlah,harga) VALUES";
            $queryJumlahSampah = '';

            foreach ($data['transaksi'] as $t) {
                $jenisSmp   = $t['jenis_sampah'];
                $jumlah     = $t['jumlah'];
                $hargaAsli  = $this->db->table('sampah')->select("harga")->where("jenis",$jenisSmp)->get()->getResultArray();
                $harga      = (int)$hargaAsli[0]['harga']*(float)$jumlah;
                $totalHarga = $totalHarga+$harga;

                $queryDetilSetor   .= "('$idtransaksi','$jenisSmp',$jumlah,$harga),";
                $queryJumlahSampah .= "UPDATE sampah SET jumlah=jumlah+$jumlah WHERE jenis = '$jenisSmp';";
            }

            $queryDetilSetor  = rtrim($queryDetilSetor, ",");
            $queryDetilSetor .= ';';

            $this->db->transBegin();
            $this->db->query("INSERT INTO transaksi (id,id_nasabah,type,jenis_saldo,date) VALUES('$idtransaksi','$idnasabah','setor','uang',$date);");
            $this->db->query("UPDATE dompet SET uang=uang+$totalHarga WHERE id_nasabah='$idnasabah';");
            $this->db->query($queryDetilSetor);
            $this->db->query($queryJumlahSampah);

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
        $jenisSaldo = $data['jenis_saldo'];
        $saldo      = $this->db->table('dompet')->select($jenisSaldo)->where('id_nasabah',$data['id_nasabah'])->get()->getResultArray();

        return $saldo[0][$jenisSaldo];
    }

    public function tarikSaldo(array $data): array
    {
        try {
            $date        = (int)strtotime($data['date']);
            $idtransaksi = $data['idtransaksi'];
            $idnasabah   = $data['id_nasabah'];
            $jenisSaldo  = $data['jenis_saldo'];
            $jumlahTarik = $data['jumlah'];

            $this->db->transBegin();
            $this->db->query("INSERT INTO transaksi (id,id_nasabah,type,jenis_saldo,date) VALUES('$idtransaksi','$idnasabah','tarik','$jenisSaldo',$date);");
            $this->db->query("UPDATE dompet SET $jenisSaldo=$jenisSaldo-$jumlahTarik WHERE id_nasabah='$idnasabah';");
            $this->db->query("INSERT INTO tarik_saldo (id_transaksi,jenis,jumlah) VALUES('$idtransaksi','$jenisSaldo',$jumlahTarik)");

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

    public function jumlahTps(string $idNasabah): int
    {
        $transaction = $this->db->table($this->table)->select('count(id) AS jumlah')->where('id_nasabah',$idNasabah)->where('type','pindah')->get()->getResultArray();

        return (int)$transaction[0]['jumlah'];
    }

    public function pindahSaldo(array $data): array
    {
        try {
            $date              = (int)strtotime($data['date']);
            $idnasabah         = $data['idnasabah'];
            $idtransaksi       = $data['idtransaksi'];
            $jumlahPindah      = $data['jumlahPindah'];
            $hasilKonversi     = $data['hasilKonversi'];
            $hargaemas         = $data['hargaemas'];
            $asal              = $data['asal'];
            $tujuan            = $data['tujuan'];
            $saldoDompetAsal   = $data['saldo_dompet_asal'];
            $saldoDompetTujuan = $data['saldo_dompet_tujuan'];

            $this->db->transBegin();
            $this->db->query("INSERT INTO transaksi (id,id_nasabah,type,jenis_saldo,date) VALUES('$idtransaksi','$idnasabah','pindah','$asal',$date);");
            $this->db->query("UPDATE dompet SET $asal=$saldoDompetAsal,$tujuan=$saldoDompetTujuan WHERE id_nasabah='$idnasabah';");
            $this->db->query("INSERT INTO pindah_saldo (id_transaksi,asal,jumlah,hasil_konversi,tujuan,harga_emas) VALUES ('$idtransaksi','$asal',$jumlahPindah,$hasilKonversi,'$tujuan',$hargaemas)");

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return [
                    'success' => false,
                    'message' => "pindah saldo is failed",
                    'code'    => 500
                ];
            } 
            else {
                $this->db->transCommit();
                return [
                    "success"  => true,
                    'message' => 'pindah saldo is success',
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

    public function getData(array $get,?bool $isAdmin=null,?string $idNasabah=null): array
    {
        try {
            if (isset($get['id_transaksi']) && !isset($get['idnasabah'])) {
                $id_transaksi   = $get['id_transaksi'];
                $code_transaksi = substr($get['id_transaksi'],0,3);
                
                if ($code_transaksi == 'TSS') {
                    $transaction  = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.id_nasabah,transaksi.type,transaksi.jenis_saldo,nasabah.nama_lengkap,setor_sampah.jenis_sampah,setor_sampah.jumlah,setor_sampah.harga,transaksi.date 
                    FROM transaksi 
                    JOIN nasabah ON (transaksi.id_nasabah = nasabah.id) 
                    JOIN setor_sampah ON (transaksi.id = setor_sampah.id_transaksi) 
                    WHERE transaksi.id = '$id_transaksi';")->getResultArray();

                    $transaction = $this->makeDetilTransaksi($transaction);
                } 
                else if ($code_transaksi == 'TTS') {
                    $transaction  = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.id_nasabah,transaksi.type,transaksi.jenis_saldo,nasabah.nama_lengkap,tarik_saldo.jenis,tarik_saldo.jumlah,transaksi.date 
                    FROM transaksi 
                    JOIN nasabah ON (transaksi.id_nasabah = nasabah.id) 
                    JOIN tarik_saldo ON (transaksi.id = tarik_saldo.id_transaksi) 
                    WHERE transaksi.id = '$id_transaksi';")->getResultArray()[0];
                }
                else if ($code_transaksi == 'TPS') {
                    $transaction  = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.id_nasabah,transaksi.type,transaksi.jenis_saldo,nasabah.nama_lengkap,pindah_saldo.asal,pindah_saldo.jumlah,pindah_saldo.tujuan,pindah_saldo.hasil_konversi,pindah_saldo.harga_emas,transaksi.date 
                    FROM transaksi 
                    JOIN nasabah ON (transaksi.id_nasabah = nasabah.id) 
                    JOIN pindah_saldo ON (transaksi.id = pindah_saldo.id_transaksi) 
                    WHERE transaksi.id = '$id_transaksi';")->getResultArray()[0];
                }
                else {
                    $transaction = false;
                }
            } 
            else if ($isAdmin) {
                $query  = 'SELECT transaksi.id AS id_transaksi,transaksi.id_nasabah,transaksi.type,transaksi.date,
                (SELECT SUM(harga) from setor_sampah WHERE setor_sampah.id_transaksi = transaksi.id) AS total_setor,
                (SELECT SUM(jumlah) from tarik_saldo WHERE tarik_saldo.id_transaksi = transaksi.id) AS total_tarik,
                (SELECT SUM(jumlah) from pindah_saldo WHERE pindah_saldo.id_transaksi = transaksi.id) AS total_pindah 
                FROM transaksi';

                if (isset($get['idnasabah'])) {
                    $id_nasabah  = $get['idnasabah'];
                    $query      .= ' WHERE transaksi.id_nasabah = '.$id_nasabah;
                } 
                
                $query      .= ' ORDER BY transaksi.date ASC;';
                $transaction = $this->db->query($query)->getResultArray();
                $transaction = $this->filterData($transaction);
            } 
            else {
                $transaction = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.type,transaksi.jenis_saldo,transaksi.date,
                (SELECT SUM(harga) AS total_setor from setor_sampah WHERE setor_sampah.id_transaksi = transaksi.id),
                (SELECT SUM(jumlah) AS total_kg from setor_sampah WHERE setor_sampah.id_transaksi = transaksi.id),
                (SELECT jumlah AS total_tarik from tarik_saldo WHERE tarik_saldo.id_transaksi = transaksi.id),
                (SELECT jumlah AS total_pindah from pindah_saldo WHERE pindah_saldo.id_transaksi = transaksi.id)
                FROM transaksi
                WHERE transaksi.id_nasabah = '$idNasabah' ORDER BY transaksi.date ASC;")->getResultArray();

                $transaction = $this->filterData($transaction);
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

    public function makeDetilTransaksi(array $data): array
    {
        $detil  = [];
        $barang = [];

        foreach ($data as $d) {
            $id_transaksi = $d['id_transaksi'];
            $id_nasabah   = $d['id_nasabah'];
            $nama_lengkap = $d['nama_lengkap'];
            $type         = $d['type'];
            $jenis_saldo  = $d['jenis_saldo'];
            $date         = $d['date'];
            unset($d['id_transaksi']);
            unset($d['id_nasabah']);
            unset($d['nama_lengkap']);
            unset($d['type']);
            unset($d['type']);
            unset($d['date']);
            $barang[] = $d;
        }

        $detil['id_transaksi'] = $id_transaksi;
        $detil['id_nasabah']   = $id_nasabah;
        $detil['nama_lengkap'] = $nama_lengkap;
        $detil['type']         = $type;
        $detil['jenis_saldo']  = $jenis_saldo;
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
            if ($d['total_kg'] == null) {
                unset($d['total_kg']);
            }
            if ($d['total_tarik'] == null) {
                unset($d['total_tarik']);
            }
            if ($d['total_pindah'] == null) {
                unset($d['total_pindah']);
            }

            $transaction[] = $d;
        }

        return $transaction;
    }

}
