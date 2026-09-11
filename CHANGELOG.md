# Changelog

تمام تغییرات مهم این پروژه در این فایل ثبت می‌شود.

فرمت بر اساس [Keep a Changelog](https://keepachangelog.com/en/1.1.0/) است
و نسخه‌بندی مطابق [Semantic Versioning](https://semver.org/spec/v2.0.0.html) انجام می‌شود.

## [Unreleased]

## [1.1.1] — 2026-09-11

### Fixed
- رفع مشکل زنجیرهٔ وابستگی که نصب روی PHP 8.1 را ناممکن می‌کرد (`illuminate/support 12` → `nesbot/carbon ^3.8.4` → `symfony/clock ^8.x`)
- پین کردن پلتفرم Composer روی PHP 8.1.0 در `composer.json` تا همیشه نسخه‌های سازگار با PHP 8.1 حلولاسیون شوند
- بازتولید `composer.lock` با `illuminate/support v10.49.0` و `nesbot/carbon 2.73.0` (بدون `symfony/clock`)

## [1.1.0] — 2026-09-10

### Added
- انتشار عمومی پکیج با نام `swanflutter/payping-master`
- پشتیبانی کامل از PayPing API v3 (پرداخت، تأیید، تسهیم، برگشت وجه، مسدودسازی)
- پشتیبانی از تمام سرویس‌ها: فاکتور (v2)، مشتری، محصول، کوپن، لینک پرداخت ثابت، برداشت، گزارش، استعلام، خرید اقساطی (BNPL) و آپلود فایل
- سرویس `UploadService` برای آپلود فایل‌های multipart (`POST /v1/upload/*`)
- متدهای `paid()` و `paidNotify()` برای `GET/POST /v3/pay/paid/{refId}/{paymentCode}`
- پشتیبانی از Laravel 9 / 10 / 11 / 12 با Service Provider و Facade آماده
- DTOهای `CreatePaymentRequest` و `VerifyPaymentRequest`
- کلاس `PayPingException` با دسترسی به کد HTTP و جزئیات خطای `metaData.errors`
- حالت آزمایشی (test mode) برای شبیه‌سازی پاسخ‌ها
- مستندات جداگانه برای هر سرویس در پوشه `docs/`
- لایسنس MIT
