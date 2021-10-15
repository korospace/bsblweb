<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function dashboard()
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
            return redirect()->to(base_url().'/login');
        } 
        else {
            return view('Nasabah/index',$data);
        }
    }
}
