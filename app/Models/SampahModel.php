<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class SampahModel extends Model
{
    protected $table         = 'sampah';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id','id_kategori','jenis','harga'];

    public function getLastSampah(): array
    {
        try {
            $lastSampah = $this->db->table($this->table)->select('id')->orderBy('id','DESC')->get()->getResultArray();

            if (!empty($lastSampah)) { 
                return [
                    'success' => true,
                    'message' => $lastSampah[0]
                ];
            }
            else {   
                return [
                    'success' => false,
                    'message' => "not found",
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
                    'message' => 'add new sampah is success',
                ];
            } 
            else {   
                return [
                    'success' => false,
                    'message' => "add new sampah is failed",
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

    public function getItem(array $get): array
    {
        try {
            if (isset($get['kategori'])) {
                $sampah = $this->db->table($this->table)->select("sampah.id,kategori_sampah.name AS kategori,sampah.jenis,sampah.harga")->join('kategori_sampah','sampah.id_kategori = kategori_sampah.id')->where("sampah.id_kategori",$get['kategori'])->get()->getResultArray();
            } 
            else {
                $sampah = $this->db->table($this->table)->select('sampah.id,kategori_sampah.name AS kategori,sampah.jenis,sampah.harga')->join('kategori_sampah','sampah.id_kategori = kategori_sampah.id')->get()->getResultArray();
            }
            
            if (empty($sampah)) {    
                return [
                    'success' => false,
                    'message' => "sampah notfound",
                    'code'    => 404
                ];
            } 
            else {   
                return [
                    'success' => true,
                    'message' => $sampah
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

    public function editItem(array $data): array
    {
        try {
            $this->db->table($this->table)->where('id',$data['id'])->update($data);
            
            if ($this->db->affectedRows() > 0) {
                return [
                    "success" => true,
                    'message' => 'edit sampah is success',
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

    public function deleteItem(string $id): array
    {
        try {
            $this->db->table($this->table)->where('id', $id)->delete();
            
            if ($this->db->affectedRows() > 0) {
                return [
                    "success"  => true,
                    'message' => "delete sampah with id $id is success",
                ];
            } 
            else {   
                return [
                    'success' => false,
                    'message' => "sampah with id $id is not found",
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
