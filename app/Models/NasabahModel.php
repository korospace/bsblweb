<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class NasabahModel extends Model
{
    protected $table         = 'nasabah';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id','email','username','password','nama_lengkap','notelp','alamat','tgl_lahir','kelamin','token'];

    public function getLastNasabah(): array
    {
        try {
            $lastNasabah = $this->db->table($this->table)->select('id')->orderBy('created_at','DESC')->get()->getResultArray();

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
            $this->db->transBegin();

            $this->db->query("INSERT INTO nasabah(id,email,username,password,nama_lengkap,notelp,alamat,tgl_lahir,kelamin) VALUES('".$data['id']."','".$data['email']."','".$data['username']."','".$data['password']."','".$data['nama_lengkap']."','".$data['alamat']."','".$data['tgl_lahir']."','".$data['kelamin']."')");
            $this->db->query("INSERT INTO dompet_uang (id_nasabah) VALUES('".$data['id']."')");
            $this->db->query("INSERT INTO dompet_emas (id_nasabah) VALUES('".$data['id']."')");

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return [
                    'success' => false,
                    'message' => "register nasabah failed",
                    'code'    => 500
                ];
            } 
            else {
                $this->db->transCommit();
                return [
                    "success"  => true,
                    'message' => 'register nasabah success',
                ];
            }
        } 
        catch (Exception $e) {
            $this->db->transRollback();
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

    public function createDompetUang(string $id): array
    {
        try {
            $query = $this->db->table('dompet_uang')->insert(['id_nasabah' => $id]);

            $query = $query ? true : false;
            
            if ($query == true) {
                return [
                    'success' => true,
                    'message' => 'create dompet uang success'
                ];
            }
        } 
        catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function createDompetEmas(string $id): array
    {
        try {
            $query = $this->db->table('dompet_emas')->insert(['id_nasabah' => $id]);

            $query = $query ? true : false;
            
            if ($query == true) {
                return [
                    'success' => true,
                    'message' => 'create dompet emas success'
                ];
            }
        } 
        catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
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
            $dataNasabah = $this->db->table($this->table)->select("id,password,is_verify")->where("email",$email)->get()->getResultArray();
            
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
            $dataNasabah = $this->db->table($this->table)->select("id,email,username,nama_lengkap,alamat,notelp,tgl_lahir,kelamin,created_at")->where("id",$id)->get()->getFirstRow();
            
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
