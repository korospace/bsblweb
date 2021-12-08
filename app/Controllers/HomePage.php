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

    public function listArtikel(string $kategori)
    {
        $data = [
            'title'    => 'Artikel | ' . $kategori,
            'kategori' => $kategori,
        ];

        return view('HomePage/listArtikel', $data);
    }

    public function detilArtikel(string $slug)
    {
        $data = [
            'title' => 'Artikel',
            'slug'  => $slug,
        ];

        return view('HomePage/detilArtikel', $data);
    }
}
