<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class Admin extends ResourceController
{
    public $basecontroller;

	public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->baseController = new BaseController;
    }

    public function login()
    {
        var_dump(password_hash('superadmin', PASSWORD_DEFAULT));die;
    }
}
