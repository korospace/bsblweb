<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SignUp extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'bsbl | SignUp'
        ];

        return view('SignUp/index',$data);
    }
}
