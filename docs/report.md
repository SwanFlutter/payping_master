# سرویس گزارش‌ها (Report)

گزارش تراکنش‌ها و برداشت‌های حساب.

```php
$report = $payping->report();
```

## فهرست متدها

| متد پکیج | متد HTTP | Endpoint | توضیح |
|----------|----------|----------|-------|
| `transactions(array $data)` | `POST` | `/v1/report/TransactionReport` | گزارش تراکنش‌ها |
| `transactionsCount(array $data)` | `POST` | `/v1/report/TransactionReportCount` | تعداد تراکنش‌ها |
| `withdraws(array $data)` | `POST` | `/v1/report/WithdrawTransactions` | گزارش برداشت‌ها |
| `withdrawsCount(array $data)` | `POST` | `/v1/report/WithdrawTransactionsCount` | تعداد برداشت‌ها |
| `get(string $code)` | `GET` | `/v1/report/{code}` | گزارش یک تراکنش با کد |

## گزارش تراکنش‌ها

فیلترها مطابق `TransactionReportViewModel` داکیومنت رسمی:

```php
$transactions = $payping->report()->transactions([
    'startDate' => '2026-01-01',
    'endDate'   => '2026-06-30',
]);
```

هر رکورد تراکنش شامل این فیلدهاست:

| فیلد | توضیح |
|------|-------|
| `amount` | مبلغ |
| `payDate` | تاریخ پرداخت |
| `isPaid` | پرداخت تأیید شده؟ |
| `description` | توضیحات |
| `name` | نام پرداخت‌کننده / دریافت‌کننده |
| `payerIdentity` | موبایل یا ایمیل پرداخت‌کننده |
| `isRequest` | درخواست یا پرداخت |
| `code` | کد پرداخت |
| `clientId` | شناسه زیرسیستم مشتری در پی‌پینگ |
| `clientRefId` | کد ارسالی مشتری به پی‌پینگ |
| `invoiceNo` | شناسه پرداخت |
| `createdDate` | تاریخ ساخت پرداخت / درخواست |

## بقیه گزارش‌ها

```php
// تعداد کل تراکنش‌ها
$count = $payping->report()->transactionsCount();

// گزارش برداشت‌ها
$withdraws = $payping->report()->withdraws(['startDate' => '2026-01-01']);

// تعداد برداشت‌ها
$count = $payping->report()->withdrawsCount();

// جزئیات یک تراکنش با کد پرداخت
$details = $payping->report()->get($paymentCode);
```
