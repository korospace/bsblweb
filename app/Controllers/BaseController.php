<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use CodeIgniter\RESTful\ResourceController;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use \Firebase\JWT\JWT;

use Exception as phpException;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends ResourceController
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    /**
     * TOKEN KEY.
     */
    public function getKey() : string
    {
        return "03102000";
    }

    /**
     * Generate OTP.
     */
    public function generateOTP(int $n) : string
    {
        $generator = "1357902468";      
        $result    = "";
      
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
      
        return $result;
    }

    /**
     * file to Base64.
     */
    public function base64Decode(String $path,String $type) : string
    {
        $path   = $path;
        $data   = file_get_contents($path);
        $type   = preg_replace('/\s+/', '', $type);
        $base64 = 'data:'.$type.';base64,'.base64_encode($data);
        // var_dump('tes'.$base64);die;
      
        return $base64;
    }

    public function encrypt(string $pass) 
    { 
        return openssl_encrypt(trim($pass), "AES-128-ECB", $this->getKey()); 
    } 

    public function decrypt(string $pass) 
    { 
        return openssl_decrypt($pass, "AES-128-ECB", $this->getKey()); 
    } 

    /**
     * Send Email OTP.
     */
    public function sendVerification(String $email,String $otp)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();                          
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 465;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'ssl';
            // $mail->Username   = 'banksampahbudiluhur@gmail.com';
            // $mail->Password   = 'latxapaiejnamadl';
            $mail->Username   = 'bsublservice@gmail.com';
            $mail->Password   = 'cibqkqfbrvoaxvwt';
            $mail->Subject    = 'code OTP';
            $mail->Body       = "Terimakasih sudah bergabung bersama Bank Sampah Budiluhur.<br>berikut adalah code OTP anda:<br><h1>$otp</h1>";

            $mail->setFrom('bsublservice@gmail.com', 'Bank Sampah UBL');
            $mail->addAddress($email);
            $mail->isHTML(true);

            if($mail->send()) {
                return true;
            }
        } 
        catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Send Kritik AND Saran
     */
    public function sendKritikSaran(String $userName,String $userEmail,String $message)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();                          
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 465;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'ssl';
            // $mail->Username   = 'banksampahbudiluhur@gmail.com';
            // $mail->Password   = 'latxapaiejnamadl';
            $mail->Username   = 'bsublservice@gmail.com';
            $mail->Password   = 'cibqkqfbrvoaxvwt';
            $mail->Subject    = 'Kritik Dan Saran';
            $mail->Body       = "<p>name  : $userName</p>
            <p>email : $userEmail</p><br>
            <p><b><u>kriti dan saran:</u></b></p>$message";

            $mail->setFrom($userEmail,$userName);
            $mail->addAddress('banksampahbudiluhur@gmail.com','Banksampah Budiluhur');
            $mail->addReplyTo($userEmail,$userName);
            $mail->isHTML(true);

            if($mail->send()) {
                return true;
            }
        } 
        catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Send Forgot Password
     */
    public function sendForgotPass(String $userEmail,String $password)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();                          
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 465;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'ssl';
            // $mail->Username   = 'banksampahbudiluhur@gmail.com';
            // $mail->Password   = 'latxapaiejnamadl';
            $mail->Username   = 'bsublservice@gmail.com';
            $mail->Password   = 'cibqkqfbrvoaxvwt';
            $mail->Subject    = 'Lupa Password';
            $mail->Body       = "<u>password anda:</u><h1>$password</h1>";

            $mail->setFrom('bsublservice@gmail.com', 'Bank Sampah UBL');
            $mail->addAddress($userEmail);
            $mail->isHTML(true);

            if($mail->send()) {
                return true;
            }
        } 
        catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Privilege check
     */
    public function checkPrivilege(array $resultCheckToken)
    {
        $privilege  = (isset($resultCheckToken['message']['data']['privilege']) ) ? $resultCheckToken['message']['data']['privilege'] : 'nasabah';

        if (!in_array($privilege,['admin','super'])) {
            $response = [
                'status'   => 401,
                'error'    => true,
                'messages' => 'access denied',
            ];
    
            return $this->respond($response,401);
        } 
    }

    /**
     * Generate New Token 
     */
    public function generateToken(String $id,bool $rememberme,?String $username = null,?String $privilege = null): string
    {
        // $iat = time(); // current timestamp value
        // $nbf = $iat + 10;

        $payload = array(
            // "iat" => $iat, // issued at
            // "nbf" => $nbf, //not before in seconds
            "id"         => $id,
            "uniqueid"   => uniqid(),
            "expired"    => ($rememberme == true) ? time()+2592000 : time()+3600, 
        );

        ($username)  ? $payload['username']  = $username  : '' ;
        ($privilege) ? $payload['privilege'] = $privilege : '' ;
        // var_dump($payload);die;

        return JWT::encode($payload, $this->getKey());
    }

    /**
     * Check token
     */
    public function checkToken(?string $token,?bool $dbcheck = true): array
    {
        try {
            $db      = \Config\Database::connect();
            $key     = $this->getKey();
            $decoded = JWT::decode($token, $key, array("HS256"));
            $decoded = (array)$decoded;
            $table   = (isset($decoded['privilege'])) ? 'admin' : 'nasabah';

            if ($dbcheck == false) {
                return [
                    'success'   => true,
                    'username'  => (isset($decoded['username' ])) ? $decoded['username' ] : '',
                    'privilege' => (isset($decoded['privilege'])) ? $decoded['privilege'] : '',
                    'expired'   => $decoded['expired'] - time(),
                ];
            }
            else if (time() < $decoded['expired']) {
                if ($table == 'admin') {
                    $dataUser = $db->table('admin')->select('token')->where("token", $token)->get()->getResultArray();
                } 
                else {
                    $dataUser = $db->table('nasabah')->select('token')->where("token", $token)->get()->getResultArray();
                }

                if (!empty($dataUser)) {
                    $response = [
                        'status'   => 200,
                        'error'    => false,
                        'data'     => $decoded
                    ];

                    $response['data']['expired'] = $decoded['expired'] - time();
                    
                    return [
                        'success' => true,
                        'message' => $response
                    ];
                } 
                else {
                    return [
                        'success' => false,
                        'code'    => 401,
                        'message' => 'access denied'
                    ];
                }
            } 
            else {
                $db->table($table)->where('id', $decoded['id'])->update(['token' => null]);
                
                if ($db->affectedRows()> 0) {
                    $msg = 'token expired';
                }
                else {
                    $msg = 'access denied';
                }

                return [
                    'success' => false,
                    'code'    => 401,
                    'message' => $msg 
                ];
            }
        } 
        catch (phpException $ex) {
            return [
                'success' => false,
                'code'    => 401,
                'message' => 'access denied'
            ];
        }
    }

    /**
     * Unix timestamp parser
     */
    public function SECONDS_TO_HMS(int $seconds): string
    {

        $hrs  = floor($seconds / 3600);
        $mins = intval(($seconds / 60) % 60); 
        $sec  = intval($seconds % 60);

        $hrs  = str_pad($hrs,2,'0',STR_PAD_LEFT);
        $mins = str_pad($mins,2,'0',STR_PAD_LEFT);
        $sec  = str_pad($sec,2,'0',STR_PAD_LEFT);

        return $hrs." jam ".$mins." menit";
        // return $hrs." jam ".$mins." menit ".$sec." detik";
    }

    /**
     * Method Parser.
     */
    function _methodParser(string $variableName): void
    {
        // global $_PUT;

        $putdata  = fopen("php://input", "r");
        $raw_data = '';

        while ($chunk = fread($putdata, 1024))
            $raw_data .= $chunk;

        fclose($putdata);

        $boundary = substr($raw_data, 0, strpos($raw_data, "\r\n"));

        if(empty($boundary)){
            parse_str($raw_data,$data);
            $GLOBALS[ $variableName ] = $data;
            return;
        }

        $parts = array_slice(explode($boundary, $raw_data), 1);
        $data  = array();

        foreach ($parts as $part) {
            if ($part == "--\r\n") break;

            $part = ltrim($part, "\r\n");
            list($raw_headers, $body) = explode("\r\n\r\n", $part, 2);

            $raw_headers = explode("\r\n", $raw_headers);
            $headers = array();
            foreach ($raw_headers as $header) {
                list($name, $value) = explode(':', $header);
                $headers[strtolower($name)] = ltrim($value, ' ');
            }

            if (isset($headers['content-disposition'])) {
                $filename = null;
                $tmp_name = null;
                preg_match(
                    '/^(.+); *name="([^"]+)"(; *filename="([^"]+)")?/',
                    $headers['content-disposition'],
                    $matches
                );
                
                if(count($matches) !== 0){
                    list(, $type, $name) = $matches;
                }

                if( isset($matches[4]) )
                {
                    if( isset( $_FILES[ $matches[ 2 ] ] ) )
                    {
                        continue;
                    }

                    $filename       = $matches[4];
                    $filename_parts = pathinfo( $filename );
                    $tmp_name       = tempnam( ini_get('upload_tmp_dir'), $filename_parts['filename']);

                    $_FILES[ $matches[ 2 ] ] = array(
                        'error'=>0,
                        'name'=>$filename,
                        'tmp_name'=>$tmp_name,
                        'size'=>strlen( $body ),
                        'type'=>preg_replace('/\s+/', '', $value)
                    );

                    file_put_contents($tmp_name, $body);
                }
                else
                {
                    $data[$name] = substr($body, 0, strlen($body) - 2);
                }
            }

        }
        $GLOBALS[ $variableName ] = $data;
        return;
    }
}
