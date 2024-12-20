<?php

use App\Helpers\Helper;
use CodeIgniter\Test\CIUnitTestCase;

use App\Models\{NICEPay, AccessToken, Ewallet};
use App\Libraries\{Snap, SnapEwalletService};

use Tests\unit\NicepayTestConst;

final class NicepayEwalletTest extends CIUnitTestCase
{

    private $clientSecret;
    private $oldKeyFormat;
    private $iMidTest;

    protected function setUp(): void
    {

        $testConst = new NicepayTestConst();

        $this->clientSecret = $testConst::IMID_EWALLET_CLIENT_SECRET;
        $this->oldKeyFormat = $testConst::IMID_EWALLET_PRIVATE_KEY;
        $this->iMidTest = $testConst::IMID_EWALLET;
    }

    public function testPaymentEwalletSnap()
    {
        $timestamp = Helper::getFormattedDate();

        $config = NICEPay::builder()
            ->setIsProduction(false)
            ->setPrivateKey($this->oldKeyFormat)
            ->setClientSecret($this->clientSecret)
            ->setPartnerId($this->iMidTest)
            ->setExternalID("extIDEwallet" . $timestamp)
            ->setTimestamp($timestamp)
            ->build();

        $ewalletBuilder = Ewallet::builder();
        $requestBody = $ewalletBuilder
            ->setPartnerReferenceNo("ordNo" . $timestamp)
            ->setMerchantId($this->iMidTest)
            ->setSubMerchantId("310928924949487")
            ->setExternalStoreId("")
            ->setValidUpTo("")
            ->setPointOfInitiation("Mobile App")
            ->setAmount("1000.00", "IDR")
            ->setAdditionalInfo(
                [
                    "mitraCd" => "DANA",
                    "goodsNm" => "Testing Ewallet Snap",
                    "billingNm" => "John Doe",
                    "billingPhone" => "081227619520",
                    "dbProcessUrl" => "http://ptsv2.com/t/dbProcess/post",
                    "callBackUrl" => "https://dev.nicepay.co.id/IONPAY_CLIENT/paymentResult.jsp",
                    "msId" => "data",
                    "cartData" => "{\"count\":\"2\",\"item\":[{\"img_url\":\"http://img.aaa.com/ima1.jpg\",\"goods_name\":\"Item 1 Name\",\"goods_detail\":\"Item 1 Detail\",\"goods_amt\":\"500.00\",\"goods_quantity\":\"1\"},{\"img_url\":\"http://img.aaa.com/ima2.jpg\",\"goods_name\":\"Item 2 Name\",\"goods_detail\":\"Item 2 Detail\",\"goods_amt\":\"500.00\",\"goods_quantity\":\"1\"}]}"
                ]
            )
            ->setUrlParam([
                ["https://example.com", "PAY_NOTIFY", "Y"],
                ["https://another-example.com", "PAY_RETURN", "Y"]
            ])
            ->build();

        $accessToken = self::getAccessToken($config);
        $snapEwalletService = new SnapEwalletService();

        try {
            $response = $snapEwalletService->paymentEwallet($requestBody, $accessToken, $config);
            $this->assertEquals("2005400", $response->getResponseCode());
            $this->assertEquals("Successful", $response->getResponseMessage());
            // Add more assertions as needed for specific response properties
        } catch (Exception $e) {
            $this->fail("Ewallet Snap Payment Test Failed, Error thrown : " . $e->getMessage());
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
