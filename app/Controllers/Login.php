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

        $token = [
            'value' => null
        ];

        if (isset($_COOKIE['token'])) {
            $token = [
                'value' => $_COOKIE['token'],
                'type'  => 'nasabah'
            ];
        } 
        else if (isset($_COOKIE['tokenAdmin'])){
            $token = [
                'value' => $_COOKIE['tokenAdmin'],
                'type'  => 'admin'
            ];
        }
        
        if ($token['value'] == null) {
            return view('Login/index',$data);
        } 
        else {
            if ($token['type'] == 'nasabah') {
                return redirect()->to(base_url().'/nasabah');
            } else {
                return redirect()->to(base_url().'/admin');
            }
        }
    }
}
