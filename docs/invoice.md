# سرویس فاکتور (Invoice v2)

مدیریت کامل فاکتورها — شامل فاکتور سریع، زمان‌بندی شده و تأیید پرداخت.

```php
$invoice = $payping->invoice();
```

## فهرست متدها

| متد پکیج | متد HTTP | Endpoint | توضیح |
|----------|----------|----------|-------|
| `create(array $data)` | `POST` | `/v2/invoice` | ایجاد فاکتور |
| `send(string $code)` | `POST` | `/v2/invoice/Send/{code}` | ارسال فاکتور |
| `get(string $code)` | `GET` | `/v2/invoice/{code}` | دریافت جزئیات فاکتور |
| `update(string $code, array $data)` | `PUT` | `/v2/invoice/{code}` | ویرایش فاکتور |
| `archive(string $code)` | `POST` | `/v2/invoice/Archive/{code}` | آرشیو کردن |
| `deArchive(string $code)` | `POST` | `/v2/invoice/DeArchive/{code}` | خارج کردن از آرشیو |
| `getPdf(string $code)` | `GET` | `/v2/invoice/Pdf/{code}` | دریافت PDF فاکتور |
| `list(array $params)` | `GET` | `/v2/invoice/List` | لیست فاکتورها |
| `count(array $params)` | `GET` | `/v2/invoice/ListCount` | تعداد فاکتورها |
| `copy(array $data)` | `POST` | `/v2/invoice/Copy` | کپی فاکتور |
| `cancel(string $code)` | `POST` | `/v2/invoice/Cancel` | لغو فاکتور |
| `reminder(string $code)` | `POST` | `/v2/invoice/Reminder/{code}` | ارسال یادآور پرداخت |
| `getPaymentCode(string $code, string $couponCode = '')` | `GET` | `/v2/invoice/PaymentCode` | دریافت کد پرداخت فاکتور |
| `confirmPayment(array $data)` | `POST` | `/v2/invoice/ConfirmPayment` | تأیید پرداخت دستی |
| `fastInvoice(array $data)` | `POST` | `/v2/invoice/FastInvoice` | فاکتور سریع |
| `schedule(array $data)` | `POST` | `/v2/invoice/Schedule` | ایجاد فاکتور زمان‌بندی‌شده |
| `cancelSchedule(string $code)` | `POST` | `/v2/invoice/CancelSchedule` | لغو زمان‌بندی |
| `getSchedule(string $code)` | `GET` | `/v2/invoice/Schedule/{code}` | دریافت زمان‌بندی |

## ایجاد فاکتور

```php
$response = $payping->invoice()->create([
    'title'       => 'فاکتور خرید اشتراک',
    'number'      => 'INV-1403-001',
    'dueDate'     => '2026-10-01T00:00:00',   // تاریخ سررسید
    'customers'   => [
        [
            'firstName' => 'علی',
            'lastName'  => 'محمدی',
            'email'     => 'ali@example.com',
            'phone'     => '09123456789',
        ],
    ],
    'products'    => [
        [
            'title'       => 'اشتراک شش ماهه',
            'amount'      => 72000,
            'description' => 'توضیح آیتم',
            'quantity'    => 1,
        ],
    ],
    'createStatus' => 1,   // 0 = پیش‌نویس، 1 = ارسال، 2 = پرداخت دستی
    'returnUrl'    => 'https://example.com/callback.php',
]);
```

### فیلدهای مهم بدنه درخواست (`InvoiceCreateViewModel`)

| فیلد | نوع | توضیح |
|------|-----|-------|
| `title` | string | عنوان فاکتور |
| `number` | string | شماره فاکتور |
| `sendDate` | date-time | تاریخ ارسال |
| `dueDate` | date-time | تاریخ سررسید پرداخت |
| `createStatus` | `0`,`1`,`2` | 0 = ذخیره در پیش‌نویس، 1 = ارسال، 2 = پرداخت دستی انجام شده |
| `customers` | array | مشتریان فاکتور |
| `cc` | array | ایمیل‌های رونوشت |
| `products` | array | آیتم‌های مالی فاکتور |
| `couponCode` | string | کد تخفیف کلی فاکتور |
| `discountAmount` | double | مبلغ یا درصد تخفیف کلی |
| `discountType` | `0`,`1` | 1 = مبلغ، 0 = درصد |
| `shipping` | double | هزینه حمل و نقل |
| `notes` | string | پیام برای پرداخت‌کننده |
| `termsAndConditions` | string | شرایط و قوانین |
| `memo` | string | یادداشت داخلی |
| `attachments` | array&lt;string&gt; | کلید فایل‌های ضمیمه از سرویس آپلود |
| `returnUrl` | string | آدرس بازگشت از صفحه پرداخت |
| `sendAttachmentsAfterSuccessPayment` | boolean | نمایش ضمیمه‌ها فقط بعد از پرداخت موفق |
| `showNotesAfterSuccessPayment` | boolean | نمایش پیام فقط بعد از پرداخت موفق |
| `showTermsAfterSuccessPayment` | boolean | نمایش قوانین فقط بعد از پرداخت موفق |
| `tagIds` | array&lt;int&gt; | برچسب‌های فاکتور |

## فاکتور سریع (FastInvoice)

```php
$response = $payping->invoice()->fastInvoice([
    'title'    => 'فاکتور سریع',
    'dueDate'  => '2026-10-01T00:00:00',
    'customer' => [
        'firstName' => 'علی',
        'lastName'  => 'محمدی',
        'email'     => 'ali@example.com',
    ],
    'products' => [
        ['title' => 'محصول', 'amount' => 50000, 'quantity' => 1],
    ],
]);
```

## دریافت کد پرداخت فاکتور

```php
$response = $payping->invoice()->getPaymentCode($invoiceCode);
// یا با کد تخفیف:
$response = $payping->invoice()->getPaymentCode($invoiceCode, $couponCode);

// redirect کاربر به صفحه پرداخت فاکتور:
header('Location: ' . $response['paymentCodeUrl']);
```

## زمان‌بندی فاکتور

```php
// ایجاد زمان‌بندی
$payping->invoice()->schedule([...]);

// مشاهده زمان‌بندی
$payping->invoice()->getSchedule($code);

// لغو زمان‌بندی
$payping->invoice()->cancelSchedule($code);
```

## لیست و جستجو

```php
$invoices = $payping->invoice()->list([
    'startDate' => '2026-01-01',
    'endDate'   => '2026-12-31',
]);

$count = $payping->invoice()->count();
```
