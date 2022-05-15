<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use \Firebase\JWT\JWT;
use App\Utils\TokenUtil;

class NasabahViewGuard implements FilterInterface
{

    public $tokenUtils;

    public function __construct()
    {
        $this->tokenUtils = new TokenUtil();
    }
    
    /**
     * TOKEN KEY.
     */
    public function getKey() : string
    {
        return "03102000";
    }

    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $token  = (isset($_COOKIE['token'])) ? $_COOKIE['token'] : null;
        $result = $this->tokenUtils->checkToken($token,false);

        $data   = [
            'token'     => $token,
            'privilege' => (isset($result['data']['privilege'])) ? $result['data']['privilege'] : null,
        ];

        if ($result['success'] == false) {
            setcookie('token', null, -1, '/'); 
            unset($_COOKIE['token']); 

            return redirect()->to(base_url().'/login');
        } 
        else if($data['privilege'] !== 'nasabah') {
            return redirect()->to(base_url().'/notfound');
        } 
        else {
            setcookie('token',$token,$this->tokenUtils->cookieOps($result['data']['expired']));
            return view('Nasabah/index',$data);
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
