# سرویس خرید اقساطی (BNPL)

سرویس «پرداخت اقساطی» پی‌پینگ برای پذیرندگان — ساخت سفارش اقساطی و مدیریت طرح‌ها.

```php
$bnpl = $payping->bnpl();
```

## فهرست متدها

| متد پکیج | متد HTTP | Endpoint | توضیح |
|----------|----------|----------|-------|
| `changeWalletCredit(array $data)` | `POST` | `/v1/bnpl/merchant/contract/change-wallet-credit-amount` | تغییر اعتبار کیف پول قرارداد |
| `getOptions()` | `GET` | `/v1/bnpl/merchant/options/get` | دریافت تنظیمات اقساطی |
| `createOrder(array $data)` | `POST` | `/v1/bnpl/merchant/order/create` | ساخت سفارش اقساطی |
| `listOrders(array $params)` | `GET` | `/v1/bnpl/merchant/order/list` | لیست سفارش‌های اقساطی |
| `getOrder(string $trackingCode, string $clientRefId)` | `GET` | `/v1/bnpl/merchant/order/detail` | جزئیات یک سفارش |
| `listPlans()` | `GET` | `/v1/bnpl/merchant/plan/list` | لیست طرح‌های اقساطی |
| `togglePlan(array $data)` | `PUT` | `/v1/bnpl/merchant/plan/toggle-active` | فعال/غیرفعال کردن طرح |

## ساخت سفارش اقساطی

فیلدها مطابق `BnplMerchantOrderCreateRequest` داکیومنت رسمی:

| فیلد | نوع | الزامی | توضیح |
|------|-----|--------|-------|
| `amount` | integer | ✅ | مبلغ سفارش (تومان) |
| `mobile` | string | ✅ | موبایل خریدار |
| `callbackUrl` | string | ✅ | آدرس بازگشت پس از پرداخت |
| `refId` | string | ✅ | شناسه سفارش شما |
| `description` | string | — | توضیحات |
| `cancelUrl` | string | — | آدرس لغو پرداخت |
| `targetPlans` | array&lt;string&gt; | — | طرح‌های مجاز برای این سفارش |

```php
$response = $payping->bnpl()->createOrder([
    'amount'      => 12000000,
    'mobile'      => '09123456789',
    'callbackUrl' => 'https://example.com/bnpl-callback.php',
    'cancelUrl'   => 'https://example.com/bnpl-cancel.php',
    'refId'       => 'ORDER-98765',
    'description' => 'لپ‌تاپ لنوو',
]);

$trackingCode = $response['trackingCode']; // برای پیگیری و redirect به درگاه اقساطی
```

## پیگیری سفارش

```php
// با کد رهگیری یا شناسه سفارش خودتان
$order = $payping->bnpl()->getOrder($trackingCode);
$order = $payping->bnpl()->getOrder('', 'ORDER-98765');

// لیست همه سفارش‌ها
$orders = $payping->bnpl()->listOrders(['page' => 1]);
```

## طرح‌های اقساطی

```php
$plans = $payping->bnpl()->listPlans();

// فعال یا غیرفعال کردن یک طرح
$payping->bnpl()->togglePlan([
    'planCode' => $planCode,
    'isActive' => false,
]);
```
