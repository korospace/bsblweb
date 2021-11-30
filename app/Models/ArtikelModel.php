<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ArtikelModel extends Model
{
    protected $table         = 'artikel';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id','title','thumbnail','content','id_kategori','created_by','created_at'];

    public function getLastArtikel(): array
    {
        try {
            $lastArtikel = $this->db->table($this->table)->select('id')->limit(1)->orderBy('id','DESC')->get()->getResultArray();

            if (!empty($lastArtikel)) { 
                return [
                    'status' => 200,
                    'error'  => false,
                    'data'   => $lastArtikel[0],
                ];
            }
            else {   
                return [
                    'status'   => 404,
                    'error'    => true,
                    'messages' => 'not found',
                ];
            } 
        } 
        catch (Exception $e) {
            return [
                'status'   => 500,
                'error'    => true,
                'messages' => $e->getMessage(),
            ];
        }
    }

    public function addArtikel(array $data): array
    {
        try {
            $query = $this->db->table($this->table)->insert($data);

            if ($query == true) {
                return [
                    'status'   => 201,
                    'error'    => false,
                    'messages' => 'add artikel is success',
                ];
            } 
        } 
        catch (Exception $e) {
            return [
                'status'   => 500,
                'error'    => true,
                'messages' => $e->getMessage(),
            ];
        }
    }

    public function getOldThumbnail(string $id): string
    {
        $oldThumbnail = $this->db->table($this->table)->select('thumbnail')->where('id',$id)->get()->getResultArray()[0]['thumbnail'];
        
        if (!empty($oldThumbnail)) {    
            return $oldThumbnail;
        } 
    }

    public function editArtikel(array $data): array
    {
        try {
            $this->db->table($this->table)->where('id',$data['id'])->update($data);
            
            return [
                'status'   => 201,
                'error'    => false,
                'messages' => ($this->db->affectedRows()>0) ? 'edit artikel is success' : 'nothing updated'
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

    public function deleteArtikel(string $id): array
    {
        try {
            $this->db->table($this->table)->where('id', $id)->delete();
            $affectedRows = $this->db->affectedRows();

            return [
                'status'   => ($affectedRows>0) ? 201   : 404,
                'error'    => ($affectedRows>0) ? false : true,
                'messages' => ($affectedRows>0) ? "delete artikel with id $id is success" : "artikel with id $id is not found"
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

    public function getArtikel(array $get): array
    {
        try {
            $orderby = (isset($get['orderby']) && $get['orderby']=='terbaru')? 'DESC': 'ASC';

            if (isset($get['id']) && !isset($get['kategori'])) {
                $berita = $this->db->table($this->table)
                ->select("artikel.id,artikel.title,artikel.id_kategori,kategori_artikel.name AS kategori,users.nama_lengkap AS penulis,artikel.created_at,artikel.thumbnail,artikel.content")
                ->join('kategori_artikel', 'kategori_artikel.id = artikel.id_kategori')
                ->join('users', 'users.id = artikel.created_by')
                ->where("artikel.id",$get['id'])->get()->getFirstRow();
            } 
            else if (isset($get['kategori']) && !isset($get['id'])) {
                $berita = $this->db->table($this->table)->select('artikel.id,artikel.title,kategori_artikel.name AS kategori,users.nama_lengkap AS penulis,artikel.created_at,artikel.thumbnail')
                ->join('kategori_artikel', 'kategori_artikel.id = artikel.id_kategori')
                ->join('users', 'users.id = artikel.created_by')
                ->where("kategori_artikel.name",$get['kategori'])
                ->orderBy('artikel.created_at',$orderby)->get()->getResultArray();
            } 
            else {
                $berita = $this->db->table($this->table)->select('artikel.id,artikel.title,kategori_artikel.name AS kategori,users.nama_lengkap AS penulis,artikel.created_at,artikel.thumbnail')
                ->join('kategori_artikel', 'kategori_artikel.id = artikel.id_kategori')
                ->join('users', 'users.id = artikel.created_by')
                ->orderBy('artikel.created_at',$orderby)->get()->getResultArray();
            }
            
            if (empty($berita)) {    
                return [
                    'status'   => 404,
                    'error'    => true,
                    'messages' => "artikel notfound",
                ];
            } 
            else {   
                return [
                    'status' => 200,
                    'error'  => false,
                    'data'   => $berita
                ];
            }
        } 
        catch (Exception $e) {
            return [
                'status'   => 500,
                'error'    => true,
                'messages' => $e->getMessage(),
            ];
        }
    }

    public function getRelatedArtikel(string $id): array
    {
        try {
            $allBerita  = [];
            $idKategori = $this->db->table($this->table)->select("id_kategori")->where("id",$id)->get()->getResultArray()[0]['id_kategori'];

            $firstId   = $this->db->table($this->table)->select('id')->where("id_kategori",$idKategori)->limit(1)->orderBy('id','ASC')->get()->getResultArray()[0]['id'];
            $lastId    = $this->db->table($this->table)->select('id')->where("id_kategori",$idKategori)->limit(1)->orderBy('id','DESC')->get()->getResultArray()[0]['id'];
            
            $limitPrev  = 2;
            $prevBerita = $this->db->query("SELECT artikel.id,artikel.title,kategori_artikel.name AS kategori,artikel.created_at,artikel.thumbnail 
            FROM artikel 
            JOIN kategori_artikel ON(artikel.id_kategori = kategori_artikel.name) 
            WHERE artikel.id_kategori = '$idKategori' 
            AND artikel.id BETWEEN '$firstId' AND '$id' 
            ORDER BY artikel.id DESC LIMIT $limitPrev OFFSET 1")->getResultArray();
            
            $limitNext  = 2 + ($limitPrev-count($prevBerita));
            $nextBerita = $this->db->query("SELECT artikel.id,artikel.title,kategori_artikel.name AS kategori,artikel.created_at,artikel.thumbnail 
            FROM artikel 
            JOIN kategori_artikel ON(artikel.id_kategori = kategori_artikel.name) 
            WHERE artikel.id_kategori = '$idKategori' 
            AND artikel.id BETWEEN '$id' AND '$lastId '
            ORDER BY artikel.id ASC LIMIT $limitNext OFFSET 1")->getResultArray();

            if (count($nextBerita) < 2 && count($prevBerita) == 2) {
                $limitNewNext  = 2-count($nextBerita);
                $newNextBerita = $this->db->query("SELECT artikel.id,artikel.title,kategori_artikel.name AS kategori,artikel.created_at,artikel.thumbnail 
                FROM artikel 
                JOIN kategori_artikel ON(artikel.id_kategori = kategori_artikel.name)
                WHERE artikel.id_kategori = '$idKategori' 
                AND artikel.id BETWEEN '$firstId' AND '".$prevBerita[1]['id']."' ORDER BY artikel.id DESC LIMIT $limitNewNext OFFSET 1")->getResultArray();
                
                foreach ($newNextBerita as $key) {
                    $nextBerita[] = $key;
                }
            }

            foreach ($prevBerita as $key) {
                $allBerita[] = $key;
            }
            foreach ($nextBerita as $key) {
                $allBerita[] = $key;
            }

            if (count($prevBerita) + count($nextBerita) < 4) {
                $limitOtherKat = 4-(count($prevBerita) + count($nextBerita));
                $otherKat = $this->db->query("SELECT artikel.id,artikel.title,kategori_artikel.name AS kategori,artikel.created_at,artikel.thumbnail 
                FROM artikel 
                JOIN kategori_artikel ON(artikel.id_kategori = kategori_artikel.id)
                WHERE artikel.id_kategori != '$idKategori' 
                ORDER BY artikel.id DESC LIMIT $limitOtherKat")->getResultArray();

                foreach ($otherKat as $key) {
                    $allBerita[] = $key;
                }
            }

            if (empty($allBerita)) {    
                return [
                    'status'   => 404,
                    'error'    => true,
                    'messages' => "related artikel notfound",
                ];
            } 
            else {   
                return [
                    'status' => 200,
                    'error'  => false,
                    'data'   => $allBerita
                ];
            }
        } 
        catch (Exception $e) {
            return [
                'status'   => 500,
                'error'    => true,
                'messages' => $e->getMessage(),
            ];
        }
    }
}
