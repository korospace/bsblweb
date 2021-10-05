<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class AdminModel extends Model
{
    protected $table         = 'admin';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id','username','password','nama_lengkap','notelp','alamat','tgl_lahir','kelamin','privilage','active','token','last_active'];

    public function getLastAdmin(): array
    {
        try {
            $lastAdmin = $this->db->table($this->table)->select('id')->orderBy('created_at','DESC')->get()->getResultArray();

            if (!empty($lastAdmin)) { 
                return [
                    'success' => true,
                    'message' => $lastAdmin[0]
                ];
            }
            else {
                return [
                    'success' => false,
                    'message' => 'not found',
                    'code'    => 404
                ];
            }
        } 
        catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

    public function getAdminByUsername(string $username): array
    {
        try {
            $dataAdmin = $this->db->table($this->table)->select("id,password,privilege,last_active")->where("username",$username)->get()->getResultArray();

            if (empty($dataAdmin)) {    
                return [
                    'success' => false,
                    'message' => [
                        'username' => "username notfound",
                    ],
                    'code'    => 404
                ];
            } 
            else {   
                return [
                    'success' => true,
                    'message' => $dataAdmin[0]
                ];
            }
        } 
        catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

    public function updateToken(string $id,string $token): array
    {
        try {
            $data = [
                'token' => $token,
                'last_active' => time()
            ];

            $this->db->table($this->table)->where('id',$id)->update($data);
            
            if ($this->db->affectedRows() > 0) {
                // non active admin
                $this->nonActiveAdmin();

                return [
                    "success"  => true,
                    'message' => 'update new token is success',
                ];
            } 
            else {   
                return [
                    'success' => false,
                    'message' => "update new token is failed",
                    'code'    => 404
                ];
            }     
        } 
        catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

    public function getProfileAdmin(string $id): array
    {
        try {
            $dataAdmin = $this->db->table($this->table)->select("id,username,nama_lengkap,alamat,notelp,tgl_lahir,kelamin,created_at")->where("id",$id)->get()->getFirstRow();
            
            if (empty($dataAdmin)) {    
                return [
                    'success' => false,
                    'message' => "profile admin with id $id notfound",
                    'code'    => 404
                ];
            } else {   
                return [
                    'success' => true,
                    'message' => $dataAdmin
                ];
            }
        } 
        catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

    public function editProfileAdmin(array $data): array
    {
        try {
            $this->db->table($this->table)->where('id',$data['id'])->update($data);
            
            if ($this->db->affectedRows() > 0) {
                return [
                    "success"  => true,
                    'message' => 'edit profile is success',
                ];
            } 
            else {   
                return [
                    'success' => true,
                    'message' => "nothing updated",
                ];
            }  
        } 
        catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

    public function setTokenNull(string $id): array
    {
        try {
            $data = [
                'token' => null,
            ];
    
            $this->db->table($this->table)->where('id',$id)->update($data);
            
            if ($this->db->affectedRows() > 0) {
                return [
                    "success"  => true,
                    'message' => 'logout success',
                ];
            } 
            else {   
                return [
                    'success' => false,
                    'message' => "user not found",
                    'code'    => 404
                ];
            }     
        } 
        catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

    public function getNasabah(array $get): array
    {
        try {
            if (isset($get['id'])) {
                $nasabah = $this->db->table('nasabah')->select("id,email,username,nama_lengkap,alamat,notelp,tgl_lahir,kelamin,is_verify,created_at")->where("id",$get['id'])->get()->getFirstRow();
            } 
            else {
                $nasabah = $this->db->table('nasabah')->select("id,nama_lengkap,created_at")->orderBy('created_at','DESC')->get()->getResultArray();
            }
            
            if (empty($nasabah)) {    
                return [
                    'success' => false,
                    'message' => "nasabah notfound",
                    'code'    => 404
                ];
            } else {   
                return [
                    'success' => true,
                    'message' => $nasabah
                ];
            }
        } 
        catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

    public function deleteNasabah(string $id): array
    {
        try {
            $this->db->table('nasabah')->where('id', $id)->delete();
            
            if ($this->db->affectedRows() > 0) {
                return [
                    "success"  => true,
                    'message' => "delete nasabah with id $id is success",
                ];
            } 
            else {   
                return [
                    'success' => false,
                    'message' => "nasabah with id '$id' is not found",
                    'code'    => 404
                ];
            }     
        } 
        catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

    public function getAdmin(array $get,string $id_admin): array
    {
        try {
            if (isset($get['id_admin'])) {
                $admin = $this->db->table($this->table)->select("id,username,nama_lengkap,alamat,notelp,tgl_lahir,kelamin,privilege,active,last_active,created_at")->where("id",$get['id_admin'])->where("id !=",$id_admin)->get()->getFirstRow();
            } 
            else {
                $admin = $this->db->table($this->table)->select("id,nama_lengkap,privilege")->where("id !=",$id_admin)->get()->getResultArray();
            }
            
            if (empty($admin)) {    
                return [
                    'success' => false,
                    'message' => "admin notfound",
                    'code'    => 404
                ];
            } 
            else {   
                return [
                    'success' => true,
                    'message' => $admin
                ];
            }
        } 
        catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

    public function addAdmin(array $data): array
    {
        try {
            $query = $this->db->table($this->table)->insert($data);

            $query = $query ? true : false;
            
            if ($query == true) {
                return [
                    "success"  => true,
                    'message' => 'add new admin is success',
                ];
            } 
            else {   
                return [
                    'success' => false,
                    'message' => "add new admin is failed",
                    'code'    => 500
                ];
            } 
        } 
        catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

    public function deleteAdmin(string $id,string $id_admin): array
    {
        try {
            $this->db->table($this->table)->where('id', $id)->where('id !=', $id_admin)->delete();
            
            if ($this->db->affectedRows() > 0) {
                return [
                    "success"  => true,
                    'message' => "delete admin with id $id is success",
                ];
            } 
            else {   
                return [
                    'success' => false,
                    'message' => "admin with id '$id' is not found",
                    'code'    => 404
                ];
            }     
        } 
        catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

    public function nonActiveAdmin(): void
    {
        try {
            $timeNow    = time();
            $rangeTotal = (3600*24)*30;
            $builder    = $this->db;
            $admins     = $builder->query("SELECT id FROM admin WHERE $timeNow-last_active >= $rangeTotal")->getResultArray();
            
            // var_dump((time()-1633184363)/60);
            // var_dump($admins);die;

            foreach ($admins as $admin) {
                $data = [
                    'active' => false,
                ];
        
                $this->db->table($this->table)->where('id',$admin['id'])->update($data);
            }
        } 
        catch (Exception $e) {
            
        }
    }
}
