<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function dashboardAdmin()
    {
        $data = [
            'title' => 'Admin | dashboard'
        ];

        return view('Admin/index',$data);
    }

    public function dashboardNasabah()
    {
        $data = [
            'title' => 'Nasabah | dashboard'
        ];

        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->checkToken($token);

        if ($result['success'] == false) {
            setcookie('token', null, -1, '/'); 
            unset($_COOKIE['token']); 

            return redirect()->to(base_url().'/login');
        } 
        else {
            return view('Nasabah/index',$data);
        }
    }
}
