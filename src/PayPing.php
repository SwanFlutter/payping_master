<?php

namespace ShareXOS\PayPing;

use ShareXOS\PayPing\Services\PaymentService;
use ShareXOS\PayPing\Services\InvoiceService;
use ShareXOS\PayPing\Services\CustomerService;
use ShareXOS\PayPing\Services\ProductService;
use ShareXOS\PayPing\Services\ReportService;
use ShareXOS\PayPing\Services\InquiryService;
use ShareXOS\PayPing\Services\WithdrawService;
use ShareXOS\PayPing\Services\BnplService;
use ShareXOS\PayPing\Services\PermaLinkService;
use ShareXOS\PayPing\Services\CouponService;

class PayPing
{
    private HttpClient $client;
    private array $services = [];

    public function __construct(string|HttpClient $tokenOrClient, bool $testMode = false, int $timeout = 45)
    {
        if ($tokenOrClient instanceof HttpClient) {
            $this->client = $tokenOrClient;
        } else {
            $this->client = new HttpClient($tokenOrClient, $timeout, $testMode);
        }
    }

    public function payment(): PaymentService
    {
        return $this->getService('payment', PaymentService::class);
    }

    public function invoice(): InvoiceService
    {
        return $this->getService('invoice', InvoiceService::class);
    }

    public function customer(): CustomerService
    {
        return $this->getService('customer', CustomerService::class);
    }

    public function product(): ProductService
    {
        return $this->getService('product', ProductService::class);
    }

    public function report(): ReportService
    {
        return $this->getService('report', ReportService::class);
    }

    public function inquiry(): InquiryService
    {
        return $this->getService('inquiry', InquiryService::class);
    }

    public function withdraw(): WithdrawService
    {
        return $this->getService('withdraw', WithdrawService::class);
    }

    public function bnpl(): BnplService
    {
        return $this->getService('bnpl', BnplService::class);
    }

    public function permalink(): PermaLinkService
    {
        return $this->getService('permalink', PermaLinkService::class);
    }

    public function coupon(): CouponService
    {
        return $this->getService('coupon', CouponService::class);
    }

    private function getService(string $name, string $class)
    {
        if (!isset($this->services[$name])) {
            $this->services[$name] = new $class($this->client);
        }
        return $this->services[$name];
    }
}
