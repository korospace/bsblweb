<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class SampahModel extends Model
{
    protected $table         = 'sampah';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id','kategori','jenis','harga'];

    public function getLastSampah(): array
    {
        try {
            $lastSampah = $this->db->table($this->table)->select('id')->limit(1)->orderBy('id','DESC')->get()->getResultArray();

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

    public function getItem(bool $isAdmin): array
    {
        try {
            if ($isAdmin) {
                $select = "id,kategori,jenis,harga,jumlah";
            }
            else {
                $select = "kategori,jenis,harga";
            }

            $sampah = $this->db->table($this->table)->select($select)->orderBy('id','ASC')->get()->getResultArray();
            
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

    public function totalItem(?string $idnasabah = null): array
    {
        try {
            $totalSampah = [];
            $kategori    = $this->db->table('kategori_sampah')->get()->getResultArray();

            // var_dump($kategori);die;

            if ($idnasabah) {
                $setorSampah = $this->db->table('setor_sampah')->select('kategori_sampah.name AS kategori,sampah.jenis AS jenis,SUM(setor_sampah.jumlah) AS jumlah')->join('sampah', 'setor_sampah.jenis_sampah = sampah.jenis')->join('transaksi', 'setor_sampah.id_transaksi = transaksi.id')->join('kategori_sampah', 'sampah.kategori = kategori_sampah.name')->where('transaksi.id_nasabah=',$idnasabah)->groupBy(["kategori_sampah.name", "sampah.jenis"])->get()->getResultArray();
            } 
            else {
                $setorSampah = $this->db->table('setor_sampah')->select('kategori_sampah.name AS kategori,sampah.jenis AS jenis,SUM(setor_sampah.jumlah) AS jumlah')->join('sampah', 'setor_sampah.jenis_sampah = sampah.jenis')->join('kategori_sampah', 'sampah.kategori = kategori_sampah.name')->groupBy(["kategori_sampah.name", "sampah.jenis"])->get()->getResultArray();
            }
            
            foreach ($kategori as $k) {
                $totalSampah[$k['name']] = [
                    'title'  => $k['name'],
                    'total'  => 0,
                    'detail' => [],
                ];
            }

            foreach ($setorSampah as $s) {
                $totalSampah[$s['kategori']]['total'] = round($totalSampah[$s['kategori']]['total']+(float)$s['jumlah'],4);
                $totalSampah[$s['kategori']]['detail'][] = [
                    'jenis'  => $s['jenis'],
                    'jumlah' => $s['jumlah'],
                ];
            }
            
            return [
                'success' => true,
                'message' => $totalSampah
            ];
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
            $result = $this->db->table($this->table)->where('id', $id)->delete();

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
