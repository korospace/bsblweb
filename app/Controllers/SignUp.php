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

        return view('SignUp/index',$data);
    }
}
