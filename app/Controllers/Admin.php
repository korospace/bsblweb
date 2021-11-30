<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\UserModel;
use App\Models\TransaksiModel;

class Admin extends BaseController
{
    public $userModel;

	public function __construct()
    {
        $this->userModel  = new UserModel;
    }

    /**
     * Views method
     * =====================================
     */
    // Admin dashboard
    public function dashboardAdmin()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);
        
        $data   = [
            'title' => 'Admin | dashboard',
            'token' => $token,
        ];
        
        if($result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login/admin');
        } 
        else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,time() + $result['data']['expired'],'/');
            $data['password']  = $result['data']['password'];
            $data['privilege'] = $result['data']['privilege'];
            return view('Admin/index',$data);
        }
    }

    // transaksi page
    public function transaksiPage()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        $data   = [
            'title' => 'Admin | transaksi',
            'token' => $token,
        ];
        
        if($result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        } 
        else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,time() + $result['data']['expired'],'/');
            $data['password']  = $result['data']['password'];
            $data['privilege'] = $result['data']['privilege'];
            $data['idadmin']   = $result['data']['userid'];
            return view('Admin/transaksiPage',$data);
        }
    }

    // List sampah page
    public function listSampahView()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        $data   = [
            'title'     => 'Admin | list sampah',
            'token'     => $token,
        ];
        
        if($result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        } 
        else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,time() + $result['data']['expired'],'/');
            $data['password']  = $result['data']['password'];
            $data['privilege'] = $result['data']['privilege'];
            return view('Admin/listSampah',$data);
        }
    }

    // List admin page
    public function listAdminView()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        $data   = [
            'title'     => 'Admin | list admin',
            'token'     => $token,
        ];
        
        if($result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        } 
        else if($result['data']['privilege'] != 'superadmin') {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,time() + $result['data']['expired'],'/');
            $data['password']  = $result['data']['password'];
            $data['privilege'] = $result['data']['privilege'];
            return view('Admin/listAdmin',$data);
        }
    }

    // List nasabah page
    public function listNasabahView()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        $data   = [
            'title' => 'Admin | list nasabah',
            'token' => $token,
        ];
        
        if($result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        } 
        else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,time() + $result['data']['expired'],'/');
            $data['password']  = $result['data']['password'];
            $data['privilege'] = $result['data']['privilege'];
            return view('Admin/listNasabah',$data);
        }
    }

    // List artikel page
    public function listArtikelView()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        $data   = [
            'title' => 'Admin | list artikel',
            'token' => $token,
        ];
        
        if($result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        } 
        else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,time() + $result['data']['expired'],'/');
            $data['password']  = $result['data']['password'];
            $data['privilege'] = $result['data']['privilege'];
            return view('Admin/listArtikel',$data);
        }
    }

    // Add artikel page
    public function addArtikelView()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        $data   = [
            'title'     => 'Admin | tambah artikel',
            'token'     => $token,
        ];
        
        if($result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        }  
        else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,time() + $result['data']['expired'],'/');
            $data['password']  = $result['data']['password'];
            $data['privilege'] = $result['data']['privilege'];
            return view('Admin/crudArtikel',$data);
        }
    }

    // Edit artikel page
    public function editArtikelView(?string $id=null)
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        if ($id!=null) {
            $data   = [
                'title'     => 'Admin | edit artikel',
                'idartikel' => $id,
                'token'     => $token,
            ];
            
            if($result['success'] == false) {
                setcookie('token', null, -1, '/');
                unset($_COOKIE['token']);
                return redirect()->to(base_url().'/login');
            } 
            else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
                return redirect()->to(base_url().'/notfound');
            } 
            else {
                setcookie('token',$token,time() + $result['data']['expired'],'/');
                $data['password']  = $result['data']['password'];
                $data['privilege'] = $result['data']['privilege'];
                return view('Admin/crudArtikel',$data);
            }
        } 
        else {
            return redirect()->to(base_url().'/admin/listartikel');
        }
    }

    // Admin profile page
    public function profileAdmin()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);
        $data   = [
            'title' => 'Admin | profile',
            'token' => $token,
        ];
        
        if($result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        } 
        else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,time() + $result['data']['expired'],'/');
            $data['password']  = $result['data']['password'];
            $data['privilege'] = $result['data']['privilege'];
            return view('Admin/profile',$data);
        }
    }

    // Detil nasabah view
    public function detilNasabahView(?string $id=null)
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        if ($id!=null) {
            $data = [
                'title'     => 'Admin | detil nasabah',
                'idnasabah' => $id,
                'token'     => $token,
            ];

            if($result['success'] == false) {
                setcookie('token', null, -1, '/');
                unset($_COOKIE['token']);
                return redirect()->to(base_url().'/login');
            } 
            else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
                return redirect()->to(base_url().'/notfound');
            } 
            else {
                setcookie('token',$token,time() + $result['data']['expired'],'/');
                $data['password']  = $result['data']['password'];
                $data['privilege'] = $result['data']['privilege'];
                return view('Admin/detilNasabah',$data);
            }
        }
        else {
            return redirect()->to(base_url().'/admin/listnasabah');
        }
    }

    public function cetakRekap(string $date)
    {
        $token     = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result    = $this->checkToken($token, false);
        $privilege = (isset($result['privilege'])) ? $result['privilege'] : null;

        if ($token == null || $result['success'] == false || !in_array($privilege,['super','admin'])) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        }

        $transaksiModel = new TransaksiModel;
        $dbresponse     = $transaksiModel->rekapData(['date' => $date]);
        
        if ($dbresponse['success'] == false) {
            return redirect()->to(base_url().'/login');
        }

        $data      = $dbresponse['data'];
        $rekapDate = $data['date'];
        // dd($data['tss']);

        // setor sampah
        $tss   = $data['tss'];
        $trTss = "";
        $noTss = 1;
        $totKgSetor   = 0;
        $totUangSetor = 0;

        foreach ($tss as $key) {
            $totKgSetor   = $totKgSetor+(float)$key['jumlah'];
            $totUangSetor = $totUangSetor+(int)$key['harga'];

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
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$key['jumlah']."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    Rp ".number_format($key['harga'] , 0, ',', '.')."
                </td>
            </tr>";
        }

        $trTss .= "<tr style='background: rgb(230, 230, 230);'>
            <th colspan='5' style='text-align: center;font-size: 0.8em;font-family: sans;'>
                total
            </th>
            <th style='text-align: left;font-size: 0.8em;font-family: sans;'>
                ".$totKgSetor."g
            </th>
            <th style='text-align: left;font-size: 0.8em;font-family: sans;'>
                Rp ".number_format($totUangSetor , 0, ',', '.')."
            </th>
        </tr>";

        // jual sampah
        $tjs   = $data['tjs'];
        $trTjs = "";
        $noTjs = 1;
        $totKgjual   = 0;
        $totUangJual = 0;

        foreach ($tjs as $key) {
            $totKgjual   = $totKgjual+(float)$key['jumlah'];
            $totUangJual = $totUangJual+(int)$key['harga'];

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
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$key['jumlah']."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    Rp ".number_format($key['harga'] , 0, ',', '.')."
                </td>
            </tr>";
        }

        $trTjs .= "<tr style='background: rgb(230, 230, 230);'>
            <th colspan='4' style='text-align: center;font-size: 0.8em;font-family: sans;'>
                total
            </th>
            <th style='text-align: left;font-size: 0.8em;font-family: sans;'>
                ".$totKgjual."g
            </th>
            <th style='text-align: left;font-size: 0.8em;font-family: sans;'>
                Rp ".number_format($totUangJual , 0, ',', '.')."
            </th>
        </tr>";
        
        // pindah saldo
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
                <td style='font-size: 0.7em;font-family: sans;'>
                    Rp ".number_format($key['harga_emas'] , 0, ',', '.')."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$key['tujuan']."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    Rp ".number_format($key['jumlah'] , 0, ',', '.')."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>
                    ".$key['hasil_konversi']. "g
                </td>
            </tr>";
        }

        $trTps .= "<tr style='background: rgb(230, 230, 230);'>
            <th colspan='6' style='text-align: center;font-size: 0.8em;font-family: sans;'>
                total
            </th>
            <th style='text-align: left;font-size: 0.8em;font-family: sans;'>
                Rp ".number_format($totUangPindah , 0, ',', '.')."
            </th>
            <th style='text-align: left;font-size: 0.8em;font-family: sans;'>
                ".$totKgPindah."g
            </th>
        </tr>";
        
        // tarik saldo
        $tts   = $data['tts'];
        $trTts = "";
        $noTts = 1;
        $totKgTarik   = 0;
        $totUangTarik = 0;

        foreach ($tts as $key) {
            $uang     = ($key['jenis_saldo'] == 'uang')     ? $key['jumlah'] : 0;
            $antam    = ($key['jenis_saldo'] == 'antam')    ? $key['jumlah'] : 0;
            $ubs      = ($key['jenis_saldo'] == 'ubs')      ? $key['jumlah'] : 0;
            $galery24 = ($key['jenis_saldo'] == 'galery24') ? $key['jumlah'] : 0;

            if ($uang == 0) {
                $totKgTarik   = $totKgTarik+(float)$key['jumlah'];
            } 
            else {
                $totUangTarik = $totUangTarik+(int)$key['jumlah'];
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
                <td style='font-size: 0.7em;font-family: sans;'>
                    Rp ".number_format((int)$uang , 0, ',', '.')."
                </td>
                <td style='font-size: 0.7em;font-family: sans;'>".$antam."g</td>
                <td style='font-size: 0.7em;font-family: sans;'>".$ubs."g</td>
                <td style='font-size: 0.7em;font-family: sans;'>".$galery24."g</td>
            </tr>";
        }

        $trTts .= "<tr style='background: rgb(230, 230, 230);'>
            <th colspan='4' style='text-align: center;font-size: 0.8em;font-family: sans;'>
                total
            </th>
            <th style='text-align: left;font-size: 0.8em;font-family: sans;'>
                Rp ".number_format($totUangTarik , 0, ',', '.')."
            </th>
            <th colspan='3' style='text-align: center;font-size: 0.8em;font-family: sans;'>
                ".$totKgTarik."g
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
                            <span  style='font-size: 1em;font-family: sans;'>
                                $rekapDate
                            </span>
                        </th>
                    </tr>';
                </table>
            </div>

            <h1 style='font-style: italic;margin-top: 40px;margin-bottom: 10px;font-family: sans;font-size: 1.4em;'>
                1. Setor sampah
            </h1>

            <table border='0' width='100%' cellpadding='5'>
                <thead>
                    <tr style='font-size: 0.8em;'>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>#</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Tanggal</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>ID Transaksi</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Nama Nasabah</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Jenis sampah</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Kg</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Harga</th>
                    </tr>
                <thead>
                <tbody>
                    $trTss
                </tbody>
            </table>

            <h1 style='font-style: italic;margin-top: 40px;margin-bottom: 10px;font-family: sans;font-size: 1.4em;'>
                2. Jual sampah
            </h1>

            <table border='0' width='100%' cellpadding='5'>
                <thead>
                    <tr style='font-size: 0.8em;'>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>#</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Tanggal</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>ID Transaksi</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Jenis sampah</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Kg</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Harga</th>
                    </tr>
                <thead>
                <tbody>
                    $trTjs
                </tbody>
            </table>

            <h1 style='font-style: italic;margin-top: 40px;margin-bottom: 10px;font-family: sans;font-size: 1.4em;'>
                3. Pindah saldo
            </h1>

            <table border='0' width='100%' cellpadding='5'>
                <thead>
                    <tr>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>#</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Tanggal</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>ID Transaksi</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Nama Nasabah</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Harga Emas</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Tujuan</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Jumlah</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Hasil Konversi</th>
                    </tr>
                <thead>
                <tbody>
                    $trTps
                </tbody>
            </table>

            <h1 style='font-style: italic;margin-top: 40px;margin-bottom: 10px;font-family: sans;font-size: 1.4em;'>
                4. Tarik saldo
            </h1>

            <table border='0' width='100%' cellpadding='5'>
                <thead>
                    <tr>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>#</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Tanggal</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>ID Transaksi</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Nama Nasabah</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Uang</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Antam</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Ubs</th>
                        <th style='border: 0.5px solid black;font-size: 0.8em;font-family: sans;'>Galery24</th>
                    </tr>
                <thead>
                <tbody>
                    $trTts
                </tbody>
            </table>

        </body>
        
        </html>");

        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('rekap-transaksi#'.$date.".pdf", 'I');
    }

    /**
     * Confirm delete
     *   url    : domain.com/admin/confirmdelete
     *   method : POST
     */
    public function confirmDelete(): object
    {
        $data   = $this->request->getPost();
        $this->validation->run($data,'confirmDelete');
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
            // verify password
            if (password_verify($data['password'],$data['hashedpass'])) {

                $response = [
                    'status'   => 200,
                    'error'    => false,
                    'messages' => 'confirm success',
                ];

                return $this->respond($response,200);
            } 
            else {
                $response = [
                    'status'   => 404,
                    'error'    => true,
                    'messages' => [
                        'password' => "password not match",
                    ],
                ];
        
                return $this->respond($response,404);
            }
        }
    }

    /**
     * Session Check
     *   url    : domain.com/admin/sessioncheck
     *   method : GET
     */
    public function sessionCheck(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        return $this->respond($result,200);
    }

    /**
     * Get own profile
     *   url    : domain.com/admin/getprofile
     *   method : GET
     */
    public function getProfile(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $id        = $result['data']['userid'];
        $dbrespond = $this->userModel->getProfileUser($id);

        return $this->respond($dbrespond,$dbrespond['status']);
    }

    /**
     * Edit own profile
     *   url    : domain.com/admin/editprofile
     *   method : PUT
     */
    public function editProfile(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $this->_methodParser('data');
        global $data;
        $data['id'] = $result['data']['userid']; 

        $this->validation->run($data,'editOwnProfileAdmin');
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
            $id         = $data['id'];
            $dataAdmin  = $this->userModel->db->table('users')->select('password')->where("id",$id)->get()->getResultArray();

            if (!empty($dataAdmin)) {
                $newpass = '';
                $oldpass = '';

                if (isset($data['new_password'])) {
                    $this->validation->run($data,'newPasswordWithOld');
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
                        $newpass = trim($data['new_password']);
                        $oldpass = trim($data['old_password']);
                    }
                }
        
                $data = [
                    "id"           => $data['id'],
                    "username"     => trim($data['username']),
                    "nama_lengkap" => strtolower(trim($data['nama_lengkap'])),
                    "notelp"       => trim($data['notelp']),
                    "alamat"       => trim($data['alamat']),
                    "tgl_lahir"    => trim($data['tgl_lahir']),
                    "kelamin"      => strtolower(trim($data['kelamin'])),
                ];

                if ($newpass != '') {
                    if (password_verify($oldpass,$dataAdmin[0]['password'])) {
                        $data['password'] = password_hash($newpass, PASSWORD_DEFAULT);
                        unset($data['new_password']);
                        unset($data['old_password']);
                    } 
                    else {
                        return $this->fail(['old_password' => 'wrong old password'],400,true);
                    }
                }

                $dbrespond = $this->userModel->editUser($data);

                return $this->respond($dbrespond,$dbrespond['status']);
            } 
            else {
                return $this->fail("nasabah with id $id not found",404,true);
            }
        }
    }

    /**
     * Logout
     *   url    : domain.com/admin/logout
     *   method : DELETE
     */
    public function logout(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $id        = $result['data']['userid'];
        $dbrespond = $this->userModel->setTokenNull($id);

        return $this->respond($dbrespond,$dbrespond['status']);
    }

    /**
     * Get nasabah
     *   url    : - domain.com/admin/getnasabah
     *   method : GET
     */
    public function getNasabah(): object
    {
        $result    = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);
        
        if ($this->request->getGet('orderby')) {
            $this->validation->run($this->request->getGet(),'filterGetNasabah');
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

        $getnasabah = $this->userModel->getNasabah($this->request->getGet());

        return $this->respond($getnasabah,$getnasabah['status']);
    }

    /**
     * Edit nasabah
     *   url    : domain.com/admin/editnasabah
     *   method : PUT
     */
    public function editNasabah(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $this->_methodParser('data');
        global $data;

        $id           = (isset($data['id'])) ? $data['id'] : 'null';
        $dataNasabah  = $this->userModel->db->table('users')->select('id')->where("id",$id)->get()->getResultArray();
        
        if (!empty($dataNasabah)) {

            $this->validation->run($data,'editNasabahValidate');
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
                $newpass = '';

                if (isset($data['new_password'])) {
                    if ($data['new_password'] != '') {
                        $this->validation->run($data,'newPassword');
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
                            $newpass = $data['new_password'];
                        }
                    }
                }
        
                $data = [
                    "id"           => $data['id'],
                    "username"     => trim($data['username']),
                    "nama_lengkap" => strtolower(trim($data['nama_lengkap'])),
                    "notelp"       => trim($data['notelp']),
                    "alamat"       => trim($data['alamat']),
                    "tgl_lahir"    => trim($data['tgl_lahir']),
                    "kelamin"      => $data['kelamin'],
                    "is_verify"    => (trim($data['is_verify']) == '1') ?true:false,
                ];

                if ($newpass != '') {
                    $data['password'] = $this->encrypt($newpass);
                }

                $editNasabah  = $this->userModel->editUser($data);

                return $this->respond($editNasabah,$editNasabah['status']);
            }
        } 
        else {
            $response = [
                'status'   => 404,
                'error'    => true,
                'messages' => [
                    'id'   => "nasabah with id ($id) not found",
                ],
            ];
    
            return $this->respond($response,404);
        }
    }

    /**
     * Delete nasabah
     *   url    : domain.com/admin/deletenasabah?id=:id
     *   method : DELETE
     */
	public function deleteNasabah(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        if($this->request->getGet('id') == null) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => 'required parameter id',
            ];
    
            return $this->respond($response,400);
        } 
        else {
            $currentAdminId = $result['data']['userid'];
            $dbrespond      = $this->userModel->deleteUser($this->request->getGet('id'),$currentAdminId);

            return $this->respond($dbrespond,$dbrespond['status']);
        }
    }

    /**
     * Get admin
     *   url    : - domain.com/admin/getadmin
     *            - domain.com/admin/getadmin?id=:id
     *   method : GET
     */
    public function getAdmin(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],'superadmin');

        $idadmin        = ($this->request->getGet('id'))?$this->request->getGet('id'):false;
        $currentAdminId = $result['data']['userid'];
        $dbrespond      = $this->userModel->getAdmin($idadmin,$currentAdminId);

        return $this->respond($dbrespond,$dbrespond['status']);
    }

    /**
     * Edit admin
     *   url    : domain.com/admin/editadmin
     *   method : PUT
     */
    public function editAdmin(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],'superadmin');

        $this->_methodParser('data');
        global $data;

        $this->validation->run($data,'editAdminValidate');
        $errors = $this->validation->getErrors();

        if($errors) {
            $response = [
                'status' => 400,
                'error' => true,
                'messages' => $errors,
            ];
    
            return $this->respond($response,400);
        } 
        else {

            $newpass = '';

            if (isset($data['new_password'])) {
                if ($data['new_password'] != '') {
                    $this->validation->run($data,'newPassword');
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
                        $newpass = $data['new_password'];
                    }
                }
            }
            
            $data = [
                "id"           => trim($data['id']),
                "username"     => trim($data['username']),
                "nama_lengkap" => strtolower(trim($data['nama_lengkap'])),
                "notelp"       => trim($data['notelp']),
                "alamat"       => trim($data['alamat']),
                "tgl_lahir"    => trim($data['tgl_lahir']),
                "kelamin"      => strtolower(trim($data['kelamin'])),
                "privilege"    => strtolower(trim($data['privilege'])),
                "is_active"    => (trim($data['is_active']) == '1') ?true:false,
            ];

            if ($newpass != '') {
                $data['password'] = password_hash($newpass, PASSWORD_DEFAULT);
            }

            $dataAdmin = $this->userModel->db->table('users')->select('is_active')->where("id",$data['id'])->get()->getResultArray();

            if ($dataAdmin[0]['is_active'] == 'f') {
                if ($data['is_active'] == true) {
                    $data['last_active'] = (int)time();
                    $data['created_at']  = (int)time();
                }
            }

            $dbrespond = $this->userModel->editUser($data);

            return $this->respond($dbrespond,$dbrespond['status']);
        }
    }

    /**
     * Delete admin
     *   url    : domain.com/admin/deleteadmin?id=:id
     *   method : DELETE
     */
	public function deleteAdmin(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],'superadmin');

        if($this->request->getGet('id') == null) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => 'required parameter id',
            ];
    
            return $this->respond($response,400);
        } 
        else {
            $currentAdminId = $result['data']['userid'];
            $dbrespond      = $this->userModel->deleteUser($this->request->getGet('id'),$currentAdminId);

            return $this->respond($dbrespond,$dbrespond['status']);
        }
    }
}
