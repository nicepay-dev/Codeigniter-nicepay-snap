<?php

use App\Helpers\Helper;
use CodeIgniter\Test\CIUnitTestCase;

use App\Models\{NICEPay, AccessToken, Payout};
use App\Libraries\{Snap, SnapPayoutService};

use Tests\unit\NicepayTestConst;

final class NicepayInquiryPayoutTest extends CIUnitTestCase
{

    private $clientSecret;
    private $oldKeyFormat;
    private $iMidTest;

    protected function setUp(): void
    {
        $testConst = new NicepayTestConst();

        $this->clientSecret = $testConst::IMID_TEST_CLIENT_SECRET;
        $this->oldKeyFormat = $testConst::IMID_TEST_PRIVATE_KEY;
        $this->iMidTest = $testConst::IMID_TEST;
    }

    public function testInquiryPayoutSnap()
    {
        $timestamp = Helper::getFormattedDate();


        $config = NICEPay::builder()
            ->setIsProduction(false)
            ->setPrivateKey($this->oldKeyFormat)
            ->setClientSecret($this->clientSecret)
            ->setPartnerId($this->iMidTest)
            ->setExternalID("extIDPayout" . $timestamp)
            ->setTimestamp($timestamp)
            ->build();

        $requestBody = Payout::builder()
            ->setMerchantId($this->iMidTest)
            ->setOriginalReferenceNo("IONPAYTEST07202412101121214034")
            ->setOriginalPartnerReferenceNo("ordRefPayout20241210112121")
            ->setBeneficiaryAccountNo("903327200")
            ->build();

        $accessToken = self::getAccessToken($config);
        $snapPayoutService = new SnapPayoutService();

        try {
            $response = $snapPayoutService->inquiryPayout($requestBody, $accessToken, $config);
            $this->assertEquals("2000000", $response->getResponseCode());
            $this->assertEquals("Successful", $response->getResponseMessage());
            // Add more assertions as needed for specific response properties
        } catch (Exception $e) {
            $this->fail("Failed test inquiry failed , exception thrown : " . $e->getMessage());
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
