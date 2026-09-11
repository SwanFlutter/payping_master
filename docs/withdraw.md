# سرویس برداشت (Withdraw)

درخواست برداشت وجه از حساب PayPing و پیگیری آن.

```php
$withdraw = $payping->withdraw();
```

## فهرست متدها

| متد پکیج | متد HTTP | Endpoint | توضیح |
|----------|----------|----------|-------|
| `create(int $amount)` | `POST` | `/v1/withdraw/{amount}` | درخواست برداشت |
| `get(string $code)` | `GET` | `/v1/withdraw/{code}` | استعلام وضعیت برداشت |

## درخواست برداشت

```php
$response = $payping->withdraw()->create(500000); // مبلغ به تومان

$withdrawCode = $response['code']; // کد پیگیری برداشت
```

## استعلام وضعیت برداشت

```php
$result = $payping->withdraw()->get($withdrawCode);
// شامل وضعیت پردازش، تاریخ و جزئیات واریز به حساب بانکی
```
