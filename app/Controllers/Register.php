<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\RegisterModel;

class Register extends BaseController
{
    public $registerModel;

	public function __construct()
    {
        $this->registerModel = new RegisterModel;
    }

    /**
     * Regsiter Page for Nasabah
     */
    public function registerNasabahView()
    {
        $data = [
            'title' => 'Nasabah | register'
        ];

        $token     = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result    = $this->checkToken($token, false);
        $privilege = (isset($result['privilege'])) ? $result['privilege'] : null;
        
        if ($token == null) {
            return view('RegisterNasabah/index',$data);
        } 
        else {
            if ($privilege == 'nasabah') {
                return redirect()->to(base_url().'/nasabah');
            } 
            else {
                return redirect()->to(base_url().'/admin');
            }
        }
    }

    /**
     * Nasabah Regsiter
     *   url    : domain.com/register/nasabah
     *   method : POST
     */
    public function nasabahRegister(): object
    {
        $result = '';
        if ($this->request->getHeader('token')) {
            $result = $this->checkToken();
        }

		$data   = $this->request->getPost();
        $this->validation->run($data,'nasabahRegisterValidate');
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
            // create id nasabah
            $idNasabah  = '';
            $dbrespond  = $this->registerModel->getLastNasabah($data['kodepos']);

            if ($dbrespond['status'] == 200) {
                $lastID = $dbrespond['data']['id'];
                $lastID = (int)substr($lastID,9)+1;
                // $lastID = sprintf('%06d',$lastID);

                $idNasabah = $data['kodepos'].$this->request->getPost("rt").$this->request->getPost("rw").$lastID;
            }
            else if ($dbrespond['status'] == 404) {
                $idNasabah = $data['kodepos'].$this->request->getPost("rt").$this->request->getPost("rw").'1';
            } 
            else {
                return $this->respond($dbrespond,$dbrespond['status']);
            }
            
            $email = trim($data['email']);
            $otp   = $this->generateOTP(6);
            $data  = [
                "id"           => $idNasabah,
                "email"        => $email,
                "username"     => trim($data['username']),
                "password"     => $this->encrypt($data['password']),
                "nama_lengkap" => strtolower(trim($data['nama_lengkap'])),
                "notelp"       => trim($data['notelp']),
                "nik"          => trim($data['nik']),
                "alamat"       => trim($data['alamat']),
                "tgl_lahir"    => trim($data['tgl_lahir']),
                "kelamin"      => $data['kelamin'],
                "is_active"    => true,
                "last_active"  => (int)time(),
                "created_at"   => (int)time(),
                "privilege"    => 'nasabah',
                "otp"          => $otp,
                "wilayah"      => [
                    'id_user'   => $idNasabah,
                    'kodepos'   => trim($data['kodepos']),
                    "kelurahan" => strtolower(trim($data['kelurahan'])),
                    "kecamatan" => strtolower(trim($data['kecamatan'])),
                    "kota"      => strtolower(trim($data['kota'])),
                    "provinsi"  => strtolower(trim($data['provinsi'])),
                ],
            ];

            if ($this->request->getHeader('token')) {
                if (in_array($result['data']['privilege'],['admin','superadmin'])) {
                    $data['is_verify'] = true;
                }
            }

            $dbrespond = $this->registerModel->addNasabah($data);

            if ($dbrespond['error'] == false) {
                $sendEmail = $this->sendOtpToEmail($email,$otp);

                if ($sendEmail == true) {
                    $this->registerModel->transCommit();
                } 
                else {
                    $this->registerModel->transRollback();

                    $response = [
                        'status'   => 500,
                        'error'    => true,
                        'messages' => $sendEmail,
                    ];
            
                    return $this->respond($response,500);
                }
                
            } 
    
            return $this->respond($dbrespond,$dbrespond['status']);
        }
    }

    /**
     * Add admin
     *   url    : domain.com/register/admin
     *   method : POST
     */
    public function adminRegister(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],'superadmin');

        $data   = $this->request->getPost();
        $this->validation->run($data,'adminRegisterValidate');
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
            // create id admin
            $idAdmin    = '';
            $lastAdmin  = $this->registerModel->getLastAdmin();

            if ($lastAdmin['status'] == 200) {
                $lastID  = $lastAdmin['data']['id'];
                $lastID  = (int)substr($lastID,1)+1;
                $lastID  = sprintf('%03d',$lastID);
                $idAdmin = 'A'.$lastID;
            } 
            else {
                return $this->respond($lastAdmin,$lastAdmin['status']);
            }
            
            $data = [
                "id"           => $idAdmin,
                "email"        => trim($data['username']).'@gmail.com',
                "username"     => trim($data['username']),
                "password"     => password_hash(trim($data['password']), PASSWORD_DEFAULT),
                "nama_lengkap" => strtolower(trim($data['nama_lengkap'])),
                "notelp"       => trim($data['notelp']),
                "nik"          => $this->generateOTP(16),
                "alamat"       => trim($data['alamat']),
                "tgl_lahir"    => trim($data['tgl_lahir']),
                "kelamin"      => strtolower(trim($data['kelamin'])),
                "is_active"    => true,
                "last_active"  => (int)time(),
                "created_at"   => (int)time(),
                "privilege"    => strtolower(trim($data['privilege'])),
                "is_verify"    => true,
            ];

            $dbrespond = $this->registerModel->addAdmin($data);
    
            return $this->respond($dbrespond,$dbrespond['status']);
        }
    }
}
