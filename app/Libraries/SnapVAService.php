<?php

namespace App\Libraries;

use App\Models\{NicepayResponse, NICEPay, VirtualAccount, InquiryStatus, DeleteVirtualAccount};

class SnapVAService
{

    public function generateVA(VirtualAccount $requestBody, string $accessToken, NICEPay $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapTransaction($requestBody, 'api/v1.0/transfer-va/create-va', $accessToken, "POST");
    }

    public function inquiryStatus(InquiryStatus $requestBody, string $accessToken, NICEPay $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapInquiryTransaction($requestBody, 'api/v1.0/transfer-va/status', $accessToken, "POST");
    }

    public function deleteVA(DeleteVirtualAccount $requestBody, string $accessToken, NICEPay $config): NicepayResponse
    {
        $snap = new Snap($config);
        return $snap->requestSnapDeleteVATransaction($requestBody, 'api/v1.0/transfer-va/delete-va', $accessToken, "DELETE");
    }

}