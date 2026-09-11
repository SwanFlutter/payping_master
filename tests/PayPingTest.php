<?php

namespace SwanFlutter\PayPing\Tests;

use PHPUnit\Framework\TestCase;
use SwanFlutter\PayPing\PayPing;
use SwanFlutter\PayPing\Services\PaymentService;
use SwanFlutter\PayPing\Services\InvoiceService;

class PayPingTest extends TestCase
{
    public function test_lazy_loading_services()
    {
        $payping = new PayPing('test-token');

        $this->assertInstanceOf(PaymentService::class, $payping->payment());
        $this->assertInstanceOf(InvoiceService::class, $payping->invoice());

        // Check if it returns the same instance
        $payment1 = $payping->payment();
        $payment2 = $payping->payment();
        $this->assertSame($payment1, $payment2);
    }
}
