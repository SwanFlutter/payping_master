<?php

namespace ShareXOS\PayPing\Services;

class CustomerService extends BaseService
{
    public function create(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v1', 'customer'), $data);
    }

    public function get(string $code): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', "customer/{$code}"));
    }

    public function update(string $code, array $data): array
    {
        return $this->client->request('PUT', $this->buildUrl('v1', "customer/{$code}"), $data);
    }

    public function delete(string $code): array
    {
        return $this->client->request('DELETE', $this->buildUrl('v1', "customer/{$code}"));
    }

    public function list(array $params = []): array
    {
        $queryString = http_build_query($params);
        return $this->client->request('GET', $this->buildUrl('v1', 'customer/List') . ($queryString ? '?' . $queryString : ''));
    }

    public function count(array $params = []): array
    {
        $queryString = http_build_query($params);
        return $this->client->request('GET', $this->buildUrl('v1', 'customer/ListCount') . ($queryString ? '?' . $queryString : ''));
    }
}
