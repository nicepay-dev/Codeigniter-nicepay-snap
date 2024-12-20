<?php

use App\Helpers\Helper;
use CodeIgniter\Test\CIUnitTestCase;

use Tests\unit\NicepayTestConst;

/**
 * @internal
 */
final class NicepayVerifyTest extends CIUnitTestCase
{
    
    public function setUp(): void
    {
    }

    public function testVerifySignature()
    {

        $testConst = new NicepayTestConst();
        $dataString = $testConst::STRING_TO_SIGN;
        $publicKeyString = $testConst::IMID_COMMON_PUBLIC_KEY;
        $signatureString = $testConst::SIGNATURE_STRING;

        $isValid = Helper::verifySHA256RSA($dataString, $publicKeyString, $signatureString);

        if ($isValid) {
            log_message('info', "Success verify signature ");
        } else {
            log_message('info', "Failed verify signature ");
        }

        $this->assertTrue($isValid, "Failed verify signature");

    }
}
