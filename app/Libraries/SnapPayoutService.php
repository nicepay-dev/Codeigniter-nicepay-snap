<?php

namespace App\Libraries;

use App\Models\{NicepayResponse, NICEPay, Payout};

class SnapPayoutService
{

    public function registrationPayout(Payout $requestBody, string $accessToken, NICEPay $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapRegistrationPayoutTransaction($requestBody, 'api/v1.0/transfer/registration', $accessToken, "POST");
    }

    public function approvePayout(Payout $requestBody, string $accessToken, NICEPay $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapApprovePayoutTransaction($requestBody, 'api/v1.0/transfer/approve', $accessToken, "POST");
    }

    public function rejectPayout(Payout $requestBody, string $accessToken, NICEPay $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapRejectPayoutTransaction($requestBody, 'api/v1.0/transfer/reject', $accessToken, "POST");
    }

    public function inquiryPayout(Payout $requestBody, string $accessToken, NICEPay $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapInquiryPayoutTransaction($requestBody, 'api/v1.0/transfer/inquiry', $accessToken, "POST");
    }

    public function cancelPayout(Payout $requestBody, string $accessToken, NICEPay $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapCancelPayoutTransaction($requestBody, 'api/v1.0/transfer/cancel', $accessToken, "POST");
    }

    public function checkBalancePayout(Payout $requestBody, string $accessToken, NICEPay $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapCheckBalancePayoutTransaction($requestBody, 'api/v1.0/balance-inquiry', $accessToken, "POST");
    }

}