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
            setcookie('token',$token,$this->cookieOps($result['data']['expired']));
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
            return redirect()->to(base_url().'/login/admin');
        } 
        else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,$this->cookieOps($result['data']['expired']));
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
            return redirect()->to(base_url().'/login/admin');
        } 
        else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,$this->cookieOps($result['data']['expired']));
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
            return redirect()->to(base_url().'/login/admin');
        } 
        else if($result['data']['privilege'] != 'superadmin') {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,$this->cookieOps($result['data']['expired']));
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
            return redirect()->to(base_url().'/login/admin');
        } 
        else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,$this->cookieOps($result['data']['expired']));
            $data['password']  = $result['data']['password'];
            $data['privilege'] = $result['data']['privilege'];
            return view('Admin/listNasabah',$data);
        }
    }

    // List kategori artikel page
    public function kategoriArtikelView()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        $data   = [
            'title' => 'Admin | kategori artikel',
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
            setcookie('token',$token,$this->cookieOps($result['data']['expired']));
            $data['password']  = $result['data']['password'];
            $data['privilege'] = $result['data']['privilege'];
            return view('Admin/kategoriArtikel',$data);
        }
    }
    
    // List penghargaan page
    public function listPenghargaanView()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        $data   = [
            'title' => 'Admin | list penghargaan',
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
            setcookie('token',$token,$this->cookieOps($result['data']['expired']));
            $data['password']  = $result['data']['password'];
            $data['privilege'] = $result['data']['privilege'];
            return view('Admin/listPenghargaan',$data);
        }
    }

    // List mitra page
    public function listMitraView()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token, false);

        $data   = [
            'title' => 'Admin | list mitra',
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
            setcookie('token',$token,$this->cookieOps($result['data']['expired']));
            $data['password']  = $result['data']['password'];
            $data['privilege'] = $result['data']['privilege'];
            return view('Admin/listMitra',$data);
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
            return redirect()->to(base_url().'/login/admin');
        } 
        else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,$this->cookieOps($result['data']['expired']));
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
            return redirect()->to(base_url().'/login/admin');
        }  
        else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,$this->cookieOps($result['data']['expired']));
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
                return redirect()->to(base_url().'/login/admin');
            } 
            else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
                return redirect()->to(base_url().'/notfound');
            } 
            else {
                setcookie('token',$token,$this->cookieOps($result['data']['expired']));
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
            return redirect()->to(base_url().'/login/admin');
        } 
        else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,$this->cookieOps($result['data']['expired']));
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
                return redirect()->to(base_url().'/login/admin');
            } 
            else if(!in_array($result['data']['privilege'],['admin','superadmin'])) {
                return redirect()->to(base_url().'/notfound');
            } 
            else {
                setcookie('token',$token,$this->cookieOps($result['data']['expired']));
                $data['password']  = $result['data']['password'];
                $data['privilege'] = $result['data']['privilege'];
                return view('Admin/detilNasabah',$data);
            }
        }
        else {
            return redirect()->to(base_url().'/admin/listnasabah');
        }
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
     * Total account
     *   url    : - domain.com/admin/totalakun
     *   method : GET
     */
    public function totalAkun()
    {
        $result    = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $dbrespond = $this->userModel->totalAkun();

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
        
        $this->validation->run($data,'idNasabahValidate');
        $this->validation->run($data,'editProfileNasabahByAdmin');
        $this->validation->run($data,'isVerifyValidate');
        if (isset($data['email']) && $data['email'] != "") {
            $this->validation->run($data,'emailValidateById');
        }
        if (isset($data['tgl_lahir']) && $data['tgl_lahir'] != "") {
            $this->validation->run($data,'tglLahirValidate');
        }
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
                "email"        => isset($data['email']) && $data['email'] != "" ? trim($data['email']) : null,
                "nama_lengkap" => strtolower(trim($data['nama_lengkap'])),
                "nik"          => $data['nik'] ? trim($data['nik']) : null,
                "notelp"       => $data['notelp'] ? trim($data['notelp']) : null,
                "alamat"       => $data['alamat'] ? trim($data['alamat']) : null,
                "tgl_lahir"    => isset($data['tgl_lahir']) && $data['tgl_lahir'] != "" ? trim($data['tgl_lahir']) : null,
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
                "notelp"       => $data['notelp'] ? trim($data['notelp']) : null,
                "alamat"       => $data['alamat'] ? trim($data['alamat']) : null,
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
