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
        $result     = $this->baseController->checkToken($token);

        if ($result['success'] == true) {
            $data = $this->request->getPost(); 
            $data['thumbnail'] = $this->request->getFile('thumbnail'); 
            
            // $file = $data['thumbnail'];
            // $newFileName = $file->getRandomName();
            // $dbFileName  = base_url().'/assets/img/thumbnail/'.$newFileName;
            // var_dump($dbFileName);die;

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
                $lastBerita  = $this->beritaModel->getLastBerita();
                $idBerita    = '';
    
                if ($lastBerita['success'] == true) {
                    $lastID    = $lastBerita['message']['id'];
                    $lastID    = (int)substr($lastID,2)+1;
                    $lastID    = sprintf('%03d',$lastID);
                    $idBerita  = 'BA'.$lastID;
                }
                else if ($lastBerita['code'] == 404) {
                    $idBerita = 'BA001';
                } 
                else {
                    $response = [
                        'status'   => $lastBerita['code'],
                        'error'    => true,
                        'messages' => $lastBerita['message'],
                    ];
            
                    return $this->respond($response,$lastBerita['code']);
    
                }

                $data = [
                    "id"          => $idBerita,
                    "title"       => strtolower(trim($data['title'])),
                    "thumbnail"   => $this->baseController->base64Decode($_FILES['thumbnail']['tmp_name'],$_FILES['thumbnail']['type']),
                    // "thumbnail"  => $dbFileName,
                    "content"     => trim($data['content']),
                    "kategori"    => trim($data['kategori']),
                    "created_by"  => $result['message']['data']['id'],
                    "created_at"  => time(),
                ];

                $dbresponse = $this->beritaModel->addItem($data);

                if ($dbresponse['success'] == true) {
                    $response = [
                        'status' => 201,
                        'error' => false,
                        'messages' => $dbresponse['message'],
                    ];

                    // $file->move('assets/img/thumbnail/', $newFileName);
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
     *   url    : - domain.com/berita_acara/getitem
     *            - domain.com/berita_acara/getitem?kategori=:id_kategori
     *            - domain.com/berita_acara/getitem?id_berita=:id
     *   method : GET
     */
    public function getItem(): object
    {
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
        $result     = $this->baseController->checkToken($token);

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
                    "kategori"   => trim($data['kategori']),
                    "created_by" => $result['message']['data']['id'],
                    "created_at"  => time(),
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

                    // $file          = $xx['new_thumbnail'];
                    // $newFileName   = $file->getRandomName();
                    // $dbFileName    = base_url().'/assets/img/thumbnail/'.$newFileName;
                    // $old_thumbnail = $this->beritaModel->getOldThumbnail($data['id']);
                    // $old_thumbnail = explode('/',$old_thumbnail);
                    // $old_thumbnail = end($old_thumbnail);
                    // $realPath      = $_SERVER["DOCUMENT_ROOT"].'/bsblapi/assets/img/thumbnail/';

                    $data['thumbnail'] = $this->baseController->base64Decode($_FILES['new_thumbnail']['tmp_name'],$_FILES['new_thumbnail']['type']);
                    // $data['thumbnail'] = $dbFileName;
                }

                $dbresponse = $this->beritaModel->editItem($data);

                if ($dbresponse['success'] == true) {
                    $response = [
                        'status' => 201,
                        'error' => false,
                        'messages' => $dbresponse['message'],
                    ];

                    // if (isset($xx['new_thumbnail'])) {
                    //     rename($file->getPathname(),$realPath.$newFileName);
                    //     unlink($realPath.$old_thumbnail);
                    // }

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
     *   url    : domain.com/berita_acara/deleteitem?id=:id
     *   method : DELETE
     */
	public function deleteItem(): object
    {
        $authHeader = $this->request->getHeader('token');
        $token      = $authHeader->getValue();
        $result     = $this->baseController->checkToken($token);

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
