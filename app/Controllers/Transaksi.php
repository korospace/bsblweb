<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class Transaksi extends ResourceController
{
    public $basecontroller;
    public $transaksiModel;

	public function __construct()
    {
        $this->validation     = \Config\Services::validation();
        $this->baseController = new BaseController;
        $this->transaksiModel = new TransaksiModel;
    }

    /**
     * Setor sampah
     *   url    : domain.com/transaksi/setorsampah
     *   method : POST
     */
    public function setorSampah()
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
                foreach ($data['transaksi'] as $t) {
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

                $data['idtransaksi'] = 'TSS'.$this->baseController->generateOTP(9);
                $dbresponse          = $this->transaksiModel->setorSampah($data);
    
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

    /**
     * Setor sampah
     *   url    : domain.com/transaksi/tariksaldo
     *   method : POST
     */
    public function tarikSaldo()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->baseController->checkToken($token,'admin');

        if ($result['success'] == true) {
            $data  = $this->request->getPost();

            $this->validation->run($data,'tarikSaldo');
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
                $saldo = $this->transaksiModel->getSaldo($data);
                
                if ((float)$saldo < (float)$data['jumlah'] || (float)$saldo == 0) {
                    $response = [
                        'status'   => 400,
                        'error'    => true,
                        'messages' => 'saldo '.$data['jenis_dompet'].' anda tidak cukup',
                    ];
            
                    return $this->respond($response,400);
                }

                $data['idtransaksi'] = 'TTS'.$this->baseController->generateOTP(9);
                $dbresponse          = $this->transaksiModel->tarikSaldo($data);
    
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

    /**
     * Get data transaction
     *   url    : domain.com/transaksi/getdata
     *   method : GET
     */
    public function getData()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->baseController->checkToken($token,'union');

        if ($result['success'] == true) {

            $isAdmin    = isset($result['message']['data']['privilege']);
            $idNasabah  = $result['message']['data']['id'];

            if ($this->request->getGet('id_transaksi')) {
                $this->validation->run($this->request->getGet(),'detilTransaksiCheck');
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

            $dbresponse = $this->transaksiModel->getData($this->request->getGet(),$isAdmin,$idNasabah);

            if ($dbresponse['success'] == true) {
                $response = [
                    'status'   => 200,
                    "error"    => false,
                    'data'     => $dbresponse['data'],
                ];

                return $this->respond($response,200);
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
