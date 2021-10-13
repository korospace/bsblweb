<?php

namespace App\Controllers;

use App\Models\NasabahModel;
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
     * Pindah saldo
     *   url    : domain.com/transaksi/pindahsaldo
     *   method : POST
     */
    public function pindahSaldo(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = ($authHeader != null) ? $authHeader->getValue() : null;
        $result     = $this->baseController->checkToken($token,'nasabah');

        if ($result['success'] == true) {
            $data   = $this->request->getPost();
            $data['idnasabah'] = $result['message']['data']['id'];
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
                $jatahHabis = $this->transaksiModel->jatahPindahSaldoCheck($data['idnasabah']);
                
                if ($jatahHabis['status']) {
                    $nextJatah = $this->baseController->SECONDS_TO_HMS($jatahHabis['date']);
                    
                    $response  = [
                        'status'   => 400,
                        'error'    => true,
                        'messages' => "jatah selanjutnya tersedia dalam $nextJatah",
                    ];
            
                    return $this->respond($response,400);
                } 

                $nasabahModel      = new NasabahModel;
                $dataSaldo         = $nasabahModel->getSaldoNasabah($data['idnasabah']);
                $saldoDompetAsal   = (float)$dataSaldo['message']['saldo_'.$data['dompet_asal']];
                $saldoDompetTujuan = ($data['dompet_asal'] == 'uang') ? (float)$dataSaldo['message']['saldo_emas'] : (float)$dataSaldo['message']['saldo_uang'];
                $jumlahPindah      = (float)$data['jumlah'];

                if ($saldoDompetAsal < $jumlahPindah ) {
                    $response = [
                        'status'   => 400,
                        'error'    => true,
                        'messages' => 'saldo '.$data['dompet_asal'].' tidak cukup',
                    ];
            
                    return $this->respond($response,400);
                }

                $konversiSaldo = $this->konversiSaldo($data);

                $newdata = [
                    'idnasabah'           => $data['idnasabah'],
                    'idtransaksi'         => 'TPS'.$this->baseController->generateOTP(9),
                    'jumlahPindah'        => $jumlahPindah,
                    'hasilKonversi'       => $konversiSaldo['hasil'],
                    'hargaemas'           => $konversiSaldo['hargaemas'],
                    'nama_dompet_asal'    => ($data['dompet_asal'] == 'uang') ? 'uang' : 'emas',
                    'saldo_dompet_asal'   => $saldoDompetAsal-$jumlahPindah,
                    'nama_dompet_tujuan'  => ($data['dompet_asal'] == 'uang') ? 'emas' : 'uang',
                    'saldo_dompet_tujuan' => $saldoDompetTujuan+$konversiSaldo['hasil']
                ];
                
                // var_dump($newdata);die;
                $dbresponse = $this->transaksiModel->pindahSaldo($newdata);
                
                if ($dbresponse['success'] == true) {
                    $response = [
                        'status'     => 201,
                        'error'      => false,
                        'message'    => $dbresponse['message'],
                        'harga_emas' => $konversiSaldo['hargaemas'],
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

    public function konversiSaldo(array $data): array
    {
        if ($data['dompet_asal'] == 'uang') {
            // var_dump([
            //     'hargaemas' => $this->getHargaEmas(),
            //     'hasil'     => floor((float)$data['jumlah']/$this->getHargaEmas()),
            // ]);die;
            return [
                'hargaemas' => $this->getHargaEmas(),
                'hasil'     => (float)$data['jumlah']/$this->getHargaEmas(),
            ];
        } 
        else {
            // var_dump([
            //     'hargaemas' => $this->getHargaEmas(),
            //     'hasil'     =>round((float)$data['jumlah']*$this->getHargaEmas()),
            // ]);die;
            return [
                'hargaemas' => $this->getHargaEmas(),
                'hasil'     => round((float)$data['jumlah']*$this->getHargaEmas()),
            ];
        }
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
}
