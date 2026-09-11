<?php

namespace ShareXOS\PayPing\Services;

class CouponService extends BaseService
{
    public function create(array $data): array
    {
        return $this->client->request('POST', $this->buildUrl('v1', 'coupon'), $data);
    }

    public function update(array $data): array
    {
        return $this->client->request('PUT', $this->buildUrl('v1', 'coupon'), $data);
    }

    public function get(string $code): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', "coupon/{$code}"));
    }

    public function delete(string $code): array
    {
        return $this->client->request('DELETE', $this->buildUrl('v1', "coupon/{$code}"));
    }

    public function list(array $params = []): array
    {
        $queryString = http_build_query($params);
        return $this->client->request('GET', $this->buildUrl('v1', 'coupon/List') . ($queryString ? '?' . $queryString : ''));
    }

    public function count(array $params = []): array
    {
        $queryString = http_build_query($params);
        return $this->client->request('GET', $this->buildUrl('v1', 'coupon/ListCount') . ($queryString ? '?' . $queryString : ''));
    }

    public function buyersCount(string $couponCode): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', "coupon/{$couponCode}/BuyersListCount"));
    }

    public function buyers(string $couponCode, array $params = []): array
    {
        $queryString = http_build_query($params);
        return $this->client->request('GET', $this->buildUrl('v1', "coupon/{$couponCode}/BuyersList") . ($queryString ? '?' . $queryString : ''));
    }
}
