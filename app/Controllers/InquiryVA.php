<?php
 //defined('BASEPATH') OR exit('No direct script access allowed');
 namespace App\Controllers;
 use Requests;
 

class InquiryVA extends BaseController {
  

    public function status_va()
    {
        $http_method = "POST";
        $client_secret = NICEPAY_CLIENT_SECRET;
        date_default_timezone_set('Asia/Jakarta');
        $domain = "https://dev.nicepay.co.id/nicepay";
        $end_point = "/api/v1.0/transfer-va/status";
        $time_stamp = date('c');
        $partner_id = "NORMALTEST";

        $session = session();
        $access_token = $session->get('aksesToken'); 

        //$amount = (float) $this->request->getPost('amount');
        $txid = $this->request->getPost('tXidVA');
        $vanum = $this->request->getPost('vanum');
        $trxId = $this->request->getPost('trxId');
        // print_r($amount);
        //print_r($txid);
        // print_r($vanum);
        // print_r($trxId);
        //$amount = "15000.00";

        
        $external_id = random_string('alnum', 5);
        $totalAmount = [
            "value" => "15000.00",
            "currency" => "IDR"
        ];  

    
        $additionalInfo = [
            "tXidVA" => $txid,
            "trxId" => $trxId,
            "totalAmount" => $totalAmount
        ];
        

        $bodyModel = [
            "partnerServiceId" => "",
            "customerNo" => "",
            "virtualAccountNo" => $vanum,
            "inquiryRequestId" => "",
            "additionalInfo" => $additionalInfo
            ];

            //print_r($bodyModel);

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

        $data['virtualAccountNo'] = $responseData['virtualAccountData']['virtualAccountNo'];
        $data['virtualAccountName'] = $responseData['additionalInfo']['virtualAccountName'];
        $data['trxId'] = $responseData['additionalInfo']['trxId'];
        $data['transactionStatusDesc'] = $responseData['additionalInfo']['transactionStatusDesc'];
        $data['latestTransactionStatus'] = $responseData['additionalInfo']['latestTransactionStatus'];
        $amount = $responseData['virtualAccountData']['totalAmount']['value'];
        $data['tXidVA'] = $responseData['additionalInfo']['tXidVA'];

        $formatted_amount = number_format($amount, 0, '', '');
        $data['totalAmount'] = $formatted_amount;


        // $this->data['responseData'] = $responseData;
         echo view('inquiryVA', $data);
        // print_r($responseData);
        

        // if (strpos($amount, '.00') !== false) {
        //     $amount = rtrim($amount, '.00');
        // }
        

        return $response;
    
    }
}