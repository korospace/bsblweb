<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class OTP extends BaseController
{
    public function otp()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $data = [
                'title'    => 'Verivikasi Akun',
                'email'    => $_POST['email'],
                'password' => $_POST['password']
            ];

            return view('OTP/index',$data);
        }
        else {
            return redirect()->to(base_url().'/login');
        }
    }
}