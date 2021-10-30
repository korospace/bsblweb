<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class BeritaAcaraModel extends Model
{
    protected $table         = 'berita_acara';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id','title','thumbnail','content','kategori','created_by','created_at'];

    public function getLastBerita(): array
    {
        try {
            $lastBerita = $this->db->table($this->table)->select('id')->orderBy('id','DESC')->get()->getResultArray();

            if (!empty($lastBerita)) { 
                return [
                    'success' => true,
                    'message' => $lastBerita[0]
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
                $berita = $this->db->table($this->table)->select("berita_acara.id,berita_acara.title,admin.nama_lengkap AS author,berita_acara.created_at,berita_acara.content")->join('admin', 'berita_acara.created_by = admin.id')->where("berita_acara.id",$get['id_berita'])->get()->getFirstRow();
            } 
            else if (isset($get['kategori']) && !isset($get['id_berita'])) {
                $berita = $this->db->table($this->table)->select('id,title,kategori,created_at,thumbnail')->where("kategori",$get['kategori'])->orderBy('created_at','DESC')->get()->getResultArray();
            } 
            else {
                $berita = $this->db->table($this->table)->select('id,title,kategori,created_at,thumbnail')->orderBy('created_at','DESC')->get()->getResultArray();
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

    public function getOldThumbnail(string $id): string
    {
        $oldThumbnail = $this->db->table($this->table)->select('thumbnail')->where('id',$id)->get()->getResultArray();
        
        if (!empty($oldThumbnail)) {    
            return $oldThumbnail[0]['thumbnail'];
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
