<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;

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
        $model = new ArtikelModel();
        $post  = $model->select("title,thumbnail")->where('slug',$slug)->first();

        $data = [
            'title' => $post['title'],
            'slug'  => $slug,
            'thumbnail' => base_url().'/assets/images/thumbnail-berita/'.$post['thumbnail']
        ];

        return view('HomePage/detilArtikel', $data);
    }
}
