# سرویس استعلام‌ها (Inquiry)

استعلام‌های بانکی، هویتی و خدماتی — کارمزد جداگانه دارند و نیازمند فعال بودن سرویس در حساب PayPing هستند.

```php
$inquiry = $payping->inquiry();
```

## استعلام‌های بانکی

| متد پکیج | Endpoint | توضیح |
|----------|----------|-------|
| `cardOwner(string $cardNumber)` | `GET /v1/inquiry/Cards/card-to-owner-info-inquiry` | اطلاعات دارنده کارت |
| `cardToSheba(string $cardNumber)` | `GET /v1/inquiry/Cards/card-to-sheba-inquiry` | تبدیل کارت به شبا |
| `cardToDeposit(string $cardNumber)` | `GET /v1/inquiry/Cards/card-to-deposit-inquiry` | تبدیل کارت به شماره حساب |
| `matchCard(string $cardNumber, string $nationalCode, string $birthDate)` | `GET /v1/inquiry/Matching/nationalCode-with-card` | تطبیق کارت با کدملی و تاریخ تولد |
| `matchSheba(string $sheba, string $nationalCode, string $birthDate)` | `GET /v1/inquiry/Matching/nationalCode-with-sheba` | تطبیق شبا با کدملی و تاریخ تولد |
| `shebaOwner(string $sheba)` | `GET /v1/inquiry/Sheba/sheba-owner-info` | اطلاعات دارنده شبا |

```php
$owner = $payping->inquiry()->cardOwner('6037990000000000');
$sheba = $payping->inquiry()->cardToSheba('6037990000000000');

$match = $payping->inquiry()->matchCard(
    '6037990000000000',
    '0012345678',
    '1370/01/01'
);
```

## استعلام‌های هویتی

| متد پکیج | Endpoint | توضیح |
|----------|----------|-------|
| `matchMobile(string $mobileNumber, string $nationalCode)` | `GET /v1/inquiry/Matching/nationalcode-with-mobile` | تطبیق موبایل با کدملی |
| `identity(string $nationalCode, string $birthDate)` | `GET /v1/inquiry/NationalCode/inquiry-with-personal-info` | استعلام مشخصات با کدملی و تاریخ تولد |

```php
$identity = $payping->inquiry()->identity('0012345678', '1370/01/01');
$match    = $payping->inquiry()->matchMobile('09123456789', '0012345678');
```

## استعلام خدماتی

| متد پکیج | Endpoint | توضیح |
|----------|----------|-------|
| `postalCode(string $postalCode)` | `GET /v1/inquiry/PostalCode/inquiry-postal-code` | اطلاعات آدرس با کدپستی |

```php
$address = $payping->inquiry()->postalCode('1234567890');
```
