<?php

namespace SwanFlutter\PayPing\Services;

class ProductService extends BaseService
{
    public function create(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v1', 'product'), $data);
    }

    public function update(array $data): array
    {
        return $this->client->request('PUT', $this->buildUrl('v1', 'product'), $data);
    }

    public function get(string $code): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', "product/{$code}"));
    }

    public function delete(string $code): array
    {
        return $this->client->request('DELETE', $this->buildUrl('v1', "product/{$code}"));
    }

    public function list(array $params = []): array
    {
        $queryString = http_build_query($params);
        return $this->client->request('GET', $this->buildUrl('v1', 'product/List') . ($queryString ? '?' . $queryString : ''));
    }
}
