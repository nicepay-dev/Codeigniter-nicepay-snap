<?php

namespace App\Libraries;

use App\Models\{NicepayResponse, NICEPay, Qris, InquiryStatusQris, RefundQris};

class SnapQrisService
{

    public function generateQris(Qris $requestBody, string $accessToken, NICEPay $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapQrisTransaction($requestBody, 'api/v1.0/qr/qr-mpm-generate', $accessToken, "POST");
    }

    public function inquiryStatusQris(InquiryStatusQris $requestBody, string $accessToken, NICEPay $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapInquiryQrisTransaction($requestBody, 'api/v1.0/qr/qr-mpm-query', $accessToken, "POST");
    }

    public function refund(RefundQris $requestBody, string $accessToken, $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapRefundQrisTransaction($requestBody, 'api/v1.0/qr/qr-mpm-refund', $accessToken, "POST");
    }

}