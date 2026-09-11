# Implementation Plan - Laravel/PHP Package for PayPing v3

This plan outlines the steps to transform the current pure PHP library into a comprehensive Laravel-supported package that implements all PayPing API services as documented in `payping-docs (1).md`.

## User Review Required

> [!IMPORTANT]
> The package will be refactored to support multiple modules (Payment, Products, Invoices, etc.). The main `PayPing` class will act as a gateway to these services.

## Proposed Changes

### Project Configuration

#### [MODIFY] [composer.json](file:///G:/xampp/htdocs/sharexos/payping-master/composer.json)
- Update `name` to `sharexos/payping` (standardizing).
- Add `illuminate/support` to `require-dev` or `require` if we want to provide built-in Laravel features (better to keep it in `extra` for standalone use but provide a ServiceProvider).
- Add Laravel auto-discovery in `extra` section.

#### [NEW] [payping.php](file:///G:/xampp/htdocs/sharexos/payping-master/config/payping.php)
- Create a default configuration file for Laravel.

### Core Architecture

#### [MODIFY] [PayPing.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/PayPing.php)
- Refactor to act as a manager.
- Add methods: `payment()`, `withdraw()`, `report()`, `product()`, `permalink()`, `coupon()`, `customer()`, `invoice()`, `inquiry()`, `bnpl()`.
- Move the core CURL logic to a trait or a base `HttpClient` class.

#### [NEW] [HttpClient.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/HttpClient.php)
- Extracted logic for making requests, handling headers, and parsing errors.

#### [NEW] [BaseService.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/Services/BaseService.php)
- Base class for all services providing access to the `HttpClient`.

### Modules Implementation (src/Services)

#### [NEW] Service Classes
- [PaymentService.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/Services/PaymentService.php) (Includes v3 payment, shared, verify, reverse, unblock)
- [WithdrawService.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/Services/WithdrawService.php)
- [ReportService.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/Services/ReportService.php)
- [ProductService.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/Services/ProductService.php)
- [PermaLinkService.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/Services/PermaLinkService.php)
- [CouponService.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/Services/CouponService.php)
- [CustomerService.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/Services/CustomerService.php)
- [InvoiceService.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/Services/InvoiceService.php)
- [InquiryService.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/Services/InquiryService.php) (Bank and Identity inquiry)
- [BnplService.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/Services/BnplService.php)

### Data Transfer Objects (DTOs)

#### [NEW] DTO Classes
- Create specialized Request and Response classes for each major endpoint to ensure type safety and ease of use (e.g., `CreateInvoiceRequest`, `CustomerDTO`, etc.).

### Laravel Integration

#### [NEW] [PayPingServiceProvider.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/Laravel/PayPingServiceProvider.php)
- Register the `PayPing` class in the container.
- Handle config publishing.

#### [NEW] [PayPing.php](file:///G:/xampp/htdocs/sharexos/payping-master/src/Laravel/Facades/PayPing.php)
- Laravel Facade for the main `PayPing` class.

## Verification Plan

### Automated Tests
- Create unit tests for each service using PHPUnit.
- Mock the API responses using a mock HTTP client.
- Run `./vendor/bin/phpunit` (after setting up the test environment).

### Manual Verification
- Test in a fresh Laravel project by linking the package locally.
- Verify that `config/payping.php` can be published.
- Verify that the Facade works: `PayPing::payment()->create(...)`.
