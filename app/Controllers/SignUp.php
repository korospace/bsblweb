<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SignUp extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Silahkan Daftarkan Diri Anda'
        ];

        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        
        if ($token == null) {
            return view('SignUp/index',$data);
        } 
        else {
            return redirect()->to(base_url().'/dashboard/nasabah');
        }
    }
}
