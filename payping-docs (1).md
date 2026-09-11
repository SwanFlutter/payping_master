# مستندات سرویس‌های پلتفرم مالی پی‌پینگ

`version: v1-v2-v3`

# پشتیبانی
  [برای دریافت پشتیبانی به صفحه ارتباط با ما مراجعه کنید.](https://payping.ir/contact/)

 # مقدمه

 تمامی وب‌ سرویس‌های توضیح داده شده در این مستندات به صورت [RESTful](https://en.wikipedia.org/wiki/Representational_state_transfer) هستند و طبق همین چهارچوب باید با آنها ارتباط برقرار کرد.
 جهت رفع هرگونه مشکل و یا پرسش با پشتیبانی در تماس باشید.

 
 

 

 # توضیحات تکمیلی برای تمام سرویس‌ها

 برای فراخوانی سرویس‌های صفحه‌بندی (pagination) اگر پارامتر ورودی ارسال نشود، حداکثر ۱۰ آیتم نمایش داده می‌شود و همچنین حداکثر تعداد دریافت آیتم به ازای هر درخواست ۵۰ عدد می‌باشد و بیشتر از آن را سرویس پشتیبانی نمی‌کند و در صورت نیاز به بارگزاری تمام آیتم‌های یک سرویس به صورت یکجا با ایمیل به بخش پشتیبانی در تماس باشید. همینطور توجه داشته باشین واحد پول در تمام سرویس‌ها تومان می‌باشد و منطقه زمانی تمامی‌ تاریخ و ساعت‌ها برابر با ساعت جهانی یا UTC می‌باشد.

 # نکاتی برای آپلود فایل‌ها

 برای آپلود هرگونه فایل اعم از عکس پروفایل کاربران و یا گزارشات پرداخت‌ها و ... می‌بایست که از [سرویس بارگذاری فایل](#tag/Upload) استفاده کنید.

 پس از انجام عملیات آپلود توسط سرویس بارگذاری فایل، تنها کافیست نام فایل آپلود شده که در خروجی سرویس به شما برگردانده می‌شود را ذخیره نمایید.

 # جدول کدهای دریافتی از هر سرویس

 بعد از ارسال هر درخواست به سمت سرور، از سمت ما طبق قواعد وب‌سرویس‌های RESTful کدی به شما بازگرداننده می‌شود.
 هر کد معنایی دارد که در جدول زیر توضیحات مربوطه را می‌بینید:

 |شماره کد|توضیحات|
 |-------|--------|
 |`200`| عملیات با موفقیت انجام شد |
 |`400`| مشکلی در ارسال درخواست وجود دارد |
 |`500`| مشکلی در سرور رخ داده است |
 |`503`| سرور در حال حاضر قادر به پاسخگویی نمی‌باشد |
 |`401`| عدم دسترسی|
 |`403`| دسترسی غیر مجاز |
 |`404`| آیتم درخواستی مورد نظر موجود نمی‌باشد |

## Authentication

### `Bearer` — apiKey

برای احراز هویت در سرویس‌های مختلف باید از توکن Bearer در header درخواست‌ها به صورت زیر استفاده کنید. 


 ساختار ارسال توکن: (Bearer TOKEN) 


  اگر شما یک اپلیکیشن و یا وب‌سایت شخصی دارید و قصد استفاده از سرویس‌های مالی ما را برای خود دارید می‌بایست از access token استفاده کنید،  جهت مطالعه روند دریافت آن از کنسول توسعه‌دهنده،   [لطفا اینجا کلیک نمایید.](https://www.payping.io/help/fa/nhoh-driaft-tokn-akhtsasi/)

- **name**: `Authorization`
- **in**: `header`

### `oauth2` — oauth2

اما اگر وب‌سایت و اپلیکیشن شما قصد دسترسی به اطلاعات سایر کاربران پی‌پینگ را دارد، شما می‌بایست از سرویس OAuth ما استفاده کنید که به شما اجازه یک احراز هویت امن با استفاده از یک متد استاندارد و ساده به اپلیکیشن‌های وب، موبایل و دسکتاپ میدهد. جهت مطالعه روند اعطای دسترسی و روند کار [لطفا اینجا کلیک نمایید.](https://www.payping.io/help/fa/nhoh-driaft-tokn-akhtsasi/)

**جریان `authorizationCode`:**
- Authorization URL: `https://oauth.payping.ir/connect/authorize`
- Token URL: `https://oauth.payping.ir/connect/token`
- Scopes:
  - `profile` — دسترسی مرتبط با تمام اطلاعات یک کاربر
  - `email` — دسترسی به مشاهده ایمیل
  - `nationalcode` — دسترسی به مشاهده کدملی کاربر
  - `birthday` — دسترسی به مشاهده تاریخ تولد کاربر
  - `shaba` — دسترسی به مشاهده شبای بانکی کاربر
  - `phone` — دسترسی به مشاهده شماره تماس کاربر
  - `pay:read` — دسترسی فقط خواندنی در سرویس پرداخت
  - `pay:write` — دسترسی نوشتن و تغییرات در سرویس پرداخت
  - `product:read` — دسترسی فقط خواندنی در سرویس آیتم‌های مالی
  - `product:write` — دسترسی نوشتن و تغییرات در سرویس آیتم‌های مالی
  - `coupon:read` — دسترسی فقط خواندنی در سرویس کد تخفیف
  - `coupon:write` — دسترسی فقط خواندنی در سرویس کد تخفیف
  - `customer:read` — دسترسی نوشتن و تغییرات در سرویس مشتریان
  - `customer:write` — دسترسی نوشتن و تغییرات در سرویس مشتریان
  - `invoice:read` — دسترسی فقط خواندنی به سرویس فاکتور ها
  - `invoice:write` — دسترسی نوشتن و تغییرات در سرویس فاکتور ها
  - `upload:write` — دسترسی مرتبط با سرویس بارگذاری فایل‌ها
  - `inquiry:bankInquiry` — دسترسی مرتبط با سرویس های استعلامی-دسته سرویس های استعلام بانکی
  - `inquiry:identityInquiry` — دسترسی مرتبط با سرویس های استعلامی-دسته سرویس های استعلام هویتی
  - `inquiry:facilityInquiry` — دسترسی مرتبط با سرویس های استعلامی-دسته سرویس های استعلام خدماتی
  - `bnpl:merchantread` — دسترسی فقط خواندنی در سرویس اقساطی
  - `bnpl:merchantwrite` — دسترسی نوشتن و تغییرات در سرویس اقساطی

---

## Endpointها

## Payment-v3

نسخه بروز شده از سرویس تراکنش های مالی، پیشنهاد می شود با توجه به بهبود های انجام شده در نسخه فعلی مهاجرت به سرویس جدید از سمت توسعه دهندگان صورت گیرد
## خطاهای زمان پرداخت 

 در فرایند های پرداخت بعلت اینکه ممکن است با توجه به هرنوع خطا کاربر عملیات خاصی را برنامه‌ریزی کرده باشد، به هر خطا کدی اختصاص داده شده است که در جدول زیر مشخص گردیده است: 

| توضیح | کد خطا |
|-------|--------|
| `101` | داده های ارسالی نامعتبر است |
| `102` | درگاه پرداخت فعال برای پذیرنده یافت نشد * |
| `103` | توکن احراز هویت پذیرنده تایید نشده است * |
| `104` | مبلغ تراکنش برای مشتری آزمایشی معتبر نیست (دقت داشته باشید توکن احراز هویت تست دارای محدودیت در مبلغ پرداخت می‌باشد) |
| `105` | آدرس بازگشت پذیرنده معتبر نمی‌باشد |
| `106` | خطای داخلی سرویس رخ داده است * |
| `107` | براساس داده های ارسالی قوانین مورد انتظار رعایت نشده است |
| `108` | خطای داخلی سرور رخ داده است * |
| `109` | پرداخت در حال بررسی می‌باشد |
| `110` | پرداخت قبلاً انجام شده است |
| `111` | حساب کاربری پذیرنده مسدود می‌باشد * |
| `112` | سقف تراکنش مشتری آزمایشی به اتمام رسیده است * |
| `113` | شماره تلفن همراه معتبر نمی‌باشد |
| `114` | ارتباط با درگاه بانکی برقرار نشد. لطفا مجدد تلاش نمایید * |
| `115` | اطلاعات ارسالی از بانک تکراری می‌باشد |
| `116` | حساب های کاربری در تسهیم معتبر نمی‌باشند |
| `117` | شماره شبای تکراری در تسهیم وجود دارد |
| `118` | حساب های کاربری در تسهیم معتبر نمی‌باشند |
| `121` | تایید تراکنش نیازمند پرداخت موفق می‌باشد |
| `122` | داده‌های ارسالی نامعتبر است. پرداخت یافت نشد |
| `123` | تراکنش قبلا تایید شده است |
| `124` | تراکنش با این نسخه از سیستم سازگار نیست * |
| `126` | درخواست با وضعیت فعلی اطلاعات در تعارض است * |
| `127` | خطایی در انجام عملیات در درگاه رخ داده است (کاربر عملیات پرداخت را لغو کرده یا زمان مجاز انجام تراکنش به اتمام رسیده است) |
| `128` | این پرداخت بلاک نمی‌باشد |
| `129` | وضعیت تراکنش اجازه حذف آن را نمی‌دهد (در صورتیکه تراکنش حداقل یکبار به درگاه پرداخت منتقل شده باشد، امکان حذف آن وجود نخواهد داشت) |
| `130` | در حال حاضر امکان پردازش این کد پرداخت وجود ندارد * |
| `131` | تراکنش شما در وضعیت نامعتبر قرار دارد و امکان ادامه فرآیند پرداخت وجود ندارد * |
| `132` | شما مجاز به انجام این تغییر وضعیت نیستید * |
| `133` | اطلاعات پرداخت نامعتبر می‌باشد |
| `134` | این تراکنش قابلیت بازگشت وجه ندارد |
| `135` | مهلت انجام عملیات بازگشت وجه به پایان رسیده است |
| `137` | مبلغ تراکنش اشتباه می‌باشد |
| `138` | مجموع مبالغ سهم‌ها باید با مبلغ کل پرداخت برابر باشد |
| `155` | عملیات تایید تراکنش در حال پردازش است. لطفا مجددا تلاش نمایید |
| `156` | عملیات بازگشت وجه تراکنش در حال پردازش است. لطفا مجددا تلاش نمایید |
| `158` | حساب های کاربری در تسهیم، درگاه مشترک ندارند |
| `159` | امکان تسهیم پرداخت صرفاً با صاحب کسب‌وکار وجود ندارد |
| `160` | این پرداخت تسهیمی می باشد و امکان تسهیم مجدد آن وجود ندارد |
| `161` | به دلیل داشتن درگاه با تسویه مستقیم، امکان ایجاد پرداخت تسهیمی وجود ندارد |
| `162` | پرداخت تسهیمی روی درگاه دارای تسویه مستقیم امکان‌پذیر نیست |
| `163` | داده‌های تقسیم مبلغ برای درگاه تسویه مستقیم معتبر نیست |
| `164` | شبای پرداخت‌یاری پی‌پینگ برای این درگاه تنظیم نشده است |
| `165` | شبای فعالی برای این درگاه یافت نشد |
 
 #### * در صورت بروز این دست از خطاها، کافیست شناسه پیگیری پی پینگ (paypingTraceId) را به پشتیبانی اعلام نمایید.

## مرجع پاسخ‌های دریافتی از سرویس


در صورتی که انجام عملیات با خطا مواجه شود، اطلاعات مربوط به آن طبق ساختار زیر خواهد بود:

| نام پارامتر      | نوع پارامتر | توضیحات |
|------------------|-------------|----------|
| `type`           | string        | لینک مستندات مربوط به خطا |
| `title`          | string        | عنوان خطای دریافتی |
| `status`         | number         | کد خطای استاندارد Http <br/> - `400`: اطلاعات ارسالی نامعتبر است <br/> - `409`: عملیات تکراریست یا اطلاعات ارسالی با داده‌های فعلی مغایرت دارد <br/> - `500`: خطای داخلی سرویس رخ داده است |
| `instance`       | string        | آدرس درخواستی که خطا رخ داده است |
| `paypingTraceId` | string        | شناسه پیگیری خطای دریافتی |
| `metaData`       | Json        | اطلاعات خطا |

  *توصیه می‌شود شناسه `paypingTraceId` ذخیره شود تا در فرآیند پشتیبانی سریع‌تر عمل شود.*

  ### نمونه خطای HTTP 400 در فرایند ساخت پرداخت:
  ```json
  {
    "type": "https://datatracker.ietf.org/doc/html/rfc7231#section-6.5.1",
    "title": "ValidationException",
    "status": 400,
    "instance": "/v3/pay",
    "paypingTraceId": "0HN50ATIAS006:00000002",
    "metaData": {
      "code": 101,
      "errors": [
        { "message": "مقدار فیلد 'آدرس بازگشت پذیرنده' اجباری است" },
        { "message": "مقدار فیلد 'شناسه ارجاع پذیرنده' اجباری است" }
      ]
    }
  }
  ```

### `POST /v3/pay`

**خلاصه:** ساخت پرداخت-نسخه 3

به کمک این متد می‌توانید یک دستور پرداخت ایجاد کنید.

بعد از تولید کد پرداخت، کافیست کاربر را به Url داده شده جهت پرداخت ریدایرکت نمایید.

در مستند پیش رو برای موضوع "مبلغ" با دو واژه مواجه خواهید بود. "مبلغ دستور پرداخت" عددی است که شما به عنوان کاربر به پی پینگ اعلام خواهید کرد. جهت تسهیل در شناسایی عدد نهایی تراکنش، پی پینگ در مراحل مختلف "مبلغ نهایی پرداخت" را با همین عنوان به شما به عنوان کاربر پی پینگ اعلام می کند. این مبلغ معادل عددی آن چیزیست که پرداخت کننده با آن به درگاه هدایت می شود. در نظر داشته باشید با توجه به سناریوی کارمزد اعمال شده بر روی حساب کاربری شما ممکن است این مبلغ بیشتر از مبلغ دستور پرداخت صادره باشد.

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json`

**PaymentModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int64) | — | مبلغ دستور پرداخت |
| `returnUrl` | string | — | آدرس بازگشت پذیرنده |
| `payerIdentity` | string | — | شماره موبایل یا ایمیل پرداخت کننده - اگر شماره موبایل وارد شود، تمام شماره کارت‌های ذخیره شده پرداخت‌کننده در درگاه، نمایش داده می‌شود. |
| `payerName` | string | — | نام پرداخت کننده |
| `description` | string | — | توضیحات |
| `clientRefId` | string | — | شناسه ارجاع پذیرنده |
| `isReversible` | boolean | — | تراکنش قابلیت بازگشت وجه دارد یا خیر |
| `IsBlocked` | boolean | — | وضعیت بلاک بودن تراکنش |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | کافیست کاربر را به Url داده شده جهت پرداخت ریدایرکت کنید |
| `400` | Bad Request |
| `500` | Server Error |
| `default` | Error |

**پاسخ `200` — `application/json`:**

**PaymentDto**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `paymentCode` | string | — | کد پرداخت |
| `url` | string | — | لینک دستور پرداخت |
| `amount` | integer(int32) | — | مبلغ دستور پرداخت |
| `payerWage` | integer(int32) | — | مبلغ کارمزد پرداخت کننده |
| `businessWage` | integer(int32) | — | مبلغ کارمزد پذیرنده |
| `gatewayAmount` | integer(int32) | — | مبلغ نهایی پرداخت |
| `paypingVat` | integer(int32) | — | مبلغ مالیات بر ارزش افزوده (Value-Added Tax) |

**پاسخ `400` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**مثال:**

```json
{
  "type": "https://datatracker.ietf.org/doc/html/rfc7231#section-6.5.1",
  "title": "ValidationException",
  "status": 400,
  "instance": "/v3/pay",
  "paypingTraceId": "0HN50ATIAS006:00000002",
  "metaData": {
    "code": 101,
    "errors": [
      {
        "message": " ﻣﻘﺪارﻓﯿﻠﺪ'آدرسﺑﺎزگﺸﺖپﺬﯾﺮﻧﺪه'اﺟﺒﺎریاﺳﺖ "
      },
      {
        "message": " ﻣﻘﺪارﻓﯿﻠﺪ'ﺷﻨﺎﺳﮫارﺟﺎعپﺬﯾﺮﻧﺪه'اﺟﺒﺎریاﺳﺖ "
      }
    ]
  }
}
```

**پاسخ `500` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `default` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

---

### `DELETE /v3/pay`

**خلاصه:** حذف پرداخت-نسخه 3

از این متد برای حذف یک تراکنش استفاده می‌شود.
            
در صورتی که تراکنش حداقل یک پرداخت موفق در درگاه داشته باشد،
امکان حذف آن وجود نخواهد داشت.

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json`

**RemoveModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `paymentCode` | string | — | کد پرداخت |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `204` | عملیات حذف با موفقیت انجام شده است. |
| `400` | Bad Request |
| `406` | Not Acceptable |
| `500` | Server Error |
| `default` | Error |

**پاسخ `400` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**پاسخ `406` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**پاسخ `500` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `default` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

---

### `POST /v3/pay/shared`

**خلاصه:** ساخت پرداخت تسهیمی-نسخه 3

در صورتیکه تمایل دارید پس از انجام یک پرداخت، مبالغ بصورت خودکار و به نسبت مشخص بین چند نفر تقسیم شود می‌بایست از پرداخت تسهیمی استفاده نمایید

به کمک این متد می‌توانید یک دستور پرداخت تسهیمی ایجاد کنید.

بعد از تولید کد پرداخت، کافیست کاربر را به Url داده شده جهت پرداخت ریدایرکت نمایید.

در مستند پیش رو برای موضوع "مبلغ" با دو واژه مواجه خواهید بود. "مبلغ دستور پرداخت" عددی است که شما به عنوان کاربر به پی پینگ اعلام خواهید کرد. جهت تسهیل در شناسایی عدد نهایی تراکنش، پی پینگ در مراحل مختلف "مبلغ نهایی پرداخت" را با همین عنوان به شما به عنوان کاربر پی پینگ اعلام می کند. این مبلغ معادل عددی آن چیزیست که پرداخت کننده با آن به درگاه هدایت می شود. در نظر داشته باشید با توجه به سناریوی کارمزد اعمال شده بر روی حساب کاربری شما ممکن است این مبلغ بیشتر از مبلغ دستور پرداخت صادره باشد.

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json`

**SharedPaymentModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `returnUrl` | string | — | آدرس بازگشت پذیرنده |
| `payerIdentity` | string | — | شماره موبایل یا ایمیل پرداخت کننده - اگر شماره موبایل وارد شود، تمام شماره کارت‌های ذخیره شده پرداخت‌کننده در درگاه، نمایش داده می‌شود. |
| `payerName` | string | — | نام پرداخت کننده |
| `description` | string | — | توضیحات |
| `clientRefId` | string | — | شناسه ارجاع پذیرنده |
| `isReversible` | boolean | — | تراکنش قابلیت بازگشت وجه دارد یا خیر |
| `items` | array&lt;[SharedPaymentItemModel](#schema-sharedpaymentitemmodel)&gt; | — | اطلاعات تسهیم (به ازای هر صاحب سهم، یک رکورد در نظر بگیرید) |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | کافیست کاربر را به Url داده شده جهت پرداخت ریدایرکت کنید |
| `400` | Bad Request |
| `406` | Not Acceptable |
| `500` | Server Error |
| `default` | Error |

**پاسخ `200` — `application/json`:**

**PaymentDto**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `paymentCode` | string | — | کد پرداخت |
| `url` | string | — | لینک دستور پرداخت |
| `amount` | integer(int32) | — | مبلغ دستور پرداخت |
| `payerWage` | integer(int32) | — | مبلغ کارمزد پرداخت کننده |
| `businessWage` | integer(int32) | — | مبلغ کارمزد پذیرنده |
| `gatewayAmount` | integer(int32) | — | مبلغ نهایی پرداخت |
| `paypingVat` | integer(int32) | — | مبلغ مالیات بر ارزش افزوده (Value-Added Tax) |

**پاسخ `400` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**پاسخ `406` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**پاسخ `500` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `default` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

---

### `GET /v3/pay/start/{paymentCode}`

**خلاصه:** انتقال به درگاه-نسخه 3

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `paymentCode` | path | string(uuid) | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `400` | Bad Request |
| `500` | Server Error |
| `502` | ارتباط با درگاه برقرار نشد |
| `default` | Error |

**پاسخ `400` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `500` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `502` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `default` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

---

### `GET /v3/pay/paid/{refId}/{paymentCode}`

**خلاصه:** ارسال اطلاعات پرداخت به پذیرنده

این متد بصورت خودکار پس از بازگشت از درگاه فراخوانی می شود و نیاز به فراخوانی از سمت پذیرنده نمی باشد.

پس از اتمام فرایند در این متد، اطلاعات پرداخت به آدرس ReturnUrl که در مرحله اول (ساخت پرداخت) مشخص شده است در بدنه درخواست بصورت POST ("Content-Type": "application/x-www-form-urlencoded") ارسال می شود.

**نکته مهم:** اگر وضعیت تراکنش موفق بود، پذیرنده میبایست " شناسه ارجاع پذیرنده" یا  clientRefId را در پایگاه داده خود جستجو نماید و صحت اطلاعات paymentCode و amount ارسالی از پی‌پینگ را با پایگاه داده خود مقایسه نماید. در صورت بروز هرگونه مغایرت، از ادامه تراکنش صرف نظر نمایید.

نمونه خروجی تولید شده در وضعیت موفق یک پرداخت:
- **status** (integer):  مقدار '1' به معنی موفق، مقدار '0' به معنی عدم پرداخت  
- **errorCode** (integer):  کد خطای بازگشتی - در صورت موفق بودن پرداخت، خالی است
- **data (Json):**
    - clientRefId (string): شناسه ارجاع پذیرنده  
    - paymentCode (string): کد پرداخت  
    - paymentRefId (int64): کد رهگیری پرداخت - این فیلد تنها در پرداخت موفق ارسال خواهد شد
    - amount (integer): مبلغ دستور پرداخت  
    - gatewayAmount (integer): مبلغ نهایی پرداخت  
    - cardNumber (string): شماره کارت پرداخت‌کننده - این فیلد تنها در پرداخت موفق ارسال خواهد شد
    - cardHashPan (string): هش کارت پرداخت‌کننده - این فیلد تنها در پرداخت موفق ارسال خواهد شد

ممکن است با توجه به نوع درگاه پرداختی، شماره کارت و شماره کارت هش شده، ارسال نشوند. در این صورت این مقادیر حتما در مرحله تایید نهایی پرداخت ارسال خواهند شد.

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `refId` | path | integer(int64) | ✅ |  |
| `paymentCode` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `400` | Bad Request |
| `406` | Not Acceptable |
| `500` | Server Error |
| `default` | Error |

**پاسخ `400` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**پاسخ `406` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**پاسخ `default` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

---

### `POST /v3/pay/paid/{refId}/{paymentCode}`

**خلاصه:** ارسال اطلاعات پرداخت به پذیرنده

این متد بصورت خودکار پس از بازگشت از درگاه فراخوانی می شود و نیاز به فراخوانی از سمت پذیرنده نمی باشد.

پس از اتمام فرایند در این متد، اطلاعات پرداخت به آدرس ReturnUrl که در مرحله اول (ساخت پرداخت) مشخص شده است در بدنه درخواست بصورت POST ("Content-Type": "application/x-www-form-urlencoded") ارسال می شود.

**نکته مهم:** اگر وضعیت تراکنش موفق بود، پذیرنده میبایست " شناسه ارجاع پذیرنده" یا  clientRefId را در پایگاه داده خود جستجو نماید و صحت اطلاعات paymentCode و amount ارسالی از پی‌پینگ را با پایگاه داده خود مقایسه نماید. در صورت بروز هرگونه مغایرت، از ادامه تراکنش صرف نظر نمایید.

نمونه خروجی تولید شده در وضعیت موفق یک پرداخت:
- **status** (integer):  مقدار '1' به معنی موفق، مقدار '0' به معنی عدم پرداخت  
- **errorCode** (integer):  کد خطای بازگشتی - در صورت موفق بودن پرداخت، خالی است
- **data (Json):**
    - clientRefId (string): شناسه ارجاع پذیرنده  
    - paymentCode (string): کد پرداخت  
    - paymentRefId (int64): کد رهگیری پرداخت - این فیلد تنها در پرداخت موفق ارسال خواهد شد
    - amount (integer): مبلغ دستور پرداخت  
    - gatewayAmount (integer): مبلغ نهایی پرداخت  
    - cardNumber (string): شماره کارت پرداخت‌کننده - این فیلد تنها در پرداخت موفق ارسال خواهد شد
    - cardHashPan (string): هش کارت پرداخت‌کننده - این فیلد تنها در پرداخت موفق ارسال خواهد شد

ممکن است با توجه به نوع درگاه پرداختی، شماره کارت و شماره کارت هش شده، ارسال نشوند. در این صورت این مقادیر حتما در مرحله تایید نهایی پرداخت ارسال خواهند شد.

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `refId` | path | integer(int64) | ✅ |  |
| `paymentCode` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `400` | Bad Request |
| `406` | Not Acceptable |
| `500` | Server Error |
| `default` | Error |

**پاسخ `400` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**پاسخ `406` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**پاسخ `default` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

---

### `POST /v3/pay/verify`

**خلاصه:** تایید نهایی پرداخت-نسخه 3

از این متد برای تایید پرداخت پس از بازگشت موفق از درگاه بانکی استفاده می‌شود.
در صورتی که این متد تا 10 دقیقه پس از پرداخت فراخوانی نشود، پرداخت نامعتبر خواهد بود
و وجه پرداختی به حساب پرداخت‌کننده باز خواهد گشت.
            
**نکته مهم:** در صورت موفقیت‌آمیز بودن وریفای تراکنش، پذیرنده می‌بایست صحت اطلاعات
amount و clientRefId ارسالی از پی‌پینگ را با پایگاه داده خود مقایسه نماید.
در صورت بروز هرگونه مغایرت، از تایید تراکنش صرف نظر نمایید.
            
در صورت دریافت کدهای وضعیت 202 یا 502، عملیات تأیید تراکنش هنوز در حال پردازش است.
در این حالت از تلاش برای پرداخت مجدد خودداری کنید و متد Verify را مجدداً فراخوانی نمایید
تا نتیجه نهایی تراکنش دریافت شود.

در صورتی که پاسخ 409 دریافت کردید و مقدار 'metaData.code' برابر با 110 باشد، به معنای این است که تراکنش قبلاً وریفای شده است و نیازی به تأیید مجدد ندارد.

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json`

**VerifyModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `paymentRefId` | integer(int64) | ✅ | کد رهگیری پرداخت (در مرحله ارسال اطلاعات پرداخت برای پذیرنده ارسال شده است) |
| `paymentCode` | string | ✅ | کد پرداخت |
| `amount` | integer(int32) | ✅ | مبلغ دستور پرداخت |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | Success |
| `202` | عملیات تایید تراکنش در حال پردازش است. لطفا مجددا تلاش نمایید. |
| `400` | Bad Request |
| `409` | در صورتی که پاسخ 409 دریافت کردید و مقدار 'metaData.code' برابر با 110 باشد، به معنای این است که تراکنش قبلاً وریفای شده است و نیازی به تأیید مجدد ندارد. |
| `500` | Server Error |
| `502` | عملیات تایید تراکنش در حال پردازش است. لطفا مجددا تلاش نمایید. |
| `default` | Error |

**پاسخ `200` — `application/json`:**

**VerifyDto**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int64) | — | مبلغ دستور پرداخت |
| `cardNumber` | string | — | شماره کارت پرداخت کننده |
| `cardHashPan` | string | — | شماره کارت هش شده پرداخت کننده |
| `clientRefId` | string | — | شناسه ارجاع پذیرنده |
| `paymentRefId` | integer(int64) | — | کد رهگیری پرداخت |
| `code` | string | — | کد پرداخت |
| `payedDate` | string | — | تاریخ و ساعت پرداخت (UTC) |
| `payerWage` | integer(int64) | — | مبلغ کارمزد پرداخت کننده |
| `businessWage` | integer(int64) | — | مبلغ کارمزد پذیرنده |
| `gatewayAmount` | integer(int64) | — | مبلغ نهایی پرداخت |
| `paypingVat` | integer(int32) | — | مبلغ مالیات بر ارزش افزوده (Value-Added Tax) |
| `sharedPaymentItems` | array&lt;[SharedPaymentItemDetail](#schema-sharedpaymentitemdetail)&gt; | — | اطلاعات تسهیم کننده‌ها - این فیلد تنها در پرداخت تسهیمی ارسال می شود |

**پاسخ `400` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `409` — `application/json`:**

**PaymentConflictProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentConflictProblemDetails_metaData`](#schema-paymentconflictproblemdetails_metadata) | — |  |

**مثال:**

```json
{
  "type": "https://datatracker.ietf.org/doc/html/rfc7231#section-6.5.8",
  "title": "ConflictException",
  "status": 409,
  "instance": "/v3/pay/verify",
  "paypingTraceId": "0HN50NTIAS004:00000002",
  "metaData": {
    "code": 110,
    "message": {
      "Amount": 1000,
      "PayerWage": 10,
      "BusinessWage": 0,
      "GatewayAmount": 1010,
      "CardNumber": "603799******1234",
      "CardHashPan": "be7eec45143dea50c39f1559640c1273",
      "ClientRefId": "123",
      "PaymentRefId": 1111004003,
      "Code": "01K2YQYESEQGNMCVFPQ9VC96YF",
      "PayedDate": "2024-08-03 10:30:00Z"
    }
  }
}
```

**پاسخ `500` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `default` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

---

### `POST /v3/pay/reverse`

**خلاصه:** بازگشت وجه پرداخت-نسخه 3

این سرویس جهت بازگرداندن مبلغ پرداخت‌شده ی خریدار طراحی شده است. پذیرنده می‌تواند تا 30 دقیقه پس از پرداخت موفق و تایید تراکنش (وریفای)، درخواست بازگشت وجه (مستقیماً به کارت خریدار) را ثبت نماید.

در صورتیکه بخواهید یک تراکنش امکان ریورس داشته باشد، باید در مرحله ساخت پرداخت پارامتر:

**isReversible: true**

را به همراه سایر پارامترهای ساخت یک پرداخت (ساده/تسهیمی) ارسال نمایید.

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json`

**ReverseModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `paymentRefId` | integer(int64) | ✅ | کد رهگیری پرداخت (در مرحله ارسال اطلاعات پرداخت برای پذیرنده ارسال شده است) |
| `paymentCode` | string | ✅ | کد پرداخت |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | Success |
| `400` | Bad Request |
| `406` | Not Acceptable |
| `500` | Server Error |
| `default` | Error |

**پاسخ `200` — `application/json`:**

**ReverseDto**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int64) | — | مبلغ اصلی دستور پرداخت |
| `clientRefId` | string | — | شناسه ارجاع پذیرنده |
| `paymentRefId` | integer(int64) | — | کد رهگیری پرداخت |
| `code` | string | — | کد پرداخت |
| `payerWage` | integer(int32) | — | مبلغ کارمزد پرداخت کننده |
| `gatewayAmount` | integer(int32) | — | مبلغ نهایی بازگشت داده‌شده |
| `reversedDate` | string | — | تاریخ و ساعت بازگشت وجه (UTC) |
| `sharedPaymentItems` | array&lt;[SharedPaymentItemDetail](#schema-sharedpaymentitemdetail)&gt; | — | اطلاعات تسهیم کننده‌ها - این فیلد تنها در پرداخت تسهیمی ارسال می شود |

**پاسخ `400` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `406` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `500` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `default` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

---

### `POST /v3/pay/share`

**خلاصه:** انجام تسهیم بین ذی‌نفعان

`operationId`: `ShareWithModelWithApiVersionWithCancellationTokenPost`

این متد امکان تسهیم مبلغ یه پرداخت به ذی‌نفعان مشخص‌شده را فراهم می‌کند.
            
شرایط لازم برای استفاده از این متد:
- پرداخت در زمان ایجاد به‌صورت بلاک (Blocked) ثبت شده باشد.
- تراکنش با وضعیت موفق (Successful) تکمیل شده باشد.
- پرداخت قبلاً تسهیم نشده باشد.
            
نکته:
تسهیم صرفاً زمانی انجام می‌شود که حداقل یک ذی‌نفع معتبر در درخواست مشخص شده باشد.
امکان تسهیم صد به صفر با یک کاربر دیگر نیز وجود دارد.

#### بدنه درخواست (Request Body)

مدل تسهیم پرداخت که شامل:
- `PaymentRefId`: کد رهگیری پرداخت
- `PaymentCode`: کد پرداخت
- `Amount`: مبلغ دستور پرداخت
- `PaymentShares`: لیست اطلاعات تسهیم برای هر ذی‌نفع

**Content-Type:** `application/json`

**ShareRequest** — درخواست انجام تسهیم بین ذی‌نفعان
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `paymentRefId` | integer(int64) | — | کد رهگیری پرداخت (در مرحله ارسال اطلاعات پرداخت برای پذیرنده ارسال شده است) |
| `paymentCode` | string | — | کد پرداخت |
| `amount` | integer(int32) | — | مبلغ دستور پرداخت |
| `paymentShares` | array&lt;[SharedPaymentItemModel](#schema-sharedpaymentitemmodel)&gt; | — | اطلاعات تسهیم (به ازای هر صاحب سهم، یک رکورد در نظر بگیرید) |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | پرداخت با موفقیت بین ذی‌نفعان تسهیم شد. |
| `400` | Bad Request |
| `406` | Not Acceptable |
| `500` | Server Error |
| `default` | Error |

**پاسخ `200` — `application/json`:**

**ShareResult** — نتیجه تسهیم پرداخت
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | — | مبلغ دستور پرداخت |
| `paymentCode` | string | — | کد پرداخت |
| `paymentRefId` | integer(int64) | — | کد رهگیری پرداخت |
| `clientRefId` | string | — | شناسه ارجاع پذیرنده |
| `paymentShares` | array&lt;[SharedPaymentItemDetail](#schema-sharedpaymentitemdetail)&gt; | — | جزئیات سهم‌های تخصیص‌یافته به هر ذینفع |

**پاسخ `400` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `406` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `500` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `default` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

---

### `POST /v3/pay/unblock`

**خلاصه:** آزادسازی پرداخت مسدود شده

`operationId`: `UnblockWithModelWithApiVersionWithCancellationTokenPost`

این متد امکان آزادسازی یک پرداخت مسدود شده را فراهم می‌کند.
            
شرایط لازم برای استفاده از این متد:
- پرداخت در زمان ایجاد به‌صورت بلاک (Blocked) ثبت شده باشد.
- پرداخت توسط ادمین سیستم بلاک نشده باشد
            
نکته:
در صورتی که پرداخت تسهیمی باشد، باید کد پرداخت اصلی ارسال شود و نه کد پرداخت های ذینفعان.

#### بدنه درخواست (Request Body)

مدل آزادسازی پرداخت که شامل:
- `PaymentCode`: کد پرداخت
- `Amount`: مبلغ دستور پرداخت

**Content-Type:** `application/json`

**UnblockRequest** — درخواست آزادسازی پرداخت مسدود شده
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `paymentCode` | string | — | کد پرداخت |
| `amount` | integer(int32) | — | مبلغ دستور پرداخت |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `204` | عملیات آزادسازی پرداخت با موفقیت انجام شده است. |
| `400` | Bad Request |
| `406` | Not Acceptable |
| `500` | Server Error |
| `default` | Error |

**پاسخ `400` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `406` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `500` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

**پاسخ `default` — `application/json`:**

**PaymentProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

---

## Withdraw

متدهای مرتبط با درخواست تسویه حساب.

### `POST /v1/withdraw/{amount}`

**خلاصه:** درخواست تسویه حساب

`operationId`: `CreateWithdraw`

به کمک این متد می توانید یک درخواست تسویه با مبلغ دلخواه ایجاد نمایید. خروجی این متد شامل یک یا چند کد تسویه می باشد.  

  **توجه:** علت ایجاد چند کد تسویه در برخی از درخواست ها، وجود موجودی روی پایانه های فروشگاهی مختلف می باشد.

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `amount` | path | integer(int32) | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | تسویه حساب جدید با موفقیت ساخته شد |

**پاسخ `200` — `application/json`:**

**WithdrawResult**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کد تسویه |

---

### `GET /v1/withdraw/{code}`

**خلاصه:** نمایش جزئیات درخواست تسویه

`operationId`: `GetWithdrawDetails`

از این متد برای نمایش جزئیات یک درخواست تسویه استفاده می شود.

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | جزئیات تسویه با موفقیت نمایش داده شد |

**پاسخ `200` — `application/json`:**

**WithdrawDetailsViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | — | مبلغ |
| `reqDate` | string(date-time) | — | تاریخ درخواست تسویه |
| `isRepaid` | boolean | — | تاییدیه تسویه 0= در انتظار تایید 1= تسویه شده |
| `repayDate` | string(date-time) | — | تاریخ تسویه |
| `shaba` | string | — | شماره شبای تسویه |
| `payareferencCode` | string | — | شناسه پی گیری بانک |
| `description` | string | — | توضیحات تسویه |
| `refundedCode` | string | — | کد پرداختی که برای آن برگشت وجه ثبت شده است |
| `withdrawType` | string | — | نوع تسویه تسویه معمولی =0 برگشت پول=1 تسویه بازاریابی=2 تسویه شبا به غیر=3 |
| `isPardakhtYar` | boolean | — | نوع فرایند تسویه 0= عادی 1= پرداختیار |
| `isLegal` | boolean | — | پرداخت حقیقی/حقوقی 0= حقیقی 1= حقوقی |
| `repayPayaId` | string | — | شماره پی گیری بانک |
| `trackingNumber` | string | — | شماره پی گیری بانک |
| `ipgType` | string | — | درگاه پرداخت. (دقیق نیست و کاربرد ندارد) |

---

## Report

متدهای مرتبط با گزارش تراکنش‌های درخواست و یا پرداخت پول.

### `POST /v1/report/TransactionReport`

**خلاصه:** گزارش تراکنش ها

`operationId`: `TransactionsReport`

از این متد برای نمایش جزئیات تراکنش های کاربر استفاده می شود.

#### بدنه درخواست (Request Body)

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | لیسات تراکنش ها با موفقیت ساخته شد |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `array`

آیتم‌ها:
**TransactionReportViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | — | مبلغ |
| `payDate` | string(date-time) | — | تاریخ پرداخت |
| `isPaid` | boolean | — | اینکه پرداخت تایید شده است |
| `description` | string | — | توضیحات |
| `name` | string | — | نام پرداخت کننده/دریافت کننده |
| `payerIdentity` | string | — | شماره موبایل یا ایمیل پرداخت کننده |
| `isRequest` | boolean | — | درخواست/پرداخت |
| `code` | string | — | کد پرداخت |
| `clientId` | string | — | شناسه زیر سیستم مشتری در پی‌پینگ |
| `clientRefId` | string | — | کد ارسالی مشتری به پی‌پینگ |
| `invoiceNo` | string | — | شناسه پرداخت |
| `createdDate` | string(date-time) | — | تاریخ ساخت پرداخت/درخواست |

---

### `POST /v1/report/TransactionReportCount`

**خلاصه:** تعداد تراکنش ها

`operationId`: `TransactionsReportCount`

از این متد برای نمایش تعداد تراکنش های برگشت داده شده از متد TransactionReport استفاده می شود.

#### بدنه درخواست (Request Body)

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | تعداد تراکنش ها با موفقیت ساخته شد |

**پاسخ `200` — `application/json`:**

**ResultViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `result` | integer(int64) | — | تعداد |

---

### `POST /v1/report/WithdrawTransactions`

**خلاصه:** دریافت لیست تسویه حساب

`operationId`: `WithdrawTransactionsReport`

به کمک این متد می توانید لیست درخواست های تسویه شده و در انتظار تسویه را نمایش دهید.

#### بدنه درخواست (Request Body)

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | جزئیات تسویه با موفقیت نمایش داده شد |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `array`

آیتم‌ها:
**TransactionWithdrawDetailsViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `reqDate` | string(date-time) | — |  |
| `code` | string | — |  |
| `isRepaid` | boolean | — |  |
| `repayDate` | string(date-time) | — |  |
| `amount` | integer(int32) | — |  |

---

### `POST /v1/report/WithdrawTransactionsCount`

**خلاصه:** تعداد لیست تسویه حساب

`operationId`: `WithdrawTransactionsCount`

به کمک این متد می توانید تعداد لیست درخواست های تسویه شده و در انتظار تسویه را که از متد WithdrawTransactions دریافت کرده اید را نمایش دهید.

#### بدنه درخواست (Request Body)

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | جزئیات تسویه با موفقیت نمایش داده شد |

**پاسخ `200` — `application/json`:**

**ResultViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `result` | integer(int64) | — | تعداد |

---

### `GET /v1/report/{code}`

**خلاصه:** نمایش جزئیات تراکنش و مغایرت گیری

`operationId`: `GetPaymentDetails`

از این متد برای نمایش جزئیات یک تراکنش با استفاده از کد پرداخت، استفاده می شود.  

  **توجه:**  
  با استفاده از فیلد PaymentStatus شما می توانید از وضعیت تراکنش در هر مرحله ای مطلع شوید و اقدامات لازم را انجام دهید.  
  با استفاده از فیلد IsPaid شما متوجه می شوید که یک تراکنش وریفای (تایید نهایی) شده است یا خیر.  

  `مغایرت گیری`  
  در صورتی که refid را در بازگشت خریدار از درگاه بانکی به هر دلیلی دریافت نکردید از طریق فراخوانی کد پرداخت با این متد آخرین refid پرداخت را دریافت کرده و براساس آن پرداخت هایی که در وضعیت PaymentStatus=5 قرار دارند یعنی 'کاربر از درگاه با موفقیت برگشته و منتظر وریفای پذیرنده هست'، را وریفای نمایید.

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | جزئیات تراکنش با موفقیت ساخته شد |

**پاسخ `200` — `application/json`:**

**PaymentDetailsVM**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | — | مبلغ |
| `reqDate` | string(date-time) | — | تاریخ درخواست |
| `payDate` | string(date-time) | — | تاریخ پرداخت |
| `isRequest` | boolean | — | درخواست/پرداخت |
| `isPaid` | boolean | — | تاییدیه پرداخت |
| `description` | string | — | توضیحات |
| `payerIdentity` | string | — | شناسه پرداخت کننده |
| `platform` | string | — | نوع سیستم عامل پرداخت کننده |
| `browser` | string | — | مرورگر پرداخت کننده |
| `rrn` | string | — | شماره کارت پرداخت کننده |
| `clientId` | string | — | شناسه زیر سیستم مشتری در پی‌پینگ |
| `clientRefId` | string | — | کد ارسالی مشتری به پی‌پینگ |
| `invoiceNo` | string | — | شناسه پرداخت |
| `wage` | integer(int32) | — | کارمزد |
| `paypingVat` | integer(int32) | — | مبلغ مالیات بر ارزش افزوده (Value-Added Tax) |
| `shaparakWage` | integer(int32) | — | کارمزد شاپرک |
| `ipgName` | string | — | درگاه پرداخت کننده |
| `paymentType` | integer `0`,`1`,`2`,`3` | — | نوع درگاه پرداخت 0 = Default 1 = Online 2 = Cash 3 = Pos |
| `isBlocked` | boolean | — |  |
| `name` | string | — |  |
| `isRefund` | boolean | — |  |
| `refundStatus` | integer `0`,`1`,`2`,`3` | — | 0 = NoStatus 1 = Awaiting 2 = Complete 3 = Incomplete |
| `cAff` | string | — | کد بازاریابی |
| `cAffWage` | integer(int32) | — | کارمزد بازاریاب |
| `payPingAffWage` | integer(int32) | — | کارمز سرویس بازاریابی پی‌پینگ |
| `refId` | string | — | شماره پرداخت پی‌پینگ |
| `paymentStatus` | integer `0`,`1`,`2`,`3`,`4`,`5` | — | وضعیت پرداخت 0 = کدپرداخت ساخته شده 1 = تراکنش با موفقیت روی درگاه انجام شده و وری فای بانک هم با موفقیت انجام شده (تایید نهایی) 2 = کاربر وارد درگاه شده 3 = کاربر به هر دلیلی تراکنش را لغو کرده 4 = تراکنش با موفقیت روی درگاه انجام شده ولی وری فای سمت بانک ناموفق بوده 5 = کاربر از درگاه با موفقیت برگشته و منتظر وری فای پذیرنده هست |

---

## Product

سرویس‌های عمومی بخش آیتم‌های مالی، لینک ثابت و سرویس‌های مربوط به پروسه پرداخت آنها

### `PUT /v1/product`

**خلاصه:** بروزرسانی آیتم مالی

`operationId`: `EditProduct`

#### بدنه درخواست (Request Body)

مشخصات آیتم مالی

**Content-Type:** `application/json`

**ProductEditViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `title` | string | ✅ |  |
| `description` | string | — |  |
| `amount` | integer(int32) | ✅ |  |
| `defineAmountByUser` | boolean | — |  |
| `haveTax` | boolean | — |  |
| `quantity` | integer(int32) | — |  |
| `unlimited` | boolean | — |  |
| `imageLink` | string | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | آیتم‌ مالی با موفقیت بروزرسانی شد |

---

### `POST /v1/product`

**خلاصه:** ساخت یک آیتم‌ مالی جدید

`operationId`: `CreateProduct`

#### بدنه درخواست (Request Body)

مشخصات آیتم مالی

**Content-Type:** `application/json`

**ProductCreateViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `title` | string | ✅ |  |
| `description` | string | — |  |
| `amount` | integer(int32) | — |  |
| `defineAmountByUser` | boolean | — |  |
| `quantity` | integer(int32) | — |  |
| `haveTax` | boolean | — |  |
| `unlimited` | boolean | — |  |
| `imageLink` | string | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | آیتم مالی با موفقیت ساخته شد |

**پاسخ `200` — `application/json`:**

**CodeViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |

---

### `GET /v1/product/{code}`

**خلاصه:** نمایش یک آیتم مالی

`operationId`: `GetProductDetails`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | آیتم مالی با موفقیت نمایش داده شد |

**پاسخ `200` — `application/json`:**

**ProductFullDeatilViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `title` | string | — |  |
| `description` | string | — |  |
| `quantity` | integer(int32) | — |  |
| `unlimited` | boolean | — |  |
| `userId` | integer(int32) | — |  |
| `amount` | integer(int32) | — |  |
| `defineAmountByUser` | boolean | — |  |
| `isActive` | boolean | — |  |
| `isArchived` | boolean | — |  |
| `haveTax` | boolean | — |  |
| `tax` | integer(int32) | — |  |
| `imageLink` | string | — |  |
| `imageId` | string | — |  |
| `category` | [`CategoryMinorDetailViewModel`](#schema-categoryminordetailviewmodel) | — |  |

---

### `DELETE /v1/product/{code}`

**خلاصه:** حذف یک آیتم مالی

`operationId`: `DeleteProduct`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | آیتم مالی با موفقیت حذف شد |

---

### `GET /v1/product/List`

**خلاصه:** دریافت لیست آیتم‌های مالی

`operationId`: `GetProductList`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `offset` | query | integer(int32) | — |  |
| `limit` | query | integer(int32) | — |  |
| `witharchived` | query | boolean | — |  |
| `search` | query | string | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | لیست آیتم‌های مالی با موفقیت نمایش داده شد |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `array`

آیتم‌ها:
**ProductListItemViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | — |  |
| `title` | string | — |  |
| `code` | string | — |  |
| `quantity` | integer(int32) | — |  |
| `unlimited` | boolean | — |  |
| `defineAmountByUser` | boolean | — |  |
| `amountDisplay` | string | — |  |
| `quantityViewModel` | string | — |  |
| `isActive` | boolean | — |  |
| `haveTax` | boolean | — |  |
| `havePerma` | boolean | — |  |

---

## PermaLink

سرویس‌های  لینک ثابت آیتم مالی

### `PUT /v1/permalink`

**خلاصه:** ویرایش لینک ثابت یک آیتم مالی

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json-patch+json`

**PermanentEditViewModel**
نوع: `object` | nullable

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `productCode` | string | — |  |
| `redirectPage` | string | — |  |
| `getAddress` | boolean | — |  |
| `mailerLiteListId` | string | — |  |
| `smsText` | string | — |  |
| `customDescriptionText` | string | — |  |
| `isActive` | boolean | — |  |
| `emailOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `phoneOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `nameOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `customDesOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `permanentType` | [`PermanentType`](#schema-permanenttype) | — |  |
| `isMultiple` | boolean | — |  |

**Content-Type:** `application/json`

**PermanentEditViewModel**
نوع: `object` | nullable

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `productCode` | string | — |  |
| `redirectPage` | string | — |  |
| `getAddress` | boolean | — |  |
| `mailerLiteListId` | string | — |  |
| `smsText` | string | — |  |
| `customDescriptionText` | string | — |  |
| `isActive` | boolean | — |  |
| `emailOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `phoneOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `nameOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `customDesOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `permanentType` | [`PermanentType`](#schema-permanenttype) | — |  |
| `isMultiple` | boolean | — |  |

**Content-Type:** `text/json`

**PermanentEditViewModel**
نوع: `object` | nullable

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `productCode` | string | — |  |
| `redirectPage` | string | — |  |
| `getAddress` | boolean | — |  |
| `mailerLiteListId` | string | — |  |
| `smsText` | string | — |  |
| `customDescriptionText` | string | — |  |
| `isActive` | boolean | — |  |
| `emailOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `phoneOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `nameOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `customDesOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `permanentType` | [`PermanentType`](#schema-permanenttype) | — |  |
| `isMultiple` | boolean | — |  |

**Content-Type:** `application/*+json`

**PermanentEditViewModel**
نوع: `object` | nullable

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `productCode` | string | — |  |
| `redirectPage` | string | — |  |
| `getAddress` | boolean | — |  |
| `mailerLiteListId` | string | — |  |
| `smsText` | string | — |  |
| `customDescriptionText` | string | — |  |
| `isActive` | boolean | — |  |
| `emailOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `phoneOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `nameOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `customDesOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `permanentType` | [`PermanentType`](#schema-permanenttype) | — |  |
| `isMultiple` | boolean | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | Success |

---

### `POST /v1/permalink`

**خلاصه:** ساخت لینک ثابت برای یک آیتم مالی

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json-patch+json`

**PermanentCreateViewModel**
نوع: `object` | nullable

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `productCode` | string | — |  |
| `redirectPage` | string | — |  |
| `getAddress` | boolean | — |  |
| `mailerLiteListId` | string | — |  |
| `smsText` | string | — |  |
| `customDescriptionText` | string | — |  |
| `emailOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `phoneOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `nameOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `customDesOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `clientId` | string | — |  |
| `clientRefId` | string | — |  |
| `permanentType` | [`PermanentType`](#schema-permanenttype) | — |  |
| `isMultiple` | boolean | — |  |

**Content-Type:** `application/json`

**PermanentCreateViewModel**
نوع: `object` | nullable

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `productCode` | string | — |  |
| `redirectPage` | string | — |  |
| `getAddress` | boolean | — |  |
| `mailerLiteListId` | string | — |  |
| `smsText` | string | — |  |
| `customDescriptionText` | string | — |  |
| `emailOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `phoneOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `nameOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `customDesOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `clientId` | string | — |  |
| `clientRefId` | string | — |  |
| `permanentType` | [`PermanentType`](#schema-permanenttype) | — |  |
| `isMultiple` | boolean | — |  |

**Content-Type:** `text/json`

**PermanentCreateViewModel**
نوع: `object` | nullable

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `productCode` | string | — |  |
| `redirectPage` | string | — |  |
| `getAddress` | boolean | — |  |
| `mailerLiteListId` | string | — |  |
| `smsText` | string | — |  |
| `customDescriptionText` | string | — |  |
| `emailOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `phoneOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `nameOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `customDesOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `clientId` | string | — |  |
| `clientRefId` | string | — |  |
| `permanentType` | [`PermanentType`](#schema-permanenttype) | — |  |
| `isMultiple` | boolean | — |  |

**Content-Type:** `application/*+json`

**PermanentCreateViewModel**
نوع: `object` | nullable

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `productCode` | string | — |  |
| `redirectPage` | string | — |  |
| `getAddress` | boolean | — |  |
| `mailerLiteListId` | string | — |  |
| `smsText` | string | — |  |
| `customDescriptionText` | string | — |  |
| `emailOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `phoneOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `nameOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `customDesOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `clientId` | string | — |  |
| `clientRefId` | string | — |  |
| `permanentType` | [`PermanentType`](#schema-permanenttype) | — |  |
| `isMultiple` | boolean | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | لینک آیتم مالی با موفقیت ساخته شد |

**پاسخ `200` — `application/json`:**

**CodeVM**
نوع: `object` | nullable

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |

---

### `GET /v1/permalink/{code}`

**خلاصه:** دریافت اطلاعات لینک ثابت 

`operationId`: `GetPermaList`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | Success |

**پاسخ `200` — `application/json`:**

**PermanentDetailViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `redirectPage` | string | — |  |
| `getAddress` | boolean | — |  |
| `userId` | integer(int32) | — |  |
| `mailerLiteListId` | string | — |  |
| `smsText` | string | — |  |
| `customDescriptionText` | string | — |  |
| `isActive` | boolean | — |  |
| `isArchived` | boolean | — |  |
| `emailOption` | integer `0`,`1`,`2` | — |  |
| `phoneOption` | integer `0`,`1`,`2` | — |  |
| `nameOption` | integer `0`,`1`,`2` | — |  |
| `customDesOption` | integer `0`,`1`,`2` | — |  |
| `clientId` | string | — |  |
| `clientRefId` | string | — |  |
| `qrLink` | string | — |  |
| `permanentType` | integer `0`,`1` | — |  |
| `buyerCounts` | integer(int32) | — |  |
| `buyerSum` | integer(int32) | — |  |

---

### `DELETE /v1/permalink/{code}`

**خلاصه:** حذف لینک ثابت برای یک آیتم مالی

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | Success |

---

### `GET /v1/permalink/{productCode}/BuyersList`

**خلاصه:** دریافت لیست اطلاعات خریداران یک آیتم مالی دارای لینک ثابت

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `offset` | query | integer(int32) | — |  |
| `limit` | query | integer(int32) | — |  |
| `productCode` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | Success |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `array` | nullable

آیتم‌ها:
**ProductBuyerViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | — |  |
| `fullName` | string | — |  |
| `customDescription` | string | — |  |
| `code` | string | — |  |
| `phone` | string | — |  |
| `email` | string | — |  |
| `payDate` | string(date-time) | — |  |
| `amountDisplay` | string | — |  |
| `payDateDisplay` | string | — |  |
| `phoneViewModel` | string | — |  |

---

### `GET /v1/permalink/{productCode}/BuyersListCount`

**خلاصه:** دریافت تعداد لیست اطلاعات خریداران یک آیتم مالی دارای لینک ثابت

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `productCode` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | Success |

**پاسخ `200` — `application/json`:**

**CountVM**
نوع: `object` | nullable

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `count` | integer(int32) | — |  |

---

### `GET /v1/permalink/{payCode}/Buyer`

**خلاصه:** دریافت اطلاعات خریدار مربوط به یک کد پرداخت

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `payCode` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | Success |

**پاسخ `200` — `application/json`:**

**BuyerDetailsViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `amount` | integer(int32) | — |  |
| `addressLine` | string | — |  |
| `postalCode` | string | — |  |
| `firstName` | string | — |  |
| `lastName` | string | — |  |
| `email` | string | — |  |
| `city` | string | — |  |
| `phone` | string | — |  |
| `customDescription` | string | — |  |
| `permanLinkCode` | string | — |  |
| `productInfo` | [`ProductInfo`](#schema-productinfo) | — |  |
| `couponCode` | string | — |  |
| `productCode` | string | — |  |
| `campaignCode` | string | — |  |
| `isPaid` | boolean | — |  |
| `payerId` | integer(int32) | — |  |
| `invoiceNo` | string | — |  |
| `payDate` | string(date-time) | — |  |
| `fullName` | string | — |  |

---

## coupon

سرویس‌های عمومی بخش کدهای تخفیف

### `PUT /v1/coupon`

**خلاصه:** بروزرسانی کد تخفیف

`operationId`: `EditCoupon`

#### بدنه درخواست (Request Body)

مشخصات کد تخفیف

**Content-Type:** `application/json`

**CouponEditViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `name` | string | — |  |
| `userCouponCode` | string | — |  |
| `type` | integer `0`,`1` | — |  |
| `amount` | integer(int32) | — |  |
| `code` | string | — |  |
| `redeemDate` | string(date-time) | — |  |
| `redeemTime` | string | — |  |
| `maxRedemption` | integer(int32) | — |  |
| `isActive` | boolean | — |  |
| `activeProductCode` | array&lt;string&gt; | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | کد تخفیف با موفقیت بروزرسانی شد |

---

### `POST /v1/coupon`

**خلاصه:** ساخت یک کد تخفیف جدید

`operationId`: `CreateCoupon`

#### بدنه درخواست (Request Body)

مشخصات کد تخفیف

**Content-Type:** `application/json`

**CouponCreateViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `name` | string | — |  |
| `userCouponCode` | string | — |  |
| `type` | integer `0`,`1` | — |  |
| `amount` | integer(int32) | — |  |
| `redeemDate` | string(date-time) | — |  |
| `redeemTime` | string | — |  |
| `maxRedemption` | integer(int32) | — |  |
| `isActive` | boolean | — |  |
| `activeProductCode` | array&lt;string&gt; | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | کد تخفیف با موفقیت ساخته شد |

**پاسخ `200` — `application/json`:**

**CodeViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |

---

### `GET /v1/coupon/{code}`

**خلاصه:** نمایش یک کد تخفیف

`operationId`: `GetCouponDetails`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | کد تخفیف با موفقیت نمایش داده شد |

**پاسخ `200` — `application/json`:**

**CouponDetailViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `name` | string | — |  |
| `type` | integer `0`,`1` | — |  |
| `amount` | integer(int32) | — |  |
| `code` | string | — |  |
| `redeemDate` | string(date-time) | — |  |
| `redeemTime` | string | — |  |
| `maxRedemption` | integer(int32) | — |  |
| `isActive` | boolean | — |  |
| `activeProductCode` | string | — |  |
| `isArchived` | boolean | — |  |
| `userCouponCode` | string | — |  |
| `buyerCounts` | integer(int32) | — |  |
| `buyerSum` | integer(int32) | — |  |

---

### `DELETE /v1/coupon/{code}`

**خلاصه:** حذف یک کد تخفیف

`operationId`: `DeleteCoupon`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | کد تخفیف با موفقیت حذف شد |

---

### `GET /v1/coupon/List`

**خلاصه:** نمایش لیست کدهای تخفیف

`operationId`: `GetCouponList`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `offset` | query | integer(int32) | — |  |
| `limit` | query | integer(int32) | — |  |
| `witharchived` | query | boolean | — |  |
| `search` | query | string | — |  |
| `productcode` | query | string | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | لیست کدهای تخفیف با موفقیت نمایش داده شد |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `array`

آیتم‌ها:
**CouponListItemViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `name` | string | — |  |
| `type` | integer `0`,`1` | — |  |
| `amount` | integer(int32) | — |  |
| `code` | string | — |  |
| `isActive` | boolean | — |  |
| `activeProductCode` | string | — |  |
| `activeProductName` | array&lt;string&gt; | — |  |
| `userCouponCode` | string | — |  |
| `amountDisplay` | string | — |  |

---

### `GET /v1/coupon/ListCount`

**خلاصه:** دریافت تعداد کدهای تخفیف

`operationId`: `GetCouponListCount`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `witharchived` | query | boolean | — |  |
| `search` | query | string | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | تعداد کدهای تخفیف با موفقیت نمایش داده شد |

**پاسخ `200` — `application/json`:**

**CountViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `count` | integer(int32) | — |  |

---

### `GET /v1/coupon/{couponCode}/BuyersListCount`

**خلاصه:** دریافت تعداد خرید‌های یک کد تخفیف

`operationId`: `GetCouponBuyersCount`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `couponCode` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | تعداد خریدهای یک کد تخفیف با موفقیت نمایش داده شد |

**پاسخ `200` — `application/json`:**

**CountViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `count` | integer(int32) | — |  |

---

### `GET /v1/coupon/{couponCode}/BuyersList`

**خلاصه:** دریافت لیست پرداخت‌های انجام شده یک کد تخفیف

`operationId`: `GetCouponBuyersList`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `offset` | query | integer(int32) | — |  |
| `limit` | query | integer(int32) | — |  |
| `couponCode` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | لیست خریدهای این کد تخفیف با موفقیت نمایش داده شد |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `array`

آیتم‌ها:
**BuyerDetailsViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `amount` | integer(int32) | — |  |
| `addressLine` | string | — |  |
| `postalCode` | string | — |  |
| `firstName` | string | — |  |
| `lastName` | string | — |  |
| `email` | string | — |  |
| `city` | string | — |  |
| `phone` | string | — |  |
| `customDescription` | string | — |  |
| `permanLinkCode` | string | — |  |
| `productInfo` | [`ProductInfo`](#schema-productinfo) | — |  |
| `couponCode` | string | — |  |
| `productCode` | string | — |  |
| `campaignCode` | string | — |  |
| `isPaid` | boolean | — |  |
| `payerId` | integer(int32) | — |  |
| `invoiceNo` | string | — |  |
| `payDate` | string(date-time) | — |  |
| `fullName` | string | — |  |

---

## Customer

در این بخش میتوانید مشتریان خود را به صورت یک دفترچه سنتی مدیریت و در زمان صدور فاکتور از این لیست استفاده کنید.

### `POST /v1/customer`

**خلاصه:** مشتری جدید

`operationId`: `CreateCustomer`

#### بدنه درخواست (Request Body)

مشخصات مشتری

**Content-Type:** `application/json`

**CustomerCreateViewModel** — ثبت مشتری جدید
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `userPhotoFileId` | string | — | پس از آپلود و دریافت کلید فایل را اینجا قرار دهید |
| `email` | string | — | پست الکترونیک |
| `phone` | string | — | تلفن |
| `firstName` | string | ✅ | نام |
| `lastName` | string | ✅ | نام خانوادگی |
| `businessName` | string | — | نام کسب و کار |
| `additionalInfo` | string | — | اطلاعات اضافی |
| `zipCode` | string | — | کدپستی |
| `state` | string | — | استان |
| `city` | string | — | شهر |
| `location` | string | — | آدرس |
| `memo` | string | — | متن یادآوری |
| `isBusiness` | boolean | — | حقوقی = true, حقیقی = false |
| `nationalId` | string | — | کدملی |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نمایش مشخصات مشتری |

**پاسخ `200` — `application/json`:**

**CustomerDetailViewModel** — جزییات مشخصات مشتری
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ | کلید یکتای مشتری |
| `userPhotoFileAddress` | string | — | پس از آپلود و دریافت کلید فایل را اینجا قرار دهید |
| `userPhotoFileId` | string | — | لیست کلیدهای یکتا فایل تصویر پرسنلی |
| `email` | string | — | پست الکترونیک |
| `phone` | string | — | تلفن |
| `firstName` | string | ✅ | نام |
| `lastName` | string | ✅ | نام خانوادگی |
| `businessName` | string | — | نام کسب و کار |
| `additionalInfo` | string | — | اطلاعات اضافی |
| `memo` | string | — | یادآوری |
| `zipCode` | string | — | کدپستی |
| `state` | string | — | استان |
| `city` | string | — | شهر |
| `location` | string | — | آدرس |
| `isBusiness` | boolean | — | حقوقی = true, حقیقی = false |
| `nationalId` | string | — | کد ملی/شماره اقتصادی |

---

### `GET /v1/customer/{code}`

**خلاصه:** مشخصات مشتری

`operationId`: `GetCustomerDetails`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نمایش مشخصات مشتری |

**پاسخ `200` — `application/json`:**

**CustomerDetailViewModel** — جزییات مشخصات مشتری
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ | کلید یکتای مشتری |
| `userPhotoFileAddress` | string | — | پس از آپلود و دریافت کلید فایل را اینجا قرار دهید |
| `userPhotoFileId` | string | — | لیست کلیدهای یکتا فایل تصویر پرسنلی |
| `email` | string | — | پست الکترونیک |
| `phone` | string | — | تلفن |
| `firstName` | string | ✅ | نام |
| `lastName` | string | ✅ | نام خانوادگی |
| `businessName` | string | — | نام کسب و کار |
| `additionalInfo` | string | — | اطلاعات اضافی |
| `memo` | string | — | یادآوری |
| `zipCode` | string | — | کدپستی |
| `state` | string | — | استان |
| `city` | string | — | شهر |
| `location` | string | — | آدرس |
| `isBusiness` | boolean | — | حقوقی = true, حقیقی = false |
| `nationalId` | string | — | کد ملی/شماره اقتصادی |

---

### `PUT /v1/customer/{code}`

**خلاصه:** بروزرسانی مشخصات مشتری

`operationId`: `EditCustomer`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### بدنه درخواست (Request Body)

مشخصات بروز شده مشتری

**Content-Type:** `application/json`

**CustomerEditViewModel** — بروزرسانی مشتری
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ | کلید یکتای مشتری |
| `userPhotoFileId` | string | — | پس از آپلود و دریافت کلید فایل را اینجا قرار دهید |
| `email` | string | — | پست الکترونیک |
| `phone` | string | — | تلفن |
| `firstName` | string | ✅ | نام |
| `lastName` | string | ✅ | نام خانوادگی |
| `businessName` | string | — | نام کسب و کار |
| `additionalInfo` | string | — | اطلاعات اضافی |
| `zipCode` | string | — | کدپستی |
| `state` | string | — | استان |
| `city` | string | — | شهر |
| `location` | string | — | آدرس |
| `memo` | string | — | متن یادآوری |
| `isBusiness` | boolean | — | حقوقی = true, حقیقی = false |
| `nationalId` | string | — | کدملی |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نمایش مشخصات مشتری |

**پاسخ `200` — `application/json`:**

**CustomerDetailViewModel** — جزییات مشخصات مشتری
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ | کلید یکتای مشتری |
| `userPhotoFileAddress` | string | — | پس از آپلود و دریافت کلید فایل را اینجا قرار دهید |
| `userPhotoFileId` | string | — | لیست کلیدهای یکتا فایل تصویر پرسنلی |
| `email` | string | — | پست الکترونیک |
| `phone` | string | — | تلفن |
| `firstName` | string | ✅ | نام |
| `lastName` | string | ✅ | نام خانوادگی |
| `businessName` | string | — | نام کسب و کار |
| `additionalInfo` | string | — | اطلاعات اضافی |
| `memo` | string | — | یادآوری |
| `zipCode` | string | — | کدپستی |
| `state` | string | — | استان |
| `city` | string | — | شهر |
| `location` | string | — | آدرس |
| `isBusiness` | boolean | — | حقوقی = true, حقیقی = false |
| `nationalId` | string | — | کد ملی/شماره اقتصادی |

---

### `DELETE /v1/customer/{code}`

**خلاصه:** حذف مشتری

`operationId`: `DeleteCustomer`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نمایش کلید یکتای مشتری |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `string`

---

### `GET /v1/customer/List`

**خلاصه:** لیست مشتریان

`operationId`: `GetCustomerList`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `offset` | query | integer(int32) | — |  |
| `limit` | query | integer(int32) | — |  |
| `search` | query | string | — |  |
| `customerType` | query | integer `0`,`1`,`2` | — |  |
| `withPhoto` | query | boolean | — |  |
| `code` | query | string | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نمایش لیست مشتریان |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `array`

آیتم‌ها:
**CustomerListItemViewModel** — مشخصات مشتری
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کلید یکتا مشتری |
| `email` | string | — | پست الکترونیک |
| `phone` | string | — | تلفن |
| `firstName` | string | — | نام |
| `lastName` | string | — | نام خانوادگی |
| `businessName` | string | — | نام کسب و کار |
| `nationalId` | string | — | کد ملی/شماره اقتصادی |
| `isBusiness` | string | — | حقوقی = true, حقیقی = false |

---

### `GET /v1/customer/ListCount`

**خلاصه:** تعداد مشتریان

`operationId`: `GetCustomerListCount`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `search` | query | string | — |  |
| `customerType` | query | integer `0`,`1`,`2` | — |  |
| `code` | query | string | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نمایش تعداد مشتریان |

**پاسخ `200` — `application/json`:**

**ListCountViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `count` | integer(int32) | — |  |

---

## Invoice

در این بخش میتوانید فاکتور بسازید و با انتخاب یک یا چند مشتری و حتی پست الکترونیک برای آنها فاکتور را ارسال کنید تا نسبت به پرداخت آن اقدام کنند.

### `POST /v2/invoice`

**خلاصه:** فاکتور جدید

`operationId`: `CreateInvoice`

#### بدنه درخواست (Request Body)

مشخصات فاکتور

**Content-Type:** `application/json`

**InvoiceCreateViewModel** — ثبت فاکتور جدید
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `cc` | array&lt;[InvoiceCcToCreateOrUpdateViewModel](#schema-invoicecctocreateorupdateviewmodel)&gt; | — | ایمیل‌ها |
| `customers` | array&lt;[InvoiceBillToCreateOrUpdateViewModel](#schema-invoicebilltocreateorupdateviewmodel)&gt; | — | مشتریان فاکتور |
| `createStatus` | integer `0`,`1`,`2` | — | نوع ثبت فاکتور: 0 = ذخیره در پیش‌نویس 1 =     ارسال 2 = پرداخت دستی انجام شده |
| `paidManualDescription` | string | — | شرح پرداخت نقدی یا دستی |
| `number` | string | — | شماره فاکتور |
| `title` | string | — | عنوان فاکتور |
| `sendDate` | string(date-time) | — | تاریخ ارسال فاکتور |
| `dueDate` | string(date-time) | — | تاریخ سررسید پرداخت |
| `hasOtherDiscount` | boolean | — | آیا فاکتور شامل تخفیف کلی است |
| `itemHasDiscount` | boolean | — | فعال بودن امکان درج تخفیف برای هر آیتم |
| `itemDiscounts` | number(double) | — | مجموع تخفیف آیتم‌های مالی فاکتور |
| `discountCouponCode` | string | — | کد تخفیف ویژه آیتم‌ها |
| `couponCode` | string | — | کد تخفیف کلی فاکتور |
| `discountAmount` | number(double) | — | مبلغ یا درصد تخفیف کلی فاکتور |
| `discountType` | integer `0`,`1` | — | نوع تخفیف به کل فاکتور: 1 = مبلغ 0 = درصد |
| `shipping` | number(double) | — | هزینه حمل و نقل |
| `notes` | string | — | پیامی جهت نمایش به پرداخت‌کننده |
| `termsAndConditions` | string | — | شرایط و قوانین جهت نمایش به پرداخت‌کننده |
| `memo` | string | — | یادداشت داخلی برای صادرکننده فاکتور |
| `products` | array&lt;[InvoiceProductCreateViewModel](#schema-invoiceproductcreateviewmodel)&gt; | — | آیتم‌های مالی فاکتور |
| `sendAttachmentsAfterSuccessPayment` | boolean | — | نمایش فایل‌های ضمیمه فقط پس از پرداخت موفق = true، نمایش     قبل و بعد از پرداخت = false |
| `showNotesAfterSuccessPayment` | boolean | — | نمایش پیام برای پرداخت‌کننده فقط پس از پرداخت موفق =     true، نمایش قبل و بعد از پرداخت = false |
| `showTermsAfterSuccessPayment` | boolean | — | نمایش قوانین و مقررات برای پرداخت‌کننده فقط پس از پرداخت     موفق = true، نمایش قبل و بعد از پرداخت = false |
| `attachments` | array&lt;string&gt; | — | کلید(های) یکتا فایل‌های ضمیمه دریافتی از سرویس آپلود |
| `tagIds` | array&lt;integer&gt; | — | برچسب‌های مرتبط با فاکتور |
| `returnUrl` | string | — | آدرس بازگشت از صفحه پرداخت |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نمایش فاکتور |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `array`

آیتم‌ها:
**InvoiceScheduleCreateResponseItem** — اطلاعات فاکتور زمانبندی شده ایجاد شده برای هر مشتری
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کد یکتای فاکتور ایجاد شده |
| `customerCode` | string | — | کد یکتای مشتری |

---

### `POST /v2/invoice/Send/{code}`

**خلاصه:** ارسال فاکتور

`operationId`: `SendInvoice`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نمایش وضعیت ارسال فاکتور |

**پاسخ `200` — `application/json`:**

**InvoiceSendInvoiceResponseViewModel** — بازگشت مشخصات درخواست ارسال فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `success` | boolean | — | موفقیت آمیز بودن درخواست = true, ناموفق بودن = false |
| `message` | string | — | پیام خطا یا موفقیت |
| `modelCode` | string | — | کلید یکتا |

---

### `GET /v2/invoice/{code}`

**خلاصه:** دریافت فاکتور

`operationId`: `GetInvoiceDetails`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نمایش فاکتور |

**پاسخ `200` — `application/json`:**

**InvoiceDetailViewModel** — جزییات فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کلید یکتای فاکتور |
| `parentCode` | string | — | کلید والد بودن فاکتور |
| `paymentCode` | string | — | کد یکتای پرداخت |
| `ccToes` | array&lt;[InvoiceCcToDetailViewModel](#schema-invoicecctodetailviewmodel)&gt; | — | لیست ایمیل |
| `billToes` | array&lt;[InvoiceBillToDetailViewModel](#schema-invoicebilltodetailviewmodel)&gt; | — | لیست مشتری |
| `status` | integer `0`,`1`,`2`,`3`,`4`,`5` | — | وضعیت فاکتور: 0 = پیش نویس 1 = در انتظار پرداخت 2 = پرداخت شد 3 = معوق 4 = لغو شده 5 = همه |
| `paidManualDescription` | string | — | شرح پرداخت دستی |
| `saveToTemplate` | boolean | — | ذخیره به عنوان قالب فاکتور |
| `invoiceNumber` | integer(int64) | — | شماره فاکتور |
| `invoiceTitle` | string | — | عنوان فاکتور |
| `invoiceDateTime` | string(date-time) | — | تاریخ ثبت |
| `dueDate` | string(date-time) | — | تاریخ سررسید |
| `payedDateTime` | string(date-time) | — | تاریخ پرداخت |
| `canceledDateTime` | string(date-time) | — | تاریخ لغو |
| `subTotal` | number(double) | — | جمع مبلغ پرداختی آیتم های مالی |
| `itemsDiscountAmount` | number(double) | — | جمع مبلغ تخفیف آیتم های مالی |
| `totalDiscountAmount` | number(double) | — | مبلغ تخفیف به کل فاکتور |
| `totalDiscountPercent` | integer(int32) | — | درصد تخفیف به کل فاکتور |
| `totalDiscountType` | integer `0`,`1` | — | نوع تخفیف به کل فاکتور: 1 = مبلغ 0 = درصد |
| `sumDiscountAmount` | number(double) | — | جمع کل تخفیف اعمال شده روی فاکتور |
| `totalTaxtionAmount` | number(double) | — | مبلغ مالیات |
| `shipping` | number(double) | — | هزینه حمل و نقل |
| `total` | number(double) | — | مبلغ کل |
| `notes` | string | — | پیامی جهت نمایش به پرداخت کننده |
| `termsAndConditions` | string | — | متن شرایط و قوانین جهت نمایش به پرداخت کننده |
| `memo` | string | — | متن دلخواه جهت یادآوری فقط برای صادر کننده فاکتور |
| `invoiceSchulder` | [`InvoiceSchulderDetailViewModel`](#schema-invoiceschulderdetailviewmodel) | — |  |
| `invoiceItems` | array&lt;[InvoiceItemDetailViewModel](#schema-invoiceitemdetailviewmodel)&gt; | — | آیتم های مالی فاکتور |
| `isSendAttachmentsAfterPayment` | boolean | — | نمایش فایل های ضمیمه به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `isSendNotesAndTermsAfterPayment` | boolean | — | نمایش پیام به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `isSendTermsAfterPayment` | boolean | — | نمایش متن قوانین و مقررات به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `attachFileIds` | array&lt;string&gt; | — | لیست کلید یکتای فایل های ضمیمه |
| `attachFileAddresses` | array&lt;string&gt; | — | لیست آدرس فایل های ضمیمه |
| `qrCodeFileName` | string | — | آدرس تصویر بارکد فاکتور |

---

### `PUT /v2/invoice/{code}`

**خلاصه:** بروزرسانی فاکتور

`operationId`: `EditInvoice`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### بدنه درخواست (Request Body)

فاکتور بروز شده

**Content-Type:** `application/json`

**InvoiceEditViewModel** — بروزرسانی فاکتور ساده
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ | کلید یکتای فاکتور |
| `ccToes` | array&lt;[InvoiceCcToCreateOrUpdateViewModel](#schema-invoicecctocreateorupdateviewmodel)&gt; | — | ایمیل ها |
| `billToes` | array&lt;[InvoiceBillToCreateOrUpdateViewModel](#schema-invoicebilltocreateorupdateviewmodel)&gt; | — | مشتریان |
| `createStatus` | integer `0`,`1`,`2` | — | نوع ثبت: 0 = ذخیره در پیش نویس 1 = ارسال 2 = دستی پرداخت شد |
| `paidManualDescription` | string | — | شرح پرداخت دستی |
| `saveToTemplate` | boolean | — | ذخیره به عنوان قالب |
| `templateCode` | string | — | کد یکتای قالب فاکتور |
| `invoiceNumber` | integer(int64) | — | شماره فاکتور |
| `invoiceTitle` | string | — | عنوان فاکتور |
| `invoiceDateTime` | string(date-time) | — | تاریخ ثبت |
| `dueDate` | string(date-time) | — | تاریخ سررسید- تاریخی که باید پرداخت صورت پذیرد |
| `totalDiscountValue` | number(double) | — | تخفیف به کل فاکتور |
| `totalDiscountType` | integer `0`,`1` | — | نوع تخفیف به مبلغ یا درصد 1 = مبلغ 0 = درصد |
| `shipping` | number(double) | — | هزینه حمل و نقل |
| `notes` | string | — | متن جهت ارسال به دریافت کننده |
| `termsAndConditions` | string | — | متن شرایط و قوانین جهت ارسال به دریافت کننده |
| `memo` | string | — | ایجاد یک متن دلخواه جهت یادآوری فقط برای کاربر ثبت کننده |
| `invoiceItems` | array&lt;[InvoiceItemCreateViewModel](#schema-invoiceitemcreateviewmodel)&gt; | — | آیتم های مالی فاکتور |
| `isSendAttachmentsAfterPayment` | boolean | — | نمایش فایل های ضمیمه به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `isSendNotesAndTermsAfterPayment` | boolean | — | نمایش پیام به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `isSendTermsAfterPayment` | boolean | — | نمایش متن قوانین و مقررات به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `attachmentsIds` | array&lt;string&gt; | — | کلید(های) یکتا دریافت شده از سرویس آپلود به صورت آرایه از رشته ها قرار دهید |
| `isDevicePayment` | boolean | — | ثبت فاکتور بدون مشتری = true, با مشتری = false |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نمایش فاکتور |

**پاسخ `200` — `application/json`:**

**InvoiceDetailViewModel** — جزییات فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کلید یکتای فاکتور |
| `parentCode` | string | — | کلید والد بودن فاکتور |
| `paymentCode` | string | — | کد یکتای پرداخت |
| `ccToes` | array&lt;[InvoiceCcToDetailViewModel](#schema-invoicecctodetailviewmodel)&gt; | — | لیست ایمیل |
| `billToes` | array&lt;[InvoiceBillToDetailViewModel](#schema-invoicebilltodetailviewmodel)&gt; | — | لیست مشتری |
| `status` | integer `0`,`1`,`2`,`3`,`4`,`5` | — | وضعیت فاکتور: 0 = پیش نویس 1 = در انتظار پرداخت 2 = پرداخت شد 3 = معوق 4 = لغو شده 5 = همه |
| `paidManualDescription` | string | — | شرح پرداخت دستی |
| `saveToTemplate` | boolean | — | ذخیره به عنوان قالب فاکتور |
| `invoiceNumber` | integer(int64) | — | شماره فاکتور |
| `invoiceTitle` | string | — | عنوان فاکتور |
| `invoiceDateTime` | string(date-time) | — | تاریخ ثبت |
| `dueDate` | string(date-time) | — | تاریخ سررسید |
| `payedDateTime` | string(date-time) | — | تاریخ پرداخت |
| `canceledDateTime` | string(date-time) | — | تاریخ لغو |
| `subTotal` | number(double) | — | جمع مبلغ پرداختی آیتم های مالی |
| `itemsDiscountAmount` | number(double) | — | جمع مبلغ تخفیف آیتم های مالی |
| `totalDiscountAmount` | number(double) | — | مبلغ تخفیف به کل فاکتور |
| `totalDiscountPercent` | integer(int32) | — | درصد تخفیف به کل فاکتور |
| `totalDiscountType` | integer `0`,`1` | — | نوع تخفیف به کل فاکتور: 1 = مبلغ 0 = درصد |
| `sumDiscountAmount` | number(double) | — | جمع کل تخفیف اعمال شده روی فاکتور |
| `totalTaxtionAmount` | number(double) | — | مبلغ مالیات |
| `shipping` | number(double) | — | هزینه حمل و نقل |
| `total` | number(double) | — | مبلغ کل |
| `notes` | string | — | پیامی جهت نمایش به پرداخت کننده |
| `termsAndConditions` | string | — | متن شرایط و قوانین جهت نمایش به پرداخت کننده |
| `memo` | string | — | متن دلخواه جهت یادآوری فقط برای صادر کننده فاکتور |
| `invoiceSchulder` | [`InvoiceSchulderDetailViewModel`](#schema-invoiceschulderdetailviewmodel) | — |  |
| `invoiceItems` | array&lt;[InvoiceItemDetailViewModel](#schema-invoiceitemdetailviewmodel)&gt; | — | آیتم های مالی فاکتور |
| `isSendAttachmentsAfterPayment` | boolean | — | نمایش فایل های ضمیمه به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `isSendNotesAndTermsAfterPayment` | boolean | — | نمایش پیام به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `isSendTermsAfterPayment` | boolean | — | نمایش متن قوانین و مقررات به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `attachFileIds` | array&lt;string&gt; | — | لیست کلید یکتای فایل های ضمیمه |
| `attachFileAddresses` | array&lt;string&gt; | — | لیست آدرس فایل های ضمیمه |
| `qrCodeFileName` | string | — | آدرس تصویر بارکد فاکتور |

---

### `POST /v2/invoice/Archive/{code}`

**خلاصه:** آرشیو فاکتور

`operationId`: `ArchiveWithCodePost`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `400` | Bad Request |
| `500` | Server Error |
| `401` | Unauthorized |
| `403` | Forbidden |
| `200` | Success |

**پاسخ `400` — `application/json`:**

**پاسخ 400**
نوع: `object`

_سایر فیلدها (additionalProperties):_ `{"type": "string"}`

---

### `POST /v2/invoice/DeArchive/{code}`

**خلاصه:** خروج فاکتور از آرشیو

`operationId`: `DeArchiveWithCodePost`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `400` | Bad Request |
| `500` | Server Error |
| `401` | Unauthorized |
| `403` | Forbidden |
| `200` | Success |

**پاسخ `400` — `application/json`:**

**پاسخ 400**
نوع: `object`

_سایر فیلدها (additionalProperties):_ `{"type": "string"}`

---

### `GET /v2/invoice/Pdf/{code}`

**خلاصه:** فاکتور غیر رسمی pdf درخواست

`operationId`: `GetInvoicePdf`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نمایش مشخصات فایل فاکتور غیر رسمی |

**پاسخ `200` — `application/json`:**

**InvoicePdfResponseViewModel** — مشخصات بازگشت درخواست فایل پی دی اف فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `success` | boolean | — | موفقیت آمیز بودن درخواست = true, ناموفق بودن = false |
| `message` | string | — | پیام خطا یا موفقیت |
| `fileAddress` | string | — | آدرس فایل |

---

### `GET /v2/invoice/List`

**خلاصه:** لیست فاکتور ها

`operationId`: `GetInvoiceList`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `offset` | query | integer(int32) | — |  |
| `limit` | query | integer(int32) | — |  |
| `status` | query | integer `0`,`1`,`2`,`3`,`4`,`5`,`6`,`7` | — |  |
| `isArchived` | query | boolean | — |  |
| `IsSearchDueDate` | query | boolean | — |  |
| `IsSearchCreateDate` | query | boolean | — |  |
| `searchDateFrom` | query | string(date-time) | — |  |
| `searchDateTo` | query | string(date-time) | — |  |
| `search` | query | string | — |  |
| `CustomerCode` | query | string | — |  |
| `invoiceCode` | query | string | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نمایش لیست فاکتور ها |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `array`

آیتم‌ها:
**InvoiceListItemViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کلید یکتای فاکتور |
| `number` | integer(int64) | — | شماره فاکتور |
| `sendDate` | string(date-time) | — | تاریخ ثبت فاکتور |
| `dueDate` | string(date-time) | — | تاریخ سررسید فاکتور |
| `payedDateTime` | string(date-time) | — | تاریخ پرداخت |
| `canceledDateTime` | string(date-time) | — | تاریخ لغو |
| `title` | string | — | عنوان |
| `status` | integer `0`,`1`,`2`,`3`,`4`,`5` | — | وضعیت فاکتور:   0 = پیش‌نویس   1 = در انتظار پرداخت   2 = پرداخت شد   3 = معوق   4 = لغو شده   5 = همه |
| `invoicePaidBy` | string | — | پرداخت‌کننده فاکتور |
| `total` | number(double) | — | مبلغ نهایی یا قابل پرداخت |
| `isCorrection` | boolean | — | آیا این فاکتور اصلاحیه است |
| `isSchedule` | boolean | — | آیا این فاکتور زمان‌بندی شده است |
| `cc` | array&lt;[InvoiceCcToListItemViewModel](#schema-invoicecctolistitemviewmodel)&gt; | — | دریافت‌کننده‌های ایمیلی |
| `customerCode` | string | — | کد مشتری |
| `customer` | [`InvoiceBillToListItemViewModel`](#schema-invoicebilltolistitemviewmodel) | — |  |

---

### `GET /v2/invoice/ListCount`

**خلاصه:** تعداد فاکتور ها

`operationId`: `GetInvoiceListCount`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `offset` | query | integer(int32) | — |  |
| `limit` | query | integer(int32) | — |  |
| `status` | query | integer `0`,`1`,`2`,`3`,`4`,`5`,`6`,`7` | — |  |
| `isArchived` | query | boolean | — |  |
| `IsSearchDueDate` | query | boolean | — |  |
| `IsSearchCreateDate` | query | boolean | — |  |
| `searchDateFrom` | query | string(date-time) | — |  |
| `searchDateTo` | query | string(date-time) | — |  |
| `search` | query | string | — |  |
| `CustomerCode` | query | string | — |  |
| `invoiceCode` | query | string | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نمایش تعداد فاکتورها |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `count` | integer | ✅ | تعداد فاکتورها |

---

### `POST /v2/invoice/Copy`

**خلاصه:** کپی یک فاکتور برای مشتری جدید

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json-patch+json`

**InvoiceCopyRequestViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ |  |
| `customerCodes` | array&lt;string&gt; | ✅ |  |
| `sendDate` | string(date-time) | — |  |

**Content-Type:** `application/json`

**InvoiceCopyRequestViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ |  |
| `customerCodes` | array&lt;string&gt; | ✅ |  |
| `sendDate` | string(date-time) | — |  |

**Content-Type:** `text/json`

**InvoiceCopyRequestViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ |  |
| `customerCodes` | array&lt;string&gt; | ✅ |  |
| `sendDate` | string(date-time) | — |  |

**Content-Type:** `application/*+json`

**InvoiceCopyRequestViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ |  |
| `customerCodes` | array&lt;string&gt; | ✅ |  |
| `sendDate` | string(date-time) | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | Success |
| `400` | Bad Request |
| `401` | Unauthorized |
| `403` | Forbidden |
| `500` | Server Error |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `array`

آیتم‌ها:
**InvoiceCreateResponseViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `customerCode` | string | — |  |

**پاسخ `400` — `application/json`:**

**پاسخ 400**
نوع: `object`

_سایر فیلدها (additionalProperties):_ `{"type": "string"}`

---

### `POST /v2/invoice/Cancel`

**خلاصه:** درخواست لغو فاکتور

`operationId`: `CancelInvoice`

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json`

**InvoiceCancelRequest**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | Success |
| `400` | Bad Request |

**پاسخ `400` — `application/json`:**

**پاسخ 400**
نوع: `string` | مثال: `"string"`

---

### `POST /v2/invoice/Reminder/{code}`

**خلاصه:** ارسال یادآوری فاکتور

`operationId`: `RemindeInvoice`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نمایش وضعیت ارسال یادآوری فاکتور |

**پاسخ `200` — `application/json`:**

**InvoiceSendReminderResponseViewModel** — بازگشت مشخصات ارسال یادآوری فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `success` | boolean | — | موفقیت آمیز بودن درخواست = true, ناموفق بودن = false |
| `message` | string | — | پیام خطا یا موفقیت |
| `modelCode` | string | — | کلید یکتا فاکتور |

---

### `GET /v2/invoice/PaymentCode`

**خلاصه:** دریافت کد پرداخت برای یک فاکتور

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `Code` | query | string | ✅ |  |
| `CouponCode` | query | string | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | Success |
| `400` | Bad Request |
| `401` | Unauthorized |
| `403` | Forbidden |
| `404` | Not Found |
| `500` | Server Error |

**پاسخ `200` — `application/json`:**

**InvoicePaymentCodeResponse**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `payCode` | string | — |  |

**پاسخ `400` — `application/json`:**

**پاسخ 400**
نوع: `object`

_سایر فیلدها (additionalProperties):_ `{"type": "string"}`

---

### `POST /v2/invoice/ConfirmPayment`

**خلاصه:** تایید پرداخت یک فاکتور

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json-patch+json`

**InvoiceConfirmPaymentRequestViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `invoiceCode` | string | ✅ |  |
| `refId` | string | ✅ |  |

**Content-Type:** `application/json`

**InvoiceConfirmPaymentRequestViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `invoiceCode` | string | ✅ |  |
| `refId` | string | ✅ |  |

**Content-Type:** `text/json`

**InvoiceConfirmPaymentRequestViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `invoiceCode` | string | ✅ |  |
| `refId` | string | ✅ |  |

**Content-Type:** `application/*+json`

**InvoiceConfirmPaymentRequestViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `invoiceCode` | string | ✅ |  |
| `refId` | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | Success |
| `400` | Bad Request |
| `401` | Unauthorized |
| `403` | Forbidden |
| `500` | Server Error |

**پاسخ `200` — `application/json`:**

**InvoiceConfirmPaymentResponseViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `success` | boolean | — |  |
| `message` | string | — |  |
| `modelCode` | string | — |  |
| `refId` | string | — |  |
| `previewKey` | string | — |  |
| `invoice` | [`InvoiceInPublicShow`](#schema-invoiceinpublicshow) | — |  |

**پاسخ `400` — `application/json`:**

**پاسخ 400**
نوع: `object`

_سایر فیلدها (additionalProperties):_ `{"type": "string"}`

---

### `POST /v2/invoice/FastInvoice`

**خلاصه:** ساخت همزمان فاکتور و مشتری و دریافت کد پرداخت

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json-patch+json`

**FastInvoiceCreateRequestViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `number` | string | — |  |
| `title` | string | — |  |
| `dueDate` | string(date-time) | — |  |
| `customer` | [`InvoiceCustomerCreateViewModel`](#schema-invoicecustomercreateviewmodel) | — |  |
| `couponCode` | string | — |  |
| `discountAmount` | number(double) | — |  |
| `discountType` | [`DiscountType`](#schema-discounttype) | — |  |
| `shipping` | number(double) | — |  |
| `notes` | string | — |  |
| `termsAndConditions` | string | — |  |
| `memo` | string | — |  |
| `products` | array&lt;[InvoiceProductCreateViewModel](#schema-invoiceproductcreateviewmodel)&gt; | — |  |
| `sendAttachmentsAfterSuccessPayment` | boolean | — |  |
| `showNotesAfterSuccessPayment` | boolean | — |  |
| `showTermsAfterSuccessPayment` | boolean | — |  |
| `attachments` | array&lt;string&gt; | — |  |

**Content-Type:** `application/json`

**FastInvoiceCreateRequestViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `number` | string | — |  |
| `title` | string | — |  |
| `dueDate` | string(date-time) | — |  |
| `customer` | [`InvoiceCustomerCreateViewModel`](#schema-invoicecustomercreateviewmodel) | — |  |
| `couponCode` | string | — |  |
| `discountAmount` | number(double) | — |  |
| `discountType` | [`DiscountType`](#schema-discounttype) | — |  |
| `shipping` | number(double) | — |  |
| `notes` | string | — |  |
| `termsAndConditions` | string | — |  |
| `memo` | string | — |  |
| `products` | array&lt;[InvoiceProductCreateViewModel](#schema-invoiceproductcreateviewmodel)&gt; | — |  |
| `sendAttachmentsAfterSuccessPayment` | boolean | — |  |
| `showNotesAfterSuccessPayment` | boolean | — |  |
| `showTermsAfterSuccessPayment` | boolean | — |  |
| `attachments` | array&lt;string&gt; | — |  |

**Content-Type:** `text/json`

**FastInvoiceCreateRequestViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `number` | string | — |  |
| `title` | string | — |  |
| `dueDate` | string(date-time) | — |  |
| `customer` | [`InvoiceCustomerCreateViewModel`](#schema-invoicecustomercreateviewmodel) | — |  |
| `couponCode` | string | — |  |
| `discountAmount` | number(double) | — |  |
| `discountType` | [`DiscountType`](#schema-discounttype) | — |  |
| `shipping` | number(double) | — |  |
| `notes` | string | — |  |
| `termsAndConditions` | string | — |  |
| `memo` | string | — |  |
| `products` | array&lt;[InvoiceProductCreateViewModel](#schema-invoiceproductcreateviewmodel)&gt; | — |  |
| `sendAttachmentsAfterSuccessPayment` | boolean | — |  |
| `showNotesAfterSuccessPayment` | boolean | — |  |
| `showTermsAfterSuccessPayment` | boolean | — |  |
| `attachments` | array&lt;string&gt; | — |  |

**Content-Type:** `application/*+json`

**FastInvoiceCreateRequestViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `number` | string | — |  |
| `title` | string | — |  |
| `dueDate` | string(date-time) | — |  |
| `customer` | [`InvoiceCustomerCreateViewModel`](#schema-invoicecustomercreateviewmodel) | — |  |
| `couponCode` | string | — |  |
| `discountAmount` | number(double) | — |  |
| `discountType` | [`DiscountType`](#schema-discounttype) | — |  |
| `shipping` | number(double) | — |  |
| `notes` | string | — |  |
| `termsAndConditions` | string | — |  |
| `memo` | string | — |  |
| `products` | array&lt;[InvoiceProductCreateViewModel](#schema-invoiceproductcreateviewmodel)&gt; | — |  |
| `sendAttachmentsAfterSuccessPayment` | boolean | — |  |
| `showNotesAfterSuccessPayment` | boolean | — |  |
| `showTermsAfterSuccessPayment` | boolean | — |  |
| `attachments` | array&lt;string&gt; | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | Success |
| `400` | Bad Request |
| `401` | Unauthorized |
| `403` | Forbidden |
| `500` | Server Error |

**پاسخ `200` — `application/json`:**

**FastInvoiceCreateResponseViewModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `payCode` | string | — |  |
| `customerCode` | string | — |  |

**پاسخ `400` — `application/json`:**

**پاسخ 400**
نوع: `object`

_سایر فیلدها (additionalProperties):_ `{"type": "string"}`

---

## Schedule

در این بخش میتوانید فاکتور های زمانبندی شده بسازید و با انتخاب یک یا چند مشتری و حتی پست الکترونیک برای آنها فاکتور را ارسال کنید تا نسبت به پرداخت آن اقدام کنند.

### `POST /v2/invoice/Schedule`

**خلاصه:** فاکتور زمانبندی شده جدید

`operationId`: `CreateInvoiceSchedule`

#### بدنه درخواست (Request Body)

مشخصات فاکتور زمانبندی شده

**Content-Type:** `application/json`

**InvoiceCreateScheduleViewModel** — ثبت فاکتور زمانبندی شده
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `customers` | array&lt;[InvoiceCustomerCreateViewModel](#schema-invoicecustomercreateviewmodel)&gt; | — | مشتریان |
| `createStatus` | integer `1`,`2` | — | نوع ثبت: 1 = ارسال 2 = دستی پرداخت شد |
| `discountAmount` | number(double) | — | تخفیف به کل فاکتور |
| `paidManualDescription` | string | — | شرح پرداخت دستی |
| `products` | array&lt;[InvoiceProductCreateViewModel](#schema-invoiceproductcreateviewmodel)&gt; | — | محصولات فاکتور |
| `title` | string | — | عنوان فاکتور |
| `number` | string | — | شماره فاکتور |
| `memo` | string | — | پیام داخل گزارشات - متن دلخواه جهت یادآوری فقط برای صادر کننده فاکتور |
| `notes` | string | — | پیام یادآوری جهت نمایش به پرداخت کننده |
| `showNotesAfterSuccessPayment` | boolean | — | نمایش پیام به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `showTermsAfterSuccessPayment` | boolean | — | نمایش متن قوانین و مقررات به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `sendAttachmentsAfterSuccessPayment` | boolean | — | نمایش فایل های ضمیمه به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `schedule` | [`InvoiceScheduleCreateViewModel`](#schema-invoiceschedulecreateviewmodel) | — |  |
| `sendDate` | string(date-time) | — | تاریخ ارسال فاکتور |
| `shipping` | number(double) | — | هزینه حمل و نقل |
| `returnUrl` | string | — | آدرس بازگشت فاکتور |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | لیست فاکتورهای زمانبندی شده ایجاد شده |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `array`

آیتم‌ها:
**InvoiceScheduleCreateResponseItem** — اطلاعات فاکتور زمانبندی شده ایجاد شده برای هر مشتری
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کد یکتای فاکتور ایجاد شده |
| `customerCode` | string | — | کد یکتای مشتری |

---

### `POST /v2/invoice/CancelSchedule`

**خلاصه:** لغو زمانبندی یک فاکتور

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json-patch+json`

**InvoiceCancelRequest**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ |  |

**Content-Type:** `application/json`

**InvoiceCancelRequest**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ |  |

**Content-Type:** `text/json`

**InvoiceCancelRequest**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ |  |

**Content-Type:** `application/*+json`

**InvoiceCancelRequest**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | Success |
| `400` | Bad Request |
| `401` | Unauthorized |
| `403` | Forbidden |
| `500` | Server Error |

**پاسخ `400` — `application/json`:**

**پاسخ 400**
نوع: `string` | مثال: `"string"`

---

### `GET /v2/invoice/Schedule/{code}`

**خلاصه:** دریافت فاکتور زمانبندی شده

`operationId`: `GetInvoiceSchedule`

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `code` | path | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | فاکتور زمانبندی شده |

**پاسخ `200` — `application/json`:**

**ScheduleInvoiceWithChilds** — جزییات کامل فاکتور زمابندی شده
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `parentInvoice` | [`InvoiceDetailViewModel`](#schema-invoicedetailviewmodel) | — |  |
| `childInvoices` | array&lt;[InvoiceDetailViewModel](#schema-invoicedetailviewmodel)&gt; | — | فاکتورهای ساخته شده توسط فاکتور زمابندی والد |

---

## Upload

متدهای مرتبط با [آپلود فایل‌ها](#section/) ورودی تمام این سرویس‌ها به صورت formData می‌باشد.

### `POST /v1/upload/ProfilePic`

**خلاصه:** آپلود عکس پروفایل کاربری

`operationId`: `UploadProfilePic`

محدودیت‌های فایل‌های ورودی:

JPG, PNG, JPEG

#### بدنه درخواست (Request Body)

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | عکس کاربر با موفقیت آپلود شد |

---

### `POST /v1/upload/Item`

**خلاصه:** آپلود عکس یک آیتم‌مالی

`operationId`: `UploadItem`

محدودیت‌های فایل‌های ورودی:

JPG, PNG, JPEG

#### بدنه درخواست (Request Body)

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | عکس آیتم‌مالی با موفقیت آپلود شد |

---

### `POST /v1/upload/InvoiceAttachment`

**خلاصه:** آپلود فایل‌ ضمیمه یک فاکتور

`operationId`: `UploadInvoiceAttachment`

محدودیت‌های فایل‌های ورودی:

محدودیت ندارد.

#### بدنه درخواست (Request Body)

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | فایل ضمیمه فاکتور با موفقیت آپلود شد |

---

## استعلام بانکی

سرویس های استعلامی مبتنی بر اطلاعات بانکی مانند شماره کارت یا شبا بانکی که در آن میتوانید بر اساس ورودی ها به اطلاعات بانکی/هویتی مشتریان خود دست پیدا کتید

### `GET /v1/inquiry/Cards/card-to-owner-info-inquiry`

**خلاصه:** ‌استعلام کارت

`operationId`: `CardToOwnerInfoInquiry`

با استفاده از سرویس استعلام کارت می‌توانید با ارسال شماره کارت، نام صاحب کارت را دریافت نمایید.

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `cardNumber` | query | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | خروجی سرویس استعلام مشخصات صاحب کارت |
| `400` | درخواست نامعتبر است |
| `401` | خطای احراز هویت |
| `403` | خطای عدم دسترسی |
| `500` | خطای داخلی |
| `503` | خطای سرویس |

**پاسخ `200` — `application/ json`:**

**CardToOwnerInfoResultModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `bankName` | [`BankEnum`](#schema-bankenum) | — |  |
| `accountStatus` | [`BankAccountStatusEnum`](#schema-bankaccountstatusenum) | — |  |
| `accountOwnerInfos` | array&lt;[AccountOwnerInfo](#schema-accountownerinfo)&gt; | — |  |

**پاسخ `400` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.validation_error",
  "status": 400,
  "detail": "خطا در پارامترهای ارسالی",
  "instance": "/v1/inquiry/Cards/card-to-owner-info-inquiry",
  "paypingTrackId": "AAAAAAAAAAAA:11111111",
  "errors": [
    {
      "card_not_valid": "شماره کارت معتبر نیست"
    },
    {
      "natioalCode_not_valid": "کد ملی معتبر نیست"
    }
  ]
}
```

**پاسخ `401` — `application/json`:**

**UnauthenticatedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthenticated",
  "status": 401,
  "detail": "خطای احراز هویت",
  "instance": "/v1/inquiry/Cards/card-to-owner-info-inquiry",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `403` — `application/json`:**

**UnauthorizedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthorized",
  "status": 403,
  "detail": "خطای عدم دسترسی",
  "instance": "/v1/inquiry/Cards/card-to-owner-info-inquiry",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `500` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.error",
  "status": 500,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/inquiry/Cards/card-to-owner-info-inquiry",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `503` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.proxy_error",
  "status": 503,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/inquiry/Cards/card-to-owner-info-inquiry",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

---

### `GET /v1/inquiry/Cards/card-to-sheba-inquiry`

**خلاصه:** ‌تبدیل کارت به شبا

`operationId`: `CardToShebaInquiry`

با استفاده از سرویس تبدیل کارت به شبا می‌توانید با ارسال شماره کارت، اطلاعات حساب از قبیل شماره شبا، نام صاحب حساب و نام بانک را دریافت نمایید.

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `cardNumber` | query | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | خروجی سرویس استعلام شماره شبای کارت |
| `400` | درخواست نامعتبر است |
| `401` | خطای احراز هویت |
| `403` | خطای عدم دسترسی |
| `500` | خطای داخلی |
| `503` | خطای سرویس |

**پاسخ `200` — `application/ json`:**

**CardToShebaResultModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `bankName` | [`BankEnum`](#schema-bankenum) | — |  |
| `shebaNumber` | string | — |  |

**پاسخ `400` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.validation_error",
  "status": 400,
  "detail": "خطا در پارامترهای ارسالی",
  "instance": "/v1/************************",
  "paypingTrackId": "AAAAAAAAAAAA:11111111",
  "errors": [
    {
      "card_not_valid": "شماره کارت معتبر نیست"
    },
    {
      "natioalCode_not_valid": "کد ملی معتبر نیست"
    }
  ]
}
```

**پاسخ `401` — `application/json`:**

**UnauthenticatedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthenticated",
  "status": 401,
  "detail": "خطای احراز هویت",
  "instance": "/v1/inquiry/Cards/card-to-sheba-inquiry",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `403` — `application/json`:**

**UnauthorizedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthorized",
  "status": 403,
  "detail": "خطای عدم دسترسی",
  "instance": "/v1/inquiry/Cards/card-to-sheba-inquiry",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `500` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.error",
  "status": 500,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/************************",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `503` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.proxy_error",
  "status": 503,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/************************",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

---

### `GET /v1/inquiry/Cards/card-to-deposit-inquiry`

**خلاصه:** ‌تبدیل کارت به حساب

`operationId`: `CardToDepositInquiry`

با استفاده از سرویس تبدیل کارت به حساب می‌توانید با ارسال شماره کارت، اطلاعات حساب از قبیل شماره حساب ، نام صاحب حساب و نام بانک را دریافت نمایید..

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `cardNumber` | query | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | خروجی سرویس استعلام شماره حساب کارت |
| `400` | درخواست نامعتبر است |
| `401` | خطای احراز هویت |
| `403` | خطای عدم دسترسی |
| `500` | خطای داخلی |
| `503` | خطای سرویس |

**پاسخ `200` — `application/ json`:**

**CardToDepositResultModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `bankName` | [`BankEnum`](#schema-bankenum) | — |  |
| `depositNumber` | string | — |  |

**پاسخ `400` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.validation_error",
  "status": 400,
  "detail": "خطا در پارامترهای ارسالی",
  "instance": "/v1/************************",
  "paypingTrackId": "AAAAAAAAAAAA:11111111",
  "errors": [
    {
      "card_not_valid": "شماره کارت معتبر نیست"
    },
    {
      "natioalCode_not_valid": "کد ملی معتبر نیست"
    }
  ]
}
```

**پاسخ `401` — `application/json`:**

**UnauthenticatedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthenticated",
  "status": 401,
  "detail": "خطای احراز هویت",
  "instance": "/v1/inquiry/Cards/card-to-deposit-inquiry",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `403` — `application/json`:**

**UnauthorizedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthorized",
  "status": 403,
  "detail": "خطای عدم دسترسی",
  "instance": "/v1/inquiry/Cards/card-to-deposit-inquiry",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `500` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.error",
  "status": 500,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/************************",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `503` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.proxy_error",
  "status": 503,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/************************",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

---

### `GET /v1/inquiry/Matching/nationalCode-with-card`

**خلاصه:** تطابق کارت و کدملی

`operationId`: `MachingCardWithNationalCode`

با استفاده از سرویس تطابق شماره کارت و کدملی می‌توانید با ارسال شماره کارت، کد ملی و تاریخ تولد بررسی کرد که مالکیت شماره کارت و کد ملی متعلق به یک شخص باشد..

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `cardNumber` | query | string | ✅ |  |
| `nationalCode` | query | string | ✅ |  |
| `birthDate` | query | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | خروجی سرویس استعلام تطبیق کد ملی و شماره کارت |
| `400` | درخواست نامعتبر است |
| `401` | خطای احراز هویت |
| `403` | خطای عدم دسترسی |
| `500` | خطای داخلی |
| `503` | خطای سرویس |

**پاسخ `200` — `application/ json`:**

**MatchingResultModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `matched` | boolean | — |  |

**پاسخ `400` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.validation_error",
  "status": 400,
  "detail": "خطا در پارامترهای ارسالی",
  "instance": "/v1/inquiry/Matching/nationalCode-with-card",
  "paypingTrackId": "AAAAAAAAAAAA:11111111",
  "errors": [
    {
      "card_not_valid": "شماره کارت معتبر نیست"
    },
    {
      "natioalCode_not_valid": "کد ملی معتبر نیست"
    }
  ]
}
```

**پاسخ `401` — `application/json`:**

**UnauthenticatedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthenticated",
  "status": 401,
  "detail": "خطای احراز هویت",
  "instance": "/v1/inquiry/Matching/nationalCode-with-card",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `403` — `application/json`:**

**UnauthorizedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthorized",
  "status": 403,
  "detail": "خطای عدم دسترسی",
  "instance": "/v1/inquiry/Matching/nationalCode-with-card",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `500` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.error",
  "status": 500,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/inquiry/Matching/nationalCode-with-card",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `503` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.proxy_error",
  "status": 503,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/inquiry/Matching/nationalCode-with-card",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

---

### `GET /v1/inquiry/Matching/nationalCode-with-sheba`

**خلاصه:** تطابق شبا و کدملی

`operationId`: `MachingShebaWithNationalCode`

با استفاده از سرویس تطابق شماره شبا و کد ملی می‌توانید با ارسال شماره شبا، کد ملی و تاریخ تولد بررسی کرد که مالکیت شماره شبا و کد ملی متعلق به یک شخص باشد..

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `sheba` | query | string | ✅ |  |
| `nationalCode` | query | string | ✅ |  |
| `birthDate` | query | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | خروجی سرویس استعلام تطبیق کد ملی و شماره شبا |
| `400` | درخواست نامعتبر است |
| `401` | خطای احراز هویت |
| `403` | خطای عدم دسترسی |
| `500` | خطای داخلی |
| `503` | خطای سرویس |

**پاسخ `200` — `application/ json`:**

**MatchingResultModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `matched` | boolean | — |  |

**پاسخ `400` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.validation_error",
  "status": 400,
  "detail": "خطا در پارامترهای ارسالی",
  "instance": "/v1/inquiry/Matching/nationalCode-with-sheba",
  "paypingTrackId": "AAAAAAAAAAAA:11111111",
  "errors": [
    {
      "sheba_not_valid": "شماره شبا معتبر نیست"
    },
    {
      "natioalCode_not_valid": "کد ملی معتبر نیست"
    }
  ]
}
```

**پاسخ `401` — `application/json`:**

**UnauthenticatedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthenticated",
  "status": 401,
  "detail": "خطای احراز هویت",
  "instance": "/v1/inquiry/Matching/nationalCode-with-sheba",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `403` — `application/json`:**

**UnauthorizedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthorized",
  "status": 403,
  "detail": "خطای عدم دسترسی",
  "instance": "/v1/inquiry/Matching/nationalCode-with-sheba",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `500` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.error",
  "status": 500,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/inquiry/Matching/nationalCode-with-sheba",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `503` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.proxy_error",
  "status": 503,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/inquiry/Matching/nationalCode-with-sheba",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

---

### `GET /v1/inquiry/Sheba/sheba-owner-info`

**خلاصه:** ‌استعلام شبا

`operationId`: `ShebaInquiry`

با استفاده از سرویس استعلام شبا می‌توانید با ارسال شماره شبا، اطلاعات حساب از قبیل نام صاحب حساب ، فعال بودن یا نبودن حساب و نام بانک را دریافت کنید.

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `sheba` | query | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | خروجی سرویس استعلام شماره شبا |
| `400` | درخواست نامعتبر است |
| `401` | خطای احراز هویت |
| `403` | خطای عدم دسترسی |
| `500` | خطای داخلی |
| `503` | خطای سرویس |

**پاسخ `200` — `application/ json`:**

**ShebaToOwnerResultModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `shebaNumber` | string | — |  |
| `bankName` | [`BankEnum`](#schema-bankenum) | — |  |
| `accountStatus` | [`BankAccountStatusEnum`](#schema-bankaccountstatusenum) | — |  |
| `depositNumber` | string | — |  |
| `accountOwnerInfos` | array&lt;[AccountOwnerInfo](#schema-accountownerinfo)&gt; | — |  |

**پاسخ `400` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.validation_error",
  "status": 400,
  "detail": "خطا در پارامترهای ارسالی",
  "instance": "/v1/inquiry/Sheba/sheba-owner-info",
  "paypingTrackId": "AAAAAAAAAAAA:11111111",
  "errors": [
    {
      "card_not_valid": "شماره کارت معتبر نیست"
    },
    {
      "natioalCode_not_valid": "کد ملی معتبر نیست"
    }
  ]
}
```

**پاسخ `401` — `application/json`:**

**UnauthenticatedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthenticated",
  "status": 401,
  "detail": "خطای احراز هویت",
  "instance": "/v1/inquiry/Sheba/sheba-owner-info",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `403` — `application/json`:**

**UnauthorizedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthorized",
  "status": 403,
  "detail": "خطای عدم دسترسی",
  "instance": "/v1/inquiry/Sheba/sheba-owner-info",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `500` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.error",
  "status": 500,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/inquiry/Sheba/sheba-owner-info",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `503` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.proxy_error",
  "status": 503,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/inquiry/Sheba/sheba-owner-info",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

---

## استعلام هویتی

با استفاده از این دسته از سرویس ها میتوانید اطلاعات هویتی مشتریان خود را استخراج نمایید.

### `GET /v1/inquiry/Matching/nationalcode-with-mobile`

**خلاصه:** تطابق کد ملی و شماره موبایل (شاهکار)

`operationId`: `MachingMobileWithNationalCode`

با استفاده از سرویس شاهکار می‌توانید مالکیت شماره موبایل و کد ملی ارسالی را با هم تطابق دهید.

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `mobileNumber` | query | string | ✅ |  |
| `nationalCode` | query | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | خروجی سرویس تطابق کد ملی و شماره موبایل |
| `400` | درخواست نامعتبر است |
| `401` | خطای احراز هویت |
| `403` | خطای عدم دسترسی |
| `500` | خطای داخلی |
| `503` | خطای سرویس |

**پاسخ `200` — `application/ json`:**

**MatchingResultModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `matched` | boolean | — |  |

**پاسخ `400` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.validation_error",
  "status": 400,
  "detail": "خطا در پارامترهای ارسالی",
  "instance": "v1/inquiry/Matching/nationalcode-with-mobile",
  "paypingTrackId": "AAAAAAAAAAAA:11111111",
  "errors": [
    {
      "mobileNumber_not_valid": "شماره موبایل معتبر نیست"
    },
    {
      "natioalCode_not_valid": "کد ملی معتبر نیست"
    }
  ]
}
```

**پاسخ `401` — `application/json`:**

**UnauthenticatedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthenticated",
  "status": 401,
  "detail": "خطای احراز هویت",
  "instance": "/v1/inquiry/Matching/nationalcode-with-mobile",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `403` — `application/json`:**

**UnauthorizedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthorized",
  "status": 403,
  "detail": "خطای عدم دسترسی",
  "instance": "/v1/inquiry/Matching/nationalcode-with-mobile",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `500` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.error",
  "status": 500,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "v1/inquiry/Matching/nationalcode-with-mobile",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `503` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.proxy_error",
  "status": 503,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "v1/inquiry/Matching/nationalcode-with-mobile",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

---

### `GET /v1/inquiry/NationalCode/inquiry-with-personal-info`

**خلاصه:** استعلام اطلاعات هویتی

`operationId`: `NationalCodeInquiry`

با استفاده از سرویس استعلام هویتی می توانید اطلاعات فرد از قبیل نام، نام خانوادگی، نام پدر و وضعیت زنده بودن فرد را به دست آورید. همچنین با استعلام هویتی می توان از تطابق کد ملی و تاریخ تولد فرد اطمینان حاصل کرد.

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `nationalCode` | query | string | ✅ |  |
| `birthDate` | query | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | خروجی سرویس استعلام کد ملی |
| `400` | درخواست نامعتبر است |
| `401` | خطای احراز هویت |
| `403` | خطای عدم دسترسی |
| `500` | خطای داخلی |
| `503` | خطای سرویس |

**پاسخ `200` — `application/ json`:**

**NationalCodeToOwnerResultModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `NationalCode` | string | — |  |
| `FirstName` | string | — |  |
| `LastName` | string | — |  |
| `FatherName` | string | — |  |
| `BirthDate` | string | — |  |
| `Alive` | boolean | — |  |

**پاسخ `400` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.validation_error",
  "status": 400,
  "detail": "خطا در پارامترهای ارسالی",
  "instance": "/v1/inquiry/NationalCode/inquiry-with-personal-info",
  "paypingTrackId": "AAAAAAAAAAAA:11111111",
  "errors": [
    {
      "natioalCode_not_valid": "کد ملی معتبر نیست"
    },
    {
      "birthDate_not_valid": "تاریخ تولد معتبر نیست"
    }
  ]
}
```

**پاسخ `401` — `application/json`:**

**UnauthenticatedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthenticated",
  "status": 401,
  "detail": "خطای احراز هویت",
  "instance": "/v1/inquiry/NationalCode/inquiry-with-personal-info",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `403` — `application/json`:**

**UnauthorizedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthorized",
  "status": 403,
  "detail": "خطای عدم دسترسی",
  "instance": "/v1/inquiry/NationalCode/inquiry-with-personal-info",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `500` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.error",
  "status": 500,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/inquiry/NationalCode/inquiry-with-personal-info",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `503` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.proxy_error",
  "status": 503,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/inquiry/NationalCode/inquiry-with-personal-info",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

---

## استعلام خدماتی

با استفاده از این سرویس میتوانید آدرس کد پستی را دریافت نمایید.

### `GET /v1/inquiry/PostalCode/inquiry-postal-code`

**خلاصه:** استعلام کدپستی

`operationId`: `PostalCodeInquiry`

با استفاده از سرویس استعلام کد پستی می‌توانید با ارسال کدپستی، جزئیات آدرس مربوط به آن را دریافت کرد..

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `postalCode` | query | string | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | خروجی سرویس استعلام کد پستی |
| `400` | درخواست نامعتبر است |
| `401` | خطای احراز هویت |
| `403` | خطای عدم دسترسی |
| `500` | خطای داخلی |
| `503` | خطای سرویس |

**پاسخ `200` — `application/ json`:**

**PostalCodeInformationResultModel**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `City` | string | — |  |
| `Province` | string | — |  |
| `Township` | string | — |  |
| `Locality` | string | — |  |
| `Avenue` | string | — |  |
| `StopStreet` | string | — |  |
| `No` | integer(int32) | — |  |
| `Floor` | string | — |  |

**پاسخ `400` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.validation_error",
  "status": 400,
  "detail": "خطا در پارامترهای ارسالی",
  "instance": "/v1/inquiry/PostalCode/inquiry-postal-code",
  "paypingTrackId": "AAAAAAAAAAAA:11111111",
  "errors": [
    {
      "postalCode_not_valid": "کد پستی معتبر نیست"
    }
  ]
}
```

**پاسخ `401` — `application/json`:**

**UnauthenticatedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthenticated",
  "status": 401,
  "detail": "خطای احراز هویت",
  "instance": "/v1/inquiry/PostalCode/inquiry-postal-code",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `403` — `application/json`:**

**UnauthorizedProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "unauthorized",
  "status": 403,
  "detail": "خطای عدم دسترسی",
  "instance": "/v1/inquiry/PostalCode/inquiry-postal-code",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `500` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.error",
  "status": 500,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/inquiry/PostalCode/inquiry-postal-code",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

**پاسخ `503` — `application/json`:**

**ProblemDetails**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

**مثال:**

```json
{
  "title": "payping.proxy_error",
  "status": 503,
  "detail": "خطایی در پردازش درخواست رخ داده است",
  "instance": "/v1/inquiry/PostalCode/inquiry-postal-code",
  "paypingTrackId": "AAAAAAAAAAAA:11111111"
}
```

---

## تنظیمات اقساطی

انجام تنظیمات سرویس اقساطی اعم از تغییر حد اعطای اعتبار و ....

### `POST /v1/bnpl/merchant/contract/change-wallet-credit-amount`

**خلاصه:** تغییر اعتبار کیف پول

این متد برای تغییر مقدار اعتبار کیف پول یک قرارداد BNPL استفاده می‌شود.

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json`

**بدنه**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `creditCode` | string(uuid) | ✅ |  |
| `walletCreditAmount` | number(double) | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نتیجه عملیات تغییر اعتبار کیف پول |
| `400` | درخواست نامعتبر |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `isSuccess` | boolean | — |  |
| `message` | string | — |  |
| `total` | number(double) | — |  |
| `remaining` | number(double) | — |  |
| `consumed` | number(double) | — |  |

**پاسخ `400` — `application/problem+json`:**

**پاسخ 400**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

---

### `GET /v1/bnpl/merchant/options/get`

**خلاصه:** دریافت گزینه‌های BNPL

این متد اطلاعات گزینه‌های BNPL شامل لیست اعتبارات و ضامنین را بازمی‌گرداند.

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | لیست گزینه‌ها |
| `400` | درخواست نامعتبر |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `credits` | array&lt;object&gt; | — |  |
| `guarantors` | array&lt;object&gt; | — |  |
| `contractId` | integer | — |  |

**پاسخ `400` — `application/problem+json`:**

**پاسخ 400**
نوع: `object`

---

## سفارشات اقساطی

سرویس های مربوط به ایجاد و گزارش های فروش اقساطی

### `POST /v1/bnpl/merchant/order/create`

**خلاصه:** ساخت سفارش اقساطی

از این متد جهت ارسال اطلاعات سفارش  استفاده کنید. فراخوانی این متد یک سفارش اقساطی با کد رهگیری یکتا تولید کرده و آدرس درگاه پرداخت اقساطی جهت هدایت کاربر را بازمی‌گرداند.

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json`

**بدنه**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | number(int32) | ✅ |  |
| `mobile` | string | ✅ |  |
| `description` | string | — |  |
| `callbackUrl` | string | ✅ |  |
| `cancelUrl` | string | — |  |
| `refId` | string | ✅ |  |
| `targetPlans` | array&lt;string&gt; | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نتیجه عملیات ساخت سفارش اقساطی |
| `400` | درخواست نامعتبر |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `redirectUrl` | string | — |  |
| `orderTrackingCode` | string(uuid) | — |  |

**پاسخ `400` — `application/problem+json`:**

**پاسخ 400**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

---

### `GET /v1/bnpl/merchant/order/list`

**خلاصه:** لیست سفارش‌های BNPL

این متد لیست سفارش‌های BNPL را با فیلترهای مختلف بازمی‌گرداند.

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `fromDate` | query | string(date-time) | — |  |
| `toDate` | query | string(date-time) | — |  |
| `consumerName` | query | string | — |  |
| `mobile` | query | string | — |  |
| `creditAmount` | query | number(double) | — |  |
| `trackingCode` | query | string | — |  |
| `orderStatusRequest` | query | integer | — |  |
| `pageSize` | query | integer | — |  |
| `pageNumber` | query | integer | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | لیست سفارش‌ها |
| `400` | درخواست نامعتبر |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `orders` | array&lt;object&gt; | — |  |
| `total` | integer | — |  |

---

### `GET /v1/bnpl/merchant/order/detail`

**خلاصه:** جزئیات سفارش BNPL

این متد جزئیات یک سفارش BNPL را بر اساس trackingCode و clientRefId بازمی‌گرداند.

#### پارامترها

| نام | in | نوع | الزامی | توضیحات |
|---|---|---|---|---|
| `trackingCode` | query | string | — |  |
| `clientRefId` | query | string | — |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | جزئیات سفارش |
| `400` | درخواست نامعتبر |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `object`

---

## طرح های اقساطی

تنظیمات مربوط به طرح های اقساطی

### `GET /v1/bnpl/merchant/plan/list`

**خلاصه:** لیست پلن‌های BNPL

این متد لیست پلن‌های BNPL را بازمی‌گرداند.

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | لیست پلن‌ها |
| `400` | درخواست نامعتبر |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `object`

---

### `PUT /v1/bnpl/merchant/plan/toggle-active`

**خلاصه:** فعال/غیرفعال کردن پلن BNPL

این متد وضعیت فعال بودن یک پلن BNPL را تغییر می‌دهد.

#### بدنه درخواست (Request Body)

**Content-Type:** `application/json`

**بدنه**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `planCode` | string(uuid) | ✅ |  |
| `isActive` | boolean | ✅ |  |

#### پاسخ‌ها (Responses)

| کد | توضیحات |
|---|---|
| `200` | نتیجه تغییر وضعیت پلن |
| `400` | درخواست نامعتبر |

**پاسخ `200` — `application/json`:**

**پاسخ 200**
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `planCode` | string | — |  |

---

## مدل‌های داده (Schemas)

### <a id="schema-paymentdto"></a>`PaymentDto`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `paymentCode` | string | — | کد پرداخت |
| `url` | string | — | لینک دستور پرداخت |
| `amount` | integer(int32) | — | مبلغ دستور پرداخت |
| `payerWage` | integer(int32) | — | مبلغ کارمزد پرداخت کننده |
| `businessWage` | integer(int32) | — | مبلغ کارمزد پذیرنده |
| `gatewayAmount` | integer(int32) | — | مبلغ نهایی پرداخت |
| `paypingVat` | integer(int32) | — | مبلغ مالیات بر ارزش افزوده (Value-Added Tax) |

### <a id="schema-paymentresult"></a>`PaymentResult`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کد پرداخت |

### <a id="schema-sharedpaymentitemdetail"></a>`SharedPaymentItemDetail`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | — | سهم تسهیم شونده (صاحب سهم) |
| `paymentCode` | string | — | کد پرداخت |
| `userIdentity` | string | — | شماره موبایل یا ایمیل کاربر |

### <a id="schema-sharedpaymentitemmodel"></a>`SharedPaymentItemModel`

اطلاعات سهم یک ذی‌نفع از پرداخت

اطلاعات سهم یک ذی‌نفع از پرداخت
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int64) | — | مبلغ دستور پرداخت |
| `userIdentity` | string | — | شماره موبایل یا ایمیل کاربر |
| `description` | string | — | توضیحات |

### <a id="schema-sharedpaymentmodel"></a>`SharedPaymentModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `returnUrl` | string | — | آدرس بازگشت پذیرنده |
| `payerIdentity` | string | — | شماره موبایل یا ایمیل پرداخت کننده - اگر شماره موبایل وارد شود، تمام شماره کارت‌های ذخیره شده پرداخت‌کننده در درگاه، نمایش داده می‌شود. |
| `payerName` | string | — | نام پرداخت کننده |
| `description` | string | — | توضیحات |
| `clientRefId` | string | — | شناسه ارجاع پذیرنده |
| `isReversible` | boolean | — | تراکنش قابلیت بازگشت وجه دارد یا خیر |
| `items` | array&lt;[SharedPaymentItemModel](#schema-sharedpaymentitemmodel)&gt; | — | اطلاعات تسهیم (به ازای هر صاحب سهم، یک رکورد در نظر بگیرید) |

### <a id="schema-verifydto"></a>`VerifyDto`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int64) | — | مبلغ دستور پرداخت |
| `cardNumber` | string | — | شماره کارت پرداخت کننده |
| `cardHashPan` | string | — | شماره کارت هش شده پرداخت کننده |
| `clientRefId` | string | — | شناسه ارجاع پذیرنده |
| `paymentRefId` | integer(int64) | — | کد رهگیری پرداخت |
| `code` | string | — | کد پرداخت |
| `payedDate` | string | — | تاریخ و ساعت پرداخت (UTC) |
| `payerWage` | integer(int64) | — | مبلغ کارمزد پرداخت کننده |
| `businessWage` | integer(int64) | — | مبلغ کارمزد پذیرنده |
| `gatewayAmount` | integer(int64) | — | مبلغ نهایی پرداخت |
| `paypingVat` | integer(int32) | — | مبلغ مالیات بر ارزش افزوده (Value-Added Tax) |
| `sharedPaymentItems` | array&lt;[SharedPaymentItemDetail](#schema-sharedpaymentitemdetail)&gt; | — | اطلاعات تسهیم کننده‌ها - این فیلد تنها در پرداخت تسهیمی ارسال می شود |

### <a id="schema-verifymodel"></a>`VerifyModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `paymentRefId` | integer(int64) | ✅ | کد رهگیری پرداخت (در مرحله ارسال اطلاعات پرداخت برای پذیرنده ارسال شده است) |
| `paymentCode` | string | ✅ | کد پرداخت |
| `amount` | integer(int32) | ✅ | مبلغ دستور پرداخت |

### <a id="schema-reversemodel"></a>`ReverseModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `paymentRefId` | integer(int64) | ✅ | کد رهگیری پرداخت (در مرحله ارسال اطلاعات پرداخت برای پذیرنده ارسال شده است) |
| `paymentCode` | string | ✅ | کد پرداخت |

### <a id="schema-reversedto"></a>`ReverseDto`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int64) | — | مبلغ اصلی دستور پرداخت |
| `clientRefId` | string | — | شناسه ارجاع پذیرنده |
| `paymentRefId` | integer(int64) | — | کد رهگیری پرداخت |
| `code` | string | — | کد پرداخت |
| `payerWage` | integer(int32) | — | مبلغ کارمزد پرداخت کننده |
| `gatewayAmount` | integer(int32) | — | مبلغ نهایی بازگشت داده‌شده |
| `reversedDate` | string | — | تاریخ و ساعت بازگشت وجه (UTC) |
| `sharedPaymentItems` | array&lt;[SharedPaymentItemDetail](#schema-sharedpaymentitemdetail)&gt; | — | اطلاعات تسهیم کننده‌ها - این فیلد تنها در پرداخت تسهیمی ارسال می شود |

### <a id="schema-sharerequest"></a>`ShareRequest`

درخواست انجام تسهیم بین ذی‌نفعان

درخواست انجام تسهیم بین ذی‌نفعان
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `paymentRefId` | integer(int64) | — | کد رهگیری پرداخت (در مرحله ارسال اطلاعات پرداخت برای پذیرنده ارسال شده است) |
| `paymentCode` | string | — | کد پرداخت |
| `amount` | integer(int32) | — | مبلغ دستور پرداخت |
| `paymentShares` | array&lt;[SharedPaymentItemModel](#schema-sharedpaymentitemmodel)&gt; | — | اطلاعات تسهیم (به ازای هر صاحب سهم، یک رکورد در نظر بگیرید) |

### <a id="schema-shareresult"></a>`ShareResult`

نتیجه تسهیم پرداخت

نتیجه تسهیم پرداخت
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | — | مبلغ دستور پرداخت |
| `paymentCode` | string | — | کد پرداخت |
| `paymentRefId` | integer(int64) | — | کد رهگیری پرداخت |
| `clientRefId` | string | — | شناسه ارجاع پذیرنده |
| `paymentShares` | array&lt;[SharedPaymentItemDetail](#schema-sharedpaymentitemdetail)&gt; | — | جزئیات سهم‌های تخصیص‌یافته به هر ذینفع |

### <a id="schema-unblockrequest"></a>`UnblockRequest`

درخواست آزادسازی پرداخت مسدود شده

درخواست آزادسازی پرداخت مسدود شده
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `paymentCode` | string | — | کد پرداخت |
| `amount` | integer(int32) | — | مبلغ دستور پرداخت |

### <a id="schema-paymentmodel"></a>`PaymentModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int64) | — | مبلغ دستور پرداخت |
| `returnUrl` | string | — | آدرس بازگشت پذیرنده |
| `payerIdentity` | string | — | شماره موبایل یا ایمیل پرداخت کننده - اگر شماره موبایل وارد شود، تمام شماره کارت‌های ذخیره شده پرداخت‌کننده در درگاه، نمایش داده می‌شود. |
| `payerName` | string | — | نام پرداخت کننده |
| `description` | string | — | توضیحات |
| `clientRefId` | string | — | شناسه ارجاع پذیرنده |
| `isReversible` | boolean | — | تراکنش قابلیت بازگشت وجه دارد یا خیر |
| `IsBlocked` | boolean | — | وضعیت بلاک بودن تراکنش |

### <a id="schema-removemodel"></a>`RemoveModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `paymentCode` | string | — | کد پرداخت |

### <a id="schema-verifypaymentviewmodel"></a>`VerifyPaymentViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `refId` | string | ✅ | کد رهگیری پرداخت (در مرحله ارسال اطلاعات پرداخت برای پذیرنده ارسال شده است) |
| `paymentCode` | string | ✅ | کد پرداخت |
| `amount` | integer(int32) | ✅ | مبلغ دستور پرداخت |

### <a id="schema-verifyresult"></a>`VerifyResult`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | — | مبلغ دستور پرداخت |
| `cardNumber` | string | — | شماره کارت پرداخت کننده |
| `cardHashPan` | string | — | شماره کارت هش شده پرداخت کننده |
| `payedDate` | string | — | تاریخ و ساعت پرداخت (UTC) |
| `payerWage` | integer(int64) | — | مبلغ کارمزد پرداخت کننده |
| `businessWage` | integer(int64) | — | مبلغ کارمزد پذیرنده |
| `gatewayAmount` | integer(int64) | — | مبلغ نهایی پرداخت |
| `merchants` | array&lt;[SharedPaymentItemDetail](#schema-sharedpaymentitemdetail)&gt; | — | اطلاعات تسهیم کننده‌ها |

### <a id="schema-transactionreportviewmodel"></a>`TransactionReportViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | — | مبلغ |
| `payDate` | string(date-time) | — | تاریخ پرداخت |
| `isPaid` | boolean | — | اینکه پرداخت تایید شده است |
| `description` | string | — | توضیحات |
| `name` | string | — | نام پرداخت کننده/دریافت کننده |
| `payerIdentity` | string | — | شماره موبایل یا ایمیل پرداخت کننده |
| `isRequest` | boolean | — | درخواست/پرداخت |
| `code` | string | — | کد پرداخت |
| `clientId` | string | — | شناسه زیر سیستم مشتری در پی‌پینگ |
| `clientRefId` | string | — | کد ارسالی مشتری به پی‌پینگ |
| `invoiceNo` | string | — | شناسه پرداخت |
| `createdDate` | string(date-time) | — | تاریخ ساخت پرداخت/درخواست |

### <a id="schema-resultviewmodel"></a>`ResultViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `result` | integer(int64) | — | تعداد |

### <a id="schema-transactionwithdrawdetailsviewmodel"></a>`TransactionWithdrawDetailsViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `reqDate` | string(date-time) | — |  |
| `code` | string | — |  |
| `isRepaid` | boolean | — |  |
| `repayDate` | string(date-time) | — |  |
| `amount` | integer(int32) | — |  |

### <a id="schema-paymentdetailsvm"></a>`PaymentDetailsVM`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | — | مبلغ |
| `reqDate` | string(date-time) | — | تاریخ درخواست |
| `payDate` | string(date-time) | — | تاریخ پرداخت |
| `isRequest` | boolean | — | درخواست/پرداخت |
| `isPaid` | boolean | — | تاییدیه پرداخت |
| `description` | string | — | توضیحات |
| `payerIdentity` | string | — | شناسه پرداخت کننده |
| `platform` | string | — | نوع سیستم عامل پرداخت کننده |
| `browser` | string | — | مرورگر پرداخت کننده |
| `rrn` | string | — | شماره کارت پرداخت کننده |
| `clientId` | string | — | شناسه زیر سیستم مشتری در پی‌پینگ |
| `clientRefId` | string | — | کد ارسالی مشتری به پی‌پینگ |
| `invoiceNo` | string | — | شناسه پرداخت |
| `wage` | integer(int32) | — | کارمزد |
| `paypingVat` | integer(int32) | — | مبلغ مالیات بر ارزش افزوده (Value-Added Tax) |
| `shaparakWage` | integer(int32) | — | کارمزد شاپرک |
| `ipgName` | string | — | درگاه پرداخت کننده |
| `paymentType` | integer `0`,`1`,`2`,`3` | — | نوع درگاه پرداخت 0 = Default 1 = Online 2 = Cash 3 = Pos |
| `isBlocked` | boolean | — |  |
| `name` | string | — |  |
| `isRefund` | boolean | — |  |
| `refundStatus` | integer `0`,`1`,`2`,`3` | — | 0 = NoStatus 1 = Awaiting 2 = Complete 3 = Incomplete |
| `cAff` | string | — | کد بازاریابی |
| `cAffWage` | integer(int32) | — | کارمزد بازاریاب |
| `payPingAffWage` | integer(int32) | — | کارمز سرویس بازاریابی پی‌پینگ |
| `refId` | string | — | شماره پرداخت پی‌پینگ |
| `paymentStatus` | integer `0`,`1`,`2`,`3`,`4`,`5` | — | وضعیت پرداخت 0 = کدپرداخت ساخته شده 1 = تراکنش با موفقیت روی درگاه انجام شده و وری فای بانک هم با موفقیت انجام شده (تایید نهایی) 2 = کاربر وارد درگاه شده 3 = کاربر به هر دلیلی تراکنش را لغو کرده 4 = تراکنش با موفقیت روی درگاه انجام شده ولی وری فای سمت بانک ناموفق بوده 5 = کاربر از درگاه با موفقیت برگشته و منتظر وری فای پذیرنده هست |

### <a id="schema-withdrawresult"></a>`WithdrawResult`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کد تسویه |

### <a id="schema-withdrawdetailsviewmodel"></a>`WithdrawDetailsViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | — | مبلغ |
| `reqDate` | string(date-time) | — | تاریخ درخواست تسویه |
| `isRepaid` | boolean | — | تاییدیه تسویه 0= در انتظار تایید 1= تسویه شده |
| `repayDate` | string(date-time) | — | تاریخ تسویه |
| `shaba` | string | — | شماره شبای تسویه |
| `payareferencCode` | string | — | شناسه پی گیری بانک |
| `description` | string | — | توضیحات تسویه |
| `refundedCode` | string | — | کد پرداختی که برای آن برگشت وجه ثبت شده است |
| `withdrawType` | string | — | نوع تسویه تسویه معمولی =0 برگشت پول=1 تسویه بازاریابی=2 تسویه شبا به غیر=3 |
| `isPardakhtYar` | boolean | — | نوع فرایند تسویه 0= عادی 1= پرداختیار |
| `isLegal` | boolean | — | پرداخت حقیقی/حقوقی 0= حقیقی 1= حقوقی |
| `repayPayaId` | string | — | شماره پی گیری بانک |
| `trackingNumber` | string | — | شماره پی گیری بانک |
| `ipgType` | string | — | درگاه پرداخت. (دقیق نیست و کاربرد ندارد) |

### <a id="schema-customercreateviewmodel"></a>`CustomerCreateViewModel`

ثبت مشتری جدید

ثبت مشتری جدید
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `userPhotoFileId` | string | — | پس از آپلود و دریافت کلید فایل را اینجا قرار دهید |
| `email` | string | — | پست الکترونیک |
| `phone` | string | — | تلفن |
| `firstName` | string | ✅ | نام |
| `lastName` | string | ✅ | نام خانوادگی |
| `businessName` | string | — | نام کسب و کار |
| `additionalInfo` | string | — | اطلاعات اضافی |
| `zipCode` | string | — | کدپستی |
| `state` | string | — | استان |
| `city` | string | — | شهر |
| `location` | string | — | آدرس |
| `memo` | string | — | متن یادآوری |
| `isBusiness` | boolean | — | حقوقی = true, حقیقی = false |
| `nationalId` | string | — | کدملی |

### <a id="schema-customerdetailviewmodel"></a>`CustomerDetailViewModel`

جزییات مشخصات مشتری

جزییات مشخصات مشتری
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ | کلید یکتای مشتری |
| `userPhotoFileAddress` | string | — | پس از آپلود و دریافت کلید فایل را اینجا قرار دهید |
| `userPhotoFileId` | string | — | لیست کلیدهای یکتا فایل تصویر پرسنلی |
| `email` | string | — | پست الکترونیک |
| `phone` | string | — | تلفن |
| `firstName` | string | ✅ | نام |
| `lastName` | string | ✅ | نام خانوادگی |
| `businessName` | string | — | نام کسب و کار |
| `additionalInfo` | string | — | اطلاعات اضافی |
| `memo` | string | — | یادآوری |
| `zipCode` | string | — | کدپستی |
| `state` | string | — | استان |
| `city` | string | — | شهر |
| `location` | string | — | آدرس |
| `isBusiness` | boolean | — | حقوقی = true, حقیقی = false |
| `nationalId` | string | — | کد ملی/شماره اقتصادی |

### <a id="schema-customereditviewmodel"></a>`CustomerEditViewModel`

بروزرسانی مشتری

بروزرسانی مشتری
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ | کلید یکتای مشتری |
| `userPhotoFileId` | string | — | پس از آپلود و دریافت کلید فایل را اینجا قرار دهید |
| `email` | string | — | پست الکترونیک |
| `phone` | string | — | تلفن |
| `firstName` | string | ✅ | نام |
| `lastName` | string | ✅ | نام خانوادگی |
| `businessName` | string | — | نام کسب و کار |
| `additionalInfo` | string | — | اطلاعات اضافی |
| `zipCode` | string | — | کدپستی |
| `state` | string | — | استان |
| `city` | string | — | شهر |
| `location` | string | — | آدرس |
| `memo` | string | — | متن یادآوری |
| `isBusiness` | boolean | — | حقوقی = true, حقیقی = false |
| `nationalId` | string | — | کدملی |

### <a id="schema-customerlistitemviewmodel"></a>`CustomerListItemViewModel`

مشخصات مشتری

مشخصات مشتری
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کلید یکتا مشتری |
| `email` | string | — | پست الکترونیک |
| `phone` | string | — | تلفن |
| `firstName` | string | — | نام |
| `lastName` | string | — | نام خانوادگی |
| `businessName` | string | — | نام کسب و کار |
| `nationalId` | string | — | کد ملی/شماره اقتصادی |
| `isBusiness` | string | — | حقوقی = true, حقیقی = false |

### <a id="schema-listcountviewmodel"></a>`ListCountViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `count` | integer(int32) | — |  |

### <a id="schema-couponcreateviewmodel"></a>`CouponCreateViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `name` | string | — |  |
| `userCouponCode` | string | — |  |
| `type` | integer `0`,`1` | — |  |
| `amount` | integer(int32) | — |  |
| `redeemDate` | string(date-time) | — |  |
| `redeemTime` | string | — |  |
| `maxRedemption` | integer(int32) | — |  |
| `isActive` | boolean | — |  |
| `activeProductCode` | array&lt;string&gt; | — |  |

### <a id="schema-codeviewmodel"></a>`CodeViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |

### <a id="schema-couponeditviewmodel"></a>`CouponEditViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `name` | string | — |  |
| `userCouponCode` | string | — |  |
| `type` | integer `0`,`1` | — |  |
| `amount` | integer(int32) | — |  |
| `code` | string | — |  |
| `redeemDate` | string(date-time) | — |  |
| `redeemTime` | string | — |  |
| `maxRedemption` | integer(int32) | — |  |
| `isActive` | boolean | — |  |
| `activeProductCode` | array&lt;string&gt; | — |  |

### <a id="schema-changewalletcreditamountrequest"></a>`ChangeWalletCreditAmountRequest`

درخواست تغییر مبلغ اعتبار کیف پول

درخواست تغییر مبلغ اعتبار کیف پول
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `creditCode` | string(uuid) | ✅ |  |
| `walletCreditAmount` | number | ✅ |  |

### <a id="schema-changewalletcreditamountresponse"></a>`ChangeWalletCreditAmountResponse`

پاسخ تغییر مبلغ اعتبار کیف پول

پاسخ تغییر مبلغ اعتبار کیف پول
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `isSuccess` | boolean | — |  |
| `message` | string | — |  |
| `total` | number | — |  |
| `remaining` | number | — |  |
| `consumed` | number | — |  |

### <a id="schema-bnplmerchantoptionsgetresponse"></a>`BnplMerchantOptionsGetResponse`

پاسخ دریافت گزینه‌های سرویس اقساطی

پاسخ دریافت گزینه‌های سرویس اقساطی
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `credits` | array&lt;object&gt; | — |  |
| `guarantors` | array&lt;object&gt; | — |  |
| `contractId` | integer | — |  |

### <a id="schema-bnplmerchantorderlistresponse"></a>`BnplMerchantOrderListResponse`

پاسخ لیست سفارشات اقساطی

پاسخ لیست سفارشات اقساطی
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `orders` | array&lt;object&gt; | — |  |
| `total` | integer | — |  |

### <a id="schema-bnplmerchantorderdetailresponse"></a>`BnplMerchantOrderDetailResponse`

پاسخ جزئیات سفارش اقساطی

پاسخ جزئیات سفارش اقساطی
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `consumerInfo` | object | — |  |
| `installmentDetails` | array&lt;object&gt; | — |  |
| `installmentInfo` | object | — |  |
| `orderStep` | integer | — |  |
| `guaranteeType` | integer | — |  |
| `guaranteeFileIds` | array&lt;string&gt; | — |  |
| `installmentCount` | integer | — |  |
| `orderCreatedDate` | string(date-time) | — |  |
| `trackingCode` | string | — |  |
| `totalBasketAmount` | number | — |  |
| `prepayment` | number | — |  |
| `creditAmount` | number | — |  |
| `creditScoreDescription` | string | — |  |
| `totalPayment` | number | — |  |
| `isCancelable` | boolean | — |  |
| `prePaymentCardNumber` | string | — |  |
| `cancelNeedsRefund` | boolean | — |  |

### <a id="schema-bnplmerchantplanlistresponse"></a>`BnplMerchantPlanListResponse`

پاسخ لیست طرح‌های اقساطی

پاسخ لیست طرح‌های اقساطی
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `plansInfo` | array&lt;object&gt; | — |  |

### <a id="schema-bnplmerchantplantoggleactiverequest"></a>`BnplMerchantPlanToggleActiveRequest`

درخواست فعال/غیرفعال کردن طرح اقساطی

درخواست فعال/غیرفعال کردن طرح اقساطی
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `planCode` | string(uuid) | ✅ |  |

### <a id="schema-bnplmerchantplantoggleactiveresponse"></a>`BnplMerchantPlanToggleActiveResponse`

پاسخ فعال/غیرفعال کردن طرح اقساطی

پاسخ فعال/غیرفعال کردن طرح اقساطی
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `planCode` | string | — |  |

### <a id="schema-bnplmerchantordercreaterequest"></a>`BnplMerchantOrderCreateRequest`

درخواست ساخت سفارش اقساطی

درخواست ساخت سفارش اقساطی
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | number(int32) | ✅ |  |
| `mobile` | string | ✅ |  |
| `description` | string | — |  |
| `callbackUrl` | string | ✅ |  |
| `cancelUrl` | string | — |  |
| `refId` | string | ✅ |  |
| `targetPlans` | array&lt;string&gt; | — |  |

### <a id="schema-bnplmerchantordercreateresponse"></a>`BnplMerchantOrderCreateResponse`

پاسخ ساخت سفارش اقساطی

پاسخ ساخت سفارش اقساطی
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `redirectUrl` | string | — |  |
| `orderTrackingCode` | string(uuid) | — |  |

### <a id="schema-coupondetailviewmodel"></a>`CouponDetailViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `name` | string | — |  |
| `type` | integer `0`,`1` | — |  |
| `amount` | integer(int32) | — |  |
| `code` | string | — |  |
| `redeemDate` | string(date-time) | — |  |
| `redeemTime` | string | — |  |
| `maxRedemption` | integer(int32) | — |  |
| `isActive` | boolean | — |  |
| `activeProductCode` | string | — |  |
| `isArchived` | boolean | — |  |
| `userCouponCode` | string | — |  |
| `buyerCounts` | integer(int32) | — |  |
| `buyerSum` | integer(int32) | — |  |

### <a id="schema-couponlistitemviewmodel"></a>`CouponListItemViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `name` | string | — |  |
| `type` | integer `0`,`1` | — |  |
| `amount` | integer(int32) | — |  |
| `code` | string | — |  |
| `isActive` | boolean | — |  |
| `activeProductCode` | string | — |  |
| `activeProductName` | array&lt;string&gt; | — |  |
| `userCouponCode` | string | — |  |
| `amountDisplay` | string | — |  |

### <a id="schema-countviewmodel"></a>`CountViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `count` | integer(int32) | — |  |

### <a id="schema-buyerdetailsviewmodel"></a>`BuyerDetailsViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `amount` | integer(int32) | — |  |
| `addressLine` | string | — |  |
| `postalCode` | string | — |  |
| `firstName` | string | — |  |
| `lastName` | string | — |  |
| `email` | string | — |  |
| `city` | string | — |  |
| `phone` | string | — |  |
| `customDescription` | string | — |  |
| `permanLinkCode` | string | — |  |
| `productInfo` | [`ProductInfo`](#schema-productinfo) | — |  |
| `couponCode` | string | — |  |
| `productCode` | string | — |  |
| `campaignCode` | string | — |  |
| `isPaid` | boolean | — |  |
| `payerId` | integer(int32) | — |  |
| `invoiceNo` | string | — |  |
| `payDate` | string(date-time) | — |  |
| `fullName` | string | — |  |

### <a id="schema-productinfo"></a>`ProductInfo`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `title` | string | — |  |
| `description` | string | — |  |
| `realAmount` | integer(int32) | — |  |

### <a id="schema-productcreateviewmodel"></a>`ProductCreateViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `title` | string | ✅ |  |
| `description` | string | — |  |
| `amount` | integer(int32) | — |  |
| `defineAmountByUser` | boolean | — |  |
| `quantity` | integer(int32) | — |  |
| `haveTax` | boolean | — |  |
| `unlimited` | boolean | — |  |
| `imageLink` | string | — |  |

### <a id="schema-producteditviewmodel"></a>`ProductEditViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `title` | string | ✅ |  |
| `description` | string | — |  |
| `amount` | integer(int32) | ✅ |  |
| `defineAmountByUser` | boolean | — |  |
| `haveTax` | boolean | — |  |
| `quantity` | integer(int32) | — |  |
| `unlimited` | boolean | — |  |
| `imageLink` | string | — |  |

### <a id="schema-productfulldeatilviewmodel"></a>`ProductFullDeatilViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `title` | string | — |  |
| `description` | string | — |  |
| `quantity` | integer(int32) | — |  |
| `unlimited` | boolean | — |  |
| `userId` | integer(int32) | — |  |
| `amount` | integer(int32) | — |  |
| `defineAmountByUser` | boolean | — |  |
| `isActive` | boolean | — |  |
| `isArchived` | boolean | — |  |
| `haveTax` | boolean | — |  |
| `tax` | integer(int32) | — |  |
| `imageLink` | string | — |  |
| `imageId` | string | — |  |
| `category` | [`CategoryMinorDetailViewModel`](#schema-categoryminordetailviewmodel) | — |  |

### <a id="schema-categoryminordetailviewmodel"></a>`CategoryMinorDetailViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `name` | string | — |  |

### <a id="schema-productlistitemviewmodel"></a>`ProductListItemViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | — |  |
| `title` | string | — |  |
| `code` | string | — |  |
| `quantity` | integer(int32) | — |  |
| `unlimited` | boolean | — |  |
| `defineAmountByUser` | boolean | — |  |
| `amountDisplay` | string | — |  |
| `quantityViewModel` | string | — |  |
| `isActive` | boolean | — |  |
| `haveTax` | boolean | — |  |
| `havePerma` | boolean | — |  |

### <a id="schema-permanentcreateviewmodel"></a>`PermanentCreateViewModel`

نوع: `object` | nullable

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `productCode` | string | — |  |
| `redirectPage` | string | — |  |
| `getAddress` | boolean | — |  |
| `mailerLiteListId` | string | — |  |
| `smsText` | string | — |  |
| `customDescriptionText` | string | — |  |
| `emailOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `phoneOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `nameOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `customDesOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `clientId` | string | — |  |
| `clientRefId` | string | — |  |
| `permanentType` | [`PermanentType`](#schema-permanenttype) | — |  |
| `isMultiple` | boolean | — |  |

### <a id="schema-showoptions"></a>`ShowOptions`

نوع: `integer` | فرمت: `int32` | enum: `0`, `1`, `2`

### <a id="schema-permanenttype"></a>`PermanentType`

نوع: `integer` | فرمت: `int32` | enum: `0`, `1`

### <a id="schema-codevm"></a>`CodeVM`

نوع: `object` | nullable

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |

### <a id="schema-permanenteditviewmodel"></a>`PermanentEditViewModel`

نوع: `object` | nullable

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `productCode` | string | — |  |
| `redirectPage` | string | — |  |
| `getAddress` | boolean | — |  |
| `mailerLiteListId` | string | — |  |
| `smsText` | string | — |  |
| `customDescriptionText` | string | — |  |
| `isActive` | boolean | — |  |
| `emailOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `phoneOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `nameOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `customDesOption` | [`ShowOptions`](#schema-showoptions) | — |  |
| `permanentType` | [`PermanentType`](#schema-permanenttype) | — |  |
| `isMultiple` | boolean | — |  |

### <a id="schema-permanentdetailviewmodel"></a>`PermanentDetailViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `redirectPage` | string | — |  |
| `getAddress` | boolean | — |  |
| `userId` | integer(int32) | — |  |
| `mailerLiteListId` | string | — |  |
| `smsText` | string | — |  |
| `customDescriptionText` | string | — |  |
| `isActive` | boolean | — |  |
| `isArchived` | boolean | — |  |
| `emailOption` | integer `0`,`1`,`2` | — |  |
| `phoneOption` | integer `0`,`1`,`2` | — |  |
| `nameOption` | integer `0`,`1`,`2` | — |  |
| `customDesOption` | integer `0`,`1`,`2` | — |  |
| `clientId` | string | — |  |
| `clientRefId` | string | — |  |
| `qrLink` | string | — |  |
| `permanentType` | integer `0`,`1` | — |  |
| `buyerCounts` | integer(int32) | — |  |
| `buyerSum` | integer(int32) | — |  |

### <a id="schema-productbuyerviewmodel"></a>`ProductBuyerViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | — |  |
| `fullName` | string | — |  |
| `customDescription` | string | — |  |
| `code` | string | — |  |
| `phone` | string | — |  |
| `email` | string | — |  |
| `payDate` | string(date-time) | — |  |
| `amountDisplay` | string | — |  |
| `payDateDisplay` | string | — |  |
| `phoneViewModel` | string | — |  |

### <a id="schema-countvm"></a>`CountVM`

نوع: `object` | nullable

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `count` | integer(int32) | — |  |

### <a id="schema-invoicecreateviewmodel"></a>`InvoiceCreateViewModel`

ثبت فاکتور جدید

ثبت فاکتور جدید
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `cc` | array&lt;[InvoiceCcToCreateOrUpdateViewModel](#schema-invoicecctocreateorupdateviewmodel)&gt; | — | ایمیل‌ها |
| `customers` | array&lt;[InvoiceBillToCreateOrUpdateViewModel](#schema-invoicebilltocreateorupdateviewmodel)&gt; | — | مشتریان فاکتور |
| `createStatus` | integer `0`,`1`,`2` | — | نوع ثبت فاکتور: 0 = ذخیره در پیش‌نویس 1 =     ارسال 2 = پرداخت دستی انجام شده |
| `paidManualDescription` | string | — | شرح پرداخت نقدی یا دستی |
| `number` | string | — | شماره فاکتور |
| `title` | string | — | عنوان فاکتور |
| `sendDate` | string(date-time) | — | تاریخ ارسال فاکتور |
| `dueDate` | string(date-time) | — | تاریخ سررسید پرداخت |
| `hasOtherDiscount` | boolean | — | آیا فاکتور شامل تخفیف کلی است |
| `itemHasDiscount` | boolean | — | فعال بودن امکان درج تخفیف برای هر آیتم |
| `itemDiscounts` | number(double) | — | مجموع تخفیف آیتم‌های مالی فاکتور |
| `discountCouponCode` | string | — | کد تخفیف ویژه آیتم‌ها |
| `couponCode` | string | — | کد تخفیف کلی فاکتور |
| `discountAmount` | number(double) | — | مبلغ یا درصد تخفیف کلی فاکتور |
| `discountType` | integer `0`,`1` | — | نوع تخفیف به کل فاکتور: 1 = مبلغ 0 = درصد |
| `shipping` | number(double) | — | هزینه حمل و نقل |
| `notes` | string | — | پیامی جهت نمایش به پرداخت‌کننده |
| `termsAndConditions` | string | — | شرایط و قوانین جهت نمایش به پرداخت‌کننده |
| `memo` | string | — | یادداشت داخلی برای صادرکننده فاکتور |
| `products` | array&lt;[InvoiceProductCreateViewModel](#schema-invoiceproductcreateviewmodel)&gt; | — | آیتم‌های مالی فاکتور |
| `sendAttachmentsAfterSuccessPayment` | boolean | — | نمایش فایل‌های ضمیمه فقط پس از پرداخت موفق = true، نمایش     قبل و بعد از پرداخت = false |
| `showNotesAfterSuccessPayment` | boolean | — | نمایش پیام برای پرداخت‌کننده فقط پس از پرداخت موفق =     true، نمایش قبل و بعد از پرداخت = false |
| `showTermsAfterSuccessPayment` | boolean | — | نمایش قوانین و مقررات برای پرداخت‌کننده فقط پس از پرداخت     موفق = true، نمایش قبل و بعد از پرداخت = false |
| `attachments` | array&lt;string&gt; | — | کلید(های) یکتا فایل‌های ضمیمه دریافتی از سرویس آپلود |
| `tagIds` | array&lt;integer&gt; | — | برچسب‌های مرتبط با فاکتور |
| `returnUrl` | string | — | آدرس بازگشت از صفحه پرداخت |

### <a id="schema-invoicecctocreateorupdateviewmodel"></a>`InvoiceCcToCreateOrUpdateViewModel`

CC

CC
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `emailAddress` | string | — | آدرس ایمیل |

### <a id="schema-invoicebilltocreateorupdateviewmodel"></a>`InvoiceBillToCreateOrUpdateViewModel`

ثبت یا بروزرسانی مشتری

ثبت یا بروزرسانی مشتری
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `addressBookCode` | string | — | کلید یکتای مشتری |

### <a id="schema-invoiceitemcreateviewmodel"></a>`InvoiceItemCreateViewModel`

ثبت آیتم مالی فاکتور

ثبت آیتم مالی فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کلید یکتا |
| `name` | string | — | عنوان |
| `description` | string | — | توضیحات |
| `tax` | boolean | — | دارای مالیات = true, نداشتن مالیات = false |
| `quantity` | integer(int32) | — | تعداد |
| `discountValue` | number(double) | — | مقدار تخفیف |
| `discountType` | integer `0`,`1` | — | نوع تخفیف: 1 = مبلغ 0 = درصد |
| `discountCouponCode` | string | — | کد یکتا تخفیف از بخش تخفیف ها |
| `price` | number(double) | — | مبلغ فی |

### <a id="schema-invoicedetailviewmodel"></a>`InvoiceDetailViewModel`

جزییات فاکتور

جزییات فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کلید یکتای فاکتور |
| `parentCode` | string | — | کلید والد بودن فاکتور |
| `paymentCode` | string | — | کد یکتای پرداخت |
| `ccToes` | array&lt;[InvoiceCcToDetailViewModel](#schema-invoicecctodetailviewmodel)&gt; | — | لیست ایمیل |
| `billToes` | array&lt;[InvoiceBillToDetailViewModel](#schema-invoicebilltodetailviewmodel)&gt; | — | لیست مشتری |
| `status` | integer `0`,`1`,`2`,`3`,`4`,`5` | — | وضعیت فاکتور: 0 = پیش نویس 1 = در انتظار پرداخت 2 = پرداخت شد 3 = معوق 4 = لغو شده 5 = همه |
| `paidManualDescription` | string | — | شرح پرداخت دستی |
| `saveToTemplate` | boolean | — | ذخیره به عنوان قالب فاکتور |
| `invoiceNumber` | integer(int64) | — | شماره فاکتور |
| `invoiceTitle` | string | — | عنوان فاکتور |
| `invoiceDateTime` | string(date-time) | — | تاریخ ثبت |
| `dueDate` | string(date-time) | — | تاریخ سررسید |
| `payedDateTime` | string(date-time) | — | تاریخ پرداخت |
| `canceledDateTime` | string(date-time) | — | تاریخ لغو |
| `subTotal` | number(double) | — | جمع مبلغ پرداختی آیتم های مالی |
| `itemsDiscountAmount` | number(double) | — | جمع مبلغ تخفیف آیتم های مالی |
| `totalDiscountAmount` | number(double) | — | مبلغ تخفیف به کل فاکتور |
| `totalDiscountPercent` | integer(int32) | — | درصد تخفیف به کل فاکتور |
| `totalDiscountType` | integer `0`,`1` | — | نوع تخفیف به کل فاکتور: 1 = مبلغ 0 = درصد |
| `sumDiscountAmount` | number(double) | — | جمع کل تخفیف اعمال شده روی فاکتور |
| `totalTaxtionAmount` | number(double) | — | مبلغ مالیات |
| `shipping` | number(double) | — | هزینه حمل و نقل |
| `total` | number(double) | — | مبلغ کل |
| `notes` | string | — | پیامی جهت نمایش به پرداخت کننده |
| `termsAndConditions` | string | — | متن شرایط و قوانین جهت نمایش به پرداخت کننده |
| `memo` | string | — | متن دلخواه جهت یادآوری فقط برای صادر کننده فاکتور |
| `invoiceSchulder` | [`InvoiceSchulderDetailViewModel`](#schema-invoiceschulderdetailviewmodel) | — |  |
| `invoiceItems` | array&lt;[InvoiceItemDetailViewModel](#schema-invoiceitemdetailviewmodel)&gt; | — | آیتم های مالی فاکتور |
| `isSendAttachmentsAfterPayment` | boolean | — | نمایش فایل های ضمیمه به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `isSendNotesAndTermsAfterPayment` | boolean | — | نمایش پیام به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `isSendTermsAfterPayment` | boolean | — | نمایش متن قوانین و مقررات به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `attachFileIds` | array&lt;string&gt; | — | لیست کلید یکتای فایل های ضمیمه |
| `attachFileAddresses` | array&lt;string&gt; | — | لیست آدرس فایل های ضمیمه |
| `qrCodeFileName` | string | — | آدرس تصویر بارکد فاکتور |

### <a id="schema-invoicecctodetailviewmodel"></a>`InvoiceCcToDetailViewModel`

CC

CC
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `emailAddress` | string | — | آدرس ایمیل |

### <a id="schema-invoicebilltodetailviewmodel"></a>`InvoiceBillToDetailViewModel`

مشتری یا پرداخت کننده

مشتری یا پرداخت کننده
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `addressBook` | [`CustomerDetailViewModel`](#schema-customerdetailviewmodel) | — |  |

### <a id="schema-invoiceschulderdetailviewmodel"></a>`InvoiceSchulderDetailViewModel`

جزییات اطلاعات ساخت زمانبندی فاکتور

جزییات اطلاعات ساخت زمانبندی فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `repeat` | integer(int32) | — | تکرار در هر X روز/هفته/ماه/سال |
| `schulderType` | integer `0`,`1`,`2`,`3` | — | نوع زمانبندی: 0 = روزانه 1 = هفتگی 2 = ماهانه 3 = سالانه |
| `dueType` | integer `0`,`1`,`2` | — | نوع پایان زمانبندی: 0 = پس از ساخت X فاکتور 1 = پایان دادن به ساخت فاکتور در تاریخ X 2 = ساخت نامحدود فاکتور |
| `endValue` | string | — | تعداد/تاریخ پایان، تولید فاکتور |
| `dueDateAfterHowManyDay` | integer(int32) | — | سررسید بعد از X روز |
| `invoiceSubSchulders` | array&lt;[InvoiceSubSchulderDetailViewModel](#schema-invoicesubschulderdetailviewmodel)&gt; | — | لیست دستور ساخت فاکتورهای زمانبندی شده و وضعیت آن ها |

### <a id="schema-invoicesubschulderdetailviewmodel"></a>`InvoiceSubSchulderDetailViewModel`

جزییات دستور ساخت فاکتورهای زمانبندی شده و وضعیت آن ها

جزییات دستور ساخت فاکتورهای زمانبندی شده و وضعیت آن ها
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `dueDate` | string(date-time) | — | تاریخ سررسید فاکتوری که باید ساخته شود |
| `mustBeCreateInDateTime` | string(date-time) | — | تاریخ روزی که فاکتور باید ساخته شود |
| `deActiveDateTime` | string(date-time) | — | تاریخ غیر فعال شدن ساخت فاکتور |
| `isInvoiceCreated` | boolean | — | ساخته شد = true, در صف انتظار= false |
| `isActive` | boolean | — | فعال بود = true, غیر فعال = false |
| `invoiceCode` | string | — | کلید یکتا فاکتور ساخته شده |

### <a id="schema-invoiceitemdetailviewmodel"></a>`InvoiceItemDetailViewModel`

جزییات آیتم مالی فاکتور

جزییات آیتم مالی فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کد یکتا |
| `name` | string | — | عنوان |
| `description` | string | — | توضیحات |
| `quantity` | integer(int32) | — | تعداد |
| `discountType` | integer `0`,`1` | — | نوع تخفیف: 1 = مبلغ 0 = درصد |
| `discountPercent` | integer(int32) | — | درصد تخفیف |
| `discountAmount` | number(double) | — | مبلغ تخفیف |
| `tax` | boolean | — | دارای مالیات = true, نداشتن مالیات = false |
| `taxRate` | integer(int32) | — | مقدار درصد مالیات |
| `price` | number(double) | — | مبلغ فی |
| `totalPrice` | number(double) | — | مبلغ فی - مبلغ تخفیف) * تعداد = مجموع) |
| `amount` | number(double) | — | مجموع + مالیات = پرداختی |

### <a id="schema-invoicesendinvoiceresponseviewmodel"></a>`InvoiceSendInvoiceResponseViewModel`

بازگشت مشخصات درخواست ارسال فاکتور

بازگشت مشخصات درخواست ارسال فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `success` | boolean | — | موفقیت آمیز بودن درخواست = true, ناموفق بودن = false |
| `message` | string | — | پیام خطا یا موفقیت |
| `modelCode` | string | — | کلید یکتا |

### <a id="schema-invoiceeditviewmodel"></a>`InvoiceEditViewModel`

بروزرسانی فاکتور ساده

بروزرسانی فاکتور ساده
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ | کلید یکتای فاکتور |
| `ccToes` | array&lt;[InvoiceCcToCreateOrUpdateViewModel](#schema-invoicecctocreateorupdateviewmodel)&gt; | — | ایمیل ها |
| `billToes` | array&lt;[InvoiceBillToCreateOrUpdateViewModel](#schema-invoicebilltocreateorupdateviewmodel)&gt; | — | مشتریان |
| `createStatus` | integer `0`,`1`,`2` | — | نوع ثبت: 0 = ذخیره در پیش نویس 1 = ارسال 2 = دستی پرداخت شد |
| `paidManualDescription` | string | — | شرح پرداخت دستی |
| `saveToTemplate` | boolean | — | ذخیره به عنوان قالب |
| `templateCode` | string | — | کد یکتای قالب فاکتور |
| `invoiceNumber` | integer(int64) | — | شماره فاکتور |
| `invoiceTitle` | string | — | عنوان فاکتور |
| `invoiceDateTime` | string(date-time) | — | تاریخ ثبت |
| `dueDate` | string(date-time) | — | تاریخ سررسید- تاریخی که باید پرداخت صورت پذیرد |
| `totalDiscountValue` | number(double) | — | تخفیف به کل فاکتور |
| `totalDiscountType` | integer `0`,`1` | — | نوع تخفیف به مبلغ یا درصد 1 = مبلغ 0 = درصد |
| `shipping` | number(double) | — | هزینه حمل و نقل |
| `notes` | string | — | متن جهت ارسال به دریافت کننده |
| `termsAndConditions` | string | — | متن شرایط و قوانین جهت ارسال به دریافت کننده |
| `memo` | string | — | ایجاد یک متن دلخواه جهت یادآوری فقط برای کاربر ثبت کننده |
| `invoiceItems` | array&lt;[InvoiceItemCreateViewModel](#schema-invoiceitemcreateviewmodel)&gt; | — | آیتم های مالی فاکتور |
| `isSendAttachmentsAfterPayment` | boolean | — | نمایش فایل های ضمیمه به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `isSendNotesAndTermsAfterPayment` | boolean | — | نمایش پیام به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `isSendTermsAfterPayment` | boolean | — | نمایش متن قوانین و مقررات به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `attachmentsIds` | array&lt;string&gt; | — | کلید(های) یکتا دریافت شده از سرویس آپلود به صورت آرایه از رشته ها قرار دهید |
| `isDevicePayment` | boolean | — | ثبت فاکتور بدون مشتری = true, با مشتری = false |

### <a id="schema-invoicepdfresponseviewmodel"></a>`InvoicePdfResponseViewModel`

مشخصات بازگشت درخواست فایل پی دی اف فاکتور

مشخصات بازگشت درخواست فایل پی دی اف فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `success` | boolean | — | موفقیت آمیز بودن درخواست = true, ناموفق بودن = false |
| `message` | string | — | پیام خطا یا موفقیت |
| `fileAddress` | string | — | آدرس فایل |

### <a id="schema-invoicelistitemviewmodel"></a>`InvoiceListItemViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کلید یکتای فاکتور |
| `number` | integer(int64) | — | شماره فاکتور |
| `sendDate` | string(date-time) | — | تاریخ ثبت فاکتور |
| `dueDate` | string(date-time) | — | تاریخ سررسید فاکتور |
| `payedDateTime` | string(date-time) | — | تاریخ پرداخت |
| `canceledDateTime` | string(date-time) | — | تاریخ لغو |
| `title` | string | — | عنوان |
| `status` | integer `0`,`1`,`2`,`3`,`4`,`5` | — | وضعیت فاکتور:   0 = پیش‌نویس   1 = در انتظار پرداخت   2 = پرداخت شد   3 = معوق   4 = لغو شده   5 = همه |
| `invoicePaidBy` | string | — | پرداخت‌کننده فاکتور |
| `total` | number(double) | — | مبلغ نهایی یا قابل پرداخت |
| `isCorrection` | boolean | — | آیا این فاکتور اصلاحیه است |
| `isSchedule` | boolean | — | آیا این فاکتور زمان‌بندی شده است |
| `cc` | array&lt;[InvoiceCcToListItemViewModel](#schema-invoicecctolistitemviewmodel)&gt; | — | دریافت‌کننده‌های ایمیلی |
| `customerCode` | string | — | کد مشتری |
| `customer` | [`InvoiceBillToListItemViewModel`](#schema-invoicebilltolistitemviewmodel) | — |  |

### <a id="schema-invoicecctolistitemviewmodel"></a>`InvoiceCcToListItemViewModel`

CC

CC
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `emailAddress` | string | — | آدرس ایمیل |

### <a id="schema-invoicebilltolistitemviewmodel"></a>`InvoiceBillToListItemViewModel`

مشتری یا پرداخت‌کننده فاکتور

مشتری یا پرداخت‌کننده فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کد مشتری |
| `displayName` | string | — | نام نمایشی مشتری |
| `fullName` | string | — | نام کامل مشتری |
| `firstName` | string | — | نام کوچک مشتری |
| `lastName` | string | — | نام خانوادگی مشتری |

### <a id="schema-invoicecopyrequestviewmodel"></a>`InvoiceCopyRequestViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ |  |
| `customerCodes` | array&lt;string&gt; | ✅ |  |
| `sendDate` | string(date-time) | — |  |

### <a id="schema-invoicecreateresponseviewmodel"></a>`InvoiceCreateResponseViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `customerCode` | string | — |  |

### <a id="schema-invoicecancelrequest"></a>`InvoiceCancelRequest`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | ✅ |  |

### <a id="schema-invoicecancelresponse"></a>`InvoiceCancelResponse`

بازگشت مشخصات درخواست لغو فاکتور

بازگشت مشخصات درخواست لغو فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کلید یکتا فاکتور |
| `message` | string | — | پیام نتیجه انجام درخواست |

### <a id="schema-invoicesendreminderresponseviewmodel"></a>`InvoiceSendReminderResponseViewModel`

بازگشت مشخصات ارسال یادآوری فاکتور

بازگشت مشخصات ارسال یادآوری فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `success` | boolean | — | موفقیت آمیز بودن درخواست = true, ناموفق بودن = false |
| `message` | string | — | پیام خطا یا موفقیت |
| `modelCode` | string | — | کلید یکتا فاکتور |

### <a id="schema-invoicecreatescheduleviewmodel"></a>`InvoiceCreateScheduleViewModel`

ثبت فاکتور زمانبندی شده

ثبت فاکتور زمانبندی شده
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `customers` | array&lt;[InvoiceCustomerCreateViewModel](#schema-invoicecustomercreateviewmodel)&gt; | — | مشتریان |
| `createStatus` | integer `1`,`2` | — | نوع ثبت: 1 = ارسال 2 = دستی پرداخت شد |
| `discountAmount` | number(double) | — | تخفیف به کل فاکتور |
| `paidManualDescription` | string | — | شرح پرداخت دستی |
| `products` | array&lt;[InvoiceProductCreateViewModel](#schema-invoiceproductcreateviewmodel)&gt; | — | محصولات فاکتور |
| `title` | string | — | عنوان فاکتور |
| `number` | string | — | شماره فاکتور |
| `memo` | string | — | پیام داخل گزارشات - متن دلخواه جهت یادآوری فقط برای صادر کننده فاکتور |
| `notes` | string | — | پیام یادآوری جهت نمایش به پرداخت کننده |
| `showNotesAfterSuccessPayment` | boolean | — | نمایش پیام به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `showTermsAfterSuccessPayment` | boolean | — | نمایش متن قوانین و مقررات به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `sendAttachmentsAfterSuccessPayment` | boolean | — | نمایش فایل های ضمیمه به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `schedule` | [`InvoiceScheduleCreateViewModel`](#schema-invoiceschedulecreateviewmodel) | — |  |
| `sendDate` | string(date-time) | — | تاریخ ارسال فاکتور |
| `shipping` | number(double) | — | هزینه حمل و نقل |
| `returnUrl` | string | — | آدرس بازگشت فاکتور |

### <a id="schema-invoiceschuldercreateorupdateviewmodel"></a>`InvoiceSchulderCreateOrUpdateViewModel`

ثبت اطلاعات زمانبندی فاکتور

ثبت اطلاعات زمانبندی فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `repeat` | integer(int32) | — | تکرار در هر X روز/هفته/ماه/سال |
| `schulderType` | integer `0`,`1`,`2`,`3` | — | نوع زمانبندی: 0 = روزانه 1 = هفتگی 2 = ماهانه 3 = سالانه |
| `dueType` | integer `0`,`1`,`2` | — | نوع پایان زمانبندی: 0 = پس از ساخت X فاکتور 1 = پایان دادن به ساخت فاکتور در تاریخ X 2 = ساخت نامحدود فاکتور |
| `endValue` | string | — | تعداد/تاریخ پایان، تولید فاکتور |
| `dueDateAfterHowManyDay` | integer(int32) | — | سررسید بعد از X روز |

### <a id="schema-invoiceschedulecreateviewmodel"></a>`InvoiceScheduleCreateViewModel`

اطلاعات زمانبندی فاکتور

اطلاعات زمانبندی فاکتور
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `count` | integer(int32) | — | تعداد فاکتورهای زمانبندی شده |
| `dueDateAfterHowManyDay` | integer(int32) | — | سررسید بعد از چند روز |
| `interval` | string | — | فاصله زمانی بین فاکتورها |
| `scheduleType` | integer `0`,`1`,`2`,`3` | — | نوع زمانبندی: 0 = روزانه 1 = هفتگی 2 = ماهانه 3 = سالانه |

### <a id="schema-invoiceschedulecreateresponseitem"></a>`InvoiceScheduleCreateResponseItem`

اطلاعات فاکتور زمانبندی شده ایجاد شده برای هر مشتری

اطلاعات فاکتور زمانبندی شده ایجاد شده برای هر مشتری
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کد یکتای فاکتور ایجاد شده |
| `customerCode` | string | — | کد یکتای مشتری |

### <a id="schema-invoicecustomercreateviewmodel"></a>`InvoiceCustomerCreateViewModel`

اطلاعات مشتری

اطلاعات مشتری
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — | کد یکتای مشتری |

### <a id="schema-scheduleinvoicewithchilds"></a>`ScheduleInvoiceWithChilds`

جزییات کامل فاکتور زمابندی شده

جزییات کامل فاکتور زمابندی شده
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `parentInvoice` | [`InvoiceDetailViewModel`](#schema-invoicedetailviewmodel) | — |  |
| `childInvoices` | array&lt;[InvoiceDetailViewModel](#schema-invoicedetailviewmodel)&gt; | — | فاکتورهای ساخته شده توسط فاکتور زمابندی والد |

### <a id="schema-invoicepaymentcoderesponse"></a>`InvoicePaymentCodeResponse`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `payCode` | string | — |  |

### <a id="schema-invoiceconfirmpaymentrequestviewmodel"></a>`InvoiceConfirmPaymentRequestViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `invoiceCode` | string | ✅ |  |
| `refId` | string | ✅ |  |

### <a id="schema-invoiceconfirmpaymentresponseviewmodel"></a>`InvoiceConfirmPaymentResponseViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `success` | boolean | — |  |
| `message` | string | — |  |
| `modelCode` | string | — |  |
| `refId` | string | — |  |
| `previewKey` | string | — |  |
| `invoice` | [`InvoiceInPublicShow`](#schema-invoiceinpublicshow) | — |  |

### <a id="schema-invoiceinpublicshow"></a>`InvoiceInPublicShow`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `previewKey` | string | — |  |
| `invoice` | [`InvoicePublicDetailViewModel`](#schema-invoicepublicdetailviewmodel) | — |  |
| `ownerInfo` | [`UserInfoInPublicShow`](#schema-userinfoinpublicshow) | — |  |

### <a id="schema-invoicepublicdetailviewmodel"></a>`InvoicePublicDetailViewModel`

جزییات فاکتور به صورت عمومی

جزییات فاکتور به صورت عمومی
نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `payedDateTime` | string(date-time) | — | تاریخ پرداخت |
| `canceledDateTime` | string(date-time) | — | تاریخ لغو |
| `expiredDateTime` | string(date-time) | — | تاریخ معوق شدن |
| `code` | string | — | کلید یکتای فاکتور |
| `parentCode` | string | — | کلید والد بودن فاکتور |
| `paymentCode` | string | — | کد یکتای پرداخت |
| `ccToes` | array&lt;[InvoiceCcToDetailViewModel](#schema-invoicecctodetailviewmodel)&gt; | — | لیست ایمیل |
| `billToes` | array&lt;[InvoiceBillToDetailViewModel](#schema-invoicebilltodetailviewmodel)&gt; | — | لیست مشتری |
| `status` | integer `0`,`1`,`2`,`3`,`4`,`5` | — | وضعیت فاکتور: 0 = پیش نویس 1 = در انتظار پرداخت 2 = پرداخت شد 3 = معوق 4 = لغو شده 5 = همه |
| `paidManualDescription` | string | — | شرح پرداخت دستی |
| `saveToTemplate` | boolean | — | ذخیره به عنوان قالب فاکتور |
| `invoiceNumber` | integer(int64) | — | شماره فاکتور |
| `invoiceTitle` | string | — | عنوان فاکتور |
| `invoiceDateTime` | string(date-time) | — | تاریخ ثبت |
| `dueDate` | string(date-time) | — | تاریخ سررسید |
| `subTotal` | number(double) | — | جمع مبلغ پرداختی آیتم های مالی |
| `itemsDiscountAmount` | number(double) | — | جمع مبلغ تخفیف آیتم های مالی |
| `totalDiscountAmount` | number(double) | — | مبلغ تخفیف به کل فاکتور |
| `totalDiscountPercent` | integer(int32) | — | درصد تخفیف به کل فاکتور |
| `totalDiscountType` | integer `0`,`1` | — | نوع تخفیف به کل فاکتور: 1 = مبلغ 0 = درصد |
| `sumDiscountAmount` | number(double) | — | جمع کل تخفیف اعمال شده روی فاکتور |
| `totalTaxtionAmount` | number(double) | — | مبلغ مالیات |
| `shipping` | number(double) | — | هزینه حمل و نقل |
| `total` | number(double) | — | مبلغ کل |
| `notes` | string | — | پیامی جهت نمایش به پرداخت کننده |
| `termsAndConditions` | string | — | متن شرایط و قوانین جهت نمایش به پرداخت کننده |
| `memo` | string | — | متن دلخواه جهت یادآوری فقط برای صادر کننده فاکتور |
| `invoiceSchulder` | [`InvoiceSchulderDetailViewModel`](#schema-invoiceschulderdetailviewmodel) | — |  |
| `invoiceItems` | array&lt;[InvoiceItemDetailViewModel](#schema-invoiceitemdetailviewmodel)&gt; | — | آیتم های مالی فاکتور |
| `isSendAttachmentsAfterPayment` | boolean | — | نمایش فایل های ضمیمه به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `isSendNotesAndTermsAfterPayment` | boolean | — | نمایش پیام به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `isSendTermsAfterPayment` | boolean | — | نمایش متن قوانین و مقررات به پرداخت کننده پس از پرداخت موفق = true, نمایش در قبل و بعد از پرداخت = false |
| `attachFileIds` | array&lt;string&gt; | — | لیست کلید یکتای فایل های ضمیمه |
| `attachFileAddresses` | array&lt;string&gt; | — | لیست آدرس فایل های ضمیمه |
| `qrCodeFileName` | string | — | آدرس تصویر بارکد فاکتور |

### <a id="schema-userinfoinpublicshow"></a>`UserInfoInPublicShow`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `name` | string | — |  |
| `profilePicture` | string | — |  |
| `isBusiness` | boolean | — |  |
| `verifyType` | integer(int32) | — |  |
| `socials` | [`SocialUserInfoExtraViewModel`](#schema-socialuserinfoextraviewmodel) | — |  |

### <a id="schema-socialuserinfoextraviewmodel"></a>`SocialUserInfoExtraViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `site` | string | — |  |
| `instagram` | string | — |  |
| `telegram` | string | — |  |
| `twitter` | string | — |  |
| `allSocialIsNull` | boolean | — |  |

### <a id="schema-fastinvoicecreaterequestviewmodel"></a>`FastInvoiceCreateRequestViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `number` | string | — |  |
| `title` | string | — |  |
| `dueDate` | string(date-time) | — |  |
| `customer` | [`InvoiceCustomerCreateViewModel`](#schema-invoicecustomercreateviewmodel) | — |  |
| `couponCode` | string | — |  |
| `discountAmount` | number(double) | — |  |
| `discountType` | [`DiscountType`](#schema-discounttype) | — |  |
| `shipping` | number(double) | — |  |
| `notes` | string | — |  |
| `termsAndConditions` | string | — |  |
| `memo` | string | — |  |
| `products` | array&lt;[InvoiceProductCreateViewModel](#schema-invoiceproductcreateviewmodel)&gt; | — |  |
| `sendAttachmentsAfterSuccessPayment` | boolean | — |  |
| `showNotesAfterSuccessPayment` | boolean | — |  |
| `showTermsAfterSuccessPayment` | boolean | — |  |
| `attachments` | array&lt;string&gt; | — |  |

### <a id="schema-discounttype"></a>`DiscountType`

نوع: `integer` | فرمت: `int32` | enum: `0`, `1`

### <a id="schema-invoiceproductcreateviewmodel"></a>`InvoiceProductCreateViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `title` | string | — |  |
| `description` | string | — |  |
| `haveTax` | boolean | — |  |
| `quantity` | number(double) | — |  |
| `discountAmount` | number(double) | — |  |
| `discountType` | [`DiscountType`](#schema-discounttype) | — |  |
| `couponCode` | string | — |  |
| `amount` | number(double) | — |  |

### <a id="schema-fastinvoicecreateresponseviewmodel"></a>`FastInvoiceCreateResponseViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | string | — |  |
| `payCode` | string | — |  |
| `customerCode` | string | — |  |

### <a id="schema-problemdetails"></a>`ProblemDetails`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

### <a id="schema-paymentproblemdetails"></a>`PaymentProblemDetails`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentProblemDetails_metaData`](#schema-paymentproblemdetails_metadata) | — |  |

### <a id="schema-paymentconflictproblemdetails"></a>`PaymentConflictProblemDetails`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |
| `paypingTraceId` | string | — |  |
| `metaData` | [`PaymentConflictProblemDetails_metaData`](#schema-paymentconflictproblemdetails_metadata) | — |  |

### <a id="schema-badrequesterrorinfo"></a>`BadRequestErrorInfo`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `message` | string | — |  |

### <a id="schema-basetransactionreport"></a>`BaseTransactionReport`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `clientsInfos` | array&lt;[ClientsInfo](#schema-clientsinfo)&gt; | — | لیست ClientId,ClientInfo |
| `filter` | array&lt;string&gt; | — | اعمال فیلتر بر روی فلگ های  کد پرداخت مبلغ تاریخ پرداخت کد ارسالی مشتری به پی‌پینگ توضیحات نام یا شناسه پرداخت کننده |
| `transactionType` | integer `6`,`7` | — | نوع تراکنش دریافت ها =6 پرداخت ها=7 |
| `fromDate` | string(date-time) | — | تاریخ شروع گزارش |
| `toDate` | string(date-time) | — | تاریخ پایان گزارش |

### <a id="schema-clientsinfo"></a>`ClientsInfo`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `clientId` | string | — |  |
| `clientRefId` | string | — |  |

### <a id="schema-createpaymentviewmodel"></a>`CreatePaymentViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | ✅ | مبلغ |
| `payerIdentity` | string | — | شماره موبایل یا ایمیل پرداخت کننده - اگر شماره موبایل وارد شود، تمام شماره کارت‌های ذخیره شده پرداخت‌کننده در درگاه، نمایش داده می‌شود. |
| `payerName` | string | — | نام پرداخت کننده |
| `description` | string | — | توضیحات |
| `returnUrl` | string | ✅ | آدرس صفحه برگشت |
| `clientRefId` | string | — | کد ارسالی توسط کاربر |

### <a id="schema-createmultipaymentviewmodel"></a>`CreateMultiPaymentViewModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `payerName` | string | — | نام پرداخت کننده |
| `pairs` | array&lt;[MultiPayPair](#schema-multipaypair)&gt; | — | لیست پرداخت ها |
| `returnUrl` | string | ✅ | آدرس صفحه برگشت |
| `clientRefId` | string | — | کد ارسالی توسط کاربر |

### <a id="schema-multipaypair"></a>`MultiPayPair`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int32) | ✅ | مبلغ |
| `name` | string | — | نام |
| `userIdentity` | string | ✅ | نام کاربری/ایمیل کاربری |
| `description` | string | — | توضیحات |

### <a id="schema-transactionreportmodel"></a>`TransactionReportModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `offset` | integer(int32) | — | نقطه شروع گزارش |
| `limit` | integer(int32) | — | نقطه پایان گزارش |
| `clientsInfos` | array&lt;[ClientsInfo](#schema-clientsinfo)&gt; | — | لیست ClientId,ClientInfo |
| `filter` | array&lt;string&gt; | — | اعمال فیلتر بر روی فلگ های  کد پرداخت مبلغ تاریخ پرداخت کد ارسالی مشتری به پی‌پینگ توضیحات نام یا شناسه پرداخت کننده |
| `transactionType` | integer `6`,`7` | — | نوع تراکنش دریافت ها =6 پرداخت ها=7 |
| `fromDate` | string(date-time) | — | تاریخ شروع گزارش |
| `toDate` | string(date-time) | — | تاریخ پایان گزارش |

### <a id="schema-accountownerinfo"></a>`AccountOwnerInfo`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `firstName` | string | — |  |
| `lastName` | string | — |  |

### <a id="schema-bankaccountstatusenum"></a>`BankAccountStatusEnum`

0 = Unknown

1 = Active

2 = BlockWithDeposit

3 = BlockWithoutDeposit

4 = Idle

0 = Unknown

1 = Active

2 = BlockWithDeposit

3 = BlockWithoutDeposit

4 = Idle
نوع: `integer` | فرمت: `int32` | enum: `0`, `1`, `2`, `3`, `4`

### <a id="schema-bankenum"></a>`BankEnum`

0 = Unknown (ناشناخته)

1 = CentralBank (بانک مرکزی)

2 = Melli (بانک ملی)

3 = Mellat (بانک ملت)

4 = Saman (بانک سامان)

5 = Ayandeh (بانک آینده)

6 = EghtesadNovin (بانک اقتصاد نوین)

7 = Sepah (بانک سپه)

8 = Tejarat (بانک تجارت)

9 = Pasargad (بانک پاسارگاد)

10 = Postbank (پست بانک ایران)

11 = Parsian (پست پارسیان)

12 = IranZamin (بانک ایران زمین)

13 = Keshvarzi (بانک کشاورزی)

14 = ToseeTaavon (بانک توسعه تعاون)

15 = ToseeSaderat (بانک توسعه توسعه صادرات)

16 = Dey (بانک دی)

17 = KhavarMianeh (بانک خاور میانه)

18 = Resalat (بانک رسالت)

19 = Sarmayeh (بانک سرمایه)

20 = Sina (بانک سینا)

21 = Shahr (بانک شهر)

22 = Saderat (بانک صادرات)

23 = SanatVaMadan (بانک صنعت و معدن)

24 = MehrIran (بانک مهر ایران)

25 = Refah (بانک رفاه)

26 = Gardeshgari (بانک گردشگری)

27 = Maskan (بانک مسکن)

28 = Kosar (موسسه مالی و اعتباری کوثر)

29 = Mellal (موسسه مالی و اعتباری ملل)

30 = EtebariTosee (موسسه مالی و اعتباری توسعه)

31 = KarAfarin (بانک کار آفرین)

32 = Noor (موسسه مالی و اعتباری نور)

33 = IranVenezuela (بانک ایران ونزوئلا)

0 = Unknown (ناشناخته)

1 = CentralBank (بانک مرکزی)

2 = Melli (بانک ملی)

3 = Mellat (بانک ملت)

4 = Saman (بانک سامان)

5 = Ayandeh (بانک آینده)

6 = EghtesadNovin (بانک اقتصاد نوین)

7 = Sepah (بانک سپه)

8 = Tejarat (بانک تجارت)

9 = Pasargad (بانک پاسارگاد)

10 = Postbank (پست بانک ایران)

11 = Parsian (پست پارسیان)

12 = IranZamin (بانک ایران زمین)

13 = Keshvarzi (بانک کشاورزی)

14 = ToseeTaavon (بانک توسعه تعاون)

15 = ToseeSaderat (بانک توسعه توسعه صادرات)

16 = Dey (بانک دی)

17 = KhavarMianeh (بانک خاور میانه)

18 = Resalat (بانک رسالت)

19 = Sarmayeh (بانک سرمایه)

20 = Sina (بانک سینا)

21 = Shahr (بانک شهر)

22 = Saderat (بانک صادرات)

23 = SanatVaMadan (بانک صنعت و معدن)

24 = MehrIran (بانک مهر ایران)

25 = Refah (بانک رفاه)

26 = Gardeshgari (بانک گردشگری)

27 = Maskan (بانک مسکن)

28 = Kosar (موسسه مالی و اعتباری کوثر)

29 = Mellal (موسسه مالی و اعتباری ملل)

30 = EtebariTosee (موسسه مالی و اعتباری توسعه)

31 = KarAfarin (بانک کار آفرین)

32 = Noor (موسسه مالی و اعتباری نور)

33 = IranVenezuela (بانک ایران ونزوئلا)
نوع: `integer` | فرمت: `int32` | enum: `0`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, `21`, `22`, `23`, `24`, `25`, `26`, `27`, `28`, `29`, `30`, `31`, `32`, `33`

### <a id="schema-cardtoownerinforesultmodel"></a>`CardToOwnerInfoResultModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `bankName` | [`BankEnum`](#schema-bankenum) | — |  |
| `accountStatus` | [`BankAccountStatusEnum`](#schema-bankaccountstatusenum) | — |  |
| `accountOwnerInfos` | array&lt;[AccountOwnerInfo](#schema-accountownerinfo)&gt; | — |  |

### <a id="schema-cardtoshebaresultmodel"></a>`CardToShebaResultModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `bankName` | [`BankEnum`](#schema-bankenum) | — |  |
| `shebaNumber` | string | — |  |

### <a id="schema-cardtodepositresultmodel"></a>`CardToDepositResultModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `bankName` | [`BankEnum`](#schema-bankenum) | — |  |
| `depositNumber` | string | — |  |

### <a id="schema-matchingresultmodel"></a>`MatchingResultModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `matched` | boolean | — |  |

### <a id="schema-shebatoownerresultmodel"></a>`ShebaToOwnerResultModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `shebaNumber` | string | — |  |
| `bankName` | [`BankEnum`](#schema-bankenum) | — |  |
| `accountStatus` | [`BankAccountStatusEnum`](#schema-bankaccountstatusenum) | — |  |
| `depositNumber` | string | — |  |
| `accountOwnerInfos` | array&lt;[AccountOwnerInfo](#schema-accountownerinfo)&gt; | — |  |

### <a id="schema-nationalcodetoownerresultmodel"></a>`NationalCodeToOwnerResultModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `NationalCode` | string | — |  |
| `FirstName` | string | — |  |
| `LastName` | string | — |  |
| `FatherName` | string | — |  |
| `BirthDate` | string | — |  |
| `Alive` | boolean | — |  |

### <a id="schema-postalcodeinformationresultmodel"></a>`PostalCodeInformationResultModel`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `City` | string | — |  |
| `Province` | string | — |  |
| `Township` | string | — |  |
| `Locality` | string | — |  |
| `Avenue` | string | — |  |
| `StopStreet` | string | — |  |
| `No` | integer(int32) | — |  |
| `Floor` | string | — |  |

### <a id="schema-unauthenticatedproblemdetails"></a>`UnauthenticatedProblemDetails`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

### <a id="schema-unauthorizedproblemdetails"></a>`UnauthorizedProblemDetails`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `type` | string | — |  |
| `title` | string | — |  |
| `status` | integer(int32) | — |  |
| `detail` | string | — |  |
| `instance` | string | — |  |

### <a id="schema-paymentproblemdetails_metadata"></a>`PaymentProblemDetails_metaData`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | integer(int32) | — |  |
| `errors` | array&lt;[BadRequestErrorInfo](#schema-badrequesterrorinfo)&gt; | — | لیست خطا |

### <a id="schema-paymentconflictproblemdetails_metadata_message"></a>`PaymentConflictProblemDetails_metaData_message`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `amount` | integer(int64) | — | مبلغ نهایی پرداخت |
| `cardNumber` | string | — | شماره کارت پرداخت کننده |
| `cardHashPan` | string | — | شماره کارت هش شده پرداخت کننده |
| `clientRefId` | string | — | شناسه ارجاع پذیرنده |
| `paymentRefId` | integer(int64) | — | کد رهگیری پرداخت |
| `code` | string | — | کد پرداخت |

### <a id="schema-paymentconflictproblemdetails_metadata"></a>`PaymentConflictProblemDetails_metaData`

نوع: `object`

| فیلد | نوع | الزامی | توضیحات |
|---|---|---|---|
| `code` | integer(int32) | — |  |
| `message` | [`PaymentConflictProblemDetails_metaData_message`](#schema-paymentconflictproblemdetails_metadata_message) | — |  |
