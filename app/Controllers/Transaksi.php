<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    public $transaksiModel;

	public function __construct()
    {
        $this->transaksiModel = new TransaksiModel;
    }

    /**
     * Setor sampah
     *   url    : domain.com/transaksi/setorsampah
     *   method : POST
     */
    public function setorSampah()
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $data   = $this->request->getPost();
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

            return $this->respond($dbresponse,$dbresponse['status']);
        }
    }

    /**
     * Tarik saldo
     *   url    : domain.com/transaksi/tariksaldo
     *   method : POST
     */
    public function tarikSaldo()
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

        $data   = $this->request->getPost();
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
            $valid  = true;
            $msg    = '';
            $saldoX = $this->transaksiModel->getSaldoJenisX($data['id_nasabah'],$data['jenis_saldo']);

            if ((float)$saldoX < (float)$data['jumlah']) {
                $valid = false;
                $msg   = [
                    'jumlah' => 'saldo '.$data['jenis_saldo'].' anda tidak cukup'
                ];
            }
            else {
                if ($data['jenis_saldo'] !== 'uang') {
                    if ((float)$saldoX-(float)$data['jumlah'] < 0.1) {
                        $valid = false;
                        $msg   = [
                            'jumlah' => 'minimal saldo yang mengendap adalah 0.1 gram'
                        ];
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

            return $this->respond($dbresponse,$dbresponse['status']);
        }
    }

    /**
     * Pindah saldo
     *   url    : domain.com/transaksi/pindahsaldo
     *   method : POST
     */
    public function pindahSaldo(): object
    {
        $result = $this->checkToken();
        $this->checkPrivilege($result['data']['privilege'],['admin','superadmin']);

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
            $asal   = 'uang';
            $tujuan = $data['tujuan'];
            $jumlahPindah      = (float)$data['jumlah'];
            $jumlahSaldoAsal   = (float)$this->transaksiModel->getSaldoJenisX($data['id_nasabah'],'uang');
            $jumlahSaldoTujuan = (float)$this->transaksiModel->getSaldoJenisX($data['id_nasabah'],$tujuan);

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
                'idnasabah'     => $data['id_nasabah'],
                'date'          => $data['date'],
                'idtransaksi'   => 'TPS'.$this->generateOTP(9),
                'jumlahPindah'  => $jumlahPindah,
                'hasilKonversi' => $konversiSaldo,
                'hargaemas'     => $data['harga_emas'],
                'asal'          => $asal,
                'tujuan'        => $tujuan,
                'saldo_dompet_asal'   => $jumlahSaldoAsal-$jumlahPindah,
                'saldo_dompet_tujuan' => $jumlahSaldoTujuan+$konversiSaldo
            ];
            
            $dbresponse = $this->transaksiModel->pindahSaldo($newdata);
            
            return $this->respond($dbresponse,$dbresponse['status']);
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
     * Jual sampah
     *   url    : domain.com/transaksi/jualsampah
     *   method : POST
     */
    public function jualSampah()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $data  = $this->request->getPost();

            $this->validation->run($data,'jualSampah');
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

                $data['idtransaksi'] = 'TJS'.$this->generateOTP(9);
                $dbresponse          = $this->transaksiModel->jualSampah($data);
    
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
     *   url    : domain.com/transaksi/sampahmasuk
     *   method : GET
     */
    public function getSampahMasuk()
    {
        $isAdmin   = false;
        $idNasabah = '';

        if ($this->request->getHeader('token')) {
            $result     = $this->checkToken();
            $isAdmin    = (in_array($result['data']['privilege'],['admin','superadmin'])) ? true : false ;
            $idNasabah  = ($isAdmin==false) ? $result['data']['userid'] : '' ;
        }

        if ($isAdmin) {
            if ($this->request->getGet('idnasabah')) {
                $idNasabah = $this->request->getGet('idnasabah');
            }
        }

        $dbresponse = $this->transaksiModel->getSampahMasuk($this->request->getGet(),$idNasabah);

        return $this->respond($dbresponse,$dbresponse['status']);
    }

    /**
     * Get data transaction
     *   url    : domain.com/transaksi/getsaldo
     *   method : GET
     */
    public function getSaldo()
    {
        $result     = $this->checkToken();
        $isAdmin    = (in_array($result['data']['privilege'],['admin','superadmin'])) ? true : false ;
        $idNasabah  = ($isAdmin==false) ? $result['data']['userid'] : '' ;

        if ($isAdmin) {
            if ($this->request->getGet('idnasabah')) {
                $idNasabah = $this->request->getGet('idnasabah');
            }
        }

        $dbresponse = $this->transaksiModel->getAllJenisSaldo($idNasabah);

        return $this->respond($dbresponse,$dbresponse['status']);
    }

    /**
     * Get data transaction
     *   url    : domain.com/transaksi/getdata
     *   method : GET
     */
    public function getData()
    {
        $result    = $this->checkToken();
        $isAdmin   = (in_array($result['data']['privilege'],['admin','superadmin'])) ? true : false ;
        $idNasabah = ($isAdmin==false) ? $result['data']['userid'] : '' ;

        if ($this->request->getGet('start') && $this->request->getGet('end')) {
            $this->validation->run($this->request->getGet(),'dateForFilterTransaksi');
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

        if ($isAdmin) {
            if ($this->request->getGet('idnasabah')) {
                $idNasabah = $this->request->getGet('idnasabah');
            }
        }

        $dbresponse = $this->transaksiModel->getData($this->request->getGet(),$idNasabah);

        return $this->respond($dbresponse,$dbresponse['status']);
    }

    /**
     * Get data transaction
     *   url    : domain.com/transaksi/rekapdata
     *   method : GET
     */
    public function rekapData()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $errors = null;
            if ($this->request->getGet('year')) {
                $this->validation->run($this->request->getGet(),'rekapDataYear');
                $errors = $this->validation->getErrors();
    
            }
            if ($this->request->getGet('date')) {
                $this->validation->run($this->request->getGet(),'rekapDataDate');
                $errors = $this->validation->getErrors();
    
            }

            if($errors) {
                $response = [
                    'status'   => 400,
                    'error'    => true,
                    'messages' => $errors,
                ];
        
                return $this->respond($response,400);
            } 
            
            $dbresponse = $this->transaksiModel->rekapData($this->request->getGet());

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
     * Get data transaction
     *   url    : domain.com/transaksi/lasttransaksi
     *   method : GET
     */
    public function lastTransaksi()
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            
            $this->validation->run($this->request->getGet(),'lastTransaksi');
            $errors = $this->validation->getErrors();

            if($errors) {
                $response = [
                    'status'   => 400,
                    'error'    => true,
                    'messages' => $errors['limit'],
                ];
        
                return $this->respond($response,400);
            } 

            $limit      = $this->request->getGet('limit');
            $dbresponse = $this->transaksiModel->lastTransaksi($limit);

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
