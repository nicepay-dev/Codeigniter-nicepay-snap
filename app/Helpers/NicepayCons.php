<?php

namespace App\Helpers;

use Config\Services;
use Exception;

class NicepayCons{

    // private const SANDBOX_BASE_URL = "https://dev.nicepay.co.id/nicepay/";
    private const SANDBOX_BASE_URL = "http://localhost:8080/nicepay/";
    private const PRODUCTION_BASE_URL = "https://www.nicepay.co.id/nicepay/";
    private const CREATE_VA_SNAP_ENDPOINT = 'api/v1.0/transfer-va/create-va';

    private const V2_REGISTRATION_ENDPOINT = "/direct/v2/registration";

    private const V2_INQUIRY_ENDPOINT = "direct/v2/inquiry";



    

    public static function getSandboxBaseUrl() : string{
        return self::SANDBOX_BASE_URL;
    }
    public static function getProductionBaseUrl() : string{
        return self::PRODUCTION_BASE_URL;
    }

    public static function getCreateVASnapEndpoint() : string{
        return self::CREATE_VA_SNAP_ENDPOINT;
    }

    public static function getV2RegistrationEndpoint() : string{
        return self::V2_REGISTRATION_ENDPOINT;
    }

    public static function getV2_INQUIRY_ENDPOINT() : string{
        return self::V2_INQUIRY_ENDPOINT;
    }
    
}


