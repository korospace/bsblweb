<?php

namespace App\Controllers;

use App\Models\SetorSampahModel;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class SetorSampah extends ResourceController
{
    public $basecontroller;
    public $setorSampahModel;

	public function __construct()
    {
        $this->validation       = \Config\Services::validation();
        $this->baseController   = new BaseController;
        $this->setorSampahModel = new SetorSampahModel;
    }

    /**
     * Add new transaction
     *   url    : domain.com/setor_sampah/addtransaction
     *   method : POST
     */
    public function addTransaction()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->baseController->checkToken($token,'admin');

        if ($result['success'] == true) {
            $data  = $this->request->getPost();

            $this->validation->run($data,'setorSampah1');
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
                foreach ($data['transaction'] as $t) {
                    $this->validation->run($t,'setorSampah2');
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

                $data['idsetor'] = 'SS'.mt_rand();
                $dbresponse      = $this->setorSampahModel->addTransaction($data);
    
                if ($dbresponse['success'] == true) {
                    $response = [
                        'status'   => 201,
                        "error"    => false,
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
