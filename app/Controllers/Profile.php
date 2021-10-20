<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    // Profile nasabah
    public function profileNasabah()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token,false);
        $data = [
            'title' => 'Nasabah | profile',
            'token' => $token,
        ];

        if ($result['success'] == false) {
            setcookie('token', null, -1, '/'); 
            unset($_COOKIE['token']); 

            return redirect()->to(base_url().'/login');
        } 
        else {
            return view('Nasabah/profilenasabah',$data);
        }

    }

    // profile admin
    public function profileAdmin()
    {
        $token  = (isset($_COOKIE['tokenAdmin'])) ? $_COOKIE['tokenAdmin'] : null;
        $result = $this->checkToken($token, false);
        $data   = [
            'title' => 'Admin | profile',
            'token' => $token
        ];
        
        if($result['success'] == false) {
            setcookie('tokenAdmin', null, -1, '/');
            unset($_COOKIE['tokenAdmin']);
            return redirect()->to(base_url().'/login');
        } else {
            return view('Admin/profile',$data);
        }
    }
}
