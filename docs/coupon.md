# سرویس کوپن تخفیف (Coupon)

مدیریت کدهای تخفیف و مشاهده خریداران آن‌ها.

```php
$coupon = $payping->coupon();
```

## فهرست متدها

| متد پکیج | متد HTTP | Endpoint | توضیح |
|----------|----------|----------|-------|
| `create(array $data)` | `POST` | `/v1/coupon` | ایجاد کوپن |
| `update(array $data)` | `PUT` | `/v1/coupon` | ویرایش کوپن |
| `get(string $code)` | `GET` | `/v1/coupon/{code}` | دریافت کوپن |
| `delete(string $code)` | `DELETE` | `/v1/coupon/{code}` | حذف کوپن |
| `list(array $params)` | `GET` | `/v1/coupon/List` | لیست کوپن‌ها |
| `count(array $params)` | `GET` | `/v1/coupon/ListCount` | تعداد کوپن‌ها |
| `buyersCount(string $couponCode)` | `GET` | `/v1/coupon/{couponCode}/BuyersListCount` | تعداد خریداران کوپن |
| `buyers(string $couponCode, array $params)` | `GET` | `/v1/coupon/{couponCode}/BuyersList` | لیست خریداران کوپن |

## ایجاد کوپن

فیلدها مطابق `CouponCreateViewModel` داکیومنت رسمی:

| فیلد | نوع | توضیح |
|------|-----|-------|
| `name` | string | نام کوپن |
| `userCouponCode` | string | کد کوپن دلخواه |
| `type` | `0`,`1` | نوع تخفیف (مبلغ / درصد) |
| `amount` | integer | مقدار تخفیف |
| `redeemDate` | date-time | تاریخ استفاده |
| `redeemTime` | string | زمان استفاده |
| `maxRedemption` | integer | حداکثر تعداد استفاده |
| `isActive` | boolean | فعال بودن |
| `activeProductCode` | array&lt;string&gt; | کدهای محصولات مرتبط |

```php
$response = $payping->coupon()->create([
    'name'           => 'تخفیف نوروزی',
    'userCouponCode' => 'NOWRUZ1405',
    'type'           => 1,        // درصدی
    'amount'         => 20,       // ۲۰٪
    'maxRedemption'  => 100,
    'isActive'       => true,
]);
```

## بقیه عملیات

```php
// دریافت
$coupon = $payping->coupon()->get($code);

// ویرایش
$payping->coupon()->update(array_merge($data, ['code' => $code]));

// حذف
$payping->coupon()->delete($code);

// لیست
$coupons = $payping->coupon()->list(['page' => 1]);

// خریداران یک کوپن
$count = $payping->coupon()->buyersCount($couponCode);
$buyers = $payping->coupon()->buyers($couponCode, ['page' => 1]);
```
