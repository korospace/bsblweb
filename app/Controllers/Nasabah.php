<?php

namespace App\Controllers;

use App\Models\NasabahModel;
use App\Models\SampahModel;
use App\Controllers\BaseController;
use CodeIgniter\Model;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class Nasabah extends ResourceController
{
    public $basecontroller;
    public $nasabahModel;

	public function __construct()
    {
        $this->validation     = \Config\Services::validation();
        $this->baseController = new BaseController;
        $this->nasabahModel   = new NasabahModel;
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
            $otp          = $this->baseController->generateOTP(6);

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
                "password"     => password_hash(trim($data['password']), PASSWORD_DEFAULT),
                "nama_lengkap" => strtolower(trim($data['nama_lengkap'])),
                "notelp"       => trim($data['notelp']),
                "alamat"       => trim($data['alamat']),
                "tgl_lahir"    => trim($data['tgl_lahir']),
                "kelamin"      => $data['kelamin'],
                "otp"          => $otp,
            ];

            $addNasabah = $this->nasabahModel->addNasabah($data);

            if ($addNasabah['success'] == true) {
                $sendEmail = $this->baseController->sendVerification($email,$otp);

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
                $database_pass = $nasabahData['message']['password'];

                if (password_verify($login_pass,$database_pass)) {
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
                        $token        = $this->baseController->generateToken(
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
                                'token   ' => $token
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
        $result     = $this->baseController->checkToken($token,'nasabah');

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
        $result     = $this->baseController->checkToken($token,'nasabah');

        if ($result['success'] == true) {
            
            $id           = $result['message']['data']['id'];
            $dataNasabah  = $this->nasabahModel->getProfileNasabah($id);
            
            if ($dataNasabah['success'] == true) {
                $response = [
                    'status' => 200,
                    'error'  => false,
                    'data '  => $dataNasabah['message']
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
        $result     = $this->baseController->checkToken($token,'nasabah');

        if ($result['success'] == true) {
            
            $id        = $result['message']['data']['id'];
            $dataSaldo = $this->nasabahModel->getSaldoNasabah($id);
            
            if ($dataSaldo['success'] == true) {
                $response = [
                    'status' => 200,
                    'error'  => false,
                    'data '  => $dataSaldo['message']
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
        $result     = $this->baseController->checkToken($token,'nasabah');

        if ($result['success'] == true) {
            $this->baseController->_methodParser('data');
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
                        if (password_verify($oldpass,$dataNasabah[0]['password'])) {
                            $data['password'] = password_hash($newpass, PASSWORD_DEFAULT);
                            unset($data['new_password']);
                            unset($data['old_password']);
                        } 
                        else {
                            return $this->fail(["old_password" => "wrong old password"],401,true);
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
        $result     = $this->baseController->checkToken($token,'nasabah');

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
            $sendEmail = $this->baseController->sendKritikSaran($_POST['name'],$_POST['email'],$_POST['message']);

            if ($sendEmail == true) {
                $response = [
                    'status'   => 200,
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