<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomePage extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'bsbl | Homepage'
        ];

        return view('HomePage/index',$data);
    }
}
