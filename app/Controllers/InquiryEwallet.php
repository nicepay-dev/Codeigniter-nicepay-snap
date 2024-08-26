<?php
 //defined('BASEPATH') OR exit('No direct script access allowed');
 namespace App\Controllers;
 use Requests;
 

class InquiryEwallet extends BaseController {
  

    public function status_ewallet()
    {
        $http_method = "POST";
        $client_secret = NICEPAY_CLIENT_SECRET;
        date_default_timezone_set('Asia/Jakarta');
        $domain = "https://dev.nicepay.co.id/nicepay";
        $end_point = "/api/v1.0/debit/status";
        $time_stamp = date('c');
        $partner_id = "TNICEEW051";
        //$createToken = new CreateToken();
        $session = session();
        $access_token = $session->get('aksesToken'); 

        //Call the create_function method to get the access token
        // $accessToken = $createToken->create_function();
        // $responseData = json_decode($accessToken->body, true);
        // $access_token = $responseData['accessToken'];  
        $external_id = random_string('alnum', 5);

        $partnerRefNo = $this->request->getPost('partnerRefNo');
        $RefNo = $this->request->getPost('RefNo');

        $totalAmount = [
            "value" => "15.00",
            "currency" => "IDR"
        ];  

        $additionalInfo = new \stdClass();
        
        $bodyModel = [
            "merchantId" => $partner_id,
            "subMerchantId" => "",
            "originalPartnerReferenceNo" => $partnerRefNo,
            "originalReferenceNo" => $RefNo,
            "serviceCode" => "54",
            "transactionDate" => $time_stamp,
            "externalStoreId" => $external_id,
            "amount" => $totalAmount,   
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

        $mitraCodes = [
            'ESHP' => 'ShopeePay',
            'DANA' => 'Dana',
            'LINK' => 'Link Aja',
            'OVOE' => 'OVO',
        ];

        $data['responseCode'] = $responseData['responseCode'];
        $data['responseMessage'] = $responseData['responseMessage'];
        $data['originalPartnerReferenceNo'] = $responseData['originalPartnerReferenceNo'];
        $data['originalReferenceNo'] = $responseData['originalReferenceNo'];
        $data['latestTransactionStatus'] = $responseData['latestTransactionStatus'];
        $data['transactionStatusDesc'] = $responseData['transactionStatusDesc'];
        $transAmountValue = $responseData['transAmount']['value'];
        $data['transAmount'] = number_format($transAmountValue, 0, '', '');
        $data['goodsNm'] = $responseData['additionalInfo']['goodsNm'];
        $mitraCd = $responseData['additionalInfo']['mitraCd'];
        $data['billingPhone'] = $responseData['additionalInfo']['billingPhone'];
        $data['billingNm'] = $responseData['additionalInfo']['billingNm'];
        
        if(isset($mitraCodes[$mitraCd])){
            $mitraNm = $mitraCodes[$mitraCd];
        }else {
            $mitraNm = 'Unknown mitra cd';
        }
        $data['mitraCd'] = $mitraNm;
         //$this->data['responseData'] = $responseData;
        echo view('inquiryEwallet',$data);
        //print_r($responseData);
        
    
    }
}