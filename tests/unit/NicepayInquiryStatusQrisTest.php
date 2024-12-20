<?php

use App\Helpers\Helper;
use CodeIgniter\Test\CIUnitTestCase;

use App\Models\{NICEPay, AccessToken, InquiryStatusQris};
use App\Libraries\{Snap, SnapQrisService};

use Tests\unit\NicepayTestConst;
final class NicepayInquiryStatusQrisTest extends CIUnitTestCase
{

    private $clientSecret;
    private $oldKeyFormat;
    private $iMidTest;

    private $storeId;

    protected function setUp(): void
    {
        $testConst = new NicepayTestConst();
        
        $this->clientSecret =$testConst::IMID_QRIS_CLIENT_SECRET;
        $this->oldKeyFormat = $testConst::IMID_QRIS_PRIVATE_KEY;
        $this->iMidTest = $testConst::IMID_QRIS;
        $this->storeId = $testConst::IMID_QRIS_STORE_ID;
    }

    public function testInquiryStatusQris()
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

        $requestBody = InquiryStatusQris::builder()
            ->setOriginalReferenceNo("TNICEQR08108202405081057332087")
            ->setOriginalPartnerReferenceNo("ncpy20240530150818")
            ->setMerchantId($this->iMidTest)
            ->setExternalStoreId($this->storeId)
            ->setServiceCode("47")
            ->build();

        $accessToken = self::getAccessToken($config);
        $snapQrisService = new SnapQrisService();
 
        try {
            $response = $snapQrisService->inquiryStatusQris($requestBody, $accessToken, $config);
            $this->assertEquals("2005100", $response->getResponseCode());
            $this->assertEquals("Successful", $response->getResponseMessage());
            // Add more assertions as needed for specific response properties
        } catch (Exception $e) {
            $this->fail("Inquiry Status Qris Test Failed, exception thrown : " . $e->getMessage());
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
