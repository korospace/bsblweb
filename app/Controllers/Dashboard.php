<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function dashboardAdmin()
    {
        $token  = (isset($_COOKIE['tokenAdmin'])) ? $_COOKIE['tokenAdmin'] : null;
        $result = $this->checkToken($token, false);
        $data   = [
            'title' => 'Admin | dashboard',
            'token' => $token
        ];
        
        if($result['success'] == false) {
            // dd($token);
            setcookie('tokenAdmin', null, -1, '/');
            unset($_COOKIE['tokenAdmin']);
            return redirect()->to(base_url().'/login');
        } else {
            return view('Admin/index',$data);
        }
    }

    public function dashboardNasabah()
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token,false);
        $data   = [
            'title' => 'Nasabah | dashboard',
            'token' => $token,
        ];

        if ($result['success'] == false) {
            setcookie('token', null, -1, '/'); 
            unset($_COOKIE['token']); 

            return redirect()->to(base_url().'/login');
        } 
        else {
            return view('Nasabah/index',$data);
        }
    }
}
