<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\NasabahModel;
use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    public $transaksiModel;

	public function __construct()
    {
        $this->validation     = \Config\Services::validation();
        $this->transaksiModel = new TransaksiModel;
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
        $result     = $this->checkToken($token);

        if ($result['success'] == true) {
            if ($this->request->getGet('date')) {
                $dataGet= $this->request->getGet();
                $this->validation->run($dataGet,'transaksiDate');
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
            
            $isAdmin    = isset($result['message']['data']['privilege']);
            $idNasabah  = ($isAdmin) ? false : $result['message']['data']['id'];

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

    /**
     * Setor sampah
     *   url    : domain.com/transaksi/setorsampah
     *   method : POST
     */
    public function setorSampah()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

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

                $data['idtransaksi'] = 'TSS'.$this->generateOTP(9);
                $dbresponse          = $this->transaksiModel->setorSampah($data);
                // var_dump((int)strtotime($data['date']));die;
    
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
     * Tarik saldo
     *   url    : domain.com/transaksi/tariksaldo
     *   method : POST
     */
    public function tarikSaldo()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

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
                $valid = true;
                $msg   = '';
                $saldo = $this->transaksiModel->getSaldo($data);

                if ((float)$saldo < (float)$data['jumlah']) {
                    $valid = false;
                    $msg   = [
                        'jumlah' => 'saldo '.$data['jenis_saldo'].' anda tidak cukup'
                    ];
                }
                else {
                    if ($data['jenis_saldo'] == 'uang') {
                        if ((float)$data['jumlah'] < 10000) {
                            $valid = false;
                            $msg   = [
                                'jumlah' => 'minimal penarikan Rp10.000'
                            ];
                        }
                    }
                    else  {
                        if ((float)$data['jumlah'] < 1) {
                            $valid = false;
                            $msg   = [
                                'jumlah' => 'minimal penarikan 1.1 gram'
                            ];
                        }
                        else {
                            $data['jumlah'] = (float)$data['jumlah']-0.1;
                        }
                    }
                }
                
                if (!$valid) {
                    $response = [
                        'status'   => 400,
                        'error'    => true,
                        'messages' => $msg,
                    ];
            
                    return $this->respond($response,400);
                }

                $data['idtransaksi'] = 'TTS'.$this->generateOTP(9);
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
     * Pindah saldo
     *   url    : domain.com/transaksi/pindahsaldo
     *   method : POST
     */
    public function pindahSaldo(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $data   = $this->request->getPost();
            $this->validation->run($data,'pindahSaldo');
            $errors = $this->validation->getErrors();

            if ($errors) {
                $response = [
                    'status'   => 400,
                    'error'    => true,
                    'messages' => $errors,
                ];
        
                return $this->respond($response,400);
            } 
            else {
                $valid  = true;
                $msg    = '';
                $asal   = $data['asal'];
                $tujuan = $data['tujuan'];
                $nasabahModel      = new NasabahModel;
                $dataSaldo         = $nasabahModel->getSaldoNasabah($data['id_nasabah']);
                $jumlahPindah      = (float)$data['jumlah'];
                $jumlahSaldoAsal   = (float)$dataSaldo['message'][$asal];
                $jumlahSaldoTujuan = (float)$dataSaldo['message'][$tujuan];

                if ($jumlahSaldoAsal < $jumlahPindah ) {
                    $valid = false;
                    $msg   = [
                        'jumlah' => 'saldo '.$asal.' tidak cukup',
                    ];
                }
                else {
                    $jumlahTps = $this->transaksiModel->JumlahTps($data['id_nasabah']);

                    if ($jumlahTps == 0) {
                        if ((float)$data['jumlah'] < 50000) {
                            $valid = false;
                            $msg   = [
                                'jumlah' => 'minimal pindah pada transaksi pertama adalah Rp50.000'
                            ];
                        }
                    } 
                    else {
                        if ((float)$data['jumlah'] < 10000) {
                            $valid = false;
                            $msg   = [
                                'jumlah' => 'minimal pindah Rp10.000'
                            ];
                        }
                    }

                    // if ($asal == 'uang' && in_array($tujuan,['antam','ubs','galery24'])) {
                    //     if ((float)$data['jumlah'] < 10000) {
                    //         $valid = false;
                    //         $msg   = [
                    //             'jumlah' => 'minimal pindah Rp10.000'
                    //         ];
                    //     }
                    // } 
                    // else if (in_array($asal,['antam','ubs','galery24']) && $tujuan == 'uang') {
                    //     if ((float)$data['jumlah'] < 1) {
                    //         $valid = false;
                    //         $msg   = [
                    //             'jumlah' => 'minimal pindah 1gram'
                    //         ];
                    //     }
                    // } 
                    // else {
                    //     $valid = false;
                    //     $msg   = [
                    //         'asal'   => 'hanya dompet uang yang dizinkan',
                    //         'tujuan' => 'hanya dompet antam/ubs/galery24 yang diizinkan',
                    //     ];
                    // }
                }

                if (!$valid) {
                    $response = [
                        'status'   => 400,
                        'error'    => true,
                        'messages' => $msg,
                    ];
            
                    return $this->respond($response,400);
                }

                $konversiSaldo = $this->konversiSaldo($data);

                $newdata = [
                    'idnasabah'           => $data['id_nasabah'],
                    'date'                => $data['date'],
                    'idtransaksi'         => 'TPS'.$this->generateOTP(9),
                    'jumlahPindah'        => $jumlahPindah,
                    'hasilKonversi'       => $konversiSaldo,
                    'hargaemas'           => $data['harga_emas'],
                    'asal'                => $asal,
                    'tujuan'              => $tujuan,
                    'saldo_dompet_asal'   => $jumlahSaldoAsal-$jumlahPindah,
                    'saldo_dompet_tujuan' => $jumlahSaldoTujuan+$konversiSaldo
                ];
                
                $dbresponse = $this->transaksiModel->pindahSaldo($newdata);
                
                if ($dbresponse['success'] == true) {
                    $response = [
                        'status'     => 201,
                        'error'      => false,
                        'message'    => $dbresponse['message'],
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

    public function konversiSaldo(array $data): float
    {
        return (float)$data['jumlah']/$data['harga_emas'];

        // if ($data['asal'] == 'uang') {
        //     return (float)$data['jumlah']/$data['harga_emas'];
        // } 
        // else {
        //     return round((float)$data['jumlah']*$data['harga_emas']);
        // }
    }

    public function getHargaEmas(): float
    {
        $output = $this->curlGetData("https://www.goldapi.io/api/XAU/USD/",array('Content-Type:application/json','x-access-token:goldapi-s79zgtkugd4m5s-io'));

        return round(((float)$output['price']/31.1)*$this->getHargaDolar());
    }

    public function getHargaDolar(): float
    {
        $output = $this->curlGetData("https://free.currconv.com/api/v7/convert?q=USD_IDR&compact=ultra&apiKey=c94ee0cbe358dc63dce9",array('Content-Type:application/json'));

        return round((float)$output['USD_IDR']);
    }

    public function curlGetData(string $url,array $headerItem): array
    {
        // persiapkan curl
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $url);
        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerItem);
        // return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch);
        $output = json_decode($output); 
        $output = (array)$output; 
        // tutup curl 
        curl_close($ch);      

        // menampilkan hasil curl
        return $output;
    }

    /**
     * Delete nasabah
     *   url    : domain.com/transaksi/deleteitem?id=:id
     *   method : DELETE
     */
	public function deleteItem(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {

            if($this->request->getGet('id') == null) {
                $response = [
                    'status'   => 400,
                    'error'    => true,
                    'messages' => 'required parameter id',
                ];
        
                return $this->respond($response,400);
            } 
            else {
                $dbresponse = $this->transaksiModel->deleteItem($this->request->getGet('id'));

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
