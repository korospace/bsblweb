<?php
namespace App\Utils;

use \Firebase\JWT\JWT;

class TokenUtil {
    /**
     * Api response
     */
    static private function httpResponse(array $response): string
    {
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code($response['status']);
        echo json_encode($response);
        die;
    }

    /**
     * Cookie Option
     */
    public function cookieOps(string $expired) : array
    {
        $cookie_options = array(
            'expires' => time() + $expired,
            'path' => '/',
            'domain' => base_url(), // leading dot for compatibility or use subdomain
            'secure' => true, // or false
            'httponly' => false, // or false
            'samesite' => 'None' // None || Lax || Strict
        );

        return $cookie_options;
    }

    /**
     * TOKEN KEY.
     */
    public function getKey() : string
    {
        return "03102000";
    }

    /**
     * Check token
     */
    public function checkToken(?string $token = null,?bool $dbcheck = true): array
    {
        try {
            if ($token == null) {
                // get token from HttpHeader
                $authHeader = $this->request->getHeader('token');
                $token      = ($authHeader != null) ? $authHeader->getValue() : null;
            }

            // token decode
            $key       = $this->getKey();
            $decoded   = JWT::decode($token, $key, array("HS256"));
            $decoded   = (array)$decoded;
            $dbConnect = \Config\Database::connect();

            if ($dbcheck == false) {
                return [
                    'success' => true,
                    'error'   => false,
                    'status'  => 200,
                    'data'    => [
                        'userid'    => $decoded['id'],
                        'password'  => $decoded['password'],
                        'privilege' => $decoded['privilege'],
                        'expired'   => $decoded['expired'] - time(),
                    ],
                ];
            }
            else if (time() < $decoded['expired']) {
                $dataUser = $dbConnect->table('users')->select('token')->where("token", $token)->get()->getResultArray();

                if (!empty($dataUser)) {
                    return [
                        'success' => true,
                        'error'   => false,
                        'status'  => 200,
                        'data'    => [
                            'userid'    => $decoded['id'],
                            'password'  => $decoded['password'],
                            'privilege' => $decoded['privilege'],
                            'expired'   => $decoded['expired'] - time(),
                        ],
                    ];
                } 
                else {
                    self::httpResponse([
                        'success'  => false,
                        'error'    => true,
                        'status'   => 401,
                        'messages' => 'invalid token',
                    ]);
                }
            } 
            else {
                $dbConnect->table('users')->where('id', $decoded['id'])->update(['token' => null]);

                self::httpResponse([
                    'success'  => false,
                    'error'    => true,
                    'status'   => 401,
                    'messages' => ($dbConnect->affectedRows()>0) ? 'token expired' : 'invalid token' 
                ]);
            }
        } 
        catch (\Throwable  $ex) {
            $response = [
                'success' => false,
                'error'   => true,
                'status'  => 401,
                'message' => 'access denied'
            ];

            if ($dbcheck == false) {
                return $response;
            }

            self::httpResponse($response);
        }
    }
} 