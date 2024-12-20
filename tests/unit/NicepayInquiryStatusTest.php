<?php

use App\Helpers\Helper;
use CodeIgniter\Test\CIUnitTestCase;

use App\Models\{NICEPay, AccessToken, VirtualAccount, InquiryStatus};
use App\Libraries\{Snap, SnapVAService, SnapQrisService};

use Tests\unit\NicepayTestConst;


final class NicepayInquiryStatusTest extends CIUnitTestCase
{

    private $clientSecret;
    private $oldKeyFormat;
    private $iMidTest;

    // public function setUp(): void {}

    protected function setUp(): void
    {
        $testConst = new NicepayTestConst();
        $this->clientSecret = $testConst::IMID_NORMALTEST_CLIENT_SECRET;
        $this->oldKeyFormat = $testConst::IMID_NORMALTEST_PRIVATE_KEY;
        $this->iMidTest = $testConst::IMID_NORMALTEST;
    }

    public function testInquiryStatusVASnap()
    {
        $timestamp = Helper::getFormattedDate();

        $config = NICEPay::builder()
            ->setIsProduction(false)
            ->setPrivateKey($this->oldKeyFormat)
            ->setClientSecret($this->clientSecret)
            ->setPartnerId($this->iMidTest)
            ->setExternalID("extIDVa" . $timestamp)
            ->setTimestamp($timestamp)
            ->build();

        $inquiryStatusBuilder = InquiryStatus::builder();
        $parameter = $inquiryStatusBuilder
            ->setPartnerServiceId(partnerServiceId: "")
            ->setCustomerNo("")
            ->setVirtualAccountNo("7001400002009911")
            ->setInquiryRequestId("reqIdVA" . $timestamp)
            ->setTrxId("2022020100000000000001")
            ->setTxIdVA("NORMALTEST02202412061018351244")
            ->setTotalAmount("10000.00", "IDR")
            ->build();

        $accessToken = self::getAccessToken($config);
        $snapVAService = new SnapVAService();

        try {
            $response = $snapVAService->inquiryStatus($parameter, $accessToken, $config);
            $this->assertEquals("2002600", $response->getResponseCode());
            $this->assertEquals("Successful", $response->getResponseMessage());
            // Add more assertions as needed for specific response properties
        } catch (Exception $e) {
            $this->fail("Exception thrown: " . $e->getMessage());
        }

    }

    private function getAccessToken(NICEPay $config): string
    { 

        $tokenBody = AccessToken::builder()
            ->setGrantType('client_credentials')
            ->setAdditionalInfo([])
            ->build();

        $snap = new Snap($config);

        try {
            $response = $snap->requestSnapAccessToken($tokenBody);
        } catch (Exception $e) {
            $this->fail("Exception thrown: " . $e->getMessage());
        }

        return $response->getAccessToken();

    }
}
