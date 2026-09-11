<?php

namespace ShareXOS\PayPing\Tests;

use PHPUnit\Framework\TestCase;
use Mockery;
use ShareXOS\PayPing\PayPing;
use ShareXOS\PayPing\HttpClient;
use ShareXOS\PayPing\DTOs\CreatePaymentRequest;

class PaymentServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function test_create_payment()
    {
        $mockClient = Mockery::mock(HttpClient::class);
        $payping = new PayPing($mockClient);

        $paymentData = [
            'amount' => 1000,
            'returnUrl' => 'https://example.com/callback',
            'clientRefId' => '123456'
        ];

        $expectedResponse = [
            'paymentCode' => 'abc-123',
            'url' => 'https://api.payping.ir/v3/pay/start/abc-123'
        ];

        $mockClient->shouldReceive('request')
            ->once()
            ->with('POST', 'https://api.payping.ir/v3/pay', $paymentData)
            ->andReturn($expectedResponse);

        $response = $payping->payment()->create($paymentData);

        $this->assertEquals($expectedResponse, $response);
    }

    public function test_create_payment_with_dto()
    {
        $mockClient = Mockery::mock(HttpClient::class);
        $payping = new PayPing($mockClient);

        $request = new CreatePaymentRequest(1000, 'https://example.com/callback');
        $request->setClientRefId('123456');

        $mockClient->shouldReceive('request')
            ->once()
            ->with('POST', 'https://api.payping.ir/v3/pay', $request->toArray())
            ->andReturn(['paymentCode' => 'dto-code']);

        $response = $payping->payment()->create($request->toArray());

        $this->assertEquals('dto-code', $response['paymentCode']);
    }

    public function test_verify_payment()
    {
        $mockClient = Mockery::mock(HttpClient::class);
        $payping = new PayPing($mockClient);

        $verifyData = [
            'amount' => 1000,
            'paymentCode' => 'abc-123',
            'paymentRefId' => 'ref-999'
        ];

        $mockClient->shouldReceive('request')
            ->once()
            ->with('POST', 'https://api.payping.ir/v3/pay/verify', $verifyData)
            ->andReturn(['status' => 200]);

        $response = $payping->payment()->verify($verifyData);

        $this->assertEquals(200, $response['status']);
    }
}
