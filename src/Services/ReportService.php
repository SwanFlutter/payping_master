<?php

namespace SwanFlutter\PayPing\Services;

class ReportService extends BaseService
{
    public function transactions(array $data = []): array
    {
        return $this->client->request('POST', $this->buildUrl('v1', 'report/TransactionReport'), $data);
    }

    public function transactionsCount(array $data = []): array
    {
        return $this->client->request('POST', $this->buildUrl('v1', 'report/TransactionReportCount'), $data);
    }

    public function withdraws(array $data = []): array
    {
        return $this->client->request('POST', $this->buildUrl('v1', 'report/WithdrawTransactions'), $data);
    }

    public function withdrawsCount(array $data = []): array
    {
        return $this->client->request('POST', $this->buildUrl('v1', 'report/WithdrawTransactionsCount'), $data);
    }

    public function get(string $code): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', "report/{$code}"));
    }
}
