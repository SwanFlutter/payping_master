<?php

namespace ShareXOS\PayPing\Tests;

use PHPUnit\Framework\TestCase;
use Mockery;
use ShareXOS\PayPing\PayPing;
use ShareXOS\PayPing\HttpClient;

class InvoiceServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function test_create_invoice()
    {
        $mockClient = Mockery::mock(HttpClient::class);
        $payping = new PayPing($mockClient);

        $invoiceData = [
            'title' => 'Test Invoice',
            'amount' => 5000,
            'customers' => [['addressBookCode' => 'cust-1']]
        ];

        $expectedResponse = [
            ['code' => 'inv-001', 'customerCode' => 'cust-1']
        ];

        $mockClient->shouldReceive('request')
            ->once()
            ->with('POST', 'https://api.payping.ir/v2/invoice', $invoiceData)
            ->andReturn($expectedResponse);

        $response = $payping->invoice()->create($invoiceData);

        $this->assertCount(1, $response);
        $this->assertEquals('inv-001', $response[0]['code']);
    }

    public function test_get_invoice()
    {
        $mockClient = Mockery::mock(HttpClient::class);
        $payping = new PayPing($mockClient);

        $mockClient->shouldReceive('request')
            ->once()
            ->with('GET', 'https://api.payping.ir/v2/invoice/inv-001')
            ->andReturn(['code' => 'inv-001', 'status' => 1]);

        $response = $payping->invoice()->get('inv-001');

        $this->assertEquals(1, $response['status']);
    }
}
