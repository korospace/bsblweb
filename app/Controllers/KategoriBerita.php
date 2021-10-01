<?php

namespace App\Controllers;

use App\Models\KategoriBeritaModel;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class KategoriBerita extends ResourceController
{
    public $basecontroller;
    public $kategoriModel;

	public function __construct()
    {
        $this->validation     = \Config\Services::validation();
        $this->baseController = new BaseController;
        $this->kategoriModel  = new KategoriBeritaModel;
    }

	public function addItem(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = $authHeader->getValue();
        $result     = $this->baseController->checkToken($token,'admin');

        if ($result['success'] == true) {
            $data = $this->request->getPost(); 

            $this->validation->run($data,'addKategoriBerita');
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
                    'messages' => $errors,
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
