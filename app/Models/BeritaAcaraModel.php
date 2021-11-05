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
            $lastBerita = $this->db->table($this->table)->select('id')->limit(1)->orderBy('id','DESC')->get()->getResultArray();

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
            if (isset($get['id']) && !isset($get['kategori'])) {
                $berita = $this->db->table($this->table)->select("id,title,kategori,created_at,content,thumbnail")->where("id",$get['id'])->get()->getFirstRow();
            } 
            else if (isset($get['kategori']) && !isset($get['id'])) {
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

    public function getOtherItem(string $id): array
    {
        try {
            $allBerita = [];
            $kategori  = $this->db->table($this->table)->select("kategori")->where("id",$id)->get()->getResultArray()[0]['kategori'];

            $firstId   = $this->db->table($this->table)->select('id')->where("kategori",$kategori)->limit(1)->orderBy('id','ASC')->get()->getResultArray()[0]['id'];
            $lastId    = $this->db->table($this->table)->select('id')->where("kategori",$kategori)->limit(1)->orderBy('id','DESC')->get()->getResultArray()[0]['id'];
            
            $prev       = 2;
            $prevBerita = $this->db->query("SELECT id,title,kategori,created_at FROM berita_acara WHERE kategori = '$kategori' AND id BETWEEN '$firstId' AND '$id' ORDER BY id DESC LIMIT $prev OFFSET 1")->getResultArray();
            
            $next       = 2 + ($prev-count($prevBerita));
            $nextBerita = $this->db->query("SELECT id,title,kategori,created_at FROM berita_acara WHERE kategori = '$kategori' AND id BETWEEN '$id' AND '$lastId' ORDER BY id ASC LIMIT $next OFFSET 1")->getResultArray();

            if (count($nextBerita) < 2 && count($prevBerita) == 2) {
                $limitNewNextB = 2-count($nextBerita);
                $newNextBerita = $this->db->query("SELECT id,title,kategori,created_at FROM berita_acara WHERE kategori = '$kategori' AND id BETWEEN '$firstId' AND '".$prevBerita[1]['id']."' ORDER BY id DESC LIMIT $limitNewNextB OFFSET 1")->getResultArray();
                
                foreach ($newNextBerita as $key) {
                    $nextBerita[] = $key;
                }
            }

            if (count($prevBerita) + count($nextBerita) < 4) {
                if (count($prevBerita) < 2) {
                    $limitNewPrevB = 2-count($prevBerita);
                    $newPrevBerita = $this->db->query("SELECT id,title,kategori,created_at FROM berita_acara WHERE kategori != '$kategori' ORDER BY id DESC LIMIT $limitNewPrevB")->getResultArray();
    
                    foreach ($newPrevBerita as $key) {
                        $prevBerita[] = $key;
                    }
                }
                if (count($nextBerita) < 2) {
                    $limitNewNextB = 2-count($nextBerita);
                    $newNextBerita = $this->db->query("SELECT id,title,kategori,created_at FROM berita_acara WHERE kategori != '$kategori' ORDER BY id ASC LIMIT $limitNewNextB")->getResultArray();
    
                    foreach ($newNextBerita as $key) {
                        $nextBerita[] = $key;
                    }
                }
            }

            foreach ($prevBerita as $key) {
                $allBerita[] = $key;
            }
            foreach ($nextBerita as $key) {
                $allBerita[] = $key;
            }

            if (empty($allBerita)) {    
                return [
                    'success' => false,
                    'message' => "berita notfound",
                    'code'    => 404
                ];
            } else {   
                return [
                    'success' => true,
                    'message' => $allBerita
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
