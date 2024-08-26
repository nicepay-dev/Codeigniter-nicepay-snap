<?php
 //defined('BASEPATH') OR exit('No direct script access allowed');
 namespace App\Controllers;
 use Requests;
 

class CreateEwallet extends BaseController {
  

    public function generate_ewallet()
    {
        
        $http_method = "POST";
        $client_secret = NICEPAY_CLIENT_SECRET;
        date_default_timezone_set('Asia/Jakarta');
        $domain = "https://dev.nicepay.co.id/nicepay";
        $end_point = "/api/v1.0/debit/payment-host-to-host";
        $time_stamp = date('c');
        //$x_time_stamp = $time_stamp->toIso8601String();
        //$date = $time_stamp->format('YmdHis');
        $partner_id = "TNICEEW051";

        $session = session();
        $access_token = $session->get('aksesToken'); 

        //print_r($x_time_stamp);

        $external_id = random_string('alnum', 5);
        $trxId = 'trxIdVA'.random_string('numeric', 6);
        $reference_no = 'refNo'. random_string('numeric', 10);

      $urlParam = array();
        $paramNotify = [
            "url" => "https://ptsv2.com/t/jhon/post",
            "type" => "PAY_NOTIFY",
            "isDeeplink" => "Y"
        ];
        array_push($urlParam, $paramNotify);
        $paramReturn = [
            "url" => "https://ptsv2.com/t/jhon/post",
            "type" => "PAY_RETURN",
            "isDeeplink" => "Y"
        ];
        array_push($urlParam, $paramReturn);

    //print_r ($urlParam);

        $items = array();
        
        $itemA = [
            "img_url" => "https://d3nevzfk7ii3be.cloudfront.net/igi/vOrGHXlovukA566A.medium",
            "goods_name" => "Nokia 3360",
            "goods_detail" => "Old Nokia 3360",
            "goods_amt" => "0.00",
            "goods_quantity" => "1"
        ];
        array_push($items, $itemA);
        $itemB = [
            "img_url" => "https://d3nevzfk7ii3be.cloudfront.net/igi/vOrGHXlovukA566A.medium",
            "goods_name" => "Nokia 3360",
            "goods_detail" => "Old Nokia 3360",
            "goods_amt" => "1.00",
            "goods_quantity" => "15"
        ];
        array_push($items, $itemB);
        $countAmt = 0;
        $countItm = 0;
        foreach ($items as $itm) {
            $amt = $itm["goods_amt"];
            str_replace(".00", "", $amt);

            $countAmt += (int) $itm["goods_quantity"] * (int) $amt;
            $countItm++;
        }
        
        $cartData = [
            "count" => "$countItm",
            "item" => $items
        ];

        $Amount = [
            "value" => $countAmt . ".00",
            "currency" => "IDR"
        ];  
        

        $additionalInfo = [
            "mitraCd" => "ESHP",
            "goodsNm" => "Testing ewallet",
            "billingNm" => "ewallet test",
            "billingPhone" => "089665542347",
            "dbProcessUrl" => "http://ptsv2.com/t/dbProcess/post",
            "callBackUrl" => "https://www.nicepay.co.id/IONPAY_CLIENT/paymentResult.jsp",
            "cartData" => json_encode($cartData)
        ];

    

        $bodyModel = [
            "partnerReferenceNo" => $reference_no,
            "merchantId" => $partner_id,
            "subMerchantId" => "",
            "externalStoreId" => "",
            "validUpTo" => "",
            "urlParam" => $urlParam,
            "pointOfInitiation" => "Mobile App",
            "amount" => $Amount,
            "additionalInfo" => $additionalInfo
            ];

        $body = json_encode($bodyModel);
        $hashBody = strtolower(hash('sha256', $body));

           
        $stirgSign = $http_method . ":" . $end_point . ":" . $access_token . ":" . $hashBody . ":" . $time_stamp;
        $bodyHasing = hash_hmac("sha512", $stirgSign, $client_secret, true);
        //print_r($stirgSign);
        //GET SIGNATURE
        $signature = base64_encode($bodyHasing);
        //GET CHANNEL-ID
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


        //print_r($headers);

        try {
            $response = Requests::post($domain . $end_point, $headers, json_encode($bodyModel));
           
        } catch (\Throwable $th) {
             throw $th;
            print_r($th);
  
            return response()->json([
                'status' => $response->status(),
                'message' => $response->successful(),
                'data' => $response->json()
            ])->setEncodingOptions(JSON_UNESCAPED_SLASHES);
  
        }
        //$responseData = $response->body;
        //print_r(json_decode($response->body,true));
        $responseData = json_decode($response->body, true);
        print "<br\>";

        // $dataDummy = [
        //     'responseCode' => '2005400',
        //     'responseMessage' => 'Successful',
        //     'partnerReferenceNo' => '2020102900000000000001',
        //     'referenceNo' => 'TNICEEW05105202210141451109841',
        //     'webRedirectUrl' => 'https://pjsp.com/universal?bizNo=REF993883&...',
        //     'appRedirectUrl' => 'https://pjsp.com/universal?bizNo=REF993883&...',
        //     'additionalInfo' => [
        //         'redirectToken' => 'df548fff93e82aad9174c657820a85aa5d10042535157c7e89f52499'
        //     ]
        // ];
    
        //print_r($dataDummy);
        $this->data['responseData'] = $responseData;
       echo view('ewallet',$this->data);

        //$resp = json_decode($responseData);
        //$json = json_encode(array_map('utf8_encode', $responseData));
        //$json = $response->getJSON();
        //print_r(CreateEwallet::myUrlEncode($resp->webRedirectUrl));
        //print_r($responseData);
        //$wm_string1 = (parse_url(urldecode($resp->webRedirectUrl)));
        //header("Content-type: application/json");
        //die(CreateEwallet::myUrlEncode($resp->webRedirectUrl));
        print "<br\>";

        // $wm_string = rawurlencode($resp->webRedirectUrl);
        
       //print("test");
       //var_dump($wm_string1);
    //    var_dump(json_encode($wm_string, JSON_PRETTY_PRINT));
    //    echo '<br>';       
       //return 0;

        
        
    
    }

       function flash_encode($string)
   {
      $string = rawurlencode(utf8_encode($string));

      $string = str_replace("%C2%96", "-", $string);
      $string = str_replace("%C2%91", "%27", $string);
      $string = str_replace("%C2%92", "%27", $string);
      $string = str_replace("%C2%82", "%27", $string);
      $string = str_replace("%C2%93", "%22", $string);
      $string = str_replace("%C2%94", "%22", $string);
      $string = str_replace("%C2%84", "%22", $string);
      $string = str_replace("%C2%8B", "%C2%AB", $string);
      $string = str_replace("%C2%9B", "%C2%BB", $string);

      return $string;
   }

   function myUrlEncode($string) {
    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    return str_replace($entities, $replacements, urlencode($string));
}
}