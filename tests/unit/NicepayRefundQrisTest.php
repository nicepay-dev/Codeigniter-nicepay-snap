<?php

use App\Helpers\Helper;
use CodeIgniter\Test\CIUnitTestCase;

use App\Models\{NICEPay, AccessToken, RefundQris};
use App\Libraries\{Snap, SnapQrisService};

use Tests\unit\NicepayTestConst;

final class NicepayRefundQrisTest extends CIUnitTestCase
{

    private $clientSecret;
    private $oldKeyFormat;
    private $iMidTest;

    // public function setUp(): void {}

    protected function setUp(): void
    {
        $testConst = new NicepayTestConst();
        
        $this->clientSecret = $testConst::IMID_TEST_CLIENT_SECRET;
        $this->oldKeyFormat = $testConst::IMID_TEST_PRIVATE_KEY;
        $this->iMidTest = $testConst::IMID_TEST;
    }

    public function testRefundQRisSnap()
    {
        $timestamp = Helper::getFormattedDate();

        $config = NICEPay::builder()
            ->setIsProduction(false)
            ->setPrivateKey($this->oldKeyFormat)
            ->setClientSecret($this->clientSecret)
            ->setPartnerId($this->iMidTest)
            ->setExternalID("extIDQris" . $timestamp)
            ->setTimestamp($timestamp)
            ->build();

        $refundQrisBuilder = RefundQris::builder();
        $requestBody = $refundQrisBuilder
            ->setOriginalReferenceNo("IONPAYTEST00202412061419183515")
            ->setOriginalPartnerReferenceNo("ORD20241206141279")
            ->setPartnerRefundNo("cancelQris" . $timestamp)
            ->setMerchantId($this->iMidTest)
            ->setExternalStoreId("NICEPAY")
            ->setRefundAmount("1000.00", "IDR")
            ->setReason("Test Refund Qris")
            ->setAdditionalInfo("1")
            ->build();

        $accessToken = self::getAccessToken($config);
        $snapQrisService = new SnapQrisService();

        try {
            $response = $snapQrisService->refund($requestBody, $accessToken, $config);
            $this->assertEquals("2007800", $response->getResponseCode());
            $this->assertEquals("Successful", $response->getResponseMessage());
            // Add more assertions as needed for specific response properties
        } catch (Exception $e) {
            $this->fail("Refund Qris Snap Test Failed, Exception thrown : " . $e->getMessage());
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
