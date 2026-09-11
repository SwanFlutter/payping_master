<?php

namespace ShareXOS\PayPing\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \ShareXOS\PayPing\Services\PaymentService payment()
 * @method static \ShareXOS\PayPing\Services\InvoiceService invoice()
 * @method static \ShareXOS\PayPing\Services\CustomerService customer()
 * @method static \ShareXOS\PayPing\Services\ProductService product()
 * @method static \ShareXOS\PayPing\Services\ReportService report()
 * @method static \ShareXOS\PayPing\Services\InquiryService inquiry()
 * @method static \ShareXOS\PayPing\Services\WithdrawService withdraw()
 * @method static \ShareXOS\PayPing\Services\BnplService bnpl()
 * @method static \ShareXOS\PayPing\Services\PermaLinkService permalink()
 * @method static \ShareXOS\PayPing\Services\CouponService coupon()
 *
 * @see \ShareXOS\PayPing\PayPing
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
