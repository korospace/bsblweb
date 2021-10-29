<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Artikel extends BaseController
{
    public function index(string $kategori)
    {
        $data = [
            'title' => 'Artikel | ' . $kategori,
        ];

        return view('Artikel/index', $data);
    }
}
