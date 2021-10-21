<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class OTP extends BaseController
{
    public function otp()
    {
        $data = [
            'title' => 'Verivikasi Akun',
            'email' => false,
            'password' => false
        ];

        if (isset($_POST['email']) && isset($_POST['password'])) {
            $data['email']    = $_POST['email'];
            $data['password'] = $_POST['password'];
        }

        // dd($data);

        return view('OTP/index',$data);
    }
}