# سرویس مشتریان (Customer)

مدیریت مشتریان حساب PayPing شما.

```php
$customer = $payping->customer();
```

## فهرست متدها

| متد پکیج | متد HTTP | Endpoint | توضیح |
|----------|----------|----------|-------|
| `create(array $data)` | `POST` | `/v1/customer` | ثبت مشتری جدید |
| `get(string $code)` | `GET` | `/v1/customer/{code}` | دریافت مشتری |
| `update(string $code, array $data)` | `PUT` | `/v1/customer/{code}` | ویرایش مشتری |
| `delete(string $code)` | `DELETE` | `/v1/customer/{code}` | حذف مشتری |
| `list(array $params)` | `GET` | `/v1/customer/List` | لیست مشتریان |
| `count(array $params)` | `GET` | `/v1/customer/ListCount` | تعداد مشتریان |

## ثبت مشتری جدید

فیلدها مطابق `CustomerCreateViewModel` داکیومنت رسمی:

| فیلد | نوع | الزامی | توضیح |
|------|-----|--------|-------|
| `firstName` | string | ✅ | نام |
| `lastName` | string | ✅ | نام خانوادگی |
| `businessName` | string | — | نام کسب‌وکار |
| `isBusiness` | boolean | — | حقوقی = true، حقیقی = false |
| `nationalId` | string | — | کدملی |
| `email` | string | — | پست الکترونیک |
| `phone` | string | — | تلفن |
| `userPhotoFileId` | string | — | کلید فایل عکس از سرویس آپلود |
| `state` | string | — | استان |
| `city` | string | — | شهر |
| `location` | string | — | آدرس |
| `zipCode` | string | — | کدپستی |
| `additionalInfo` | string | — | اطلاعات اضافی |
| `memo` | string | — | متن یادآوری |

```php
$response = $payping->customer()->create([
    'firstName'  => 'علی',
    'lastName'   => 'محمدی',
    'email'      => 'ali@example.com',
    'phone'      => '09123456789',
    'isBusiness' => false,
    'city'       => 'تهران',
]);

$customerCode = $response['code']; // کد مشتری برای مراجعات بعدی
```

## بقیه عملیات

```php
// دریافت
$customer = $payping->customer()->get($code);

// ویرایش
$payping->customer()->update($code, [
    'phone' => '09987654321',
]);

// حذف
$payping->customer()->delete($code);

// لیست
$customers = $payping->customer()->list(['page' => 1, 'perPage' => 25]);

// تعداد
$count = $payping->customer()->count();
```
