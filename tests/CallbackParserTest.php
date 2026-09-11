<?php

namespace SwanFlutter\PayPing\Tests;

use PHPUnit\Framework\TestCase;
use SwanFlutter\PayPing\CallbackParser;

class CallbackParserTest extends TestCase
{
    protected function tearDown(): void
    {
        unset($_POST, $_GET);
        parent::tearDown();
    }

    public function test_parses_v3_callback_with_json_data_field()
    {
        $payload = [
            'status'    => '1',
            'errorCode' => '',
            'data'      => json_encode([
                'clientRefId'  => 'TEST-ORDER-123',
                'paymentCode'  => '01K2YQYESEQGNMCVFPQ9VC96YF',
                'paymentRefId' => 2166036136,
                'amount'       => 1000,
                'gatewayAmount'=> 1000,
            ]),
        ];

        $parsed = CallbackParser::parse($payload);

        $this->assertSame(1, $parsed['status']);
        $this->assertSame('', $parsed['errorCode']);
        $this->assertSame('TEST-ORDER-123', $parsed['clientRefId']);
        $this->assertSame('01K2YQYESEQGNMCVFPQ9VC96YF', $parsed['paymentCode']);
        $this->assertSame(2166036136, $parsed['paymentRefId']);
        $this->assertSame(1000, $parsed['amount']);
        $this->assertTrue(CallbackParser::isSuccessful($parsed));
    }

    public function test_parses_legacy_direct_fields()
    {
        $payload = [
            'status'       => '1',
            'errorCode'    => '',
            'clientRefId'  => 'LEGACY-1',
            'paymentCode'  => 'CODE',
            'paymentRefId' => '12345',
            'amount'       => '72000',
        ];

        $parsed = CallbackParser::parse($payload);

        $this->assertSame(1, $parsed['status']);
        $this->assertSame('LEGACY-1', $parsed['clientRefId']);
        $this->assertSame('CODE', $parsed['paymentCode']);
        $this->assertSame(12345, $parsed['paymentRefId']);
        $this->assertSame(72000, $parsed['amount']);
    }

    public function test_parses_failed_payment()
    {
        $payload = [
            'status'    => '0',
            'errorCode' => '-1',
            'data'      => json_encode(['clientRefId' => 'X', 'paymentCode' => 'C']),
        ];

        $parsed = CallbackParser::parse($payload);

        $this->assertSame(0, $parsed['status']);
        $this->assertSame('-1', $parsed['errorCode']);
        $this->assertSame('X', $parsed['clientRefId']);
        $this->assertNull($parsed['paymentRefId']);
        $this->assertFalse(CallbackParser::isSuccessful($parsed));
    }

    public function test_malformed_json_data_falls_back_to_top_level()
    {
        $payload = [
            'status'      => '1',
            'errorCode'   => '',
            'data'        => '{invalid json',
            'paymentCode' => 'FALLBACK',
        ];

        $parsed = CallbackParser::parse($payload);

        $this->assertSame(1, $parsed['status']);
        $this->assertSame('FALLBACK', $parsed['paymentCode']);
    }

    public function test_missing_fields_default_to_null()
    {
        $parsed = CallbackParser::parse([]);

        $this->assertSame(0, $parsed['status']);
        $this->assertSame('', $parsed['errorCode']);
        $this->assertNull($parsed['clientRefId']);
        $this->assertNull($parsed['paymentCode']);
        $this->assertNull($parsed['paymentRefId']);
        $this->assertNull($parsed['amount']);
    }

    public function test_from_globals_reads_superglobals()
    {
        $_POST = [
            'status'    => '1',
            'errorCode' => '',
            'data'      => json_encode([
                'clientRefId'  => 'ORDER-9',
                'paymentCode'  => 'PC-9',
                'paymentRefId' => 42,
                'amount'       => 5000,
            ]),
        ];

        $parsed = CallbackParser::fromGlobals();

        $this->assertSame('ORDER-9', $parsed['clientRefId']);
        $this->assertSame('PC-9', $parsed['paymentCode']);
        $this->assertSame(42, $parsed['paymentRefId']);
        $this->assertSame(5000, $parsed['amount']);
    }
}
