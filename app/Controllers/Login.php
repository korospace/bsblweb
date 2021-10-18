<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Silahkan Login'
        ];

        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;

        if ($token == null) {
            return view('Login/index',$data);
        } 
        else {
            return redirect()->to(base_url().'/nasabah');
        }
    }
}
