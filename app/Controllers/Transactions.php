<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Transactions extends BaseController
{
    public function formTransaksi()
    {
        if (isset($_POST['name']) && isset($_POST['id'])) {
            $data = [
                'name'    => $_POST['name'],
                'id' => $_POST['id']
            ];

            return view('/Admin',$data);
        }
        else {
            return redirect()->to(base_url().'/admin/transaction');
        }
    }
}