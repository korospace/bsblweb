<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class BeritaAcaraModel extends Model
{
    protected $table         = 'berita_acara';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['title','thumbnail','content','kategori','created_by'];

    public function addItem(array $data): array
    {
        try {
            $query = $this->db->table($this->table)->insert($data);

            $query = $query ? true : false;
            
            if ($query == true) {
                return [
                    "success"  => true,
                    'message' => 'add new berita is success',
                ];
            } 
            else {   
                return [
                    'success' => false,
                    'message' => "add new beritas is failed",
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
            if (isset($get['id_berita']) && !isset($get['kategori'])) {
                $berita = $this->db->table($this->table)->select("berita_acara.id,berita_acara.title,berita_acara.kategori,admin.nama_lengkap AS author,berita_acara.created_at,berita_acara.content,berita_acara.thumbnail")->join('admin', 'berita_acara.created_by = admin.id_admin')->where("berita_acara.id",$get['id_berita'])->get()->getFirstRow();
            } 
            else if (isset($get['kategori']) && !isset($get['id_berita'])) {
                $berita = $this->db->table($this->table)->select('id,title,kategori,created_at,thumbnail')->where("kategori",$get['kategori'])->get()->getResultArray();
            } 
            else {
                $berita = $this->db->table($this->table)->select('id,title,kategori,created_at,thumbnail')->get()->getResultArray();
            }
            
            if (empty($berita)) {    
                return [
                    'success' => false,
                    'message' => "berita notfound",
                    'code'    => 404
                ];
            } else {   
                return [
                    'success' => true,
                    'message' => $berita
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
                    "success"  => true,
                    'message' => 'edit berita is success',
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
                    'message' => "delete berita with id $id is success",
                ];
            } 
            else {   
                return [
                    'success' => false,
                    'message' => "berita with id $id is not found",
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
