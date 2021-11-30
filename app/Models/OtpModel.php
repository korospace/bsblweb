<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class OtpModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['otp','is_verify'];

    public function verifyOtp(string $codeOtp): array
    {
        try {
            $data = [
                'otp'       => null,
                'is_verify' => true,
            ];
    
            $this->db->table($this->table)->where('otp', $codeOtp)->update($data);
            $affectedRows = $this->db->affectedRows();

            return [
                'status'   => ($affectedRows>0) ? 201   : 404,
                'error'    => ($affectedRows>0) ? false : true,
                'messages' => ($affectedRows>0) ? 'verification success' : 'code otp notfound'
            ];         
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
