<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProfileNasabah extends BaseController
{
    public function profilenasabah()
    {
        $data = [
            'title' => 'Selamat Datang Di Tampilan Profile'
        ];

        return view('Nasabah/profilenasabah',$data);
    }
}
