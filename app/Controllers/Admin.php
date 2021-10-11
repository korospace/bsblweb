<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\NasabahModel;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class Admin extends ResourceController
{
    public $basecontroller;
    public $adminModel;

	public function __construct()
    {
        $this->validation     = \Config\Services::validation();
        $this->baseController = new BaseController;
        $this->adminModel     = new AdminModel;
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
                    $last_active = $adminData['message']['last_active'];
                    $rangeTotal  = (3600*24)*30;
                    $privilege   = $adminData['message']['privilege'];

                    if (time()-$last_active >= $rangeTotal && $privilege != 'super') {
                        $response = [
                            'status'   => 401,
                            'error'    => true,
                            'messages' => 'account is no longer active',
                        ];
                
                        return $this->respond($response,401);
                    } 
                    else {
                        // database row id
                        $id           = $adminData['message']['id'];
                        // generate new token
                        $token        = $this->baseController->generateToken(
                            $id,
                            false,
                            $privilege,
                        );

                        // edit admin in database
                        $editAdmin = $this->adminModel->updateToken($id,$token);

                        if ($editAdmin['success'] == true) {
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
     * Session Check
     *   url    : domain.com/admin/sessioncheck
     *   method : GET
     */
    public function sessionCheck(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->baseController->checkToken($token,'admin');

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
        $result     = $this->baseController->checkToken($token,'admin');

        if ($result['success'] == true) {
            $id         = $result['message']['data']['id'];
            $dataAdmin  = $this->adminModel->getProfileAdmin($id);
            
            if ($dataAdmin['success'] == true) {
                $response = [
                    'status' => 200,
                    'error'  => false,
                    'data '  => $dataAdmin['message']
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
        $result     = $this->baseController->checkToken($token,'admin');

        if ($result['success'] == true) {
            $this->baseController->_methodParser('data');
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
                            return $this->fail(['old_password' => 'wrong old password'],401,true);
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
        $result     = $this->baseController->checkToken($token,'admin');

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
        $result     = $this->baseController->checkToken($token,'admin');

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
        $result     = $this->baseController->checkToken($token,'admin');

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
        $result     = $this->baseController->checkToken($token,'admin');

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
        $result     = $this->baseController->checkToken($token,'admin');

        if ($result['success'] == true) {
            $this->baseController->_methodParser('data');
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
                    ];
    
                    if ($newpass != '') {
                        $data['password'] = password_hash($newpass, PASSWORD_DEFAULT);
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
        $result     = $this->baseController->checkToken($token,'admin');

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
        $result     = $this->baseController->checkToken($token,'admin');

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
        $result     = $this->baseController->checkToken($token,'admin');

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
        $result     = $this->baseController->checkToken($token,'admin');

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
                $this->baseController->_methodParser('data');
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
                            // date_default_timezone_set('Asia/Jakarta');
                            // $data['last_active'] = date('Y-m-d H:i:s', time());
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
        $result     = $this->baseController->checkToken($token,'admin');

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
