<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class OTP extends BaseController
{
    public function otp()
    {
        $data = [
            'title' => 'Verivikasi Akun'
        ];

        return view('OTP/index',$data);
    }
}