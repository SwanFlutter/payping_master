<?php

namespace SwanFlutter\PayPing\Services;

class BnplService extends BaseService
{
    public function changeWalletCredit(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v1', 'bnpl/merchant/contract/change-wallet-credit-amount'), $data);
    }

    public function getOptions(): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', 'bnpl/merchant/options/get'));
    }

    public function createOrder(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v1', 'bnpl/merchant/order/create'), $data);
    }

    public function listOrders(array $params = []): array
    {
        $queryString = http_build_query($params);
        return $this->client->request('GET', $this->buildUrl('v1', 'bnpl/merchant/order/list') . ($queryString ? '?' . $queryString : ''));
    }

    public function getOrder(string $trackingCode = '', string $clientRefId = ''): array
    {
        $params = http_build_query([
            'trackingCode' => $trackingCode,
            'clientRefId' => $clientRefId
        ]);
        return $this->client->request('GET', $this->buildUrl('v1', 'bnpl/merchant/order/detail') . '?' . $params);
    }

    public function listPlans(): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', 'bnpl/merchant/plan/list'));
    }

    public function togglePlan(array $data): array
    {
        return $this->client->request('PUT', $this->buildUrl('v1', 'bnpl/merchant/plan/toggle-active'), $data);
    }
}
