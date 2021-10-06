<?php

namespace App\Controllers;

use App\Models\KategoriSampahModel;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class KategoriSampah extends ResourceController
{
    public $basecontroller;
    public $kategoriModel;

	public function __construct()
    {
        $this->validation     = \Config\Services::validation();
        $this->baseController = new BaseController;
        $this->kategoriModel  = new KategoriSampahModel;
    }

    /**
     * Add item
     *   url    : domain.com/kategori_sampah/additem
     *   method : POST
     */
	public function addItem(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = $authHeader->getValue();
        $result     = $this->baseController->checkToken($token,'admin');

        if ($result['success'] == true) {
            $data = $this->request->getPost(); 

            $this->validation->run($data,'addKategoriSampah');
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
                $lastKategori  = $this->kategoriModel->getLastKategori();
                $idKategori    = '';
    
                if ($lastKategori['success'] == true) {
                    $lastID     = $lastKategori['message']['id'];
                    $lastID     = (int)substr($lastID,2)+1;
                    $lastID     = sprintf('%02d',$lastID);
                    $idKategori = 'KS'.$lastID;
                }
                else if ($lastKategori['code'] == 404) {
                    $idKategori = 'KS01';
                } 
                else {
                    $response = [
                        'status'   => $lastKategori['code'],
                        'error'    => true,
                        'messages' => $lastKategori['message'],
                    ];
            
                    return $this->respond($response,$lastKategori['code']);
    
                }
                
                $data = [
                    "id"   => $idKategori,
                    "name" => trim($data['kategori_name']),
                ];

                $dbresponse = $this->kategoriModel->addItem($data);

                if ($dbresponse['success'] == true) {
                    $response = [
                        'status' => 201,
                        'error' => false,
                        'messages' => $dbresponse['message'],
                    ];

                    return $this->respond($response,201);
                } 
                else {
                    $response = [
                        'status'   => $dbresponse['code'],
                        'error'    => true,
                        'messages' => $dbresponse['message'],
                    ];
            
                    return $this->respond($response,$dbresponse['code']);
                }
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
    }

    /**
     * Get item
     *   url    : domain.com/kategori_sampah/getitem
     *   method : GET
     */
	public function getItem(): object
    {
        $dbresponse = $this->kategoriModel->getItem();

        if ($dbresponse['success'] == true) {
            $response = [
                'status' => 200,
                'error'  => false,
                'data'   => $dbresponse['message'],
            ];

            return $this->respond($response,201);
        } 
        else {
            $response = [
                'status'   => $dbresponse['code'],
                'error'    => true,
                'messages' => $dbresponse['message'],
            ];
    
            return $this->respond($response,$dbresponse['code']);
        }
    }

    /**
     * Delete item
     *   url    : domain.com/kategori_sampah/deleteitem?id=:id
     *   method : GET
     */
	public function deleteItem(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = $authHeader->getValue();
        $result     = $this->baseController->checkToken($token,'admin');

        if ($result['success'] == true) {
            $this->validation->run($this->request->getGet(),'idForDeleteCheck');
            $errors = $this->validation->getErrors();

            if($errors) {
                $response = [
                    'status'   => 400,
                    'error'    => true,
                    'messages' => $errors['id'],
                ];
        
                return $this->respond($response,400);
            } 
            else {
                $dbresponse = $this->kategoriModel->deleteItem($this->request->getGet('id'));

                if ($dbresponse['success'] == true) {
                    $response = [
                        'status' => 201,
                        'error' => false,
                        'messages' => $dbresponse['message'],
                    ];

                    return $this->respond($response,201);
                } 
                else {
                    $response = [
                        'status'   => $dbresponse['code'],
                        'error'    => true,
                        'messages' => $dbresponse['message'],
                    ];
            
                    return $this->respond($response,$dbresponse['code']);
                }
            }
        } 
        else {
            $response = [
                'status'   => $result['code'],
                'error'    => true,
                'messages' => $result['message'],
            ];
    
            return $this->respond($response,$result['code']);
        }
    }
}
