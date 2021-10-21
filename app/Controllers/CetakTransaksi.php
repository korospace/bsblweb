<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Controllers\BaseController;

class CetakTransaksi extends BaseController
{
    public function index(string $id)
    {
        $token  = $_COOKIE['token'];
        $result = $this->checkToken($token);

        if ($token == null || $result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        }

        $transaksiModel = new TransaksiModel;
        $dbresponse     = $transaksiModel->getData(['id_transaksi' => $id]);
        
        if ($dbresponse['success'] == false) {
            return redirect()->to(base_url().'/login');
        }
        
        $mpdf = new \Mpdf\Mpdf();
        $type = ($dbresponse['data']['type'] == 'setor')? $dbresponse['data']['type'].' sampah' : $dbresponse['data']['type'].' saldo';
        
        if ($dbresponse['data']['type'] == 'tarik') {
            $jumlah = ($dbresponse['data']['jenis_saldo'] == 'uang')? 'Rp '.number_format($dbresponse['data']['jumlah'] , 0, ',', '.') : $dbresponse['data']['jumlah'].' gram';
            $result = "<div style='padding: 20px;width: 100%;background-color: rgb(131, 146, 171);border-radius: 6px;'>
                <h1 style='font-size: 2.5em;'><b>Jumlah</b> : ${jumlah}</h1>
            </div>";
        } 
        else if ($dbresponse['data']['type'] == 'pindah') {
            $jumlah = ($dbresponse['data']['jenis_saldo'] == 'uang')? 'Rp '.number_format($dbresponse['data']['jumlah'] , 0, ',', '.') : $dbresponse['data']['jumlah'].' gram';
            $hasilKonversi = ($dbresponse['data']['asal'] == 'uang')? $dbresponse['data']['hasil_konversi'].' gram' : 'Rp '.number_format($dbresponse['data']['hasil_konversi'] , 0, ',', '.');

            $result = "<div style='padding: 20px;width: 100%;background-color: rgb(131, 146, 171);border-radius: 6px;'>
                <table>
                    <tr>
                        <td style='font-size: 2em;'>Saldo asal&nbsp;&nbsp;&nbsp;</td>
                        <td style='font-size: 2em;'>
                            : ".$dbresponse['data']['asal']."
                        </td>
                    </tr>
                    <tr>
                        <td style='font-size: 2em;'>Saldo tujuan&nbsp;&nbsp;&nbsp;</td>
                        <td style='font-size: 2em;text-transform: uppercase;'>
                            : ".  $dbresponse['data']['tujuan']."
                        </td>
                    </tr>
                    <tr>
                        <td style='font-size: 2em;'>Jumlah&nbsp;&nbsp;&nbsp;</td>
                        <td style='font-size: 2em;'>
                            : ".$jumlah."
                        </td>
                    </tr>
                    <tr>
                        <td style='font-size: 2em;'>Harga emas&nbsp;&nbsp;&nbsp;</td>
                        <td style='font-size: 2em;'>
                            : Rp ".number_format($dbresponse['data']['harga_emas'] , 0, ',', '.')."
                        </td>
                    </tr>
                    <tr>
                        <td style='font-size: 2em;'>Hasil konversi&nbsp;&nbsp;&nbsp;</td>
                        <td style='font-size: 2em;'>
                            : ".$hasilKonversi."
                        </td>
                    </tr>
                </table>
            </div>";
        }
        else {
            $barang = $dbresponse['data']['barang'];
            $trBody = "";
            $no     = 1;

            foreach ($barang as $key) {
                $bg     = ($no % 2 == 0) ? "style='background: rgb(230, 230, 230);'" : "style='background: rgb(255, 255, 255);'";

                $trBody .= "<tr $bg>
                    <th>".$no++."</th>
                    <th>".$key['jenis']."</th>
                    <th>".$key['jumlah']."</th>
                    <th>Rp ".number_format($key['harga'] , 0, ',', '.')."</th>
                </tr>";
            }
            
            $result = "<table border='0' width='100%' cellpadding='5'>
                <thead>
                    <tr>
                        <th style='border: 1px solid black;'>#</th>
                        <th style='border: 1px solid black;'>Jenis sampah</th>
                        <th style='border: 1px solid black;'>Kg</th>
                        <th style='border: 1px solid black;'>Harga</th>
                    </tr>
                <thead>
                <tbody>
                    $trBody
                </tbody>
            </table>";
        }

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
                        <th style='text-align: right;font-size: 2em;font-family: 'sans';'>
                            BUKTI TRANSAKSI
                        </th>
                    </tr>';
                </table>
            </div>

            <div style='padding-top: 60px;font-family: 'sans';'>
                <table>
                    <tr>
                        <td style='font-size: 2em;'>TANGGAL&nbsp;&nbsp;&nbsp;</td>
                        <td style='font-size: 2em;'>
                            : ".date("d/m/y H:i:s",$dbresponse['data']['date'])."
                        </td>
                    </tr>
                    <tr>
                        <td style='font-size: 2em;'>NAMA&nbsp;&nbsp;&nbsp;</td>
                        <td style='font-size: 2em;text-transform: uppercase;'>: ".$dbresponse['data']['nama_lengkap']."</td>
                    </tr>
                    <tr>
                        <td style='font-size: 2em;'>ID.NASABAH&nbsp;&nbsp;&nbsp;</td>
                        <td style='font-size: 2em;'>: ".$dbresponse['data']['id_nasabah']."</td>
                    </tr>
                    <tr>
                        <td style='font-size: 2em;'>ID.TRANSAKSI&nbsp;&nbsp;&nbsp;</td>
                        <td style='font-size: 2em;'>: ".$dbresponse['data']['id_transaksi']."</td>
                    </tr>
                </table>
            </div>

            <h1 style='font-style: italic;margin-top: 40px;margin-bottom: 20px;font-family: 'sans';'>
                ".$type."
            </h1>

            ".$result."
        </body>
        
        </html>");

        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('transaksi#'.$id.".pdf", 'I');
    }
}
