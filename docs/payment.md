# سرویس پرداخت (Payment v3)

سرویس اصلی درگاه پرداخت PayPing — نسخه 3 API.

```php
use SwanFlutter\PayPing\PayPing;

$payping = new PayPing($_ENV['PAYPING_TOKEN']);
$payment = $payping->payment();
```

## فهرست متدها

| متد پکیج | متد HTTP | Endpoint | توضیح |
|----------|----------|----------|-------|
| `create(array $data)` | `POST` | `/v3/pay` | ایجاد دستور پرداخت |
| `delete(string $paymentCode)` | `DELETE` | `/v3/pay` | حذف پرداخت |
| `createShared(array $data)` | `POST` | `/v3/pay/shared` | ایجاد پرداخت تسهیمی (چند ذی‌نفع) |
| `getStartUrl(string $paymentCode)` | — | `/v3/pay/start/{paymentCode}` | آدرس درگاه برای redirect کاربر |
| `paid(int $refId, string $paymentCode)` | `GET` | `/v3/pay/paid/{refId}/{paymentCode}` | ارسال اطلاعات پرداخت به پذیرنده* |
| `paidNotify(int $refId, string $paymentCode)` | `POST` | `/v3/pay/paid/{refId}/{paymentCode}` | همان مورد بالا با متد POST* |
| `verify(array $data)` | `POST` | `/v3/pay/verify` | تأیید نهایی پرداخت |
| `reverse(array $data)` | `POST` | `/v3/pay/reverse` | برگشت وجه |
| `share(array $data)` | `POST` | `/v3/pay/share` | تسهیم پرداخت بین ذی‌نفعان |
| `unblock(array $data)` | `POST` | `/v3/pay/unblock` | رفع مسدودی پرداخت |

\* این متدها به صورت خودکار توسط PayPing پس از بازگشت از درگاه فراخوانی می‌شوند و نیازی به فراخوانی از سمت پذیرنده نیست.

## ایجاد پرداخت

```php
$response = $payping->payment()->create([
    'amount'       => 72000,                                // مبلغ به تومان
    'returnUrl'    => 'https://example.com/callback.php',   // آدرس بازگشت
    'clientRefId'  => 'ORDER-1234567890',                   // شناسه سفارش شما (اختیاری)
    'description'  => 'خرید اشتراک شش ماهه',                // توضیحات (اختیاری)
    'payerName'    => 'علی محمدی',                           // نام پرداخت‌کننده (اختیاری)
    'payerIdentity'=> '09123456789',                        // موبایل یا ایمیل (اختیاری)
    'isReversible' => false,                                // قابلیت برگشت وجه (اختیاری)
    'IsBlocked'    => false,                                // وضعیت بلاک بودن (اختیاری)
]);
```

فیلدهای بدنه درخواست مطابق `PaymentModel` داکیومنت رسمی:

| فیلد | نوع | الزامی | توضیح |
|------|-----|--------|-------|
| `amount` | integer | ✅ | مبلغ دستور پرداخت (تومان) |
| `returnUrl` | string | ✅ | آدرس بازگشت پذیرنده |
| `payerIdentity` | string | — | موبایل یا ایمیل پرداخت‌کننده |
| `payerName` | string | — | نام پرداخت‌کننده |
| `description` | string | — | توضیحات |
| `clientRefId` | string | — | شناسه ارجاع پذیرنده |
| `isReversible` | boolean | — | تراکنش قابلیت برگشت وجه داشته باشد یا خیر |
| `IsBlocked` | boolean | — | وضعیت بلاک بودن تراکنش |

**پاسخ موفق (200):**

| فیلد | توضیح |
|------|-------|
| `paymentCode` | کد پرداخت — ⚠️ حتماً در دیتابیس ذخیره کنید |
| `url` | لینک دستور پرداخت |
| `amount` | مبلغ دستور پرداخت |
| `payerWage` | کارمزد پرداخت‌کننده |
| `businessWage` | کارمزد پذیرنده |
| `gatewayAmount` | مبلغ نهایی پرداخت (با کارمزد) |
| `paypingVat` | مالیات بر ارزش افزوده |

### استفاده با DTO

```php
use SwanFlutter\PayPing\DTOs\CreatePaymentRequest;

$request = new CreatePaymentRequest(72000, 'https://example.com/callback.php');
$request
    ->setClientRefId('ORDER-1234567890')
    ->setDescription('خرید اشتراک شش ماهه')
    ->setPayerName('علی محمدی')
    ->setPayerIdentity('09123456789')
    ->setReversible(false)
    ->setBlocked(false);

$response = $payping->payment()->create($request->toArray());
```

## redirect به درگاه

پس از دریافت `paymentCode`، کاربر را به درگاه هدایت کنید:

```php
header('Location: ' . $payping->payment()->getStartUrl($paymentCode));
exit;
```

## تأیید پرداخت (callback)

PayPing پس از بازگشت کاربر، اطلاعات پرداخت را با فرمت `application/x-www-form-urlencoded` به `returnUrl` شما POST می‌کند:

| فیلد | توضیح |
|------|-------|
| `status` | `1` = موفق، `0` = عدم پرداخت |
| `errorCode` | کد خطا (در پرداخت موفق خالی است) |
| `clientRefId` | شناسه ارجاع پذیرنده |
| `paymentCode` | کد پرداخت |
| `paymentRefId` | کد رهگیری (فقط در پرداخت موفق) |
| `amount` | مبلغ دستور پرداخت |
| `gatewayAmount` | مبلغ نهایی پرداخت |
| `cardNumber` / `cardHashPan` | شماره کارت پرداخت‌کننده (ممکن است ارسال نشود) |

⚠️ **نکته امنیتی:** حتماً `clientRefId` را در دیتابیس خود جستجو کنید و صحت `paymentCode` و `amount` را با رکورد سفارش مقایسه کنید. در صورت مغایرت، تراکنش را تأیید نکنید.

```php
use SwanFlutter\PayPing\PayPingException;

$status = (int)($_POST['status'] ?? 0);
if ($status !== 1) {
    die('پرداخت لغو شد');
}

$paymentRefId = (int)($_POST['paymentRefId'] ?? 0);
$paymentCode  = trim($_POST['paymentCode'] ?? '');

try {
    $result = $payping->payment()->verify([
        'amount'       => 72000,      // دقیقاً همان مبلغ اولیه
        'paymentCode'  => $paymentCode,
        'paymentRefId' => $paymentRefId,
    ]);

    // ✅ پرداخت تأیید شد
} catch (PayPingException $e) {
    echo 'تأیید ناموفق: ' . $e->getMessage();
}
```

فیلدهای `VerifyModel` (هر سه الزامی): `paymentRefId` (int64)، `paymentCode` (string)، `amount` (int32).

**کدهای وضعیت خاص verify:**

| کد | معنا |
|----|------|
| `200` | تأیید موفق |
| `202` / `502` | تأیید در حال پردازش است — دوباره verify را فراخوانی کنید (پرداخت مجدد نکنید) |
| `409` | اگر `metaData.code` برابر `110` باشد، تراکنش قبلاً وریفای شده — نیازی به تأیید مجدد نیست |
| سایر | خطا — جزئیات در `PayPingException` |

⚠️ اگر verify تا **۱۰ دقیقه** پس از پرداخت فراخوانی نشود، پرداخت نامعتبر و وجه به پرداخت‌کننده بازمی‌گردد.

## تسهیم پرداخت (share)

پرداخت را بین چند ذی‌نفع تقسیم کنید (به ازای هر صاحب سهم یک رکورد):

```php
$result = $payping->payment()->share([
    'paymentCode'   => $paymentCode,
    'paymentRefId'  => $paymentRefId,
    'amount'        => 72000,
    'paymentShares' => [
        ['iDShareHolder' => 'شناسه-ذینفع-۱', 'amount' => 50000],
        ['iDShareHolder' => 'شناسه-ذینفع-۲', 'amount' => 22000],
    ],
]);
```

پرداخت تسهیمی جدید هم از طریق `createShared()` با ساختار مشابه ایجاد می‌شود (`POST /v3/pay/shared`).

## برگشت وجه (reverse)

```php
$result = $payping->payment()->reverse([
    'paymentCode'  => $paymentCode,
    'paymentRefId' => $paymentRefId,
    'amount'       => 72000,
    'clientRefId'  => 'ORDER-1234567890',
]);
```

## رفع مسدودی (unblock)

برای پرداخت‌هایی که با `IsBlocked => true` ایجاد شده‌اند:

```php
$result = $payping->payment()->unblock([
    'paymentCode' => $paymentCode,
    'amount'      => 72000,
]);
```

## حذف پرداخت

```php
$payping->payment()->delete($paymentCode);
```

توجه: اگر تراکنش حداقل یک پرداخت موفق در درگاه داشته باشد، امکان حذف وجود ندارد.
