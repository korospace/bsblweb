<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\AdminModel;
use App\Models\NasabahModel;
use App\Models\TransaksiModel;

class Admin extends BaseController
{
    public $adminModel;

	public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->validation = \Config\Services::validation();
        $this->adminModel = new AdminModel;
        if (isset($_COOKIE['lasturl'])) {
            unset($_COOKIE['lasturl']);
        }
    }

    /**
     * Dashboard admin
     */
    public function dashboardAdmin()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);
        
        $data   = [
            'title'     => 'Admin | dashboard',
            'token'     => $token,
            'password'  => (isset($result['password']))  ? $result['password']  : null,
            'privilege' => (isset($result['privilege'])) ? $result['privilege'] : null,
        ];
        
        if($result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        } 
        else if($data['privilege'] == 'nasabah') {
            return redirect()->to(base_url().'/nasabah');
        } 
        else {
            setcookie('token',$token,time() + $result['expired'],'/');
            return view('Admin/index',$data);
        }
    }

    /**
     * View list admin
     */
    public function listAdminView()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        $data   = [
            'title'     => 'Admin | list admin',
            'token'     => $token,
            'password'  => (isset($result['password']))  ? $result['password']  : null,
            'privilege' => (isset($result['privilege'])) ? $result['privilege'] : null,
        ];
        
        if($result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        } 
        else if($data['privilege'] == 'nasabah') {
            return redirect()->to(base_url().'/nasabah');
        } 
        else {
            setcookie('token',$token,time() + $result['expired'],'/');
            if ($data['privilege'] != 'super') {
                return redirect()->to(base_url().'/admin');
            } 
            else {
                return view('Admin/listAdmin',$data);
            }
        }
    }

    /**
     * View list nasabah
     */
    public function listNasabahView()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        $data   = [
            'title'     => 'Admin | list nasabah',
            'token'     => $token,
            'password'  => (isset($result['password']))  ? $result['password']  : null,
            'privilege' => (isset($result['privilege'])) ? $result['privilege'] : null,
        ];
        
        if($result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        } 
        else if($data['privilege'] == 'nasabah') {
            return redirect()->to(base_url().'/nasabah');
        } 
        else {
            setcookie('token',$token,time() + $result['expired'],'/');
            return view('Admin/listNasabah',$data);
        }
    }

    /**
     * View detil nasabah
     */
    public function detilNasabahView(?string $id=null)
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        if ($id!=null) {
            $data = [
                'title'     => 'Admin | detil nasabah',
                'idnasabah' => $id,
                'token'     => $token,
                'password'  => (isset($result['password']))  ? $result['password']  : null,
                'privilege' => (isset($result['privilege'])) ? $result['privilege'] : null,
            ];

            if($result['success'] == false) {
                setcookie('token', null, -1, '/');
                unset($_COOKIE['token']);
                return redirect()->to(base_url().'/login');
            } 
            else if($data['privilege'] == 'nasabah') {
                return redirect()->to(base_url().'/nasabah');
            } 
            else {
                setcookie('token',$token,time() + $result['expired'],'/');
                return view('Admin/detilNasabah',$data);
            }
        }
        else {
            return redirect()->to(base_url().'/admin/listnasabah');
        }
    }

    /**
     * View list artikel
     */
    public function listArtikelView()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        $data   = [
            'title'     => 'Admin | list artikel',
            'token'     => $token,
            'password'  => (isset($result['password']))  ? $result['password']  : null,
            'privilege' => (isset($result['privilege'])) ? $result['privilege'] : null,
        ];
        
        if($result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        } 
        else if($data['privilege'] == 'nasabah') {
            return redirect()->to(base_url().'/nasabah');
        } 
        else {
            setcookie('token',$token,time() + $result['expired'],'/');
            return view('Admin/listArtikel',$data);
        }
    }

    /**
     * View add artikel
     */
    public function addArtikelView()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        $data   = [
            'title'     => 'Admin | tambah artikel',
            'token'     => $token,
            'password'  => (isset($result['password']))  ? $result['password']  : null,
            'privilege' => (isset($result['privilege'])) ? $result['privilege'] : null,
        ];
        
        if($result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        }  
        else if($data['privilege'] == 'nasabah') {
            return redirect()->to(base_url().'/nasabah');
        } 
        else {
            setcookie('token',$token,time() + $result['expired'],'/');
            return view('Admin/crudArtikel',$data);
        }
    }

    /**
     * View edit artikel
     */
    public function editArtikelView(?string $id=null)
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        if ($id!=null) {
            $data   = [
                'title'     => 'Admin | edit artikel',
                'idartikel' => $id,
                'token'     => $token,
                'password'  => (isset($result['password']))  ? $result['password']  : null,
                'privilege' => (isset($result['privilege'])) ? $result['privilege'] : null,
            ];
            
            if($result['success'] == false) {
                setcookie('token', null, -1, '/');
                unset($_COOKIE['token']);
                return redirect()->to(base_url().'/login');
            } 
            else if($data['privilege'] == 'nasabah') {
                return redirect()->to(base_url().'/nasabah');
            } 
            else {
                setcookie('token',$token,time() + $result['expired'],'/');
                return view('Admin/crudArtikel',$data);
            }
        } 
        else {
            return redirect()->to(base_url().'/admin/listartikel');
        }
    }

    /**
     * Profile admin
     */
    public function profileAdmin()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);
        $data   = [
            'title'     => 'Admin | profile',
            'token'     => $token,
            'password'  => (isset($result['password']))  ? $result['password']  : null,
            'privilege' => (isset($result['privilege'])) ? $result['privilege'] : null,
        ];
        
        if($result['success'] == false) {
            setcookie('token', null, -1, '/');
            unset($_COOKIE['token']);
            return redirect()->to(base_url().'/login');
        } 
        else if($data['privilege'] == 'nasabah') {
            return redirect()->to(base_url().'/nasabah');
        } 
        else {
            setcookie('token',$token,time() + $result['expired'],'/');
            return view('Admin/profile',$data);
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
     * Login
     *   url    : domain.com/admin/login
     *   method : POST
     */
    public function login(): object
    {
        $data   = $this->request->getPost();
        $this->validation->run($data,'adminLogin');
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
            // get admin data from DB by username
            $adminData  = $this->adminModel->getAdminByUsername($this->request->getPost("username"));

            if ($adminData['success'] == true) {
                $login_pass    = $this->request->getPost("password");
                $database_pass = $adminData['message']['password'];

                // verify password
                if (password_verify($login_pass,$database_pass)) {

                    // is admin active or not
                    $active      = $adminData['message']['active'];
                    $last_active = (int)$adminData['message']['last_active'];
                    $timeNow     = time();
                    $batasTime   = (int)$timeNow - (86400*30);
                    $privilege   = $adminData['message']['privilege'];

                    if ($last_active <  $batasTime && $privilege != 'super' || $active == 'f') {
                        $response = [
                            'status'   => 401,
                            'error'    => true,
                            'messages' => 'akun tidak aktif',
                        ];
                
                        return $this->respond($response,401);
                    } 
                    else {
                        // database row id
                        $id           = $adminData['message']['id'];
                        // generate new token
                        // var_dump($this->request->getPost("username"));die;
                        $token        = $this->generateToken(
                            $id,
                            false,
                            $database_pass,
                            $privilege,
                        );

                        // edit admin in database
                        $editAdmin = $this->adminModel->updateToken($id,$token);

                        if ($editAdmin['success'] == true) {
                            $response = [
                                'status'   => 200,
                                'error'    => false,
                                'messages' => 'loggin success',
                                'token'    => $token
                            ];
    
                            return $this->respond($response,200);
                        } 
                        else {
                            $response = [
                                'status'   => $editAdmin['code'],
                                'error'    => true,
                                'messages' => $editAdmin['message'],
                            ];
                    
                            return $this->respond($response,$editAdmin['code']);
                        }
                    } 
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
            else {
                $response = [
                    'status'   => $adminData['code'],
                    'error'    => true,
                    'messages' => $adminData['message'],
                ];
        
                return $this->respond($response,$adminData['code']);
            }
        }
    }

    /**
     * Login
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
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            return $this->respond($result['message'],200);
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
    }

    /**
     * Get own profile
     *   url    : domain.com/admin/getprofile
     *   method : GET
     */
    public function getProfile(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $id         = $result['message']['data']['id'];
            $dataAdmin  = $this->adminModel->getProfileAdmin($id);
            
            if ($dataAdmin['success'] == true) {
                $response = [
                    'status' => 200,
                    'error'  => false,
                    'data'   => $dataAdmin['message']
                ];

                return $this->respond($response,200);
            } 
            else {
                $response = [
                    'status'   => $dataAdmin['code'],
                    'error'    => true,
                    'messages' => $dataAdmin['message'],
                ];
        
                return $this->respond($response,$dataAdmin['code']);
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
    }

    /**
     * Edit own profile
     *   url    : domain.com/admin/editprofile
     *   method : PUT
     */
    public function editProfile(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $this->_methodParser('data');
            global $data;
            $data['id'] = $result['message']['data']['id']; 

            $this->validation->run($data,'editProfileAdmin');
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

                $dataAdmin  = $this->adminModel->db->table('admin')->select('password')->where("id",$id)->get()->getResultArray();

                if (!empty($dataAdmin)) {
                    $newpass = '';
                    $oldpass = '';

                    if (isset($data['new_password'])) {
                        $this->validation->run($data,'editNewPassword');
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
                            $oldpass = $data['old_password'];
                        }
                    }
            
                    $data = [
                        "id"           => $data['id'],
                        "username"     => $data['username'],
                        "nama_lengkap" => $data['nama_lengkap'],
                        "notelp"       => $data['notelp'],
                        "alamat"       => $data['alamat'],
                        "tgl_lahir"    => $data['tgl_lahir'],
                        "kelamin"      => $data['kelamin'],
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

                    $editAdmin = $this->adminModel->editProfileAdmin($data);

                    if ($editAdmin['success'] == true) {
                        $response = [
                            'status' => 201,
                            'error' => false,
                            'messages' => $editAdmin['message'],
                        ];
    
                        return $this->respond($response,201);
                    } 
                    else {
                        $response = [
                            'status'   => $editAdmin['code'],
                            'error'    => true,
                            'messages' => $editAdmin['message'],
                        ];
                
                        return $this->respond($response,$editAdmin['code']);
                    }
                } 
                else {
                    return $this->fail("nasabah with id $id not found",404,true);
                }
                
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
    }

    /**
     * Logout
     *   url    : domain.com/admin/logout
     *   method : DELETE
     */
    public function logout(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $id         = $result['message']['data']['id'];
            $editAdmin  = $this->adminModel->setTokenNull($id);

            if ($editAdmin['success'] == true) {
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => $editAdmin['message'],
                ];

                return $this->respond($response,200);
            } 
            else {
                $response = [
                    'status'   => $editAdmin['code'],
                    'error'    => true,
                    'messages' => $editAdmin['message'],
                ];
        
                return $this->respond($response,$editAdmin['code']);
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
        
    }

    /**
     * Get total saldo
     *   url    : domain.com/admin/totalsaldo
     *   method : GET
     */
    public function getTotalSaldo(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $totalSaldo = $this->adminModel->getTotalSaldo();
            
            if ($totalSaldo['success'] == true) {
                $response = [
                    'status' => 200,
                    'error'  => false,
                    'data '  => $totalSaldo['message']
                ];

                return $this->respond($response,200);
            } 
            else {
                $response = [
                    'status'   => $totalSaldo['code'],
                    'error'    => true,
                    'messages' => $totalSaldo['message'],
                ];
        
                return $this->respond($response,$totalSaldo['code']);
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
    }

    /**
     * Get nasabah
     *   url    : - domain.com/admin/getnasabah
     *            - domain.com/admin/getnasabah?id=:id
     *   method : GET
     */
    public function getNasabah(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $getnasabah = $this->adminModel->getNasabah($this->request->getGet());

            if ($getnasabah['success'] == true) {
                $response = [
                    'status' => 200,
                    'error' => false,
                    'data' => $getnasabah['message'],
                ];

                return $this->respond($response,200);
            } 
            else {
                $response = [
                    'status'   => $getnasabah['code'],
                    'error'    => true,
                    'messages' => $getnasabah['message'],
                ];
        
                return $this->respond($response,$getnasabah['code']);
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }

    }

    /**
     * Add nasabah
     *   url    : domain.com/admin/addnasabah
     *   method : POST
     */
    public function addNasabah(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

		if ($result['success'] == true) {
            $data   = $this->request->getPost();
            $this->validation->run($data,'nasabahRegister');
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
                $nasabahModel = new NasabahModel();
                $lastNasabah  = $nasabahModel->getLastNasabah($data['kodepos']);
                $idNasabah    = '';

                if ($lastNasabah['success'] == true) {
                    $lastID = $lastNasabah['message']['id'];
                    $lastID = (int)substr($lastID,9)+1;
                    // $lastID = sprintf('%06d',$lastID);
    
                    $idNasabah = $data['kodepos'].$this->request->getPost("rt").$this->request->getPost("rw").$lastID;
                }
                else if ($lastNasabah['code'] == 404) {
                    $idNasabah = $data['kodepos'].$this->request->getPost("rt").$this->request->getPost("rw").'1';
                } 
                else {
                    $response = [
                        'status'   => $lastNasabah['code'],
                        'error'    => true,
                        'messages' => $lastNasabah['message'],
                    ];
            
                    return $this->respond($response,$lastNasabah['code']);
                }
                
                $data = [
                    "id"           => $idNasabah,
                    "email"        => trim($data['email']),
                    "username"     => trim($data['username']),
                    "password"     => password_hash(trim($data['password']), PASSWORD_DEFAULT),
                    "nama_lengkap" => strtolower(trim($data['nama_lengkap'])),
                    "notelp"       => trim($data['notelp']),
                    "alamat"       => trim($data['alamat']),
                    "tgl_lahir"    => trim($data['tgl_lahir']),
                    "kelamin"      => $data['kelamin'],
                    "is_verify"    => true,
                    "otp"          => null,
                    "created_at"   => (int)time(),
                ];

                $addNasabah = $nasabahModel->addNasabah($data);

                if ($addNasabah['success'] == true) {
                    $response = [
                        'status'   => 201,
                        "error"    => false,
                        'messages' => 'add new nasabah is success',
                    ];

                    return $this->respond($response,201);
                } 
                else {
                    $response = [
                        'status'   => $addNasabah['code'],
                        'error'    => true,
                        'messages' => $addNasabah['message'],
                    ];
            
                    return $this->respond($response,$addNasabah['code']);
                }
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
    }

    /**
     * Edit nasabah
     *   url    : domain.com/admin/editnasabah
     *   method : PUT
     */
    public function editNasabah(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $this->_methodParser('data');
            global $data;

            $id           = (isset($data['id'])) ? $data['id'] : 'null';
            $nasabahModel = new NasabahModel();
            $dataNasabah  = $nasabahModel->db->table('nasabah')->select('id')->where("id",$id)->get()->getResultArray();
            
            if (!empty($dataNasabah)) {
    
                $this->validation->run($data,'editProfileNasabahByAdmin');
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
                            $this->validation->run($data,'editNewPasswordWithoutOld');
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
                        "email"        => trim($data['email']),
                        "username"     => trim($data['username']),
                        "nama_lengkap" => strtolower(trim($data['nama_lengkap'])),
                        "notelp"       => trim($data['notelp']),
                        "alamat"       => trim($data['alamat']),
                        "tgl_lahir"    => trim($data['tgl_lahir']),
                        "kelamin"      => $data['kelamin'],
                        "is_verify"    => (trim($data['is_verify']) == '1') ?true:false,
                        "saldo"        => [
                            "uang"     => trim($data['saldo_uang']),
                            "antam"    => trim($data['saldo_antam']),
                            "ubs"      => trim($data['saldo_ubs']),
                            "galery24" => trim($data['saldo_galery24']),
                        ]
                    ];
    
                    if ($newpass != '') {
                        $data['password'] = $this->encrypt($newpass);
                    }
    
                    $editNasabah  = $nasabahModel->editProfileNasabah($data);
    
                    if ($editNasabah['success'] == true) {
                        $response = [
                            'status' => 201,
                            'error' => false,
                            'messages' => "edit nasabah with id $id is success",
                        ];
    
                        return $this->respond($response,201);
                    } 
                    else {
                        $response = [
                            'status'   => $editNasabah['code'],
                            'error'    => true,
                            'messages' => $editNasabah['message'],
                        ];
                
                        return $this->respond($response,$editNasabah['code']);
                    }
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
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
    }

    /**
     * Delete nasabah
     *   url    : domain.com/admin/deletenasabah?id=:id
     *   method : DELETE
     */
	public function deleteNasabah(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {

            if($this->request->getGet('id') == null) {
                $response = [
                    'status'   => 400,
                    'error'    => true,
                    'messages' => 'required parameter id',
                ];
        
                return $this->respond($response,400);
            } 
            else {
                $dbresponse = $this->adminModel->deleteNasabah($this->request->getGet('id'));

                if ($dbresponse['success'] == true) {
                    $response = [
                        'status' => 201,
                        'error' => false,
                        'messages' => $dbresponse['message'],
                    ];

                    return $this->respond($response,201);
                } 
                else {
                    $response = [
                        'status'   => $dbresponse['code'],
                        'error'    => true,
                        'messages' => $dbresponse['message'],
                    ];
            
                    return $this->respond($response,$dbresponse['code']);
                }
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
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
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $privilege = $result['message']['data']['privilege'];
            $id_admin  = $result['message']['data']['id'];

            if ($privilege != 'super') {
                $response = [
                    'status'   => 401,
                    'error'    => true,
                    'messages' => 'only super admin allowed',
                ];
        
                return $this->respond($response,401);
            } 
            else {

                $getAdmin   = $this->adminModel->getAdmin($this->request->getGet(),$id_admin);
    
                if ($getAdmin['success'] == true) {
                    $response = [
                        'status' => 200,
                        'error' => false,
                        'data' => $getAdmin['message'],
                    ];
    
                    return $this->respond($response,200);
                } 
                else {
                    $response = [
                        'status'   => $getAdmin['code'],
                        'error'    => true,
                        'messages' => $getAdmin['message'],
                    ];
            
                    return $this->respond($response,$getAdmin['code']);
                }
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }

    }

    /**
     * Add admin
     *   url    : domain.com/admin/addadmin
     *   method : POST
     */
    public function addAdmin(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

		if ($result['success'] == true) {
            $privilege = $result['message']['data']['privilege'];

            if ($privilege != 'super') {
                $response = [
                    'status'   => 401,
                    'error'    => true,
                    'messages' => 'only super admin allowed',
                ];
        
                return $this->respond($response,401);
            } 
            else {
                $data   = $this->request->getPost();
                $this->validation->run($data,'adminRegister');
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
                    $lastAdmin  = $this->adminModel->getLastAdmin();
                    $idAdmin    = '';
    
                    if ($lastAdmin['success'] == true) {
                        $lastID  = $lastAdmin['message']['id'];
                        $lastID  = (int)substr($lastID,1)+1;
                        $lastID  = sprintf('%03d',$lastID);
                        $idAdmin = 'A'.$lastID;
                    } 
                    else {
                        $response = [
                            'status'   => $lastAdmin['code'],
                            'error'    => true,
                            'messages' => $lastAdmin['message'],
                        ];
                
                        return $this->respond($response,$lastAdmin['code']);
                    }
                    
                    $data = [
                        "id"           => $idAdmin,
                        "username"     => trim($data['username']),
                        "password"     => password_hash(trim($data['password']), PASSWORD_DEFAULT),
                        "nama_lengkap" => strtolower(trim($data['nama_lengkap'])),
                        "notelp"       => trim($data['notelp']),
                        "alamat"       => trim($data['alamat']),
                        "tgl_lahir"    => trim($data['tgl_lahir']),
                        "kelamin"      => strtolower(trim($data['kelamin'])),
                        "privilege"    => strtolower(trim($data['privilege'])),
                        "last_active"  => time(),
                    ];
    
                    $addAdmin = $this->adminModel->addAdmin($data);
    
                    if ($addAdmin['success'] == true) {
                        $response = [
                            'status'   => 201,
                            "error"    => false,
                            'messages' => 'add new admin is success',
                        ];
    
                        return $this->respond($response,201);
                    } 
                    else {
                        $response = [
                            'status'   => $addAdmin['code'],
                            'error'    => true,
                            'messages' => $addAdmin['message'],
                        ];
                
                        return $this->respond($response,$addAdmin['code']);
                    }
                }
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
    }

    /**
     * Edit admin
     *   url    : domain.com/admin/editadmin
     *   method : PUT
     */
    public function editAdmin(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

		if ($result['success'] == true) {
            $privilege = $result['message']['data']['privilege'];

            if ($privilege != 'super') {
                $response = [
                    'status'   => 401,
                    'error'    => true,
                    'messages' => 'only super admin allowed',
                ];
        
                return $this->respond($response,401);
            } 
            else {
                $this->_methodParser('data');
                global $data;

                $id        = (isset($data['id'])) ? $data['id'] : 'null';
                $dataAdmin = $this->adminModel->db->table('admin')->select('id')->where("id",$id)->get()->getResultArray();

                if (!empty($dataAdmin)) {
                    $this->validation->run($data,'editProfileAdminByAdmin');
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
                                $this->validation->run($data,'editNewPasswordWithoutOld');
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
                            "active"       => (trim($data['active']) == '1') ?true:false,
                        ];
    
                        if ($newpass != '') {
                            $data['password'] = password_hash($newpass, PASSWORD_DEFAULT);
                        }
                        if ($data['active'] == true) {
                            $data['last_active'] = time();
                        }
        
                        $editAdmin = $this->adminModel->editProfileAdmin($data);
        
                        if ($editAdmin['success'] == true) {
                            $response = [
                                'status'   => 201,
                                "error"    => false,
                                'messages' => "edit admin with id $id is success",
                            ];
        
                            return $this->respond($response,201);
                        } 
                        else {
                            $response = [
                                'status'   => $editAdmin['code'],
                                'error'    => true,
                                'messages' => $editAdmin['message'],
                            ];
                    
                            return $this->respond($response,$editAdmin['code']);
                        }
                    }
                } 
                else {
                    $response = [
                        'status'   => 404,
                        'error'    => true,
                        'messages' => [
                            'id'   => "admin with id ($id) not found",
                        ],
                    ];
            
                    return $this->respond($response,404);
                }
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
    }

    /**
     * Delete admin
     *   url    : domain.com/admin/deleteadmin?id=:id
     *   method : DELETE
     */
	public function deleteAdmin(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $privilege = $result['message']['data']['privilege'];
            $id_admin  = $result['message']['data']['id'];

            if ($privilege != 'super') {
                $response = [
                    'status'   => 401,
                    'error'    => true,
                    'messages' => 'only super admin allowed',
                ];
        
                return $this->respond($response,401);
            } 
            else {
                if($this->request->getGet('id') == null) {
                    $response = [
                        'status'   => 400,
                        'error'    => true,
                        'messages' => 'required parameter id',
                    ];
            
                    return $this->respond($response,400);
                } 
                else {
                    $dbresponse = $this->adminModel->deleteAdmin($this->request->getGet('id'),$id_admin);
    
                    if ($dbresponse['success'] == true) {
                        $response = [
                            'status' => 201,
                            'error' => false,
                            'messages' => $dbresponse['message'],
                        ];
    
                        return $this->respond($response,201);
                    } 
                    else {
                        $response = [
                            'status'   => $dbresponse['code'],
                            'error'    => true,
                            'messages' => $dbresponse['message'],
                        ];
                
                        return $this->respond($response,$dbresponse['code']);
                    }
                }
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
    }
}
