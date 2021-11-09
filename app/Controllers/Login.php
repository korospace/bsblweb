<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'title'   => 'Silahkan Login',
            'lasturl' => (isset($_COOKIE['lasturl'])) ? $_COOKIE['lasturl'] : '',
        ];

        $token     = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result    = $this->checkToken($token, false);
        $privilege = (isset($result['privilege'])) ? $result['privilege'] : null;
        
        if ($token == null) {
            return view('Login/index',$data);
        } 
        else {
            if ($privilege == 'nasabah') {
                return redirect()->to(base_url().'/nasabah');
            } 
            else {
                return redirect()->to(base_url().'/admin');
            }
        }
    }
}
