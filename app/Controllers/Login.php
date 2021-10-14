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

        return view('Login/index',$data);
    }
}
