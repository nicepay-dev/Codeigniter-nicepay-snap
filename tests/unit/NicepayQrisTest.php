<?php

use App\Helpers\Helper;
use CodeIgniter\Test\CIUnitTestCase;

use App\Models\{NICEPay, AccessToken, Qris};
use App\Libraries\{Snap, SnapQrisService};

use Tests\unit\NicepayTestConst;


final class NicepayQrisTest extends CIUnitTestCase
{

    private $clientSecret;
    private $oldKeyFormat;
    private $iMidTest;

    private $storeId;

    protected function setUp(): void
    {
        $testConst = new NicepayTestConst();
        $this->clientSecret = $testConst::IMID_QRIS_CLIENT_SECRET;
        $this->oldKeyFormat = $testConst::IMID_QRIS_PRIVATE_KEY;
        $this->iMidTest = $testConst::IMID_QRIS;
        $this->storeId = $testConst::IMID_QRIS_STORE_ID;
    }

    public function testGenerateQrisSnap()
    {
        $timestamp = Helper::getFormattedDate();

        // Set the validity period to 15 minutes from now
        $validityPeriod = (new DateTime())->add(new DateInterval('PT15M'))->format('Y-m-d\TH:i:s');


        $config = NICEPay::builder()
            ->setIsProduction(false)
            ->setPrivateKey($this->oldKeyFormat)
            ->setClientSecret($this->clientSecret)
            ->setPartnerId($this->iMidTest)
            ->setExternalID("extIDVa" . $timestamp)
            ->setTimestamp($timestamp)
            ->build();

        $qrisBuilder = Qris::builder();
        $requestBody = $qrisBuilder
            ->setPartnerReferenceNo("ordNo" . $timestamp)
            ->setAmount("10000.00", "IDR")
            ->setMerchantId($this->iMidTest)
            ->setStoreId($this->storeId)
            ->setValidityPeriod($validityPeriod)
            ->setAdditionalInfo(
                "Test SNAP Transaction Nicepay",
                "John Doe",
                "082213561712",
                "email@merchant.com",
                "Jakarta",
                "Jalan Bukit Berbunga 22",
                "DKI Jakarta",
                "12345",
                "Indonesia",
                "https://ptsv2.com/t/jhon/post",
                "https://ptsv2.com/t/jhon/post",
                "127.0.0.1",
                "{\"count\":1,\"item\":[{\"img_url\":\"https://d3nevzfk7ii3be.cloudfront.net/igi/vOrGHXlovukA566A.medium\",\"goods_name\":\"Nokia 3360\",\"goods_detail\":\"Old Nokia 3360\",\"goods_amt\":\"100\",\"goods_quantity\":\"1\"}]}",
                "QSHP"
            )
            ->build();

        $accessToken = self::getAccessToken($config);
        $snapQrisService = new SnapQrisService();

        try {
            $response = $snapQrisService->generateQris($requestBody, $accessToken, $config);
            $this->assertEquals("2004700", $response->getResponseCode());
            $this->assertEquals("Successful", $response->getResponseMessage());
            // Add more assertions as needed for specific response properties
        } catch (Exception $e) {
            $this->fail("Generate Qris Test Failed " . $e->getMessage());
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
