<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\BeritaAcaraModel;

class BeritaAcara extends BaseController
{
    public $beritaModel;

	public function __construct()
    {
        $this->validation  = \Config\Services::validation();
        $this->beritaModel = new BeritaAcaraModel;
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
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $data              = $this->request->getPost(); 
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
            
                $file        = $data['thumbnail'];
                // $newFileName = $file->getRandomName();
                $newFileName = str_replace(' ', '-',strtolower(trim($data['title']))).'-'.uniqid().'.jpeg';
                $dbFileName  = base_url().'/assets/images/thumbnail-berita/'.$newFileName;

                $data = [
                    "id"          => $idBerita,
                    "title"       => strtolower(trim($data['title'])),
                    // "thumbnail"   => $this->base64Decode($_FILES['thumbnail']['tmp_name'],$_FILES['thumbnail']['type']),
                    "thumbnail"   => $dbFileName,
                    "content"     => trim($data['content']),
                    "kategori"    => trim($data['kategori']),
                    "created_by"  => $result['message']['data']['id'],
                    "created_at"  => time(),
                ];

                // var_dump($newFileName);die;

                if ($file->move('assets/images/thumbnail-berita/',$newFileName)) {
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
                
                        unlink('./assets/images/thumbnail-berita/'.$newFileName);
                        return $this->respond($response,$dbresponse['code']);
                    }
                } 
                else {
                    $response = [
                        'status'   => 500,
                        'error'    => false,
                        'messages' => 'storage thumbnail berita penuh',
                    ];
                    
                    unlink('./assets/images/thumbnail-berita/'.$newFileName);
                    return $this->respond($response,500);
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
     *            - domain.com/berita_acara/getitem?id=:id
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
     * Next Previous item
     *   url    : domain.com/berita_acara/otheritem?id=:id
     *   method : GET
     */
    public function getOtherItem(): object
    {
        $this->validation->run($this->request->getGet(),'getOtherItem');
        $errors = $this->validation->getErrors();

        if($errors) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => $errors['id'],
            ];
        
            return $this->respond($response,400);
        }

        $id         = $this->request->getGet('id');
        $dbResponse = $this->beritaModel->getOtherItem($id);

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
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $this->_methodParser('data');
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

                    $file              = $xx['new_thumbnail'];
                    $newFileName       = str_replace(' ', '-',$data['title']).'-'.uniqid().'.jpeg';
                    $dbFileName        = base_url().'/assets/images/thumbnail-berita/'.$newFileName;
                    $old_thumbnail     = $this->beritaModel->getOldThumbnail($data['id']);
                    $old_thumbnail     = explode('/',$old_thumbnail);
                    $old_thumbnail     = end($old_thumbnail);
                    $data['thumbnail'] = $dbFileName;
                }

                $unlinkOldThumb = false;
                if (isset($xx['new_thumbnail'])) {
                    if (rename($file->getRealPath(),'./assets/images/thumbnail-berita/'.$newFileName)) {
                        $unlinkOldThumb = true;
                    } 
                    else {
                        $response = [
                            'status'   => 500,
                            'error'    => false,
                            'messages' => 'storage thumbnail berita penuh',
                        ];
                        
                        return $this->respond($response,500);
                    }
                }

                $dbresponse = $this->beritaModel->editItem($data);

                if ($dbresponse['success'] == true) {
                    $response = [
                        'status' => 201,
                        'error' => false,
                        'messages' => $dbresponse['message'],
                    ];

                    if ($unlinkOldThumb) {
                        unlink('./assets/images/thumbnail-berita/'.$old_thumbnail);
                    }
                    return $this->respond($response,201);
                } 
                else {
                    $response = [
                        'status'   => $dbresponse['code'],
                        'error'    => true,
                        'messages' => $dbresponse['message'],
                    ];
            
                    if ($unlinkOldThumb) {
                        unlink('./assets/images/thumbnail-berita/'.$newFileName);
                    }
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
        $result     = $this->checkToken($token);
        $this->checkPrivilege($result);

        if ($result['success'] == true) {
            $this->validation->run($this->request->getGet(),'idForDeleteBerita');
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
                $old_thumbnail = $this->beritaModel->getOldThumbnail($this->request->getGet('id'));
                $old_thumbnail = explode('/',$old_thumbnail);
                $old_thumbnail = end($old_thumbnail);

                $dbresponse    = $this->beritaModel->deleteItem($this->request->getGet('id'));

                if ($dbresponse['success'] == true) {
                    $response = [
                        'status'   => 201,
                        'error'    => false,
                        'messages' => $dbresponse['message'],
                    ];

                    // delete local thumbnail
                    unlink('./assets/images/thumbnail-berita/'.$old_thumbnail);
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
