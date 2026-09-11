<?php

namespace SwanFlutter\PayPing;

use SwanFlutter\PayPing\Services\PaymentService;
use SwanFlutter\PayPing\Services\InvoiceService;
use SwanFlutter\PayPing\Services\CustomerService;
use SwanFlutter\PayPing\Services\ProductService;
use SwanFlutter\PayPing\Services\ReportService;
use SwanFlutter\PayPing\Services\InquiryService;
use SwanFlutter\PayPing\Services\WithdrawService;
use SwanFlutter\PayPing\Services\BnplService;
use SwanFlutter\PayPing\Services\PermaLinkService;
use SwanFlutter\PayPing\Services\CouponService;
use SwanFlutter\PayPing\Services\UploadService;

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

    public function upload(): UploadService
    {
        return $this->getService('upload', UploadService::class);
    }

    private function getService(string $name, string $class)
    {
        if (!isset($this->services[$name])) {
            $this->services[$name] = new $class($this->client);
        }
        return $this->services[$name];
    }
}
