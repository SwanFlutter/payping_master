<?php

namespace SwanFlutter\PayPing\DTOs;

class VerifyPaymentRequest
{
    private int    $amount;
    private string $paymentCode;
    private int    $paymentRefId;

    public function __construct(int $amount, string $paymentCode, int $paymentRefId)
    {
        $this->amount       = $amount;
        $this->paymentCode  = $paymentCode;
        $this->paymentRefId = $paymentRefId;
    }

    public function toArray(): array
    {
        return [
            'amount'       => $this->amount,
            'paymentCode'  => $this->paymentCode,
            'paymentRefId' => $this->paymentRefId,
        ];
    }
}
