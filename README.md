# PayPing for PHP & Laravel (API v3)

[![Latest Stable Version](https://img.shields.io/packagist/v/swanflutter/payping.svg)](https://packagist.org/packages/swanflutter/payping)
[![License](https://img.shields.io/packagist/l/swanflutter/payping.svg)](https://packagist.org/packages/swanflutter/payping)
[![PHP Version](https://img.shields.io/packagist/php-v/swanflutter/payping.svg)](https://packagist.org/packages/swanflutter/payping)


<img width="1584" height="396" alt="payping_cover" src="https://github.com/user-attachments/assets/28b8b314-5add-40bc-b6c6-31e9333a5729" />


پکیج PHP برای درگاه پرداخت **PayPing API v3** — بدون وابستگی به فریم‌ورک، با پشتیبانی کامل از Laravel.

- ✅ پرداخت و تأیید پرداخت (v3)
- ✅ فاکتور، مشتری، محصول، کوپن، تسهیلات (BNPL)، برداشت، گزارش و ...
- ✅ Facade و Service Provider آماده برای Laravel 9 / 10 / 11 / 12
- ✅ بدون وابستگی HTTP اضافه (cURL خالص)

## نصب

```bash
composer require swanflutter/payping
```

## مستندات کامل

مستندات هر سرویس به صورت جداگانه در پوشه [`docs/`](docs/) نوشته شده است:

| سرویس | مستندات |
|-------|---------|
| پرداخت (v3) — ایجاد، تأیید، تسهیم، برگشت وجه | [docs/payment.md](docs/payment.md) |
| فاکتور (v2) — شامل فاکتور سریع و زمان‌بندی | [docs/invoice.md](docs/invoice.md) |
| مشتریان | [docs/customer.md](docs/customer.md) |
| محصولات | [docs/product.md](docs/product.md) |
| کوپن تخفیف | [docs/coupon.md](docs/coupon.md) |
| لینک پرداخت ثابت | [docs/permalink.md](docs/permalink.md) |
| برداشت وجه | [docs/withdraw.md](docs/withdraw.md) |
| گزارش تراکنش‌ها | [docs/report.md](docs/report.md) |
| استعلام‌های بانکی، هویتی و خدماتی | [docs/inquiry.md](docs/inquiry.md) |
| خرید اقساطی (BNPL) | [docs/bnpl.md](docs/bnpl.md) |
| آپلود فایل | [docs/upload.md](docs/upload.md) |
| راهنمای Laravel | [docs/laravel.md](docs/laravel.md) |
| مدیریت خطا و تنظیمات پیشرفته | [docs/exceptions.md](docs/exceptions.md) |

تاریخچه تغییرات: [CHANGELOG.md](CHANGELOG.md)

## استفاده (PHP خالص)

### ایجاد پرداخت

```php
use SwanFlutter\PayPing\PayPing;

$payping = new PayPing($_ENV['PAYPING_TOKEN']);

$response = $payping->payment()->create([
    'amount'       => 72000,                                // تومان (حداقل ۱۰۰۰)
    'returnUrl'    => 'https://example.com/callback.php',
    'clientRefId'  => 'ORDER-1234567890',                   // شناسه سفارش شما (اختیاری)
    'description'  => 'خرید اشتراک شش ماهه',                 // اختیاری
    'payerName'    => 'علی محمدی',                           // اختیاری
    'payerIdentity'=> '09123456789',                         // موبایل یا ایمیل (اختیاری)
]);

$paymentCode = $response['paymentCode'];  // ⚠️ در دیتابیس ذخیره کنید

// redirect کاربر به درگاه
header('Location: ' . $payping->payment()->getStartUrl($paymentCode));
exit;
```

### تأیید پرداخت (در callback)

PayPing پس از بازگشت کاربر، این مقادیر را به `returnUrl` شما POST می‌کند:

```php
use SwanFlutter\PayPing\PayPing;
use SwanFlutter\PayPing\PayPingException;

// PayPing این مقادیر را POST می‌کند:
$paymentRefId = (int)($_POST['paymentRefId'] ?? 0);
$paymentCode  = trim($_POST['paymentCode']  ?? '');
$clientRefId  = trim($_POST['clientRefId']  ?? '');
$status       = (int)($_POST['status']      ?? 0);

if ($status !== 1) {
    die('پرداخت لغو شد');
}

$payping = new PayPing($_ENV['PAYPING_TOKEN']);

try {
    // مبلغ باید دقیقاً همان مبلغ اولیه باشد
    $result = $payping->payment()->verify([
        'amount'       => 72000,
        'paymentCode'  => $paymentCode,
        'paymentRefId' => $paymentRefId,
    ]);

    // ✅ پرداخت تأیید شد — سفارش را فعال کنید
    echo 'پرداخت موفق! کد پیگیری: ' . $paymentRefId;
} catch (PayPingException $e) {
    echo 'تأیید ناموفق: ' . $e->getMessage();
}
```

## استفاده در Laravel

### تنظیمات

```bash
php artisan vendor:publish --tag=payping-config
```

فایل `.env`:

```env
PAYPING_TOKEN=your-token-here
PAYPING_TEST_MODE=false
```

### ایجاد پرداخت

```php
use SwanFlutter\PayPing\PayPing;

Route::post('/pay', function (Request $request) {
    $response = app(PayPing::class)->payment()->create([
        'amount'      => 72000,
        'returnUrl'   => route('payment.callback'),
        'clientRefId' => (string)$request->order_id,
    ]);

    return redirect()->away(
        app(PayPing::class)->payment()->getStartUrl($response['paymentCode'])
    );
});
```

### تأیید پرداخت

```php
Route::post('/payment/callback', function (Request $request) {
    if ((int)$request->input('status') !== 1) {
        abort(400, 'پرداخت لغو شد');
    }

    $result = app(PayPing::class)->payment()->verify([
        'amount'       => 72000,
        'paymentCode'  => $request->input('paymentCode'),
        'paymentRefId' => (int)$request->input('paymentRefId'),
    ]);

    return 'پرداخت موفق!';
});
```

### استفاده با Facade

```php
use SwanFlutter\PayPing\Laravel\Facades\PayPing;

PayPing::payment()->create([...]);
PayPing::invoice()->create([...]);
PayPing::coupon()->list([...]);
```

## API Reference

### `PayPing`

سرویس‌ها به صورت lazy-load ساخته می‌شوند:

| متد | سرویس |
|-----|-------|
| `$payping->payment()` | پرداخت |
| `$payping->invoice()` | فاکتور |
| `$payping->customer()` | مشتریان |
| `$payping->product()` | محصولات |
| `$payping->report()` | گزارش‌ها |
| `$payping->inquiry()` | استعلام |
| `$payping->withdraw()` | برداشت |
| `$payping->bnpl()` | خرید اعتباری (BNPL) |
| `$payping->permalink()` | لینک پرداخت ثابت |
| `$payping->coupon()` | کوپن |
| `$payping->upload()` | آپلود فایل |

سازنده:

```php
new PayPing(string $token, bool $testMode = false, int $timeout = 45)
```

### `PaymentService`

| متد | توضیح |
|-----|-------|
| `create(array $data)` | ایجاد پرداخت (`POST /v3/pay`) |
| `verify(array $data)` | تأیید پرداخت (`POST /v3/pay/verify`) |
| `getStartUrl(string $paymentCode)` | آدرس درگاه برای redirect |
| `delete(string $paymentCode)` | حذف پرداخت |
| `reverse(array $data)` | برگشت وجه |
| `share(array $data)` / `createShared(array $data)` | پرداخت اشتراکی |
| `unblock(array $data)` | رفع مسدودی |
| `paid($refId, $paymentCode)` / `paidNotify($refId, $paymentCode)` | ارسال اطلاعات پرداخت به پذیرنده (معمولاً به صورت خودکار توسط PayPing فراخوانی می‌شود) |

### `UploadService`

```php
$payping->upload()->profilePic('/path/photo.jpg');          // عکس پروفایل (JPG, PNG, JPEG)
$payping->upload()->item('/path/photo.jpg');                // عکس آیتم مالی (JPG, PNG, JPEG)
$payping->upload()->invoiceAttachment('/path/attachment.pdf'); // ضمیمه فاکتور
```

### `PayPingException`

| متد | توضیح |
|-----|-------|
| `getMessage()` | پیام خطا (شامل جزئیات PayPing) |
| `getCode()` | کد HTTP |
| `getErrors()` | آرایه خطاهای `metaData.errors` |

## تست

```bash
composer install
composer test
```

## لایسنس

MIT — [Swan Flutter](https://github.com/SwanFlutter)
