<?php

namespace ShareXOS\PayPing\DTOs;

class CreatePaymentRequest
{
    private int    $amount;
    private string $returnUrl;
    private string $clientRefId  = '';
    private string $description  = '';
    private string $payerName    = '';
    private string $payerIdentity = '';
    private bool   $isReversible = false;
    private bool   $isBlocked    = false;

    public function __construct(int $amount, string $returnUrl)
    {
        $this->amount    = $amount;
        $this->returnUrl = $returnUrl;
    }

    public function setClientRefId(string $refId): static
    {
        $this->clientRefId = $refId;
        return $this;
    }

    public function setDescription(string $desc): static
    {
        $this->description = $desc;
        return $this;
    }

    public function setPayerName(string $name): static
    {
        $this->payerName = $name;
        return $this;
    }

    public function setPayerIdentity(string $identity): static
    {
        $this->payerIdentity = $identity;
        return $this;
    }

    public function setReversible(bool $reversible): static
    {
        $this->isReversible = $reversible;
        return $this;
    }

    public function setBlocked(bool $blocked): static
    {
        $this->isBlocked = $blocked;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter([
            'amount'        => $this->amount,
            'returnUrl'     => $this->returnUrl,
            'clientRefId'   => $this->clientRefId,
            'description'   => $this->description,
            'payerName'     => $this->payerName,
            'payerIdentity' => $this->payerIdentity,
            'isReversible'  => $this->isReversible,
            'IsBlocked'     => $this->isBlocked,
        ]);
    }
}
