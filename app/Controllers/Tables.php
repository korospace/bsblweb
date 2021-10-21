<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Tables extends BaseController
{
    public function tables()
    {
        $data = [
            'title' => 'Tabel Nasabah Bank Sampah'
        ];

        return view('Admin/tables',$data);
    }
}
