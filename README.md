# ShareXOS PayPing v3

پکیج PHP برای درگاه پرداخت **PayPing API v3** — بدون وابستگی به فریم‌ورک.

## نصب

```json
// composer.json
{
  "repositories": [
    {
      "type": "path",
      "url": "../sharexos-payping"
    }
  ],
  "require": {
    "sharexos/payping": "*"
  }
}
```

## استفاده

### ایجاد پرداخت

```php
use ShareXOS\PayPing\PayPing;
use ShareXOS\PayPing\CreatePaymentRequest;
use ShareXOS\PayPing\PayPingException;

$payping = new PayPing($_ENV['PAYPING_TOKEN']);

$request = new CreatePaymentRequest(72000, 'https://sharexos.ir/callback.php');
$request
    ->setClientRefId('SXOS-1234567890-abcd')
    ->setDescription('خرید اشتراک شش ماهه')
    ->setPayerName('علی محمدی')
    ->setPayerIdentity('09123456789');  // موبایل

try {
    $response = $payping->createPayment($request);
    
    // ذخیره paymentCode در DB
    $paymentCode = $response->getPaymentCode();
    
    // redirect کاربر به درگاه
    header('Location: ' . $response->getPayUrl());
    exit;
    
} catch (PayPingException $e) {
    echo 'خطا: ' . $e->getMessage();
}
```

### تأیید پرداخت (در callback)

```php
use ShareXOS\PayPing\PayPing;
use ShareXOS\PayPing\VerifyPaymentRequest;
use ShareXOS\PayPing\PayPingException;

// PayPing این مقادیر را POST می‌کند:
$paymentRefId = (int)($_POST['paymentRefId'] ?? 0);
$paymentCode  = trim($_POST['paymentCode']  ?? '');
$clientRefId  = trim($_POST['clientRefId']  ?? '');
$status       = (int)($_POST['status']      ?? 0);

if ($status !== 1) {
    // کاربر لغو کرد
    die('پرداخت لغو شد');
}

$payping = new PayPing($_ENV['PAYPING_TOKEN']);
$verifyRequest = new VerifyPaymentRequest($paymentRefId, $paymentCode, 72000);

try {
    $verified = $payping->verifyPayment($verifyRequest);
    if ($verified) {
        // ✅ پرداخت تأیید شد — اشتراک فعال کن
        echo 'پرداخت موفق! کد پیگیری: ' . $paymentRefId;
    }
} catch (PayPingException $e) {
    echo 'تأیید ناموفق: ' . $e->getMessage();
}
```

## API Reference

### `PayPing`

| متد | توضیح |
|-----|-------|
| `__construct(string $token, bool $testMode = false)` | توکن از پنل PayPing |
| `createPayment(CreatePaymentRequest $req)` | ایجاد پرداخت |
| `verifyPayment(VerifyPaymentRequest $req)` | تأیید پرداخت |

### `CreatePaymentRequest`

| متد | نوع | توضیح |
|-----|-----|-------|
| `__construct(int $amount, string $returnUrl)` | — | مبلغ (تومان، حداقل ۱۰۰۰) + callback URL |
| `setClientRefId(string)` | optional | شناسه سفارش شما |
| `setDescription(string)` | optional | توضیحات |
| `setPayerName(string)` | optional | نام پرداخت‌کننده |
| `setPayerIdentity(string)` | optional | موبایل یا ایمیل |

### `CreatePaymentResponse`

| متد | نوع | توضیح |
|-----|-----|-------|
| `getPaymentCode()` | string | کد پرداخت — در DB ذخیره کنید |
| `getPayUrl()` | string | URL درگاه — کاربر را redirect کنید |
| `getAmount()` | float | مبلغ |
| `getGatewayAmount()` | float | مبلغ نهایی (با کارمزد) |

### `VerifyPaymentRequest`

| پارامتر | نوع | توضیح |
|---------|-----|-------|
| `$paymentRefId` | int | از `$_POST['paymentRefId']` |
| `$paymentCode` | string | از `$_POST['paymentCode']` |
| `$amount` | int | همان مبلغ اولیه |

## تفاوت با v1

| | v1 (قدیمی) | v3 (این پکیج) |
|--|--|--|
| API URL | `/v1/pay` | `/v3/pay` |
| redirect | `gotoipg/{code}` | `start/{paymentCode}` |
| verify فیلد | `refId` | `paymentRefId` + `paymentCode` |
| `clientRefId` | ندارد | ✅ دارد |
| `payerName` | ندارد | ✅ دارد |
