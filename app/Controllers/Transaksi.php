<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    public $transaksiModel;

	public function __construct()
    {
        $this->transaksiModel = new TransaksiModel;
    }

    public function cetakTransaksi(string $id)
    {
        $token     = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result    = $this->checkToken($token, false);
        $privilege = (isset($result['data']['privilege'])) ? $result['data']['privilege'] : null;

        if ($token == null || $result['success'] == false || !in_array($privilege,['nasabah','admin','superadmin'])) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        }

        $transaksiModel = new TransaksiModel;
        $dbresponse     = $transaksiModel->getData(['id_transaksi' => $id],'');
        
        if ($dbresponse['error'] == true) {
            return redirect()->to(base_url().'/login');
        }
        
        $mpdf           = new \Mpdf\Mpdf();
        $jenisTransaksi = $dbresponse['data']['jenis_transaksi'];
        
        if ($jenisTransaksi == 'penarikan saldo') {
            $jenisSaldo = ($dbresponse['data']['jenis_saldo'] == 'uang')? 'uang' : 'emas '.$dbresponse['data']['jenis_saldo'];
            $jumlah     = ($jenisSaldo == 'uang')? 'Rp '.number_format($dbresponse['data']['jumlah_tarik'] , 0, ',', ',') : round((float)$dbresponse['data']['jumlah_tarik'], 6).' gram';

            $result = "<div style='padding: 20px;width: 100%;background-color: rgb(131, 146, 171);border-radius: 6px;'>
                <table>
                    <tr>
                        <td style='font-family: sans;'>
                            <h4>Jenis saldo&nbsp;</h4>
                        </td>
                        <td style='font-family: sans;'>
                            <h4>
                            : &nbsp;&nbsp;$jenisSaldo
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td style='font-family: sans;'>
                            <h4>Jumlah</h4>
                        </td>
                        <td style='font-family: sans;'>
                            <h4>: &nbsp;&nbsp;$jumlah</h4>
                        </td>
                    </tr>
                </table>
            </div>";
        } 
        if ($jenisTransaksi == 'konversi saldo') {
            $result = "<div style='padding: 20px;width: 100%;background-color: rgb(131, 146, 171);border-radius: 6px;'>
                <table>
                    <tr>
                        <td style='font-size: 2em;font-family: sans;'>
                            Jumlah&nbsp;&nbsp;&nbsp;
                        </td>
                        <td style='font-size: 2em;font-family: sans;'>
                            : Rp ".number_format($dbresponse['data']['jumlah'] , 0, ',', ',')."
                        </td>
                    </tr>
                    <tr>
                        <td style='font-size: 2em;font-family: sans;'>
                            Harga emas&nbsp;&nbsp;&nbsp;
                        </td>
                        <td style='font-size: 2em;font-family: sans;'>
                            : Rp ".number_format($dbresponse['data']['harga_emas'] , 0, ',', ',')."
                        </td>
                    </tr>
                    <tr>
                        <td style='font-size: 2em;font-family: sans;'>
                            Hasil konversi&nbsp;&nbsp;&nbsp;
                        </td>
                        <td style='font-size: 2em;font-family: sans;'>
                            : ".round((float)$dbresponse['data']['hasil_konversi'], 6)." gram
                        </td>
                    </tr>
                </table>
            </div>";
        }
        if (in_array($jenisTransaksi,['penyetoran sampah','penjualan sampah'])) {
            $barang = $dbresponse['data']['barang'];
            $trBody = "";
            $no     = 1;
            $totalRp= 0;

            foreach ($barang as $key) {
                $totalRp += $key['jumlah_rp'];
                $bg       = ($no % 2 == 0) ? "style='background: rgb(230, 230, 230);'" : "style='background: rgb(255, 255, 255);'";

                $trBody .= "<tr $bg>
                    <td style='font-family: sans;text-align: center;'>
                        ".$no++."
                    </td>
                    <td style='font-family: sans;text-align: center;'>
                        ".$key['jenis']."
                    </td>
                    <td style='font-family: sans;text-align: center;'>
                        ".round($key['jumlah_kg'],2)."
                    </td>
                    <td style='font-family: sans;text-align: right;'>
                        Rp ".number_format($key['jumlah_rp'] , 0, ',', ',')."
                    </td>
                </tr>";
            }
            
            $result = "<table border='0' width='100%' cellpadding='5'>
                <thead>
                    <tr>
                        <th style='border: 1px solid black;font-family: sans;'>
                            #
                        </th>
                        <th style='border: 1px solid black;font-family: sans;'>
                            Jenis sampah
                        </th>
                        <th style='border: 1px solid black;font-family: sans;'>
                            Kg
                        </th>
                        <th style='border: 1px solid black;font-family: sans;'>
                            Harga
                        </th>
                    </tr>
                <thead>
                <tbody>
                    $trBody
                    <tr style='background: rgb(230, 230, 230);'>
                        <th style='font-family: sans;text-align: right;' colspan='3'>
                            Total :
                        </th>
                        <td style='font-family: sans;text-align: right;'>
                            Rp ".number_format($totalRp , 0, ',', ',')."
                        </td>
                    </tr>
                </tbody>
            </table>";
        }

        $userType = ($jenisTransaksi == 'penjualan sampah')? 'ID.ADMIN' : 'ID.NASABAH';

        $mpdf->WriteHTML("
        <!DOCTYPE html>
        <html lang='en'>
        
        <head>
            <meta charset='utf-8'>
            <title>bsbl | cetak transaksi</title>
        </head>
        
        <body>
            <div style='border-bottom: 2px solid black;padding-bottom: 20px;'>
                <table border='0' width='100%'>
                   <tr>
                        <th style='text-align: left;'>
                            <img src='".base_url()."/assets/images/banksampah-logo.png' style='width: 100px;'>
                        </th>
                        <th style='text-align: right;font-size: 2em;'>
                            BUKTI TRANSAKSI
                        </th>
                    </tr>';
                </table>
            </div>

            <div style='padding-top: 30px;'>
                <table>
                    <tr>
                        <td style='font-size: 1.4em;font-family: sans;'>
                            TANGGAL&nbsp;&nbsp;&nbsp;
                        </td>
                        <td style='font-size: 1.4em;font-family: sans;'>
                            : ".date("d/m/Y h:i A",$dbresponse['data']['date'])."
                        </td>
                    </tr>
                    <tr>
                        <td style='font-size: 1.4em;font-family: sans;'>
                            NAMA&nbsp;&nbsp;&nbsp;
                        </td>
                        <td style='font-size: 1.4em;font-family: sans;text-transform: uppercase;'>
                            : ".$dbresponse['data']['nama_lengkap']."
                        </td>
                    </tr>
                    <tr>
                        <td style='font-size: 1.4em;font-family: sans;'>
                            $userType&nbsp;&nbsp;&nbsp;
                        </td>
                        <td style='font-size: 1.4em;font-family: sans;'>
                            : ".$dbresponse['data']['id_user']."
                        </td>
                    </tr>
                    <tr>
                        <td style='font-size: 1.4em;font-family: sans;'>
                            ID.TRANSAKSI&nbsp;&nbsp;&nbsp;
                        </td>
                        <td style='font-size: 1.4em;font-family: sans;'>
                            : ".$dbresponse['data']['id_transaksi']."
                        </td>
                    </tr>
                </table>
            </div>

            <h1 style='font-style: italic;margin-top: 40px;margin-bottom: 20px;font-family: sans;'>
                ".$jenisTransaksi."
            </h1>

            ".$result."
        </body>
        
        </html>");

        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('transaksi#'.$id.".pdf", 'I');
    }

    public function cetakRekap()
    {
        $token     = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result    = $this->checkToken($token, false);
        $privilege = (isset($result['data']['privilege'])) ? $result['data']['privilege'] : null;

        if ($token == null || $result['success'] == false || !in_array($privilege,['superadmin','admin'])) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        }
        
        $transaksiModel = new TransaksiModel;
        $get            = [];
        $headDate       = '';
        $headWilayah    = '';
        $detilNasabah   = '';
        $stringDate     = '';
        $stringWilayah  = '';
        $filterWilayah  = false;
        $isRekapNasabah = false;

        if ($this->request->getGet()) {
            $filterWilayah = ($this->request->getGet('provinsi')) ? true : false;
            $isRekapNasabah= ($this->request->getGet('idnasabah'))? true : false;

            foreach ($this->request->getGet() as $key => $value) {
                $get[$key] = $value;

                if (!in_array($key,['date','start','end'])) {
                    $headWilayah .= ucfirst($value).', ';
                }
            }

            $stringWilayah = preg_replace('/, | /i', '-', $headWilayah);
            $headWilayah   = "<p style='font-size: 1.1em;font-family: sans;margin-top: 6px;text-align: right;'>
                ".trim($headWilayah,', ')."
            </p>";
        }
        else {
            return redirect()->to(base_url().'/admin/transaksi');
        }

        $dbresponse = $transaksiModel->rekapData($get);
        $data       = $dbresponse['data'];

        if (isset($get['date'])) {
            $stringDate = $get['date'];

            $headDate   = "<span  style='font-size: 1em;font-family: sans;'>
                ".$data['date']."
            </span>";
        } 
        else if (isset($get['start']) && isset($get['end'])) {
            $stringDate = date("d/F/Y", strtotime($get['start'].' 01:00'))."-".date("d/F/Y", strtotime($get['end'].' 23:59'));

            $headDate   = "<span  style='font-size: 1em;font-family: sans;'>
                ".date("d/F/Y", strtotime($get['start'].' 01:00'))." - ".date("d/F/Y", strtotime($get['end'].' 23:59'))."
            </span>";
        }
        
        if (isset($get['idnasabah'])) {
            if (count($data['nasabah']) == 0) {
               return redirect()->to(base_url().'/admin/listnasabah');
            } 
            else {
                $headWilayah  = '';
                $nasabah      = $data['nasabah'][0];
                $detilNasabah = "<table style='font-size: 1.1em;font-family: sans;margin-top: 10px;'>
                    <tr>
                        <td>Nama lengkap&nbsp;</td>
                        <td style='text-transform:capitalize'>:&nbsp;&nbsp;".$nasabah['nama_lengkap']."</td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>:&nbsp;&nbsp;".$nasabah['username']."</td>
                    </tr>
                    <tr>
                        <td>ID nasabah</td>
                        <td>:&nbsp;&nbsp;".$nasabah['id']."</td>
                    </tr>
                </table>";
            }
        }
        // dd(count($data['nasabah']));

        // setor sampah
        $tss   = $data['tss'];
        $trTss = "";
        $noTss = 1;
        $totKgSetor   = 0;
        $totUangSetor = 0;

        foreach ($tss as $key) {
            $totKgSetor   = $totKgSetor+(float)$key['jumlah_kg'];
            $totUangSetor = $totUangSetor+(int)$key['jumlah_rp'];

            $bg     = ($noTss % 2 == 0) ? "style='background: rgb(230, 230, 230);'" : "style='background: rgb(255, 255, 255);'";

            $trTss .= "<tr $bg>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$noTss++."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".date("d/m/Y", $key['date'])."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$key['id_transaksi']."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$key['nama_lengkap']."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$key['jenis_sampah']."
                </td>
                <td style='font-size: 0.7em;font-family: sans;text-align: right;'>
                    ".round((float)$key['jumlah_kg'],2)."
                </td>
                <td style='font-size: 0.7em;font-family: sans;text-align: right;'>
                    ".number_format($key['jumlah_rp'] , 0, ',', ',')."
                </td>
            </tr>";
        }

        $trTss .= "<tr style='background: rgb(230, 230, 230);'>
            <th colspan='5' style='text-align: center;font-size: 0.8em;font-family: sans;'>
                total
            </th>
            <th style='text-align: left;font-size: 0.8em;font-family: sans;text-align: right;'>
                ".$totKgSetor."
            </th>
            <th style='text-align: left;font-size: 0.8em;font-family: sans;text-align: right;'>
                ".number_format($totUangSetor , 0, ',', ',')."
            </th>
        </tr>";

        // jual sampah
        $tjs   = $data['tjs'];
        $trTjs = "";
        $noTjs = 1;
        $totKgjual   = 0;
        $totUangJual = 0;

        foreach ($tjs as $key) {
            $totKgjual   = $totKgjual+(float)$key['jumlah_kg'];
            $totUangJual = $totUangJual+(int)$key['jumlah_rp'];

            $bg     = ($noTjs % 2 == 0) ? "style='background: rgb(230, 230, 230);'" : "style='background: rgb(255, 255, 255);'";

            $trTjs .= "<tr $bg>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$noTjs++."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".date("d/m/Y", $key['date'])."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$key['id_transaksi']."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$key['jenis_sampah']."
                </td>
                <td style='font-size: 0.7em;font-family: sans;text-align: right;'>
                    ".round((float)$key['jumlah_kg'],2)."
                </td>
                <td style='font-size: 0.7em;font-family: sans;text-align: right;'>
                    ".number_format($key['jumlah_rp'] , 0, ',', ',')."
                </td>
            </tr>";
        }

        $trTjs .= "<tr style='background: rgb(230, 230, 230);'>
            <th colspan='4' style='text-align: center;font-size: 0.8em;font-family: sans;'>
                total
            </th>
            <th style='text-align: left;font-size: 0.8em;font-family: sans;text-align: right;'>
                ".$totKgjual."
            </th>
            <th style='text-align: left;font-size: 0.8em;font-family: sans;text-align: right;'>
                ".number_format($totUangJual , 0, ',', ',')."
            </th>
        </tr>";

        $elTransaksiJualS = "<table border='0' width='100%' cellpadding='5'>
            <caption style='text-align:left;font-family:sans;caption-side:top;margin-top:40px;margin-bottom:10px;font-size: 1em;'>
                4. Penjualan Sampah (ke banksampah induk)
            </caption>
            <thead>
                <tr style='font-size: 0.8em;'>
                    <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>#</th>
                    <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Tanggal</th>
                    <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>ID Transaksi</th>
                    <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Jenis sampah</th>
                    <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Kg</th>
                    <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Harga(Rp)</th>
                </tr>
            <thead>
            <tbody>
                ".$trTjs."
            </tbody>
        </table>";

        if ($filterWilayah) {
            $elTransaksiJualS = '';
        }
        
        // koonversi saldo
        $tps   = $data['tps'];
        $trTps = "";
        $noTps = 1;
        $totKgPindah   = 0;
        $totUangPindah = 0;

        foreach ($tps as $key) {
            $totKgPindah   = $totKgPindah+(float)$key['hasil_konversi'];
            $totUangPindah = $totUangPindah+(int)$key['jumlah'];

            $bg     = ($noTps % 2 == 0) ? "style='background: rgb(230, 230, 230);'" : "style='background: rgb(255, 255, 255);'";

            $trTps .= "<tr $bg>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$noTps++."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".date("d/m/Y", $key['date'])."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$key['id_transaksi']."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$key['nama_lengkap']."
                </td>
                <td style='font-size: 0.7em;font-family: sans;text-align: center;'>
                    ".number_format($key['harga_emas'] , 0, ',', ',')."
                </td>
                <td style='font-size: 0.7em;font-family: sans;text-align: right;'>
                    ".number_format($key['jumlah'] , 0, ',', ',')."
                </td>
                <td style='font-size: 0.7em;font-family: sans;text-align: right;'>
                    ".round((float)$key['hasil_konversi'],6). "
                </td>
            </tr>";
        }

        $trTps .= "<tr style='background: rgb(230, 230, 230);'>
            <th colspan='5' style='text-align: center;font-size: 0.8em;font-family: sans;'>
                total
            </th>
            <th style='text-align: left;font-size: 0.8em;font-family: sans;text-align: right;'>
                ".number_format($totUangPindah , 0, ',', ',')."
            </th>
            <th style='text-align: left;font-size: 0.8em;font-family: sans;text-align: right;'>
                ".round((float)$totKgPindah,6)."
            </th>
        </tr>";
        
        // tarik saldo
        $tts   = $data['tts'];
        $trTts = "";
        $noTts = 1;
        $totKgTarik   = 0;
        $totUangTarik = 0;

        foreach ($tts as $key) {
            $uang     = ($key['jenis_saldo'] == 'uang')     ? $key['jumlah_tarik'] : 0;
            $antam    = ($key['jenis_saldo'] == 'antam')    ? $key['jumlah_tarik'] : 0;
            $ubs      = ($key['jenis_saldo'] == 'ubs')      ? $key['jumlah_tarik'] : 0;
            $galery24 = ($key['jenis_saldo'] == 'galery24') ? $key['jumlah_tarik'] : 0;

            if ($uang == 0) {
                $totKgTarik   = $totKgTarik+(float)$key['jumlah_tarik'];
            } 
            else {
                $totUangTarik = $totUangTarik+(int)$key['jumlah_tarik'];
            }

            $bg     = ($noTts % 2 == 0) ? "style='background: rgb(230, 230, 230);'" : "style='background: rgb(255, 255, 255);'";

            $trTts .= "<tr $bg>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$noTts++."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".date("d/m/Y", $key['date'])."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$key['id_transaksi']."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$key['nama_lengkap']."
                </td>
                <td style='font-size: 0.7em;font-family: sans;text-align: right;'>
                    ".number_format((int)$uang , 0, ',', ',')."
                </td>
                <td style='font-size: 0.7em;font-family: sans;text-align: right;'>
                    ".round((float)$antam,6)."
                </td>
                <td style='font-size: 0.7em;font-family: sans;text-align: right;'>
                    ".round((float)$ubs,6)."
                </td>
                <td style='font-size: 0.7em;font-family: sans;text-align: right;'>
                    ".round((float)$galery24,6)."
                </td>
            </tr>";
        }

        $trTts .= "<tr style='background: rgb(230, 230, 230);'>
            <th colspan='4' style='text-align: center;font-size: 0.8em;font-family: sans;'>
                total
            </th>
            <th style='text-align: left;font-size: 0.8em;font-family: sans;text-align: right;'>
                ".number_format($totUangTarik , 0, ',', ',')."
            </th>
            <th colspan='3' style='text-align: center;font-size: 0.8em;font-family: sans;text-align: right;'>
                ".round((float)$totKgTarik,6)."
            </th>
        </tr>";  

        $mpdf = new \Mpdf\Mpdf();
        
        $mpdf->WriteHTML("
        <!DOCTYPE html>
        <html lang='en'>
        
        <head>
            <meta charset='utf-8'>
            <title>bsbl | rekap transaksi</title>
        </head>
        
        <body>
            <div style='border-bottom: 2px solid black;padding-bottom: 20px;'>
                <table border='0' width='100%'>
                   <tr>
                        <th style='text-align: left;'>
                            <img src='".base_url()."/assets/images/banksampah-logo.png' style='width: 100px;'>
                        </th>
                        <th style='text-align: right;'>
                            <h1  style='font-size: 2em;'>
                                REKAP TRANSAKSI
                            </h1>
                            $headDate
                        </th>
                    </tr>';
                </table>
            </div>

            $headWilayah
            $detilNasabah

            <table border='0' width='100%' cellpadding='5'>
                <caption style='text-align:left;font-family:sans;caption-side:top;margin-top:40px;margin-bottom:10px;font-size: 1em;'>
                    1. Penyetoran Sampah
                </caption>
                <thead>
                    <tr style='font-size: 0.8em;'>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>#</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Tanggal</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>ID Transaksi</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Nama Nasabah</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Jenis sampah</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Jumlah(Kg)</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Harga(Rp)</th>
                    </tr>
                <thead>
                <tbody>
                    $trTss
                </tbody>
            </table>

            <table border='0' width='100%' cellpadding='5'>
                <caption style='text-align:left;font-family:sans;caption-side:top;margin-top:40px;margin-bottom:10px;font-size: 1em;'>
                    2. Konversi Saldo
                </caption>
                <thead>
                    <tr>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>#</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Tanggal</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>ID Transaksi</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Nama Nasabah</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Harga Emas(Rp)</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Jumlah(Rp)</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Hasil Konversi(g)</th>
                    </tr>
                <thead>
                <tbody>
                    $trTps
                </tbody>
            </table>

            <table border='0' width='100%' cellpadding='5'>
                <caption style='text-align:left;font-family:sans;caption-side:top;margin-top:40px;margin-bottom:10px;font-size: 1em;'>
                    3. Penarikan Saldo
                </caption>
                <thead>
                    <tr>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>#</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Tanggal</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>ID Transaksi</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Nama Nasabah</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Uang(Rp)</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Antam(g)</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Ubs(g)</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Galery24(g)</th>
                    </tr>
                <thead>
                <tbody>
                    $trTts
                </tbody>
            </table>

            $elTransaksiJualS

        </body>
        
        </html>");

        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('rekap-transaksi#'.$stringDate."#".trim($stringWilayah,'-').".pdf", 'I');
    }

    /**
     * Setor sampah
     *   url    : domain.com/transaksi/setorsampah
     *   method : POST
     */
    public function setorSampah()
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $data   = $this->request->getPost();
        $this->validation->run($data,'setorSampah1');
        $errors = $this->validation->getErrors();

        if($errors) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => $errors,
            ];
    
            return $this->respond($response,400);
        } 
        else {
            foreach ($data['transaksi'] as $t) {
                $this->validation->run($t,'setorSampah2');
                $errors = $this->validation->getErrors();
    
                if($errors) {
                    $response = [
                        'status'   => 400,
                        'error'    => true,
                        'messages' => $errors,
                    ];
            
                    return $this->respond($response,400);
                } 
            }

            $data['idtransaksi'] = 'TSS'.$this->generateOTP(9);
            $dbresponse          = $this->transaksiModel->setorSampah($data);

            return $this->respond($dbresponse,$dbresponse['status']);
        }
    }

    /**
     * Tarik saldo
     *   url    : domain.com/transaksi/tariksaldo
     *   method : POST
     */
    public function tarikSaldo()
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $data   = $this->request->getPost();
        $this->validation->run($data,'tarikSaldo');
        $errors = $this->validation->getErrors();

        if($errors) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => $errors,
            ];
    
            return $this->respond($response,400);
        } 
        else {
            $valid  = true;
            $msg    = '';
            $saldoX = $this->transaksiModel->getSaldoJenisX($data['id_nasabah'],$data['jenis_saldo']);

            if ((float)$saldoX < (float)$data['jumlah']) {
                $valid      = false;
                $jenisSaldo = ($data['jenis_saldo'] == 'uang') ? 'uang' : 'emas';
                
                $msg   = [
                    'jumlah' => 'saldo '.$jenisSaldo.' anda tidak cukup'
                ];
            }
            else {
                if ($data['jenis_saldo'] !== 'uang') {
                    if ((float)$saldoX-(float)$data['jumlah'] < 0.1) {
                        $valid = false;
                        $msg   = [
                            'jumlah' => 'minimal saldo yang mengendap adalah 0.1 gram',
                            'saldo'  => (float)$saldoX, 
                            'tarik'  => (float)$data['jumlah'],
                            'hasil'  => (float)$saldoX-(float)$data['jumlah']
                        ];
                    }
                }
            }
            
            if (!$valid) {
                $response = [
                    'status'   => 400,
                    'error'    => true,
                    'messages' => $msg,
                ];
        
                return $this->respond($response,400);
            }

            $data['idtransaksi'] = 'TTS'.$this->generateOTP(9);
            $dbresponse          = $this->transaksiModel->tarikSaldo($data);

            return $this->respond($dbresponse,$dbresponse['status']);
        }
    }

    /**
     * Pindah saldo
     *   url    : domain.com/transaksi/pindahsaldo
     *   method : POST
     */
    public function pindahSaldo(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $data   = $this->request->getPost();
        $this->validation->run($data,'pindahSaldo');
        $errors = $this->validation->getErrors();

        if ($errors) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => $errors,
            ];
    
            return $this->respond($response,400);
        } 
        else {
            $valid  = true;
            $msg    = '';
            $jumlahPindah    = (float)$data['jumlah'];
            $jumlahSaldoAsal = (float)$this->transaksiModel->getSaldoJenisX($data['id_nasabah'],'uang');

            if ($jumlahSaldoAsal < $jumlahPindah ) {
                $valid = false;
                $msg   = [
                    'jumlah' => 'saldo uang tidak cukup',
                ];
            }
            else {
                $jumlahTps = $this->transaksiModel->JumlahTps($data['id_nasabah']);

                if ($jumlahTps == 0) {
                    if ((float)$data['jumlah'] < 50000) {
                        $valid = false;
                        $msg   = [
                            'jumlah' => 'minimal pindah pada transaksi pertama adalah Rp50.000'
                        ];
                    }
                } 
                else {
                    if ((float)$data['jumlah'] < 10000) {
                        $valid = false;
                        $msg   = [
                            'jumlah' => 'minimal pindah Rp10.000'
                        ];
                    }
                }
            }

            if (!$valid) {
                $response = [
                    'status'   => 400,
                    'error'    => true,
                    'messages' => $msg,
                ];
        
                return $this->respond($response,400);
            }

            $newdata = [
                'idnasabah'     => $data['id_nasabah'],
                'date'          => $data['date'],
                'idtransaksi'   => 'TPS'.$this->generateOTP(9),
                'jumlahPindah'  => $jumlahPindah,
                'hasilKonversi' => (float)$data['jumlah']/$data['harga_emas'],
                'hargaemas'     => $data['harga_emas'],
                'saldo_dompet_asal' => $jumlahSaldoAsal-$jumlahPindah,
            ];
            
            $dbresponse = $this->transaksiModel->pindahSaldo($newdata);
            
            return $this->respond($dbresponse,$dbresponse['status']);
        }
    }

    public function getHargaEmas(): float
    {
        $output = $this->curlGetData("https://www.goldapi.io/api/XAU/USD/",array('Content-Type:application/json','x-access-token:goldapi-s79zgtkugd4m5s-io'));

        return round(((float)$output['price']/31.1)*$this->getHargaDolar());
    }

    public function getHargaDolar(): float
    {
        $output = $this->curlGetData("https://free.currconv.com/api/v7/convert?q=USD_IDR&compact=ultra&apiKey=c94ee0cbe358dc63dce9",array('Content-Type:application/json'));

        return round((float)$output['USD_IDR']);
    }

    /**
     * Jual sampah
     *   url    : domain.com/transaksi/jualsampah
     *   method : POST
     */
    public function jualSampah()
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $data  = $this->request->getPost();

        $this->validation->run($data,'jualSampah');
        $errors = $this->validation->getErrors();

        if($errors) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => $errors,
            ];
    
            return $this->respond($response,400);
        } 
        else {
            foreach ($data['transaksi'] as $t) {
                $this->validation->run($t,'setorSampah2');
                $errors = $this->validation->getErrors();
    
                if($errors) {
                    $response = [
                        'status'   => 400,
                        'error'    => true,
                        'messages' => $errors,
                    ];
            
                    return $this->respond($response,400);
                } 
            }

            $data['idtransaksi'] = 'TJS'.$this->generateOTP(9);
            $dbresponse          = $this->transaksiModel->jualSampah($data);

            return $this->respond($dbresponse,$dbresponse['status']);
        }
    }

    /**
     * Get data transaction
     *   url    : domain.com/transaksi/sampahmasuk
     *   method : GET
     */
    public function getSampahMasuk()
    {
        $isAdmin   = false;
        $idNasabah = '';

        if ($this->request->getHeader('token')) {
            $result     = $this->checkToken();
            $isAdmin    = (in_array($result['data']['privilege'],['admin','superadmin'])) ? true : false ;
            $idNasabah  = ($isAdmin==false) ? $result['data']['userid'] : '' ;
        }

        if ($isAdmin) {
            if ($this->request->getGet('idnasabah')) {
                $idNasabah = $this->request->getGet('idnasabah');
            }
        }

        $dbresponse = $this->transaksiModel->getSampahMasuk($this->request->getGet(),$idNasabah);

        return $this->respond($dbresponse,$dbresponse['status']);
    }

    /**
     * Get data transaction
     *   url    : domain.com/transaksi/getsaldo
     *   method : GET
     */
    public function getSaldo()
    {
        $result     = $this->checkToken();
        $isAdmin    = (in_array($result['data']['privilege'],['admin','superadmin'])) ? true : false ;
        $idNasabah  = ($isAdmin==false) ? $result['data']['userid'] : '' ;

        if ($isAdmin) {
            if ($this->request->getGet('idnasabah')) {
                $idNasabah = $this->request->getGet('idnasabah');
            }
        }

        $dbresponse = $this->transaksiModel->getAllJenisSaldo($idNasabah);

        return $this->respond($dbresponse,$dbresponse['status']);
    }

    /**
     * Get data transaction
     *   url    : domain.com/transaksi/getdata
     *   method : GET
     */
    public function getData()
    {
        $result    = $this->checkToken();
        $isAdmin   = (in_array($result['data']['privilege'],['admin','superadmin'])) ? true : false ;
        $idNasabah = ($isAdmin==false) ? $result['data']['userid'] : '' ;

        if ($this->request->getGet('start') && $this->request->getGet('end')) {
            $this->validation->run($this->request->getGet(),'dateForFilterTransaksi');
            $errors = $this->validation->getErrors();

            if($errors) {
                $response = [
                    'status'   => 400,
                    'error'    => true,
                    'messages' => $errors,
                ];
        
                return $this->respond($response,400);
            } 
        }

        if ($isAdmin) {
            if ($this->request->getGet('idnasabah')) {
                $idNasabah = $this->request->getGet('idnasabah');
            }
        }

        $dbresponse = $this->transaksiModel->getData($this->request->getGet(),$idNasabah);

        return $this->respond($dbresponse,$dbresponse['status']);
    }

    /**
     * Get data transaction
     *   url    : domain.com/transaksi/rekapdata
     *   method : GET
     */
    public function rekapData()
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $errors = null;
        if ($this->request->getGet('year')) {
            $this->validation->run($this->request->getGet(),'rekapDataYear');
            $errors = $this->validation->getErrors();

        }
        if ($this->request->getGet('date')) {
            $this->validation->run($this->request->getGet(),'rekapDataDate');
            $errors = $this->validation->getErrors();

        }

        if($errors) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => $errors,
            ];
    
            return $this->respond($response,400);
        } 
        
        $dbresponse = $this->transaksiModel->rekapData($this->request->getGet());

        return $this->respond($dbresponse,$dbresponse['status']);
    }

    /**
     * Get data transaction
     *   url    : domain.com/transaksi/grafikssampah
     *   method : GET
     */
    public function grafikSetorSampah()
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $errors = null;
        if ($this->request->getGet('year')) {
            $this->validation->run($this->request->getGet(),'rekapDataYear');
            $errors = $this->validation->getErrors();
        }

        if($errors) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => $errors,
            ];
    
            return $this->respond($response,400);
        } 

        if (isset($_GET['tampilan']) && $_GET['tampilan']=='per-daerah') {
            $dbresponse = $this->transaksiModel->grafikSetorSampahPerdaerah($this->request->getGet());
        }
        else{
            $dbresponse = $this->transaksiModel->grafikSetorSampahPerbulan($this->request->getGet());
        } 

        return $this->respond($dbresponse,$dbresponse['status']);
    }

    /**
     * Delete transaksi
     *   url    : domain.com/transaksi/deletedata?id=:id
     *   method : DELETE
     */
	public function deleteData(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $this->validation->run($this->request->getGet(),'deleteTransaksi');
        $errors = $this->validation->getErrors();

        if($errors) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => $errors,
            ];
    
            return $this->respond($response,400);
        } 

        $dbresponse = $this->transaksiModel->deleteData($this->request->getGet('id'));
        return $this->respond($dbresponse,$dbresponse['status']);
    }
}
