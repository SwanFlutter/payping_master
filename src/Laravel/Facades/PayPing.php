<?php

namespace SwanFlutter\PayPing\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \SwanFlutter\PayPing\Services\PaymentService payment()
 * @method static \SwanFlutter\PayPing\Services\InvoiceService invoice()
 * @method static \SwanFlutter\PayPing\Services\CustomerService customer()
 * @method static \SwanFlutter\PayPing\Services\ProductService product()
 * @method static \SwanFlutter\PayPing\Services\ReportService report()
 * @method static \SwanFlutter\PayPing\Services\InquiryService inquiry()
 * @method static \SwanFlutter\PayPing\Services\WithdrawService withdraw()
 * @method static \SwanFlutter\PayPing\Services\BnplService bnpl()
 * @method static \SwanFlutter\PayPing\Services\PermaLinkService permalink()
 * @method static \SwanFlutter\PayPing\Services\CouponService coupon()
 * @method static \SwanFlutter\PayPing\Services\UploadService upload()
 *
 * @see \SwanFlutter\PayPing\PayPing
 */
class PayPing extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'payping';
    }
}
