<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
    public $kategoriModel;

	public function __construct()
    {
        $this->kategoriModel  = new KategoriModel;
    }

    // add kategori
	public function addKategori(string $tableName): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $data   = $this->request->getPost(); 
        $this->validation->run($data,'kategoriSampahValidate');
        $errors = $this->validation->getErrors();

        if($errors) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => $errors,
            ];
    
            return $this->respond($response,400);
        } 
        else {
            $idKategori    = '';
            $lastKategori  = $this->kategoriModel->getLastKategori($tableName);

            if ($lastKategori['error'] == false) {
                $lastID     = $lastKategori['data']['id'];
                $lastID     = (int)substr($lastID,2)+1;
                $lastID     = sprintf('%02d',$lastID);
                $idKategori = 'KS'.$lastID;
            }
            else if ($lastKategori['status'] == 404) {
                $idKategori = 'KS01';
            } 
            else {
                return $this->respond($lastKategori,$lastKategori['status']);
            }
            
            $data = [
                "id"   => $idKategori,
                "name" => trim($data['kategori_name']),
            ];

            $dbresponse = $this->kategoriModel->addKategori($data,$tableName);

            return $this->respond($dbresponse,$dbresponse['status']);
        }
    }

    // delete kategori
	public function deleteKategori(string $tableName): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        if($this->request->getGet('id') == null) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => 'required parameter id',
            ];
    
            return $this->respond($response,400);
        } 
        else {
            $dbresponse = $this->kategoriModel->deleteKategori($this->request->getGet('id'),$tableName);

            return $this->respond($dbresponse,$dbresponse['status']);
        }
    }

    // get kategori
	public function getkategori(string $tableName): object
    {
        $dbresponse = $this->kategoriModel->getKategori($tableName);

        return $this->respond($dbresponse,$dbresponse['status']);
    }
}
    