<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomePage extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Selamat Datang di Website Bank Sampah Budi Luhur',
            'baseUrl' => base_url(),
        ];

        return view('HomePage/index',$data);
    }
}
