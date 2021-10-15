<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function dashboard()
    {
        $data = [
            'title' => 'Selamat Datang Di Laporan Bank Sampah Budi Luhur'
        ];

        return view('Admin/index',$data);
    }
}
