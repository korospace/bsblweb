<?php

namespace App\Controllers;

use App\Models\BeritaAcaraModel;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class BeritaAcara extends ResourceController
{
    public $baseController;
    public $beritaModel;

	public function __construct()
    {
        $this->validation     = \Config\Services::validation();
        $this->baseController = new BaseController;
        $this->beritaModel    = new BeritaAcaraModel;
    }

    /**
     * Add item
     *   url    : domain.com/berita_acara/additem
     *   method : POST
     */
	public function addItem(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = $authHeader->getValue();
        $result     = $this->baseController->checkToken($token,'admin');

        if ($result['success'] == true) {
            $data = $this->request->getPost(); 
            $data['thumbnail'] = $this->request->getFile('thumbnail'); 

            $this->validation->run($data,'addBeritaAcara');
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
                $data = [
                    "title"      => strtolower(trim($data['title'])),
                    "thumbnail"  => $this->baseController->base64Decode($_FILES['thumbnail']['tmp_name']),
                    "content"    => trim($data['content']),
                    "kategori"   => strtolower(trim($data['kategori'])),
                    "created_by" => $result['message']['data']['id_admin'],
                ];

                $dbresponse = $this->beritaModel->addItem($data);

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
     * Get admin
     *   url    : - domain.com/admin/berita_acara
     *            - domain.com/admin/berita_acara/getitem?id=:id
     *   method : GET
     */
    public function getItem(): object
    {
        // id_berita must be number
        if ($this->request->getGet('id')) {
            $this->validation->run($this->request->getGet(),'idForGetDataCheck');
            $errors = $this->validation->getErrors();

            if($errors) {
                $response = [
                    'status'   => 400,
                    'error'    => true,
                    'messages' => $errors,
                ];
        
                return $this->respond($response,400);
            } 
        }

        $dbResponse = $this->beritaModel->getItem($this->request->getGet());
    
        if ($dbResponse['success'] == true) {
            $response = [
                'status' => 200,
                'error'  => false,
                'data'   => $dbResponse['message'],
            ];

            return $this->respond($response,200);
        } 
        else {
            $response = [
                'status'   => $dbResponse['code'],
                'error'    => true,
                'messages' => $dbResponse['message'],
            ];
    
            return $this->respond($response,$dbResponse['code']);
        }
    }

    /**
     * Update item
     *   url    : domain.com/berita_acara/edititem
     *   method : PUT
     */
	public function editItem(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = $authHeader->getValue();
        $result     = $this->baseController->checkToken($token,'admin');

        if ($result['success'] == true) {
            $this->baseController->_methodParser('data');
            global $data;

            $this->validation->run($data,'updateBeritaAcara');
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
                $data = [
                    "id"         => trim($data['id']),
                    "title"      => strtolower(trim($data['title'])),
                    "content"    => trim($data['content']),
                    "kategori"   => strtolower(trim($data['kategori'])),
                    "created_by" => $result['message']['data']['id_admin'],
                ];

                if ($this->request->getFile('new_thumbnail')) {
                    $xx['new_thumbnail'] = $this->request->getFile('new_thumbnail'); 

                    $this->validation->run($xx,'ifImgageUploadCheck');
                    $errors = $this->validation->getErrors();

                    if($errors) {
                        $response = [
                            'status'   => 400,
                            'error'    => true,
                            'messages' => $errors,
                        ];
                
                        return $this->respond($response,400);
                    } 

                    $data['thumbnail'] = $this->baseController->base64Decode($_FILES['new_thumbnail']['tmp_name']);
                }

                $dbresponse = $this->beritaModel->editItem($data);

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
                $dbresponse = $this->beritaModel->deleteItem($this->request->getGet('id'));

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
