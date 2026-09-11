<?php

namespace ShareXOS\PayPing\Services;

class InvoiceService extends BaseService
{
    public function create(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v2', 'invoice'), $data);
    }

    public function send(string $code): array
    {
        return $this->client->request('POST', $this->buildUrl('v2', "invoice/Send/{$code}"));
    }

    public function get(string $code): array
    {
        return $this->client->request('GET', $this->buildUrl('v2', "invoice/{$code}"));
    }

    public function update(string $code, array $data): array
    {
        return $this->client->request('PUT', $this->buildUrl('v2', "invoice/{$code}"), $data);
    }

    public function archive(string $code): array
    {
        return $this->client->request('POST', $this->buildUrl('v2', "invoice/Archive/{$code}"));
    }

    public function deArchive(string $code): array
    {
        return $this->client->request('POST', $this->buildUrl('v2', "invoice/DeArchive/{code}"));
    }

    public function getPdf(string $code): array
    {
        return $this->client->request('GET', $this->buildUrl('v2', "invoice/Pdf/{$code}"));
    }

    public function list(array $params = []): array
    {
        $queryString = http_build_query($params);
        return $this->client->request('GET', $this->buildUrl('v2', 'invoice/List') . ($queryString ? '?' . $queryString : ''));
    }

    public function count(array $params = []): array
    {
        $queryString = http_build_query($params);
        return $this->client->request('GET', $this->buildUrl('v2', 'invoice/ListCount') . ($queryString ? '?' . $queryString : ''));
    }

    public function copy(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v2', 'invoice/Copy'), $data);
    }

    public function cancel(string $code): array
    {
        return $this->client->request('POST', $this->buildUrl('v2', 'invoice/Cancel'), ['code' => $code]);
    }

    public function reminder(string $code): array
    {
        return $this->client->request('POST', $this->buildUrl('v2', "invoice/Reminder/{$code}"));
    }

    public function getPaymentCode(string $code, string $couponCode = ''): array
    {
        $url = $this->buildUrl('v2', 'invoice/PaymentCode') . "?Code={$code}";
        if ($couponCode) {
            $url .= "&CouponCode={$couponCode}";
        }
        return $this->client->request('GET', $url);
    }

    public function confirmPayment(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v2', 'invoice/ConfirmPayment'), $data);
    }

    public function fastInvoice(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v2', 'invoice/FastInvoice'), $data);
    }

    public function schedule(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v2', 'invoice/Schedule'), $data);
    }

    public function cancelSchedule(string $code): array
    {
        return $this->client->request('POST', $this->buildUrl('v2', 'invoice/CancelSchedule'), ['code' => $code]);
    }

    public function getSchedule(string $code): array
    {
        return $this->client->request('GET', $this->buildUrl('v2', "invoice/Schedule/{$code}"));
    }
}
