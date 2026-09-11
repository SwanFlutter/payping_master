<?php

namespace ShareXOS\PayPing;

class HttpClient
{
    private string $token;
    private int $timeout;
    private bool $testMode;

    public function __construct(string $token, int $timeout = 45, bool $testMode = false)
    {
        $this->token = $token;
        $this->timeout = $timeout;
        $this->testMode = $testMode;
    }

    /**
     * @throws PayPingException
     */
    public function request(string $method, string $url, array $body = [], array $headers = []): array
    {
        $method = strtoupper($method);

        $defaultHeaders = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Bearer ' . $this->token,
        ];

        $curl = curl_init();

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array_merge($defaultHeaders, $headers),
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_SSL_VERIFYPEER => true,
        ];

        if ($method === 'POST') {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = json_encode($body);
        } elseif ($method === 'PUT') {
            $options[CURLOPT_CUSTOMREQUEST] = 'PUT';
            $options[CURLOPT_POSTFIELDS] = json_encode($body);
        } elseif ($method === 'DELETE') {
            $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
            if (!empty($body)) {
                $options[CURLOPT_POSTFIELDS] = json_encode($body);
            }
        }

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlErr = curl_error($curl);
        curl_close($curl);

        if ($curlErr) {
            throw new PayPingException('Connection error: ' . $curlErr, 0);
        }

        $data = json_decode($response, true) ?? [];

        if ($httpCode >= 200 && $httpCode < 300) {
            return $data;
        }

        $message = $data['title'] ?? ($data['message'] ?? 'HTTP ' . $httpCode);
        $errors = [];
        if (isset($data['metaData']['errors']) && is_array($data['metaData']['errors'])) {
            foreach ($data['metaData']['errors'] as $err) {
                $errors[] = $err['message'] ?? '';
            }
        }

        if (!empty($errors)) {
            $message .= ': ' . implode(' | ', $errors);
        }

        throw new PayPingException($message, $httpCode, $errors);
    }
}
