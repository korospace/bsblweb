<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class LoginModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id','token','last_active'];

    // get data nasabah by email
    public function getNasabahByEmail(string $email): array
    {
        try {
            $dataNasabah = $this->db->table($this->table)->select("id,password,is_verify")->where("email",$email)->where("privilege",'nasabah')->get()->getResultArray();
            
            return [
                'status'   => (empty($dataNasabah)) ? 404  : 200,
                'error'    => (empty($dataNasabah)) ? true : false,
                'messages' => (empty($dataNasabah)) ? ['email' => "email not found"] : $dataNasabah[0],
            ];
        } 
        catch (Exception $e) {
            return [
                'status'   => 500,
                'error'    => true,
                'messages' => $e->getMessage(),
            ];
        }
    }

    // get data admin by username
    public function getAdminByUsername(string $username): array
    {
        try {
            $dataAdmin = $this->db->table($this->table)->select("id,password,privilege,is_active,last_active")->where("username",$username)->where("privilege!=",'nasabah')->get()->getResultArray();

            return [
                'status'   => (empty($dataAdmin)) ? 404  : 200,
                'error'    => (empty($dataAdmin)) ? true : false,
                'messages' => (empty($dataAdmin)) ? ['username' => "username notfound"] : $dataAdmin[0],
            ];
        } 
        catch (Exception $e) {
            return [
                'error'    => true,
                'messages' => $e->getMessage(),
                'code'     => 500
            ];
        }
    }

    // update nasabah Otp
    public function updateNasabahOtp(string $email,string $codeOtp): array
    {
        try {
            $this->db->table($this->table)->where('email',$email)->update(['otp' => $codeOtp]);
            
            if ($this->db->affectedRows() > 0) {
                return [
                    'error'   => false,
                    'message' => 'update otp success',
                    'code'    => 200
                ];
            } 
        } 
        catch (Exception $e) {
            return [
                'error'   => true,
                'message' => $e->getMessage(),
                'code'    => 500
            ];
        }
    }

    // update user token
    public function updateUserLogin(array $dataLogin): array
    {
        try {
            $this->db->table($this->table)->where('id',$dataLogin['id'])->update($dataLogin);
            
            if ($this->db->affectedRows() > 0) {
                return [
                    'status'  => 200,
                    'error'   => false,
                    'message' => 'login success',
                    'token'   => $dataLogin['token'],
                ];
            } 
        } 
        catch (Exception $e) {
            return [
                'status'  => 500,
                'error'   => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}
