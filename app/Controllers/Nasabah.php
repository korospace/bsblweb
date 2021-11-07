<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\NasabahModel;
use App\Models\TransaksiModel;

class Nasabah extends BaseController
{
    public $nasabahModel;

	public function __construct()
    {
        $this->validation   = \Config\Services::validation();
        $this->nasabahModel = new NasabahModel;
    }

    /**
     * Dashboaard nasabah
     */
    public function dashboardNasabah()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token,false);
        $data   = [
            'title' => 'Nasabah | dashboard',
            'token' => $token,
        ];

        if ($result['success'] == false) {
            setcookie('token', null, -1, '/'); 
            unset($_COOKIE['token']); 

            return redirect()->to(base_url().'/login');
        } 
        else {
            setcookie('token',$token,time() + $result['expired'],'/');
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
            'title' => 'Nasabah | profile',
            'token' => $token,
        ];

        if ($result['success'] == false) {
            setcookie('token', null, -1, '/'); 
            unset($_COOKIE['token']); 
            return redirect()->to(base_url().'/login');
        } 
        else {
            setcookie('token',$token,time() + $result['expired'],'/');
            return view('Nasabah/profilenasabah',$data);
        }

    }

    public function cetakTransaksi(string $id)
    {
        $token  = [
            'value' =>  null,
            'user'  =>  '',
        ];

        if (isset($_COOKIE['token'])){
            $token  = [
                'value' => $_COOKIE['token'],
                'user'  => 'nasabah',
            ];
        } 
        else if (isset($_COOKIE['tokenAdmin'])) {
            $token  = [
                'value' => $_COOKIE['tokenAdmin'],
                'user'  => 'admin',
            ];
        }
        
        $result = $this->checkToken($token['value']);

        if ($token['value'] == null || $result['success'] == false) {
            if ($token['user'] == 'nasabah') {
                setcookie('token', null, -1, '/');
                unset($_COOKIE['token']);
            } 
            else {
                setcookie('tokenAdmin', null, -1, '/');
                unset($_COOKIE['tokenAdmin']);
            }
            
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
                    <th>".$key['jenis_sampah']."</th>
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

    /**
     * register
     *   url    : domain.com/nasabah/register
     *   method : POST
     */
    public function register(): object
    {
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
            $email        = trim($data['email']);
            $otp          = $this->generateOTP(6);

            $lastNasabah  = $this->nasabahModel->getLastNasabah($data['kodepos']);
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
                "email"        => $email,
                "username"     => trim($data['username']),
                // "password"     => password_hash(trim($data['password']), PASSWORD_DEFAULT),
                "password"     => $this->encrypt($data['password']),
                "nama_lengkap" => strtolower(trim($data['nama_lengkap'])),
                "notelp"       => trim($data['notelp']),
                "alamat"       => trim($data['alamat']),
                "tgl_lahir"    => trim($data['tgl_lahir']),
                "kelamin"      => $data['kelamin'],
                "otp"          => $otp,
                "created_at"   => (int)time(),
            ];

            $addNasabah = $this->nasabahModel->addNasabah($data);

            if ($addNasabah['success'] == true) {
                $sendEmail = $this->sendVerification($email,$otp);

                if ($sendEmail == true) {
                    $response = [
                        'status'   => 201,
                        "error"    => false,
                        'messages' => 'register success. please check your email',
                    ];
    
                    return $this->respond($response,201);
                } 
                else {
                    $response = [
                        'status'   => 500,
                        'error'    => true,
                        'messages' => $sendEmail,
                    ];
            
                    return $this->respond($response,500);
                }
                
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

    /**
     * Verifikasi akun
     *   url    : domain.com/nasabah/verification
     *   method : POST
     */
    public function verification(): object
    {
		$data   = $this->request->getPost();
        $this->validation->run($data,'codeOTP');
        $errors = $this->validation->getErrors();

        if($errors) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => $errors['code_otp'],
            ];
    
            return $this->respond($response,400);
        } 
        else {
            
            $email        = $this->request->getPost('code_otp');
            $editNasabah  = $this->nasabahModel->emailVerification($email);

            if ($editNasabah['success'] == true) {
                $response = [
                    'status'   => 201,
                    'error'    => false,
                    'messages' => $editNasabah['message'],
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

    /**
     * Login
     *   url    : domain.com/nasabah/login
     *   method : POST
     */
    public function login(): object
    {
		$data   = $this->request->getPost();
        $this->validation->run($data,'nasabahLogin');
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
            
            $nasabahData  = $this->nasabahModel->getNasabahByEmail($this->request->getPost("email"));

            if ($nasabahData['success'] == true) {
                $login_pass    = $this->request->getPost("password");
                $database_pass = $this->decrypt($nasabahData['message']['password']);
                
                // if (password_verify($login_pass,$database_pass)) {
                if ($login_pass === $database_pass) {
                    $is_verify = $nasabahData['message']['is_verify'];

                    if ($is_verify == 'f') {
                        $response = [
                            'status'   => 401,
                            'error'    => true,
                            'messages' => 'account is not verify',
                        ];
                
                        return $this->respond($response,401);
                    } 
                    else {
                        // database row id
                        $id           = $nasabahData['message']['id'];
                        // rememberMe check
                        $rememberme   = ($this->request->getPost("rememberme") == '1') ? true : false;
                        // generate new token
                        $token        = $this->generateToken(
                            $id,
                            $rememberme
                        );

                        // edit nasabah in database
                        $editNasabah = $this->nasabahModel->updateToken($id,$token);

                        if ($editNasabah['success'] == true) {
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
                            'password' => "password not match",
                        ],
                    ];
            
                    return $this->respond($response,404);
                }
            } 
            else {
                $response = [
                    'status'   => $nasabahData['code'],
                    'error'    => true,
                    'messages' => $nasabahData['message'],
                ];
        
                return $this->respond($response,$nasabahData['code']);
            }
        }
    }

    /**
     * Check nasabah session
     *   url    : domain.com/nasabah/sessioncheck
     *   method : GET
     */
    public function sessionCheck(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);

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
     * Get data profile
     *   url    : domain.com/nasabah/getprofile
     *   method : GET
     */
    public function getProfile(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);

        if ($result['success'] == true) {
            
            $id           = $result['message']['data']['id'];
            $dataNasabah  = $this->nasabahModel->getProfileNasabah($id);
            
            if ($dataNasabah['success'] == true) {
                $response = [
                    'status' => 200,
                    'error'  => false,
                    'data'   => $dataNasabah['message']
                ];

                return $this->respond($response,200);
            } 
            else {
                $response = [
                    'status'   => $dataNasabah['code'],
                    'error'    => true,
                    'messages' => $dataNasabah['message'],
                ];
        
                return $this->respond($response,$dataNasabah['code']);
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
     * Get saldo
     *   url    : domain.com/nasabah/getsaldo
     *   method : GET
     */
    public function getSaldo(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);

        if ($result['success'] == true) {
            
            $id        = $result['message']['data']['id'];
            $dataSaldo = $this->nasabahModel->getSaldoNasabah($id);
            
            if ($dataSaldo['success'] == true) {
                $response = [
                    'status' => 200,
                    'error'  => false,
                    'data'   => $dataSaldo['message']
                ];

                return $this->respond($response,200);
            } 
            else {
                $response = [
                    'status'   => $dataSaldo['code'],
                    'error'    => true,
                    'messages' => $dataSaldo['message'],
                ];
        
                return $this->respond($response,$dataSaldo['code']);
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
     * Edit profile
     *   url    : domain.com/nasabah/editprofile
     *   method : PUT
     */
    public function editProfile(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);

        if ($result['success'] == true) {
            $this->_methodParser('data');
            global $data;
            $data['id'] = $result['message']['data']['id']; 

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
                $dataNasabah  = $this->nasabahModel->db->table('nasabah')->select('password')->where("id",$id)->get()->getResultArray();

                if (!empty($dataNasabah)) {
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
                        "username"     => trim($data['username']),
                        "nama_lengkap" => strtolower(trim($data['nama_lengkap'])),
                        "notelp"       => trim($data['notelp']),
                        "alamat"       => trim($data['alamat']),
                        "tgl_lahir"    => trim($data['tgl_lahir']),
                        "kelamin"      => $data['kelamin'],
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

                    $editNasabah  = $this->nasabahModel->editProfileNasabah($data);

                    if ($editNasabah['success'] == true) {
                        $response = [
                            'status' => 201,
                            'error' => false,
                            'messages' => $editNasabah['message'],
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
     *   url    : domain.com/nasabah/logout
     *   method : DELETE
     */
    public function logout(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);

        if ($result['success'] == true) {
            
            $id           = $result['message']['data']['id'];
            $editNasabah  = $this->nasabahModel->setTokenNull($id);

            if ($editNasabah['success'] == true) {
                $response = [
                    'status' => 200,
                    'error' => false,
                    'messages' => $editNasabah['message'],
                ];

                return $this->respond($response,200);
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
     * Forgot password
     *   url    : domain.com/nasabah/forgotpass
     *   method : POST
     */
    public function forgotPassword(): object
    {
        $this->validation->run($_POST,'forgotPassword');
        $errors = $this->validation->getErrors();

        if($errors) {
            $response = [
                'status'   => 404,
                'error'    => true,
                'messages' => $errors['email'],
            ];
    
            return $this->respond($response,404);
        } 
        else {
            $email         = $this->request->getPost("email");
            $nasabahData   = $this->nasabahModel->getNasabahByEmail($email);
            $database_pass = $this->decrypt($nasabahData['message']['password']);
            $sendEmail     = $this->sendForgotPass($email,$database_pass);

            if ($sendEmail == true) {
                $response = [
                    'status'   => 200,
                    "error"    => false,
                    'messages' => 'password telah terkirim',
                ];

                return $this->respond($response,200);
            } 
            else {
                $response = [
                    'status'   => 500,
                    'error'    => true,
                    'messages' => $sendEmail,
                ];
        
                return $this->respond($response,500);
            }
        }
        
    }

    /**
     * Send kritik
     *   url    : domain.com/nasabah/sendkritik
     *   method : POST
     */
    public function sendKritik(): object
    {
        $this->validation->run($_POST,'kritikSaran');
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

            if ($sendEmail == true) {
                $response = [
                    'status'   => 201,
                    "error"    => false,
                    'messages' => 'kritik dan saran successfully sent',
                ];

                return $this->respond($response,201);
            } 
            else {
                $response = [
                    'status'   => 500,
                    'error'    => true,
                    'messages' => $sendEmail,
                ];
        
                return $this->respond($response,500);
            }
        }
        
    }
}