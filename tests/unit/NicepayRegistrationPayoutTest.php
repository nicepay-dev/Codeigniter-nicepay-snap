<?php

use App\Helpers\Helper;
use CodeIgniter\Test\CIUnitTestCase;

use App\Models\{NICEPay, AccessToken, Payout};
use App\Libraries\{Snap, SnapPayoutService};

use Tests\unit\NicepayTestConst;

final class NicepayRegistrationPayoutTest extends CIUnitTestCase
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

    public function testRegistrationPayoutSnap()
    {
        $timestamp = Helper::getFormattedDate();
        $randomTimeStamp = date('Ymd') . date('His');

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
            ->setBeneficiaryAccountNo("903327200")
            ->setBeneficiaryName("IONPAY NETWORKS")
            ->setBeneficiaryPhone("081211111111")
            ->setBeneficiaryCustomerResidence("1")
            ->setBeneficiaryCustomerType("1")
            ->setBeneficiaryPostalCode("123456")
            ->setPayoutMethod('1')
            ->setBeneficiaryBankCode('BBBA')
            ->setAmount("10000.00", "IDR")
            ->setPartnerReferenceNo("ordRefPayout" . $randomTimeStamp)
            ->setDescription("Test Regist Payout")
            ->setDeliveryName("Testing Payout")
            ->setDeliveryId('1234567890234512')
            ->setReservedDt("20241211")
            ->setReservedTm('120000')
            ->build();

        $accessToken = self::getAccessToken($config);
        $snapPayoutService = new SnapPayoutService();

        try {
            $response = $snapPayoutService->registrationPayout($requestBody, $accessToken, $config);
            $this->assertEquals("2000000", $response->getResponseCode());
            $this->assertEquals("Successful", $response->getResponseMessage());
            // Add more assertions as needed for specific response properties
        } catch (Exception $e) {
            $this->fail("Failed test registration failed , exception thrown : " . $e->getMessage());
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
