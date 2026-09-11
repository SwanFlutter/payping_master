# سرویس محصولات (Product)

مدیریت محصولات و لینک پرداخت مرتبط با آن‌ها.

```php
$product = $payping->product();
```

## فهرست متدها

| متد پکیج | متد HTTP | Endpoint | توضیح |
|----------|----------|----------|-------|
| `create(array $data)` | `POST` | `/v1/product` | ایجاد محصول |
| `update(array $data)` | `PUT` | `/v1/product` | ویرایش محصول |
| `get(string $code)` | `GET` | `/v1/product/{code}` | دریافت محصول |
| `delete(string $code)` | `DELETE` | `/v1/product/{code}` | حذف محصول |
| `list(array $params)` | `GET` | `/v1/product/List` | لیست محصولات |

## ایجاد محصول

فیلدها مطابق `ProductCreateViewModel` داکیومنت رسمی:

| فیلد | نوع | الزامی | توضیح |
|------|-----|--------|-------|
| `title` | string | ✅ | عنوان محصول |
| `description` | string | — | توضیحات |
| `amount` | integer | — | مبلغ محصول (تومان) |
| `defineAmountByUser` | boolean | — | مبلغ را پرداخت‌کننده تعیین کند |
| `quantity` | integer | — | موجودی |
| `unlimited` | boolean | — | موجودی نامحدود |
| `haveTax` | boolean | — | شامل مالیات |
| `imageLink` | string | — | لینک تصویر محصول |

```php
$response = $payping->product()->create([
    'title'              => 'اشتراک شش ماهه',
    'amount'             => 72000,
    'description'        => 'اشتراک طلایی سایت',
    'quantity'           => 100,
    'unlimited'          => false,
    'defineAmountByUser' => false,
    'haveTax'            => false,
]);

$productCode = $response['code'];
```

## بقیه عملیات

```php
// دریافت
$product = $payping->product()->get($productCode);

// ویرایش (کد محصول در بدنه ارسال می‌شود)
$payping->product()->update(array_merge($data, ['code' => $productCode]));

// حذف
$payping->product()->delete($productCode);

// لیست
$products = $payping->product()->list(['page' => 1]);
```
