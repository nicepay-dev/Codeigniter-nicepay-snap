<?php

namespace App\Libraries;

use App\Models\{NicepayResponse, AccessToken, NICEPay};
use App\Helpers\Helper;
use CodeIgniter\HTTP\ResponseInterface;
use App\Helpers\HttpRequest;

class Snap
{
    private NICEPay $apiConfig;
    private $httpClient;
    private $helper;

    public function __construct(NICEPay $config)
    {
        $this->apiConfig = $config;
        $this->httpClient = new HttpRequest();  // Use CodeIgniter's CURLRequest service
        $this->helper = new Helper();
    }

    /**
     * Requests a SNAP transaction
     * 
     * @param mixed $parameter
     * @param string $endPoint
     * @param string $accessToken
     * @param string $method
     * @return NicepayResponse
     */


    /**
     * Requests SNAP access token
     * 
     * @param AccessToken $parameter
     * @return NicepayResponse
     */
    public function requestSnapAccessToken(AccessToken $parameter): NicepayResponse
    {
        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "v1.0/access-token/b2b";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders(null, $parameter->getGrantType(), null, null, null);

        $response = $this->httpClient->request($headers, $url, $jsonData, "POST", $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    // VIRTUAL ACCOUNT

    public function requestSnapTransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/transfer-va/create-va";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    public function requestSnapInquiryTransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/transfer-va/status";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    public function requestSnapDeleteVATransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/transfer-va/delete-va";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    // QRIS

    public function requestSnapQrisTransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/qr/qr-mpm-generate";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    public function requestSnapInquiryQrisTransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/qr/qr-mpm-query";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    public function requestSnapRefundQrisTransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/qr/qr-mpm-refund";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    // EWALLET

    public function requestSnapEwalletTransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/debit/payment-host-to-host";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    public function requestSnapInquiryEwalletTransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/debit/status";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    public function requestSnapRefundEwalletTransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/debit/refund";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    // PAYOUT

    public function requestSnapRegistrationPayoutTransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/transfer/registration";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    public function requestSnapApprovePayoutTransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/transfer/approve";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    public function requestSnapRejectPayoutTransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/transfer/reject";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    public function requestSnapInquiryPayoutTransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/transfer/inquiry";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    public function requestSnapCancelPayoutTransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/transfer/cancel";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    public function requestSnapCheckBalancePayoutTransaction($parameter, $endPoint, $accessToken, $method): NicepayResponse
    {

        $config = $this->apiConfig;
        $url = $this->apiConfig->getNicepayBaseUrl() . "api/v1.0/balance-inquiry";
        $jsonData = json_encode($parameter->toArray());

        // Prepare headers
        $headers = $this->getHeaders($method, null, $accessToken, $jsonData, $endPoint);

        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $this->handleResponse($response);
    }

    /**
     * Handles response processing
     * 
     * @param ResponseInterface $response
     * @return NicepayResponse
     */
    private function handleResponse(ResponseInterface $response): NicepayResponse
    {
        $httpCode = $response->getStatusCode();
        $body = $response->getBody();

        if ($httpCode >= 200 && $httpCode < 300) {
            $jsonResponse = json_decode($body, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return NicepayResponse::fromArray($jsonResponse);
            } else {
                throw new \Exception("Failed to parse JSON response: " . json_last_error_msg());
            }
        }

        // Handle errors (non-2xx status codes)
        throw new \Exception("HTTP Error $httpCode: " . $body);
    }

    /**
     * Generates request headers
     * 
     * @param string|null $httpMethod
     * @param string|null $grantType
     * @param string|null $accessToken
     * @param string|null $data
     * @param string|null $endPoint
     * @return array
     */
    public function getHeaders($httpMethod, $grantType, $accessToken, $data, $endPoint): array
    {
        $partnerID = $this->apiConfig->getPartnerId();
        $privateKey = $this->apiConfig->getPrivateKey();
        $secretKey = $this->apiConfig->getClientSecret();
        $externalId = $this->apiConfig->getExternalID();
        $timeStamp = $this->apiConfig->getTimeStamp();
        $channelId = $partnerID . "01";

        if ($grantType) {
            $stringToSign = $partnerID . "|" . $timeStamp;
            $signature = $this->helper->getSignatureAccessToken($privateKey, $stringToSign);

            return [
                'Content-Type' => 'application/json',
                'X-TIMESTAMP' => $timeStamp,
                'X-CLIENT-KEY' => $partnerID,
                'X-SIGNATURE' => $signature,
            ];
        } else {
            $hexPayload = $this->helper->getEncodePayload($data);
            $stringToSign = "$httpMethod:/$endPoint:$accessToken:$hexPayload:$timeStamp";
            $signature = $this->helper->getRegistSignature($stringToSign, $secretKey);

            return [
                'Content-Type' => 'application/json',
                'X-TIMESTAMP' => $timeStamp,
                'X-SIGNATURE' => $signature,
                'Authorization' => "Bearer $accessToken",
                'X-PARTNER-ID' => $partnerID,
                'X-EXTERNAL-ID' => $externalId,
                'CHANNEL-ID' => $channelId,
            ];
        }
    }
}
