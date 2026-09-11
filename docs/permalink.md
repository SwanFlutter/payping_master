# سرویس لینک پرداخت ثابت (PermaLink)

ساخت صفحات پرداخت ثابت برای محصولات — مناسب فروشگاه‌ها و لینک‌های دائمی.

```php
$permalink = $payping->permalink();
```

## فهرست متدها

| متد پکیج | متد HTTP | Endpoint | توضیح |
|----------|----------|----------|-------|
| `create(array $data)` | `POST` | `/v1/permalink` | ایجاد لینک پرداخت |
| `update(array $data)` | `PUT` | `/v1/permalink` | ویرایش لینک پرداخت |
| `get(string $code)` | `GET` | `/v1/permalink/{code}` | دریافت لینک پرداخت |
| `delete(string $code)` | `DELETE` | `/v1/permalink/{code}` | حذف لینک پرداخت |
| `buyers(string $productCode, array $params)` | `GET` | `/v1/permalink/{productCode}/BuyersList` | لیست خریداران محصول |
| `buyersCount(string $productCode)` | `GET` | `/v1/permalink/{productCode}/BuyersListCount` | تعداد خریداران |
| `getBuyer(string $payCode)` | `GET` | `/v1/permalink/{payCode}/Buyer` | اطلاعات خریدار یک پرداخت |

## ایجاد لینک پرداخت

فیلدها مطابق `PermanentCreateViewModel` داکیومنت رسمی:

| فیلد | نوع | توضیح |
|------|-----|-------|
| `productCode` | string | کد محصول مرتبط |
| `redirectPage` | string | آدرس بازگشت پس از پرداخت |
| `getAddress` | boolean | دریافت آدرس از خریدار |
| `smsText` | string | متن پیامک |
| `customDescriptionText` | string | توضیحات دلخواه |
| `emailOption` / `phoneOption` / `nameOption` / `customDesOption` | ShowOptions | نمایش فیلدهای اختیاری در صفحه پرداخت |
| `permanentType` | PermanentType | نوع لینک پرداخت ثابت |
| `isMultiple` | boolean | امکان پرداخت چندباره |
| `clientId` / `clientRefId` | string | شناسه‌های پذیرنده |

```php
$response = $payping->permalink()->create([
    'productCode'  => $productCode,
    'redirectPage' => 'https://example.com/thanks.php',
    'isMultiple'   => true,
]);

$payLink = $response['payLink']; // لینک پرداخت ثابت — در سایت/پیامک منتشر کنید
```

## بقیه عملیات

```php
// دریافت
$permalink = $payping->permalink()->get($code);

// ویرایش
$payping->permalink()->update(array_merge($data, ['code' => $code]));

// حذف
$payping->permalink()->delete($code);

// خریداران محصول
$count = $payping->permalink()->buyersCount($productCode);
$buyers = $payping->permalink()->buyers($productCode, ['page' => 1]);

// اطلاعات خریدار یک پرداخت خاص
$buyer = $payping->permalink()->getBuyer($payCode);
```
