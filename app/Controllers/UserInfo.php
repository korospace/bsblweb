<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserInfo extends BaseController
{
    public function info()
    {
        $data = [
            'title' => 'Info Nasabah'
        ];

        return view('Admin/user',$data);
    }
}
