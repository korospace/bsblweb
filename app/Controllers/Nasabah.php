<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\UserModel;
use App\Models\TransaksiModel;

class Nasabah extends BaseController
{
    public $userModel;

	public function __construct()
    {
        $this->userModel  = new UserModel;
    }

    /**
     * Dashboaard nasabah
     */
    public function dashboardNasabah()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token,false);
        $data   = [
            'title'     => 'Nasabah | dashboard',
            'token'     => $token,
            'privilege' => (isset($result['data']['privilege'])) ? $result['data']['privilege'] : null,
        ];

        if ($result['success'] == false) {
            setcookie('token', null, -1, '/'); 
            unset($_COOKIE['token']); 

            return redirect()->to(base_url().'/login');
        } 
        else if($data['privilege'] !== 'nasabah') {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,time() + $result['data']['expired'],'/');
            return view('Nasabah/index',$data);
        }
    }
    
    /**
     * Profile nasabah
     */
    public function profileNasabah()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token,false);
        $data = [
            'title'     => 'Nasabah | profile',
            'token'     => $token,
            'privilege' => (isset($result['data']['privilege'])) ? $result['data']['privilege'] : null,
        ];

        if ($result['success'] == false) {
            setcookie('token', null, -1, '/'); 
            unset($_COOKIE['token']); 
            return redirect()->to(base_url().'/login');
        } 
        else if($data['privilege'] !== 'nasabah') {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,time() + $result['data']['expired'],'/');
            return view('Nasabah/profilenasabah',$data);
        }

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
            $jumlah     = ($jenisSaldo == 'uang')? 'Rp '.number_format($dbresponse['data']['jumlah_tarik'] , 0, ',', '.') : $dbresponse['data']['jumlah_tarik'].' gram';

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
                            Saldo tujuan&nbsp;&nbsp;&nbsp;
                        </td>
                        <td style='font-size: 2em;font-family: sans;text-transform: uppercase;'>
                            : ".$dbresponse['data']['saldo_tujuan']."
                        </td>
                    </tr>
                    <tr>
                        <td style='font-size: 2em;font-family: sans;'>
                            Jumlah&nbsp;&nbsp;&nbsp;
                        </td>
                        <td style='font-size: 2em;font-family: sans;'>
                            : Rp ".number_format($dbresponse['data']['jumlah'] , 0, ',', '.')."
                        </td>
                    </tr>
                    <tr>
                        <td style='font-size: 2em;font-family: sans;'>
                            Harga emas&nbsp;&nbsp;&nbsp;
                        </td>
                        <td style='font-size: 2em;font-family: sans;'>
                            : Rp ".number_format($dbresponse['data']['harga_emas'] , 0, ',', '.')."
                        </td>
                    </tr>
                    <tr>
                        <td style='font-size: 2em;font-family: sans;'>
                            Hasil konversi&nbsp;&nbsp;&nbsp;
                        </td>
                        <td style='font-size: 2em;font-family: sans;'>
                            : ".$dbresponse['data']['hasil_konversi']." gram
                        </td>
                    </tr>
                </table>
            </div>";
        }
        if ($jenisTransaksi == 'penyetoran sampah') {
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
                        ".$key['jumlah_kg']."
                    </td>
                    <td style='font-family: sans;text-align: right;'>
                        Rp ".number_format($key['jumlah_rp'] , 0, ',', '.')."
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
                            Rp ".number_format($totalRp , 0, ',', '.')."
                        </td>
                    </tr>
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
                            ID.NASABAH&nbsp;&nbsp;&nbsp;
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

    /**
     * Check nasabah session
     *   url    : domain.com/nasabah/sessioncheck
     *   method : GET
     */
    public function sessionCheck(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],'nasabah');

        return $this->respond($result,200);
    }

    /**
     * Get data profile
     *   url    : domain.com/nasabah/getprofile
     *   method : GET
     */
    public function getProfile(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],'nasabah');

        $id        = $result['data']['userid'];
        $dbrespond = $this->userModel->getProfileUser($id);

        return $this->respond($dbrespond,$dbrespond['status']);
    }

    /**
     * Edit profile
     *   url    : domain.com/nasabah/editprofile
     *   method : PUT
     */
    public function editProfile(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],'nasabah');
        
        $this->_methodParser('data');
        global $data;
        $data['id'] = $result['data']['userid']; 
        
        $this->validation->run($data,'editProfileNasabah');
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
            $id           = $data['id'];
            $dataNasabah  = $this->userModel->db->table('users')->select('password')->where("id",$id)->get()->getResultArray();

            if (!empty($dataNasabah)) {
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
                        $newpass = $data['new_password'];
                        $oldpass = $data['old_password'];
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
                    $dbPass = $this->decrypt($dataNasabah[0]['password']);
                    
                    if ($oldpass === $dbPass) {
                        $data['password'] = $this->encrypt($newpass);
                        unset($data['new_password']);
                        unset($data['old_password']);
                    } 
                    else {
                        return $this->fail(["old_password" => "password lama anda salah"],400,true);
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
     *   url    : domain.com/nasabah/logout
     *   method : DELETE
     */
    public function logout(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],'nasabah');

        $id        = $result['data']['userid'];
        $dbrespond = $this->userModel->setTokenNull($id);

        return $this->respond($dbrespond,$dbrespond['status']);
    }

    /**
     * Get wilayah
     *   url    : domain.com/nasabah/wilayah
     *   method : GET
     */
    public function getWilayah(): object
    {
        $dbrespond = $this->userModel->getWilayah();

        return $this->respond($dbrespond,$dbrespond['status']);
    }

    /**
     * Send kritik
     *   url    : domain.com/nasabah/sendkritik
     *   method : POST
     */
    public function sendKritik(): object
    {
        $this->validation->run($_POST,'sendKritikValidate');
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
            $sendEmail = $this->sendKritikSaran($_POST['name'],$_POST['email'],$_POST['message']);

            $response = [
                'status'   => ($sendEmail == true) ? 201   : 500,
                "error"    => ($sendEmail == true) ? false : true,
                'messages' => ($sendEmail == true) ? 'kritik dan saran successfully sent' : $sendEmail,
            ];

            return $this->respond($response,$response['status']);
        }
    }
}