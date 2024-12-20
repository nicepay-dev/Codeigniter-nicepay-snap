<?php

namespace App\Helpers;

use CodeIgniter\I18n\Time;
use Exception;

class Helper
{
    /**
     * Sign data with a private key using OpenSSL
     * 
     * @param  string $privateKeyString - private key in string format
     * @param  string $stringToSign - data to be signed
     * @return string - base64 encoded signature
     * @throws Exception - if the private key is invalid
     */
    public static function getSignatureAccessToken($privateKeyString, $stringToSign)
    {
        // Wrap the key with proper RSA private key format
        $privateKey = openssl_pkey_get_private(self::getKey($privateKeyString));

        if (!$privateKey) {
            throw new Exception('Invalid private key');
        }

        openssl_sign($stringToSign, $signature, $privateKey, OPENSSL_ALGO_SHA256);

        return base64_encode($signature);
    }

    /**
     * Hashes and encodes request body using SHA-256
     * 
     * @param  mixed $requestBody - the request body (can be an array or string)
     * @return string - SHA-256 hashed and encoded payload
     */
    public function getEncodePayload($requestBody)
    {
        if (!is_string($requestBody)) {
            $requestBody = json_encode($requestBody);
        }

        return strtolower(hash('sha256', $requestBody));
    }

    /**
     * Sign data with client secret using HMAC-SHA512
     * 
     * @param  string $stringToSign - data to sign
     * @param  string $clientSecret - client secret for HMAC signing
     * @return string - base64 encoded HMAC-SHA512 signature
     */
    public function getRegistSignature($stringToSign, $clientSecret)
    {
        return base64_encode(hash_hmac('sha512', $stringToSign, $clientSecret, true));
    }

    /**
     * Get current date formatted as yyyy-MM-ddThh:mm:ss with timezone
     * 
     * @return string - formatted date with timezone offset
     */
    public static function getFormattedDate()
    {
        date_default_timezone_set('Asia/Jakarta');
        return date('c');
    }

    /**
     * Get current timestamp formatted as yyyyMMddHHmmss
     * 
     * @return string - formatted timestamp for V2
     */
    public static function getFormattedTimestampV2()
    {
        return Time::now('Asia/Jakarta')->format('YmdHis');
    }

    /**
     * Convert a timestamp in SNAP format (yyyyMMddHHmmss) to ISO-8601 format
     * 
     * @param  string $timeStamp - timestamp in yyyyMMddHHmmss format
     * @return string - formatted date in ISO-8601 format
     */
    public function getConvertFormatedDate($timeStamp)
    {
        $dateTime = Time::createFromFormat('YmdHis', $timeStamp, 'Asia/Jakarta');
        return $dateTime->toDateTimeString(); // ISO-8601 format with timezone
    }

    /**
     * Wrap a string in RSA private key format
     * 
     * @param  string $key - the RSA private key string
     * @return string - formatted RSA private key
     */
    public static function getKey($key)
    {
        return "-----BEGIN PRIVATE KEY-----\n" . $key . "\n-----END PRIVATE KEY-----";
    }

    /**
     * Generate a SHA-256 hash token for merchant operations
     * 
     * @param  string $tokenString - string to hash
     * @return string - hashed token
     */
    public static function generateMerchantToken($tokenString)
    {
        return hash('sha256', $tokenString);
    }

    /**
     * Verify a SHA-256 hash token with a given public key
     * 
     * @param  string $stringToSign - the string to sign
     * @param  string $publicKeyString - the public key in PEM format
     * @param  string $signatureString - the signature in base64 format
     * @return bool - true if the signature is verified
     * @throws Exception - if the public key is invalid
     */
    public static function verifySHA256RSA($stringToSign, $publicKeyString, $signatureString)
    {
        $isVerified = false;
        try {
            // Decode the public key and signature from base64
            $formattedKey = "-----BEGIN PUBLIC KEY-----\n" . wordwrap($publicKeyString, 64, "\n", true) . "\n-----END PUBLIC KEY-----";
            $publicKey = openssl_pkey_get_public($formattedKey);
            $signature = base64_decode($signatureString);
            $stringToSignBytes = $stringToSign;

            if (!$publicKey) {
                throw new Exception("Invalid public key format.");
            }

            // Verify the signature using SHA256 with RSA
            $isVerified = openssl_verify($stringToSignBytes, $signature, $publicKey, OPENSSL_ALGO_SHA256) === 1;
        } catch (Exception $e) {
            log_message('error', "Error Verifying Signature: " . $e->getMessage());
        }

        return $isVerified;
    }
}
