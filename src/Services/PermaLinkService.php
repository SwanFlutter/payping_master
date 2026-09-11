<?php

namespace SwanFlutter\PayPing\Services;

class PermaLinkService extends BaseService
{
    public function create(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v1', 'permalink'), $data);
    }

    public function update(array $data): array
    {
        return $this->client->request('PUT', $this->buildUrl('v1', 'permalink'), $data);
    }

    public function get(string $code): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', "permalink/{$code}"));
    }

    public function delete(string $code): array
    {
        return $this->client->request('DELETE', $this->buildUrl('v1', "permalink/{$code}"));
    }

    public function buyers(string $productCode, array $params = []): array
    {
        $queryString = http_build_query($params);
        return $this->client->request('GET', $this->buildUrl('v1', "permalink/{$productCode}/BuyersList") . ($queryString ? '?' . $queryString : ''));
    }

    public function buyersCount(string $productCode): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', "permalink/{$productCode}/BuyersListCount"));
    }

    public function getBuyer(string $payCode): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', "permalink/{$payCode}/Buyer"));
    }
}
