<?php

namespace App\Libraries;

use App\Models\{NicepayResponse, NICEPay, Ewallet, InquiryStatusEwallet, RefundEwallet};

class SnapEwalletService
{

    public function paymentEwallet(Ewallet $requestBody, string $accessToken, NICEPay $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapEwalletTransaction($requestBody, 'api/v1.0/debit/payment-host-to-host', $accessToken, "POST");
    }

    public function inquiryStatusEwallet(InquiryStatusEwallet $requestBody, string $accessToken, NICEPay $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapInquiryEwalletTransaction($requestBody, 'api/v1.0/debit/status', $accessToken, "POST");
    }

    public function refundEwallet(RefundEwallet $requestBody, string $accessToken, $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapRefundEwalletTransaction($requestBody, 'api/v1.0/debit/refund', $accessToken, "POST");
    }

}