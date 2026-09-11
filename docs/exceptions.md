# مدیریت خطا و تنظیمات پیشرفته

## PayPingException

هر خطای HTTP یا اتصال، استثنای `SwanFlutter\PayPing\PayPingException` ایجاد می‌کند:

```php
use SwanFlutter\PayPing\PayPing;
use SwanFlutter\PayPing\PayPingException;

try {
    $response = $payping->payment()->create($data);
} catch (PayPingException $e) {
    $e->getMessage(); // پیام خطا — شامل title و جزئیات metaData.errors
    $e->getCode();    // کد HTTP (مثلاً 400 یا 401)
    $e->getErrors();  // آرایه خطاهای metaData.errors
}
```

**فرمت خطاهای PayPing:** پاسخ‌های خطا مطابق `ProblemDetails` ساختاری شبیه این دارند:

```json
{
  "title": "ValidationException",
  "status": 400,
  "instance": "/v3/pay",
  "paypingTraceId": "0HN50ATIAS006:00000002",
  "metaData": {
    "code": 101,
    "errors": [
      { "message": "مقدار فیلد 'آدرس بازگشت پذیرنده' اجباری است" }
    ]
  }
}
```

`getMessage()` خودکار `title` و پیام‌های `metaData.errors` را ترکیب می‌کند، پس برای نمایش به کاربر کافی است.

## کدهای HTTP رایج

| کد | معنا |
|----|------|
| `200` | موفق |
| `202` / `502` | (فقط verify) تأیید در حال پردازش — دوباره تلاش کنید |
| `400` | ورودی نامعتبر — جزئیات در `getErrors()` |
| `401` | توکن نامعتبر یا منقضی |
| `403` | دسترسی به سرویس ندارید (مثلاً استعلام‌ها) |
| `404` | کد پرداخت / کد رکورد پیدا نشد |
| `409` | (فقط verify) `metaData.code == 110` یعنی قبلاً وریفای شده |
| `500` | خطای سرور PayPing |

## ساختار PayPing

```php
$payping = new PayPing(
    string $token,          // توکن API
    bool   $testMode = false, // شبیه‌سازی پاسخ‌ها
    int    $timeout = 45     // مهلت انتظار (ثانیه)
);
```

یا با HttpClient سفارشی (برای تست واحد):

```php
use SwanFlutter\PayPing\HttpClient;

$customClient = new HttpClient($token, timeout: 90, testMode: false);
$payping = new PayPing($customClient);
```

## حالت آزمایشی (Test Mode)

```php
$payping = new PayPing($token, testMode: true);
```

برای توسعه بدون تراکنش واقعی — پاسخ‌ها شبیه‌سازی می‌شوند.

## DTOها

### CreatePaymentRequest

```php
use SwanFlutter\PayPing\DTOs\CreatePaymentRequest;

$request = new CreatePaymentRequest(int $amount, string $returnUrl);
$request
    ->setClientRefId(string $refId)     // شناسه سفارش شما
    ->setDescription(string $desc)      // توضیحات
    ->setPayerName(string $name)        // نام پرداخت‌کننده
    ->setPayerIdentity(string $identity) // موبایل یا ایمیل
    ->setReversible(bool $reversible)   // قابلیت برگشت وجه
    ->setBlocked(bool $blocked);        // بلاک بودن تراکنش

$payping->payment()->create($request->toArray());
```

### VerifyPaymentRequest

```php
use SwanFlutter\PayPing\DTOs\VerifyPaymentRequest;

$request = new VerifyPaymentRequest(
    int    $amount,        // همان مبلغ اولیه
    string $paymentCode,   // کد پرداخت ذخیره‌شده
    int    $paymentRefId   // کد رهگیری از callback
);

$payping->payment()->verify($request->toArray());
```

## لیست کامل سرویس‌ها

```php
$payping->payment()   // درگاه پرداخت v3
$payping->invoice()   // فاکتور v2
$payping->customer()  // مشتریان
$payping->product()   // محصولات
$payping->report()    // گزارش‌ها
$payping->inquiry()   // استعلام‌ها
$payping->withdraw()  // برداشت
$payping->bnpl()      // خرید اقساطی
$payping->permalink() // لینک پرداخت ثابت
$payping->coupon()    // کوپن تخفیف
$payping->upload()    // آپلود فایل
```

سرویس‌ها lazy-load هستند و هر بار همان instance بازگردانده می‌شود.
