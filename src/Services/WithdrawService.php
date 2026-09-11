<?php

namespace SwanFlutter\PayPing\Services;

class WithdrawService extends BaseService
{
    public function create(int $amount): array
    {
        return $this->client->request('POST', $this->buildUrl('v1', "withdraw/{$amount}"));
    }

    public function get(string $code): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', "withdraw/{$code}"));
    }
}
