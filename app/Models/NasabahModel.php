<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class NasabahModel extends Model
{
    protected $table         = 'nasabah';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id','id_nasabah','email','username','password','nama_lengkap','notelp','alamat','tgl_lahir','kelamin','token'];

    public function getLastNasabah(): array
    {
        try {
            $lastNasabah = $this->db->table($this->table)->select('id_nasabah')->orderBy('created_at','DESC')->get()->getResultArray();

            if (empty($lastNasabah)) {    
                return [
                    'success' => false,
                    'message' => "last nasabah notfound",
                    'code'    => 404
                ];
            } 
            else {   
                return [
                    'success' => true,
                    'message' => $lastNasabah[0]
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

    public function addNasabah(array $data): array
    {
        try {
            $query = $this->db->table($this->table)->insert($data);

            $query = $query ? true : false;
            
            if ($query == true) {
                return [
                    "success"  => true,
                    'message' => 'register nasabah success',
                ];
            } 
            else {   
                return [
                    'success' => false,
                    'message' => "register nasabah failed",
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

    public function emailVerification(string $otp): array
    {
        try {
            $data = [
                'is_verify' => true,
                'otp'       => null
            ];
    
            $this->db->table($this->table)->where('otp', $otp)->update($data);
            
            if ($this->db->affectedRows() > 0) {
                return [
                    "success"  => true,
                    'message' => 'verification success',
                ];
            } 
            else {   
                return [
                    'success' => false,
                    'message' => "code otp notfound",
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

    public function getNasabahByEmail(string $email): array
    {
        try {
            $dataNasabah = $this->db->table($this->table)->select("id,id_nasabah,password,is_verify")->where("email",$email)->get()->getResultArray();
            
            if (empty($dataNasabah)) {    
                return [
                    'success' => false,
                    'message' => [
                        'email' => "email not found",
                    ],
                    'code'    => 404
                ];
            } 
            else {   
                return [
                    'success' => true,
                    'message' => $dataNasabah[0]
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
            ];
    
            $this->db->table($this->table)->where('id',$id)->update($data);
            
            if ($this->db->affectedRows() > 0) {
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

    public function getProfileNasabah(string $id): array
    {
        try {
            $dataNasabah = $this->db->table($this->table)->select("id,id_nasabah,email,username,nama_lengkap,alamat,notelp,tgl_lahir,kelamin,created_at")->where("id",$id)->get()->getFirstRow();
            
            if (empty($dataNasabah)) {    
                return [
                    'success' => false,
                    'message' => "profile nasabah with id $id notfound",
                    'code'    => 404
                ];
            } else {   
                return [
                    'success' => true,
                    'message' => $dataNasabah
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

    public function editProfileNasabah(array $data): array
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
}
