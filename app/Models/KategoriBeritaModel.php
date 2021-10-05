<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class KategoriBeritaModel extends Model
{
    protected $table         = 'kategori_berita';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id','name'];

    public function getLastKategori(): array
    {
        try {
            $lastKategori = $this->db->table($this->table)->select('id')->orderBy('id','DESC')->get()->getResultArray();

            if (!empty($lastKategori)) { 
                return [
                    'success' => true,
                    'message' => $lastKategori[0]
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

    public function addItem(array $data): array
    {
        try {
            $query = $this->db->table($this->table)->insert($data);

            $query = $query ? true : false;
            
            if ($query == true) {
                return [
                    "success"  => true,
                    'message' => 'add new kategori is success',
                ];
            } 
            else {   
                return [
                    'success' => false,
                    'message' => "add new kategori is failed",
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

    public function getItem(): array
    {
        try {
            $kategori = $this->db->table($this->table)->get()->getResultArray();
            
            if (empty($kategori)) {    
                return [
                    'success' => false,
                    'message' => "kategori notfound",
                    'code'    => 404
                ];
            } else {   
                return [
                    'success' => true,
                    'message' => $kategori
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

    public function deleteItem(string $id): array
    {
        try {
            $this->db->table($this->table)->where('id', $id)->delete();
            
            if ($this->db->affectedRows() > 0) {
                return [
                    "success"  => true,
                    'message' => "delete kategori with id $id is success",
                ];
            } 
            else {   
                return [
                    'success' => false,
                    'message' => "kategori with id $id is not found",
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
