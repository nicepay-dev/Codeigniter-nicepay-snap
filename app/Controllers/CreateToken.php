<?php
 //defined('BASEPATH') OR exit('No direct script access allowed');
 namespace App\Controllers;
 use Requests;

class CreateToken extends BaseController { 
    
  
    
    public function create_function()
    {
       $X_CLIENT_KEY = 'NORMALTEST';
       $urlToken = NICEPAY_ACCESS_TOKEN;
       date_default_timezone_set('Asia/Jakarta');
       $X_TIMESTAMP = date('c');
       $stringToSign = $X_CLIENT_KEY."|".$X_TIMESTAMP;
       $private_key = NICEPAY_PRIVATE_KEY;
       $key = "-----BEGIN RSA PRIVATE KEY-----" . "\r\n" .
       "$private_key" . // string private key
       "\r\n" .
       "-----END RSA PRIVATE KEY-----";
       $signature = $this->generateSHA256withRSASignature($stringToSign, $key);

        // Prepare headers
        $headers = [
            'Content-Type' => 'application/json',
            'X-SIGNATURE' => $signature,
            'X-CLIENT-KEY' => $X_CLIENT_KEY,
            'X-TIMESTAMP' => $X_TIMESTAMP,
        ];

        // Prepare request data
        $data = array(
          "grantType" => "client_credentials",
          "additionalInfo" => json_encode(new \stdClass())
      );
         //print_r ($signature);
        // print_r (json_encode($data));
        // print_r ($requestToken);
      
        // Make the HTTP request to obtain the access token
        
        

        try {
          $response = Requests::post($urlToken, $headers, json_encode($data));
      } catch (\Throwable $th) {
          // throw $th;
          print_r($th);

          return response()->json([
              'status' => $response->status(),
              'message' => $response->successful(),
              'data' => $response->json()
          ]);

      }

      $responseData = json_decode($response->body, true);


    $data['responseCode'] = $responseData['responseCode'];
    $data['responseMessage'] = $responseData['responseMessage'];
    $data['accessToken'] = $responseData['accessToken']; 
    $data['expiresIn'] = $responseData['expiresIn'];

    $session = session();
    $session->set("aksesToken", $responseData['accessToken']);
    echo "<br>";
      //print_r ($responseData['accessToken']);
    echo view('requestToken',$data);

    // print_r($responseData);

      // print_r ($responseMessage);
       //print_r ($accessToken);
        // if ($response->success) {
        //     $tokenData = json_decode($response->body);

        //     // Access token is available in $tokenData->access_token
        //     echo $tokenData->access_token;
        // } else {
        //     // Handle error
        //     echo 'Error: ' . $response->body;
            
        // }
         return $response;
        
    }

    private function generateSHA256withRSASignature($data, $private_key)
    {
        $privateKey = openssl_pkey_get_private($private_key);

        openssl_sign($data, $signature, $privateKey, OPENSSL_ALGO_SHA256);

        openssl_free_key($privateKey);

        return base64_encode($signature);
    }

}