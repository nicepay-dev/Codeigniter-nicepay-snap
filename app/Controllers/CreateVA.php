<?php
 //defined('BASEPATH') OR exit('No direct script access allowed');
 namespace App\Controllers;
 use Requests;
 

class CreateVA extends BaseController {
    // private $createToken;

    // public function __construct(CreateToken $createToken) {
    //     $this->CreateToken = $createToken;
    // }

    public function generate_va()
    {
        $http_method = "POST";
        $client_secret = NICEPAY_CLIENT_SECRET;
        date_default_timezone_set('Asia/Jakarta');
        $domain = "https://dev.nicepay.co.id/nicepay";
        $end_point = "/api/v1.0/transfer-va/create-va";
        $time_stamp = date('c');
        $partner_id = "NORMALTEST";
      
        
        $session = session();
        $access_token = $session->get('aksesToken');


        $external_id = random_string('alnum', 5);
        $trxId = 'trxIdVA'.random_string('numeric', 6);;

        $totalAmount = [
            "value" => "15000.00",
            "currency" => "IDR"
        ];  

        $additionalInfo = [
            "bankCd" => "CENA",
            "goodsNm" => "CENA",
            "dbProcessUrl" => "https://ptsv2.com/t/jhon/post",
            "vacctValidDt" => "",
            "vacctValidTm" => "",
            "msId" => "",
            "msFee" => "",
            "mbFee" => "",
            "mbFeeType" => ""
        ];
        
        $body = [
            "partnerServiceId" => "",
            "customerNo" => "", //for fix
            "virtualAccountNo" => "",
            "virtualAccountName" => "NICEPAY TESTING",
            "trxId" => "trxIdVa" . $time_stamp,
            "totalAmount" => $totalAmount,
            "additionalInfo" => $additionalInfo
        ];

        

        $bodyModel = [
            "partnerServiceId" => "NORMALTEST",
            "customerNo" => "",
            "virtualAccountNo" => "",
            "virtualAccountName" => "NICEPAY TESTING",
            "trxId" => $trxId,
            "totalAmount" => $totalAmount,
            "additionalInfo" => $additionalInfo
            ];

        $body = json_encode($bodyModel);
        $hashBody = strtolower(hash('sha256', $body));

           
        $stirgSign = $http_method.":".$end_point.":".$access_token.":".$hashBody.":".$time_stamp;
        

        $bodyHasing = hash_hmac("sha512", $stirgSign, $client_secret, true);
        $signature = base64_encode($bodyHasing);


        $channel = 'channel' . random_string('numeric', 6);

        $headers = [
            "Content-Type" => "application/Json",
            "Authorization" => "Bearer " . $access_token,
            "X-TIMESTAMP" => $time_stamp,
            "X-SIGNATURE" => $signature,
            "X-PARTNER-ID" => $partner_id,
            "X-EXTERNAL-ID" => $external_id,
            "CHANNEL-ID" => $channel
        ];


        try {
            $response = Requests::post($domain . $end_point, $headers, json_encode($bodyModel));
        } catch (\Throwable $th) {
            throw $th;
            print_r($th);
  
            return response()->json([
                'status' => $response->status(),
                'message' => $response->successful(),
                'data' => $response->json()
            ]);
  
        }
        $responseData = json_decode($response->body, true);

        $bankCodes =  [
            'CENA' => 'BCA',
            'BRIN' => 'BRI',
            'BMRI' => 'MANDIRI',
            'BBBA' => 'PERMATA',
            'BNIA' => 'CIMB',
            'BNIN' => 'BNI',
        ];

        // Ambil data yang diperlukan
        $data['responseCode'] = $responseData['responseCode'];
        $data['responseMessage'] = $responseData['responseMessage'];
        $data['virtualAccountNo'] = $responseData['virtualAccountData']['virtualAccountNo'];
        $data['virtualAccountName'] = $responseData['virtualAccountData']['virtualAccountName'];
        $data['trxId'] = $responseData['virtualAccountData']['trxId'];
        $amount = $responseData['virtualAccountData']['totalAmount']['value'];
        $data['currency'] = $responseData['virtualAccountData']['totalAmount']['currency'];
        $bankCode = $responseData['virtualAccountData']['additionalInfo']['bankCd'];
        $data['tXidVA'] = $responseData['virtualAccountData']['additionalInfo']['tXidVA'];
        $data['vacctValidDt'] = $responseData['virtualAccountData']['additionalInfo']['vacctValidDt'];
        $data['vacctValidTm'] = $responseData['virtualAccountData']['additionalInfo']['vacctValidTm'];

        $formatted_amount = number_format($amount, 0, '', '');
        $data['totalAmount'] = $formatted_amount;

        if (isset($bankCodes[$bankCode])) {
            $bankName = $bankCodes[$bankCode];
        } else {
            $bankName = 'Unknown Bank'; // Default jika kode bank tidak dikenal
        }
        $data['bankCode'] = $bankName;
        

        echo view('virtualAccount',$data);
        // $this->data['responseData'] = $responseData;
        // echo view('virtualAccount', $this->data);
        // print_r($responseData);
        
         return $response;
    }
}