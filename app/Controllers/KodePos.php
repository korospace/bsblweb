<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Exception;

class KodePos extends ResourceController
{
    public function searchKodePos(string $search)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://kodepos.vercel.app/search/?q=".$search);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);

        return $this->respond(json_decode($output),200);
    }
}
