<?php

namespace SwanFlutter\PayPing\Services;

use SwanFlutter\PayPing\HttpClient;

abstract class BaseService
{
    protected HttpClient $client;
    protected string $baseUrl = 'https://api.payping.ir/';

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    protected function buildUrl(string $version, string $endpoint): string
    {
        return $this->baseUrl . $version . '/' . ltrim($endpoint, '/');
    }
}
