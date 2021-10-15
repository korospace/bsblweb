<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProfileAdmin extends BaseController
{
    public function profileadmin()
    {
        $data = [
            'title' => 'Selamat Datang Di Tampilan Profile'
        ];

        return view('Admin/profile',$data);
    }
}
