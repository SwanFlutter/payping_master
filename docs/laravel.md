# راهنمای Laravel

پکیج به صورت خودکار در Laravel 9 / 10 / 11 / 12 شناسایی می‌شود (Discover بسته به `extra.laravel` در composer.json) — نیازی به ثبت دستی Provider و Alias نیست.

## تنظیمات

### انتشار فایل کانفیگ

```bash
php artisan vendor:publish --tag=payping-config
```

فایل `config/payping.php` شامل:

| کلید | متغیر محیطی | پیش‌فرض | توضیح |
|------|-------------|---------|-------|
| `token` | `PAYPING_TOKEN` | خالی | توکن API از پنل PayPing |
| `test_mode` | `PAYPING_TEST_MODE` | `false` | شبیه‌سازی پاسخ‌ها |
| `timeout` | — | `45` | مهلت انتظار پاسخ API (ثانیه) |

فایل `.env`:

```env
PAYPING_TOKEN=your-token-here
PAYPING_TEST_MODE=false
```

## تزریق وابستگی (روش پیشنهادی)

سرویس `SwanFlutter\PayPing\PayPing` به صورت singleton در کانتینر ثبت شده است:

```php
use SwanFlutter\PayPing\PayPing;

Route::post('/pay', function (Request $request, PayPing $payping) {
    $response = $payping->payment()->create([
        'amount'      => 72000,
        'returnUrl'   => route('payment.callback'),
        'clientRefId' => (string)$request->order_id,
    ]);

    // کد پرداخت را ذخیره کنید
    Order::find($request->order_id)->update(['payment_code' => $response['paymentCode']]);

    return redirect()->away($payping->payment()->getStartUrl($response['paymentCode']));
});
```

## استفاده با Facade

```php
use SwanFlutter\PayPing\Laravel\Facades\PayPing;

PayPing::payment()->create([...]);
PayPing::payment()->verify([...]);
PayPing::invoice()->create([...]);
PayPing::upload()->invoiceAttachment($path);
```

## نمونه کامل: پرداخت و callback

```php
use SwanFlutter\PayPing\PayPing;
use SwanFlutter\PayPing\PayPingException;

// ایجاد پرداخت
Route::post('/pay', function (Request $request, PayPing $payping) {
    $response = $payping->payment()->create([
        'amount'      => 72000,
        'returnUrl'   => route('payment.callback'),
        'clientRefId' => (string)$request->order_id,
        'payerName'   => $request->user()->name,
        'payerIdentity' => $request->user()->mobile,
    ]);

    return redirect()->away($payping->payment()->getStartUrl($response['paymentCode']));
});

// callback (PayPing اطلاعات را POST می‌کند)
Route::post('/payment/callback', function (Request $request, PayPing $payping) {
    if ((int)$request->input('status') !== 1) {
        return redirect()->route('checkout')->withErrors('پرداخت لغو شد');
    }

    $order = Order::where('client_ref_id', $request->input('clientRefId'))->firstOrFail();

    try {
        $payping->payment()->verify([
            'amount'       => $order->amount,   // از دیتابیس — نه از ورودی کاربر
            'paymentCode'  => $order->payment_code,
            'paymentRefId' => (int)$request->input('paymentRefId'),
        ]);

        $order->markAsPaid();
        return 'پرداخت موفق! کد پیگیری: ' . $request->input('paymentRefId');
    } catch (PayPingException $e) {
        report($e);
        return redirect()->route('checkout')->withErrors('تأیید پرداخت ناموفق بود');
    }
});
```

⚠️ در callback، همیشه `amount` و `paymentCode` را از **دیتابیس خودتان** بخوانید و با `clientRefId` ارسالی تطبیق دهید — نه از ورودی کاربر.

## تنظیمات برای تست

```env
PAYPING_TEST_MODE=true
```

در این حالت پکیج به API واقعی وصل نمی‌شود و پاسخ‌های شبیه‌سازی‌شده برمی‌گرداند.
