<?php

namespace SwanFlutter\PayPing;

/**
 * Parses the PayPing v3 payment callback payload.
 *
 * PayPing v3 sends the callback data to the merchant's returnUrl as a
 * form-urlencoded POST containing three top-level fields:
 *
 *     status     => "1" | "0"
 *     errorCode  => ""    (empty on success)
 *     data       => JSON-encoded string with the actual payment details:
 *                   {"clientRefId":"...","paymentCode":"...","paymentRefId":123,"amount":1000,...}
 *
 * This helper also stays backward compatible with the legacy format where
 * the fields were posted directly at the top level.
 */
class CallbackParser
{
    /**
     * Parse the current HTTP request payload ($_POST / $_GET).
     *
     * @return array<string, mixed>
     */
    public static function fromGlobals(): array
    {
        return self::parse(array_merge((array)$_GET, (array)$_POST));
    }

    /**
     * Parse a callback payload array (e.g. Laravel: $request->all()).
     *
     * @param array<string, mixed> $payload
     * @return array{status: int, errorCode: string, clientRefId: string|null, paymentCode: string|null, paymentRefId: int|null, amount: int|null, gatewayAmount: int|null, cardNumber: string|null, cardHashPan: string|null}
     */
    public static function parse(array $payload): array
    {
        $data = $payload;

        // v3 format: the payment details are JSON-encoded inside the "data" field.
        if (isset($payload['data']) && is_string($payload['data'])) {
            $decoded = json_decode($payload['data'], true);
            if (is_array($decoded)) {
                // Top-level fields (status, errorCode, legacy direct fields) win;
                // the decoded "data" object fills in the payment details.
                $data = $payload + $decoded;
            }
        }

        return [
            'status'        => (int)($data['status'] ?? 0),
            'errorCode'     => (string)($data['errorCode'] ?? ''),
            'clientRefId'   => isset($data['clientRefId']) ? trim((string)$data['clientRefId']) : null,
            'paymentCode'   => isset($data['paymentCode']) ? trim((string)$data['paymentCode']) : null,
            'paymentRefId'  => isset($data['paymentRefId']) && $data['paymentRefId'] !== '' && $data['paymentRefId'] !== null
                ? (int)$data['paymentRefId']
                : null,
            'amount'        => isset($data['amount']) && $data['amount'] !== '' && $data['amount'] !== null
                ? (int)$data['amount']
                : null,
            'gatewayAmount' => isset($data['gatewayAmount']) && $data['gatewayAmount'] !== '' && $data['gatewayAmount'] !== null
                ? (int)$data['gatewayAmount']
                : null,
            'cardNumber'    => isset($data['cardNumber']) ? trim((string)$data['cardNumber']) : null,
            'cardHashPan'   => isset($data['cardHashPan']) ? trim((string)$data['cardHashPan']) : null,
        ];
    }

    /**
     * Whether the parsed callback represents a successful payment.
     */
    public static function isSuccessful(array $parsed): bool
    {
        return ($parsed['status'] ?? 0) === 1;
    }
}
