<?php

namespace App\Helpers;

use CodeIgniter\HTTP\Exceptions\HTTPException;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;

class HttpRequest
{
    protected $client;

    public function __construct()
    {
        // Load the CURLRequest service
        $this->client = Services::curlrequest();
    }

    /**
     * Wrapper of CodeIgniter's CURLRequest to make API request to Nicepay API
     * @param array $headers
     * @param string $requestUrl
     * @param mixed $requestBody
     * @param string $method
     * @param bool $isRetryFlag
     * @param int $retryLimit
     * @return mixed API response, or throws an exception during request
     */
    public function request($headers, $requestUrl, $requestBody, $method = 'POST', $isRetryFlag = false, $retryLimit = 3)
    {
        $attempt = 0;
        $timeoutErrorCodes = [CURLE_OPERATION_TIMEOUTED, CURLE_COULDNT_CONNECT];

        do {
            try {
                // Build options for the request
                $options = [
                    'headers' => $headers,
                    'timeout' => 15,  // Timeout in seconds
                    'http_errors' => false, // Disable automatic exception throwing on HTTP errors
                    'verify'=> false, //for local testing only
                ];

                // Add request body for POST, PUT, PATCH, DELETE
                if (in_array(strtoupper($method), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
                    $options['body'] = $requestBody;
                }

                // Make the request
                $response = $this->client->request(strtoupper($method), $requestUrl, $options);
                
                
                $statusCode = $response->getStatusCode();
                $responseBody = $response->getBody();

                // Check for successful response (2xx HTTP codes)
                if ($statusCode >= 200 && $statusCode < 300) {
                    $jsonResponse = json_decode($responseBody, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        return $response;
                    } else {
                        throw new Exception("Failed to parse response as JSON: " . json_last_error_msg() . "\nResponse: " . $responseBody);
                    }
                }

                // Retry on Gateway Timeout (504) or other retryable conditions
                if ($isRetryFlag && $statusCode === 504 && $attempt < $retryLimit) {
                    $attempt++;
                    sleep(1); // wait 1 second before retrying
                    continue;
                }

                // Handle non-retryable errors
                $decodedResponse = json_decode($responseBody, true);
                throw new Exception("HTTP Error $statusCode: " . print_r($decodedResponse, true));

            } catch (HTTPException $e) {
                // Handle connection errors or timeout
                if ($isRetryFlag && in_array($e->getCode(), $timeoutErrorCodes) && $attempt < $retryLimit) {
                    $attempt++;
                    sleep(1); // wait before retrying
                    continue;
                }
                throw new Exception("HTTP request failed: " . $e->getMessage());
            }
        } while ($isRetryFlag && $attempt <= $retryLimit);

        
        // If retries are exhausted, return the last response or throw an error
        return $response ?? null;
    }
}
