<?php

namespace SwanFlutter\PayPing\Services;

class PaymentService extends BaseService
{
    public function create(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v3', 'pay'), $data);
    }

    public function delete(string $paymentCode): array
    {
        return $this->client->request('DELETE', $this->buildUrl('v3', 'pay'), ['paymentCode' => $paymentCode]);
    }

    public function createShared(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v3', 'pay/shared'), $data);
    }

    public function getStartUrl(string $paymentCode): string
    {
        return $this->buildUrl('v3', 'pay/start/' . $paymentCode);
    }

    public function verify(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v3', 'pay/verify'), $data);
    }

    public function reverse(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v3', 'pay/reverse'), $data);
    }

    public function share(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v3', 'pay/share'), $data);
    }

    public function unblock(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v3', 'pay/unblock'), $data);
    }

    /**
     * ارسال اطلاعات پرداخت به پذیرنده — معمولاً به صورت خودکار توسط PayPing
     * پس از بازگشت از درگاه فراخوانی می‌شود و نیاز به فراخوانی از سمت پذیرنده نیست.
     */
    public function paid(int $refId, string $paymentCode): array
    {
        return $this->client->request('GET', $this->buildUrl('v3', "pay/paid/{$refId}/{$paymentCode}"));
    }

    public function paidNotify(int $refId, string $paymentCode): array
    {
        return $this->client->request('POST', $this->buildUrl('v3', "pay/paid/{$refId}/{$paymentCode}"));
    }
}
