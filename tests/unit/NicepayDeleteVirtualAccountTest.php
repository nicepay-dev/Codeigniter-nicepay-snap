<?php

use App\Helpers\Helper;
use CodeIgniter\Test\CIUnitTestCase;

use App\Models\{NICEPay, AccessToken, DeleteVirtualAccount};
use App\Libraries\{Snap, SnapVAService};

use Tests\unit\NicepayTestConst;

final class NicepayDeleteVirtualAccountTest extends CIUnitTestCase
{

    private $clientSecret;
    private $oldKeyFormat;
    private $iMidTest;

    protected function setUp(): void
    {
        $const = new NicepayTestConst();
        $this->clientSecret = $const::IMID_NORMALTEST_CLIENT_SECRET;
        $this->oldKeyFormat = $const::IMID_NORMALTEST_PRIVATE_KEY;
        $this->iMidTest = $const::IMID_NORMALTEST;
    }

    public function testDeleteVASnap()
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

        $deleteVirtualAccountBuilder = DeleteVirtualAccount::builder();
        $parameter = $deleteVirtualAccountBuilder
            ->setPartnerServiceId("")
            ->setCustomerNo("")
            ->setVirtualAccountNo("9912304000062425")
            ->setTrxId("ordNo20241104141141")
            ->setTotalAmount("10000.00", "IDR")
            ->setTxIdVA("NORMALTEST02202411041404283040")
            ->setCancelMessage("Cancel Virtual Account")
            ->build();

        $accessToken = self::getAccessToken($config);
        $snapVAService = new SnapVAService();

        try {
            $response = $snapVAService->deleteVA($parameter, $accessToken, $config);
            $this->assertEquals("2003100", $response->getResponseCode());
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
