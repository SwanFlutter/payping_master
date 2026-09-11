# سرویس آپلود فایل (Upload)

آپلود عکس پروفایل، عکس آیتم مالی و ضمیمه فاکتور — ورودی همه سرویس‌ها `formData` (multipart) است.

```php
$upload = $payping->upload();
```

## فهرست متدها

| متد پکیج | Endpoint | توضیح |
|----------|----------|-------|
| `profilePic(string $filePath)` | `POST /v1/upload/ProfilePic` | آپلود عکس پروفایل کاربری |
| `item(string $filePath)` | `POST /v1/upload/Item` | آپلود عکس یک آیتم مالی |
| `invoiceAttachment(string $filePath)` | `POST /v1/upload/InvoiceAttachment` | آپلود ضمیمه فاکتور |

## محدودیت‌های فایل

| سرویس | فرمت‌های مجاز |
|-------|---------------|
| `profilePic` | JPG, PNG, JPEG |
| `item` | JPG, PNG, JPEG |
| `invoiceAttachment` | بدون محدودیت |

## استفاده

```php
// عکس پروفایل — کلید فایل را برای فیلد userPhotoFileId در سرویس مشتریان نگه دارید
$response = $payping->upload()->profilePic('/path/photo.jpg');
$fileId = $response['fileId'];

// عکس آیتم مالی
$response = $payping->upload()->item('/path/item.jpg');

// ضمیمه فاکتور — کلیدها را در فیلد attachments فاکتور قرار دهید
$response = $payping->upload()->invoiceAttachment('/path/attachment.pdf');
```

پس از آپلود، کلید یکتای فایل (`fileId`) را در فیلدهای مرتبط استفاده کنید:
- عکس پروفایل → فیلد `userPhotoFileId` در `customer()->create()`
- ضمیمه فاکتور → فیلد `attachments` در `invoice()->create()`
