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
            $queryJmlSampah  = '';
            $queryDetilSetor = "INSERT INTO setor_sampah (id_transaksi,id_sampah,jumlah_kg,jumlah_rp) VALUES";

            foreach ($data['transaksi'] as $t) {
                $idSampah   = $t['id_sampah'];
                $jumlah     = $t['jumlah'];
                $hargaAsli  = $this->db->table('sampah')->select("harga")->where("id",$idSampah)->get()->getResultArray();
                $harga      = (int)$hargaAsli[0]['harga']*(float)$jumlah;
                $totalHarga = $totalHarga+$harga;

                $queryJmlSampah .= "UPDATE sampah SET jumlah=jumlah+$jumlah WHERE id = '$idSampah';";
                $queryDetilSetor.= "('$idtransaksi','$idSampah',$jumlah,$harga),";
            }

            $queryDetilSetor  = rtrim($queryDetilSetor, ",");
            $queryDetilSetor .= ';';

            $this->db->transBegin();
            $this->db->query("INSERT INTO transaksi (id,id_user,jenis_transaksi,date) VALUES('$idtransaksi','$idnasabah','penyetoran sampah',$date);");
            $this->db->query("UPDATE dompet SET uang=uang+$totalHarga WHERE id_user='$idnasabah';");
            $this->db->query($queryJmlSampah);
            $this->db->query($queryDetilSetor);

            $transStatus = $this->db->transStatus();

            if ($transStatus) {
                $this->db->transCommit();
            } 
            else {
                $this->db->transRollback();
            }

            return [
                'status'   => ($transStatus) ? 201   : 500,
                'error'    => ($transStatus) ? false : true,
                'messages' => ($transStatus) ? 'setor sampah is success' : "setor sampah is failed",
            ];
        } 
        catch (Exception $e) {
            $this->db->transRollback();
            return [
                'status'   => 500,
                'error'    => true,
                'messages' => $e->getMessage(),
            ];
        }
    }

    public function getSaldoJenisX(string $idNasabah,string $jenisSaldo): string
    {
        $this->db->transBegin();
        $saldo = $this->db->table('dompet')->select($jenisSaldo)->where('id_user',$idNasabah)->get()->getResultArray();

        if ($this->db->transStatus()) {
            $this->db->transCommit();
            return $saldo[0][$jenisSaldo];
        }
        else {
            $this->db->transRollback();
        }
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
            $this->db->query("INSERT INTO transaksi (id,id_user,jenis_transaksi,date) VALUES('$idtransaksi','$idnasabah','penarikan saldo',$date);");
            $this->db->query("UPDATE dompet SET $jenisSaldo=$jenisSaldo-$jumlahTarik WHERE id_user='$idnasabah';");
            $this->db->query("INSERT INTO tarik_saldo (id_transaksi,jenis_saldo,jumlah_tarik) VALUES('$idtransaksi','$jenisSaldo',$jumlahTarik)");

            $transStatus = $this->db->transStatus();

            if ($transStatus) {
                $this->db->transCommit();
            } 
            else {
                $this->db->transRollback();
            }

            return [
                'status'   => ($transStatus) ? 201   : 500,
                'error'    => ($transStatus) ? false : true,
                'messages' => ($transStatus) ? 'tarik saldo is success' : "tarik saldo is failed",
            ];
        } 
        catch (Exception $e) {
            $this->db->transRollback();
            return [
                'status'   => 500,
                'error'    => true,
                'messages' => $e->getMessage(),
            ];
        }
    }

    public function pindahSaldo(array $data): array
    {
        try {
            $date          = (int)strtotime($data['date']);
            $idnasabah     = $data['idnasabah'];
            $idtransaksi   = $data['idtransaksi'];
            $jumlahPindah  = $data['jumlahPindah'];
            $hasilKonversi = $data['hasilKonversi'];
            $hargaemas     = $data['hargaemas'];
            $asal          = $data['asal'];
            $tujuan        = $data['tujuan'];
            $saldoDompetAsal   = $data['saldo_dompet_asal'];
            $saldoDompetTujuan = $data['saldo_dompet_tujuan'];
            
            $this->db->transBegin();
            $this->db->query("INSERT INTO transaksi (id,id_user,jenis_transaksi,date) VALUES('$idtransaksi','$idnasabah','konversi saldo',$date);");
            $this->db->query("UPDATE dompet SET $asal=$saldoDompetAsal,$tujuan=$saldoDompetTujuan WHERE id_user='$idnasabah';");
            $this->db->query("INSERT INTO pindah_saldo (id_transaksi,jumlah,saldo_tujuan,harga_emas,hasil_konversi) VALUES ('$idtransaksi',$jumlahPindah,'$tujuan',$hargaemas,$hasilKonversi)");
            
            $transStatus = $this->db->transStatus();

            if ($transStatus) {
                $this->db->transCommit();
            } 
            else {
                $this->db->transRollback();
            }

            return [
                'status'   => ($transStatus) ? 201   : 500,
                'error'    => ($transStatus) ? false : true,
                'messages' => ($transStatus) ? 'pindah saldo is success' : "pindah saldo is failed",
            ];
        } 
        catch (Exception $e) {
            $this->db->transRollback();
            return [
                'status'   => 500,
                'error'    => true,
                'messages' => $e->getMessage(),
            ];
        }
    }

    public function jumlahTps(string $idNasabah): int
    {
        $transaction = $this->db->table($this->table)->select('count(id) AS jumlah')->where('id_user',$idNasabah)->where('jenis_transaksi','pindah saldo')->get()->getResultArray();

        return (int)$transaction[0]['jumlah'];
    }

    public function jualSampah(array $data): array
    {
        try {
            $date        = (int)strtotime($data['date']);
            $idtransaksi = $data['idtransaksi'];
            $totalHarga  = 0;
            $queryDetilJual   = "INSERT INTO jual_sampah (id_transaksi,jenis_sampah,jumlah,harga,date) VALUES";
            $queryJumlahSampah = '';

            foreach ($data['transaksi'] as $t) {
                $jenisSmp   = $t['jenis_sampah'];
                $jumlah     = $t['jumlah'];
                $hargaAsli  = $this->db->table('sampah')->select("harga")->where("jenis",$jenisSmp)->get()->getResultArray();
                $harga      = (int)$hargaAsli[0]['harga']*(float)$jumlah;
                $totalHarga = $totalHarga+$harga;

                $queryDetilJual    .= "('$idtransaksi','$jenisSmp',$jumlah,$harga,$date),";
                $queryJumlahSampah .= "UPDATE sampah SET jumlah=jumlah-$jumlah WHERE jenis = '$jenisSmp';";
            }

            $queryDetilJual  = rtrim($queryDetilJual, ",");
            $queryDetilJual .= ';';

            $this->db->transBegin();
            $this->db->query($queryDetilJual);
            $this->db->query($queryJumlahSampah);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return [
                    'success' => false,
                    'message' => "jual sampah is failed",
                    'code'    => 500
                ];
            } 
            else {
                $this->db->transCommit();
                return [
                    "success"  => true,
                    'message' => 'jual sampah is success',
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

    public function getSampahMasuk(array $get,string $idNasabah): array
    {
        try {
            if (isset($get['kategori'])) {

            } 
            else {
                $query  = "SELECT SUM(setor_sampah.jumlah_kg) AS total,kategori_sampah.name AS kategori
                FROM transaksi 
                JOIN setor_sampah    ON(setor_sampah.id_transaksi=transaksi.id)
                JOIN sampah          ON(setor_sampah.id_sampah=sampah.id) 
                JOIN kategori_sampah ON(sampah.id_kategori=kategori_sampah.id)";

                if ($idNasabah != '') {
                    $query .= " WHERE transaksi.id_user = '$idNasabah'";
                }

                $query .= "  GROUP BY kategori_sampah.name";
            }

            $query      .= ";";
            $sampahMasuk = $this->db->query($query)->getResultArray();
            
            if (empty($sampahMasuk)) {    
                return [
                    'status'   => 404,
                    'error'    => true,
                    'messages' => "data notfound",
                ];
            } 
            else {   
                return [
                    'status' => 200,
                    'error'  => true,
                    'data'   => $sampahMasuk
                ];
            }
        } 
        catch (Exception $e) {
            return [
                'status'   => 500,
                'error'    => true,
                'messages' => $e->getMessage(),
            ];
        }
    }

    public function getAllJenisSaldo(string $idNasabah): array
    {   
        try {
            $this->db->transBegin();

            if ($idNasabah != '') {
                $saldo = $this->db->table('dompet')->select('uang,ubs,antam,galery24')->where('id_user',$idNasabah)->get()->getResultArray()[0];
            }
            else {
                $saldo = $this->db->query("SELECT SUM(uang) AS uang,SUM(ubs) AS ubs,SUM(antam) AS antam,SUM(galery24) AS galery24 FROM dompet")->getResultArray()[0];
            }

            if ($this->db->transStatus()) {
                $this->db->transCommit();
                return [
                    'status' => 200,
                    'error'  => false,
                    'data'   => $saldo,
                ];
            }
            else {
                $this->db->transRollback();
            }
        } 
        catch (Exception $e) {
            $this->db->transRollback();
            return [
                'status'   => 500,
                'error'    => true,
                'messages' => $e->getMessage(),
            ];
        }
    }

    public function getData(array $get,string $idNasabah): array
    {
        try {
            if (isset($get['id_transaksi']) && !isset($get['idnasabah'])) {
                $id_transaksi   = $get['id_transaksi'];
                $code_transaksi = substr($get['id_transaksi'],0,3);
                
                if ($code_transaksi == 'TSS') {
                    $transaction  = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.id_user,transaksi.jenis_transaksi,users.nama_lengkap,sampah.jenis,setor_sampah.jumlah_kg,setor_sampah.jumlah_rp,transaksi.date 
                    FROM transaksi 
                    JOIN users        ON (transaksi.id_user = users.id) 
                    JOIN setor_sampah ON (transaksi.id = setor_sampah.id_transaksi) 
                    JOIN sampah       ON (setor_sampah.id_sampah = sampah.id) 
                    WHERE transaksi.id = '$id_transaksi';")->getResultArray();

                    $transaction = $this->makeDetilTransaksi($transaction);
                } 
                else if ($code_transaksi == 'TTS') {
                    $transaction  = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.id_user,transaksi.jenis_transaksi,users.nama_lengkap,tarik_saldo.jenis_saldo,tarik_saldo.jumlah_tarik,transaksi.date 
                    FROM transaksi 
                    JOIN users ON (transaksi.id_user = users.id) 
                    JOIN tarik_saldo ON (transaksi.id = tarik_saldo.id_transaksi) 
                    WHERE transaksi.id = '$id_transaksi';")->getResultArray()[0];
                }
                else if ($code_transaksi == 'TPS') {
                    $transaction  = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.id_user,transaksi.jenis_transaksi,users.nama_lengkap,pindah_saldo.jumlah,pindah_saldo.saldo_tujuan,pindah_saldo.hasil_konversi,pindah_saldo.harga_emas,transaksi.date 
                    FROM transaksi 
                    JOIN users ON (transaksi.id_user = users.id) 
                    JOIN pindah_saldo ON (transaksi.id = pindah_saldo.id_transaksi) 
                    WHERE transaksi.id = '$id_transaksi';")->getResultArray()[0];
                }
                else {
                    $transaction = false;
                }
            } 
            else {
                $query  = 'SELECT transaksi.id AS id_transaksi,transaksi.id_user,transaksi.date,transaksi.jenis_transaksi,
                (SELECT SUM(jumlah_rp) from setor_sampah WHERE setor_sampah.id_transaksi = transaksi.id) AS total_uang_setor,
                (SELECT SUM(jumlah_kg) from setor_sampah WHERE setor_sampah.id_transaksi = transaksi.id) AS total_kg_setor,
                (SELECT SUM(jumlah_tarik) from tarik_saldo WHERE tarik_saldo.id_transaksi = transaksi.id) AS total_tarik,
                (SELECT jenis_saldo from tarik_saldo WHERE tarik_saldo.id_transaksi = transaksi.id) AS jenis_saldo,
                (SELECT SUM(jumlah) from pindah_saldo WHERE pindah_saldo.id_transaksi = transaksi.id) AS total_pindah,
                (SELECT SUM(hasil_konversi) from pindah_saldo WHERE pindah_saldo.id_transaksi = transaksi.id) AS hasil_konversi 
                FROM transaksi';

                if ($idNasabah != '') {
                    $query .= " WHERE transaksi.id_user = '$idNasabah'";
                }

                if (isset($get['start']) && isset($get['end'])) {
                    $start   = (int)strtotime($get['start'].' 01:00');
                    $end     = (int)strtotime($get['end'].' 23:59');
                    // var_dump($start);
                    // var_dump($end);die;

                    $query  .= ($idNasabah != '') ? ' AND' : ' WHERE' ;
                    $query  .= " transaksi.date BETWEEN $start AND $end";
                }

                $query      .= ' ORDER BY transaksi.date ASC;';
                $transaction = $this->db->query($query)->getResultArray();
                $transaction = $this->filterData($transaction);
            } 

            if (empty($transaction)) {    
                return [
                    'status'   => 404,
                    'error'    => true,
                    'messages' => "transaction notfound",
                ];
            } 
            else {   
                return [
                    'status' => 200,
                    'error'  => false,
                    'data'   => $transaction
                ];
            }
        } 
        catch (Exception $e) {
            $this->db->transRollback();
            return [
                'status'   => 500,
                'error'    => true,
                'messages' => $e->getMessage(),
            ];
        }
    }

    public function lastTransaksi(string $limit): array
    {
        try {
            $limit  = (int)$limit;
            $query  = "SELECT transaksi.id AS id_transaksi,nasabah.nama_lengkap,transaksi.type,transaksi.date,transaksi.jenis_saldo,
            (SELECT SUM(harga) from setor_sampah WHERE setor_sampah.id_transaksi = transaksi.id) AS total_setor,
            (SELECT SUM(jumlah) AS total_kg from setor_sampah WHERE setor_sampah.id_transaksi = transaksi.id),
            (SELECT SUM(jumlah) from tarik_saldo WHERE tarik_saldo.id_transaksi = transaksi.id) AS total_tarik,
            (SELECT SUM(jumlah) from pindah_saldo WHERE pindah_saldo.id_transaksi = transaksi.id) AS total_pindah 
            FROM transaksi 
            JOIN nasabah ON (transaksi.id_nasabah = nasabah.id)
            ORDER BY transaksi.date DESC LIMIT $limit;";

            $transaction = $this->db->query($query)->getResultArray();
            $transaction = $this->filterData($transaction);

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
            $id_transaksi   = $d['id_transaksi'];
            $id_user        = $d['id_user'];
            $nama_lengkap   = $d['nama_lengkap'];
            $jenis_transaksi= $d['jenis_transaksi'];
            $date           = $d['date'];
            unset($d['id_transaksi']);
            unset($d['id_user']);
            unset($d['nama_lengkap']);
            unset($d['jenis_transaksi']);
            unset($d['date']);
            $barang[] = $d;
        }

        $detil['id_transaksi']   = $id_transaksi;
        $detil['id_user']        = $id_user;
        $detil['nama_lengkap']   = $nama_lengkap;
        $detil['jenis_transaksi']= $jenis_transaksi;
        $detil['date']           = $date;
        $detil['barang']         = $barang;

        return $detil;
    }

    public function filterData(array $data): array
    {
        $transaction = [];

        foreach ($data as $d) {
            if ($d['total_uang_setor'] == null) {
                unset($d['total_uang_setor']);
            }
            if ($d['total_kg_setor'] == null) {
                unset($d['total_kg_setor']);
            }
            if ($d['total_tarik'] == null) {
                unset($d['total_tarik']);
            }
            if ($d['jenis_saldo'] == null) {
                unset($d['jenis_saldo']);
            }
            if ($d['total_pindah'] == null) {
                unset($d['total_pindah']);
            }
            if ($d['hasil_konversi'] == null) {
                unset($d['hasil_konversi']);
            }

            $transaction[] = $d;
        }

        return $transaction;
    }

    public function rekapData(array $get): array
    {
        try {
            $transaction = [];

            if (isset($get['date'])) {
                $start   = (int)strtotime('01-'.$get['date']);
                $end     = $start+(86400*30);
                
                $dataTss = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.id_nasabah,transaksi.type,transaksi.jenis_saldo,nasabah.nama_lengkap,setor_sampah.jenis_sampah,setor_sampah.jumlah,setor_sampah.harga,transaksi.date 
                FROM transaksi 
                JOIN setor_sampah ON (transaksi.id = setor_sampah.id_transaksi) 
                JOIN nasabah ON (transaksi.id_nasabah = nasabah.id)
                WHERE transaksi.date BETWEEN '$start' AND '$end'
                ORDER BY date ASC;")->getResultArray();

                $dataTps = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.id_nasabah,transaksi.type,transaksi.jenis_saldo,nasabah.nama_lengkap,pindah_saldo.asal,pindah_saldo.jumlah,pindah_saldo.tujuan,pindah_saldo.hasil_konversi,pindah_saldo.harga_emas,transaksi.date 
                FROM transaksi 
                JOIN pindah_saldo ON (transaksi.id = pindah_saldo.id_transaksi) 
                JOIN nasabah ON (transaksi.id_nasabah = nasabah.id)
                WHERE transaksi.date BETWEEN '$start' AND '$end'
                ORDER BY date ASC;")->getResultArray();

                $dataTts = $this->db->query("SELECT transaksi.id AS id_transaksi,transaksi.id_nasabah,transaksi.type,transaksi.jenis_saldo,nasabah.nama_lengkap,tarik_saldo.jenis,tarik_saldo.jumlah,transaksi.date 
                FROM transaksi 
                JOIN tarik_saldo ON (transaksi.id = tarik_saldo.id_transaksi) 
                JOIN nasabah ON (transaksi.id_nasabah = nasabah.id)
                WHERE transaksi.date BETWEEN '$start' AND '$end'
                ORDER BY date ASC;")->getResultArray();

                $dataTjs = $this->db->query("SELECT id_transaksi,jenis_sampah,jumlah,harga,date 
                FROM jual_sampah 
                WHERE date BETWEEN '$start' AND '$end'
                ORDER BY date ASC;")->getResultArray();

                $transaction['date'] = date('F, Y', $start);
                $transaction['tss']  = $dataTss;
                $transaction['tps']  = $dataTps;
                $transaction['tts']  = $dataTts;
                $transaction['tjs']  = $dataTjs;
            } 
            else {
                $query  = "SELECT transaksi.id,transaksi.date,
                (SELECT SUM(jumlah) AS sampah_masuk from setor_sampah WHERE setor_sampah.id_transaksi = transaksi.id),
                (SELECT SUM(harga) AS uang_masuk from setor_sampah WHERE setor_sampah.id_transaksi = transaksi.id),
                (SELECT SUM(jumlah) AS uang_keluar from tarik_saldo WHERE tarik_saldo.id_transaksi = transaksi.id AND jenis = 'uang'),
                (SELECT SUM(jumlah) AS emas_keluar from tarik_saldo WHERE tarik_saldo.id_transaksi = transaksi.id AND jenis != 'uang')
                FROM transaksi";

                $year = null;
                if (isset($get['year'])) {
                    $year   = $get['year'];
                    $start  = (int)strtotime('01-01-'.$get['year']);
                    $end    = $start+(86400*365);
                    $query .= " WHERE transaksi.date BETWEEN '$start' AND '$end'";
                } 

                $query       .= " ORDER BY transaksi.date ASC;";
                $transaction = $this->db->query($query)->getResultArray();
                $transaction = $this->filterRekapData($transaction,$year);
                $transaction = $this->addSampahKeluar($transaction,$year);
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

    public function filterRekapData(array $data,?string $year = null): array
    {
        $transaction = [];

        foreach ($data as $d) {

            $newD = $this->removeNull($d);
            $id_transaksi = substr($newD['id'],0,3);

            if ($id_transaksi != 'TPS') {
                if ($year) {
                    $transaction[strtolower(date('F', $d['date']))][] = $newD;
                } 
                else {
                    $transaction[strtolower(date('F-Y', $d['date']))][] = $newD;
                }
                
            }

        }

        return $this->groupingEachTrans($transaction);
    }

    public function removeNull(array $data): array
    {
        $newData = $data;

        if ($newData['sampah_masuk'] == null) {
            unset($newData['sampah_masuk']);
        }
        if ($newData['uang_masuk'] == null) {
            unset($newData['uang_masuk']);
        }
        if ($newData['uang_keluar'] == null) {
            unset($newData['uang_keluar']);
        }
        if ($newData['emas_keluar'] == null) {
            unset($newData['emas_keluar']);
        }

        return $newData;
    }

    public function groupingEachTrans(array $data): array
    {
        $newData = [];

        foreach ($data as $key => $value) {
            $date1          = '';
            $date2          = '';
            $totSampahMasuk = 0;
            $totUangMasuk   = 0;
            $totUangKeluar  = 0;
            $totEmasKeluar  = 0;
            
            foreach ($value as $v) {
                $date1        = date('m-Y', $v['date']);
                $date2        = date("F, Y", $v['date']);
                $id_transaksi = substr($v['id'],0,3);

                if ($id_transaksi == 'TSS') {
                    $totSampahMasuk = $totSampahMasuk + (float)$v['sampah_masuk'];
                    $totUangMasuk   = $totUangMasuk + (int)$v['uang_masuk'];
                }
                else if ($id_transaksi == 'TTS') {
                    if (isset($v['uang_keluar'])) {
                        $totUangKeluar = $totUangKeluar + (int)$v['uang_keluar'];
                    } 
                    else if (isset($v['emas_keluar'])) {
                        $totEmasKeluar = $totEmasKeluar + (float)$v['emas_keluar'];
                    }
                }
            }

            $newData[$key] = [
                'date1'          => $date1,
                'date2'          => $date2,
                'totSampahMasuk' => $totSampahMasuk,
                'totSampahKeluar'=> 0,
                'totUangMasuk'   => $totUangMasuk,
                'totUangKeluar'  => $totUangKeluar,
                'totEmasKeluar'  => $totEmasKeluar,
            ];
        }

        return $newData;
    }

    public function addSampahKeluar(array $data,?string $year = null)
    {
        $newData = $data;
        $query   = "SELECT id_transaksi,date,SUM(jumlah) AS jumlah FROM jual_sampah";

        if ($year) {
            $start = (int)strtotime('01-01-'.$year);
            $end   = $start+(86400*365);
            $query.= " WHERE date BETWEEN '$start' AND '$end'";
        }

        $query   .= " GROUP BY id_transaksi,date ORDER BY date ASC;";

        $sampahKeluar = $this->db->query($query)->getResultArray();

        $newSampahKeluar1 = []; 
        $newSampahKeluar2 = []; 

        foreach ($sampahKeluar as $sk) {
            if ($year) {
                $newSampahKeluar1[strtolower(date('F', $sk['date']))][] = $sk;
            } 
            else {
                $newSampahKeluar1[strtolower(date('F-Y', $sk['date']))][] = $sk;
            }
        }

        foreach ($newSampahKeluar1 as $key => $sk1) {
            $date      = '';
            $totSampah = 0;
            
            foreach ($sk1 as $s) {
                $date      = $s['date'];
                $totSampah = $totSampah + (float)$s['jumlah'];
            }

            $newSampahKeluar2[$key] = [
                'date'   => $date,
                'jumlah' => $totSampah,
            ];
        }

        foreach ($newSampahKeluar2 as $sk2) {
            if ($year) {
                $newData[strtolower(date('F', $sk2['date']))]['totSampahKeluar'] = $sk2['jumlah'];
            } 
            else {
                $newData[strtolower(date('F-Y', $sk2['date']))]['totSampahKeluar'] = $sk2['jumlah'];
            }
        }
        
        return $newData;
    }

    public function deleteItem(string $id): array
    {
        try {
            $this->db->table($this->table)->where('id', $id)->delete();
            
            if ($this->db->affectedRows() > 0) {
                return [
                    "success"  => true,
                    'message' => "delete transaksi with id $id is success",
                ];
            } 
            else {   
                return [
                    'success' => false,
                    'message' => "transaksi with id '$id' is not found",
                    'code'    => 404
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
