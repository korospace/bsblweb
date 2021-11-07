<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\SampahModel;

class Sampah extends BaseController
{
    public $sampahModel;

	public function __construct()
    {
        $this->validation  = \Config\Services::validation();
        $this->sampahModel = new SampahModel;
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
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

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
                    "kategori"    => trim($data['kategori']),
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
     *   url    : domain.com/sampah/getitem
     *   method : GET
     */
    public function getItem(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $isAdmin    = false;

        if (!is_null($token)) {
            $result = $this->checkToken($token);
        
            if (isset($result['message']['data']['privilege'])) {
                $isAdmin = true;
            }
        }

        $dbResponse = $this->sampahModel->getItem($isAdmin);
    
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
     * Total item
     *   url    : - domain.com/sampah/totalitem
     *		      - domain.com/sampah/totalitem?idnasabah=:idnasabah (only admin)
     *   method : GET
     */
    public function totalItem(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $id         = null;

        if (!is_null($token)) {
            $result = $this->checkToken($token);
        
            if ($result['success'] == true) {
                if (isset($result['message']['data']['privilege'])) {
                    if ($this->request->getGet('idnasabah')) {
                        $id = $this->request->getGet('idnasabah');
                    }
                }
                else {
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
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $this->_methodParser('data');
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
                    "kategori"    => trim($data['kategori']),
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
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

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
