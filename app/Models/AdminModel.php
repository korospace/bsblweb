<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class AdminModel extends Model
{
    protected $table                = 'admin';
    protected $primaryKey           = 'id';
    protected $allowedFields        = ['id','id_admin','username','password','nama_lengkap','notelp','alamat','tgl_lahir','kelamin','privilage','status','token','last_active'];

}
