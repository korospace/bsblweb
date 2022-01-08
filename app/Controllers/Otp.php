<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\OtpModel;

class Otp extends BaseController
{
    public $otpModel;

	public function __construct()
    {
        $this->otpModel   = new OtpModel;
    }

    /**
     * Page for OTP Verification
     */
    public function otpView()
    {
        $data = [
            'title'    => 'Nasabah | verifikasi akun',
            'password' => (isset($_POST['password'])) ? $_POST['password'] : '',
            'username_or_email' => (isset($_POST['username_or_email']))    ? $_POST['username_or_email']    : '' ,
        ];

        return view('OtpPage/index',$data);
    }

    /**
     * Verifikasi akun
     *   url    : domain.com/otp/verify
     *   method : POST
     */
    public function verifyOtp(): object
    {
		$data   = $this->request->getPost();
        $this->validation->run($data,'verifyOtpValidate');
        $errors = $this->validation->getErrors();

        if($errors) {
            $response = [
                'status'   => 400,
                'error'    => true,
                'messages' => $errors['code_otp'],
            ];
    
            return $this->respond($response,400);
        } 
        else {
            
            $codeOtp    = $this->request->getPost('code_otp');
            $dbrespond  = $this->otpModel->verifyOtp($codeOtp);
    
            return $this->respond($dbrespond,$dbrespond['status']);
        }    
    }
}
