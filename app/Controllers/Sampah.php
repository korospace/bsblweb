<?php

namespace App\Controllers;

use App\Models\SampahModel;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class Sampah extends ResourceController
{
    public $baseController;
    public $sampahModel;

	public function __construct()
    {
        $this->validation     = \Config\Services::validation();
        $this->baseController = new BaseController;
        $this->sampahModel    = new SampahModel;
    }

    /**
     * Add item
     *   url    : domain.com/sampah/additem
     *   method : POST
     */
	public function addItem(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = $authHeader->getValue();
        $result     = $this->baseController->checkToken($token,'admin');

        if ($result['success'] == true) {
            $data = $this->request->getPost(); 

            $this->validation->run($data,'addSampah');
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
                $lastSampah  = $this->sampahModel->getLastSampah();
                $idSampah    = '';
    
                if ($lastSampah['success'] == true) {
                    $lastID    = $lastSampah['message']['id'];
                    $lastID    = (int)substr($lastID,2)+1;
                    $lastID    = sprintf('%03d',$lastID);
                    $idSampah  = 'S'.$lastID;
                }
                else if ($lastSampah['code'] == 404) {
                    $idSampah = 'S001';
                } 
                else {
                    $response = [
                        'status'   => $lastSampah['code'],
                        'error'    => true,
                        'messages' => $lastSampah['message'],
                    ];
            
                    return $this->respond($response,$lastSampah['code']);
                }

                $data = [
                    "id"          => $idSampah,
                    "id_kategori" => trim($data['id_kategori']),
                    "jenis"       => strtolower(trim($data['jenis'])),
                    "harga"       => trim($data['harga']),
                ];

                $dbresponse = $this->sampahModel->addItem($data);

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
     *   url    : - domain.com/sampah/
     *            - domain.com/sampah/getitem?kategori=:id_kategori
     *   method : GET
     */
    public function getItem(): object
    {
        $dbResponse = $this->sampahModel->getItem($this->request->getGet());
    
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
     * Get item
     *   url    : domain.com/sampah/totalitem
     *   method : GET
     */
    public function totalItem(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $id         = null;

        if (!is_null($token)) {
            $result = $this->baseController->checkToken($token,'union');
        
            if ($result['success'] == true) {
                if (!isset($result['message']['data']['privilege'])) {
                    $id = $result['message']['data']['id'];
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

        $dbResponse = $this->sampahModel->totalItem($id);
    
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
     *   url    : domain.com/sampah/edititem
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

            $this->validation->run($data,'updateSampah');
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
                    "id"          => $data['id'],
                    "id_kategori" => trim($data['id_kategori']),
                    "jenis"       => strtolower(trim($data['jenis'])),
                    "harga"       => trim($data['harga']),
                    "jumlah"      => trim($data['jumlah']),
                ];

                $dbresponse = $this->sampahModel->editItem($data);

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
     * Delete item
     *   url    : domain.com/sampah/deleteitem?id=:id
     *   method : DELETE
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
                $dbresponse = $this->sampahModel->deleteItem($this->request->getGet('id'));

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
