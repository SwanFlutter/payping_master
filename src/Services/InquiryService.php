<?php

namespace ShareXOS\PayPing\Services;

class InquiryService extends BaseService
{
    public function cardOwner(string $cardNumber): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', 'inquiry/Cards/card-to-owner-info-inquiry') . "?cardNumber={$cardNumber}");
    }

    public function cardToSheba(string $cardNumber): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', 'inquiry/Cards/card-to-sheba-inquiry') . "?cardNumber={$cardNumber}");
    }

    public function cardToDeposit(string $cardNumber): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', 'inquiry/Cards/card-to-deposit-inquiry') . "?cardNumber={$cardNumber}");
    }

    public function matchCard(string $cardNumber, string $nationalCode, string $birthDate): array
    {
        $params = http_build_query([
            'cardNumber' => $cardNumber,
            'nationalCode' => $nationalCode,
            'birthDate' => $birthDate
        ]);
        return $this->client->request('GET', $this->buildUrl('v1', 'inquiry/Matching/nationalCode-with-card') . '?' . $params);
    }

    public function matchSheba(string $sheba, string $nationalCode, string $birthDate): array
    {
        $params = http_build_query([
            'sheba' => $sheba,
            'nationalCode' => $nationalCode,
            'birthDate' => $birthDate
        ]);
        return $this->client->request('GET', $this->buildUrl('v1', 'inquiry/Matching/nationalCode-with-sheba') . '?' . $params);
    }

    public function shebaOwner(string $sheba): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', 'inquiry/Sheba/sheba-owner-info') . "?sheba={$sheba}");
    }

    public function matchMobile(string $mobileNumber, string $nationalCode): array
    {
        $params = http_build_query([
            'mobileNumber' => $mobileNumber,
            'nationalCode' => $nationalCode
        ]);
        return $this->client->request('GET', $this->buildUrl('v1', 'inquiry/Matching/nationalcode-with-mobile') . '?' . $params);
    }

    public function identity(string $nationalCode, string $birthDate): array
    {
        $params = http_build_query([
            'nationalCode' => $nationalCode,
            'birthDate' => $birthDate
        ]);
        return $this->client->request('GET', $this->buildUrl('v1', 'inquiry/NationalCode/inquiry-with-personal-info') . '?' . $params);
    }

    public function postalCode(string $postalCode): array
    {
        return $this->client->request('GET', $this->buildUrl('v1', 'inquiry/PostalCode/inquiry-postal-code') . "?postalCode={$postalCode}");
    }
}
