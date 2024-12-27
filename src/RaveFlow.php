<?php

namespace OnyedikaAnagha\RaveFlow;

use GuzzleHttp\Client;
use OnyedikaAnagha\RaveFlow\Exceptions\FlutterwaveException;

class RaveFlow
{
    protected $client;
    protected $secretKey;
    protected $publicKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->secretKey = config('flutterwave.secret_key');
        $this->publicKey = config('flutterwave.public_key');
        $this->baseUrl = config('flutterwave.is_production') 
            ? 'https://api.flutterwave.com/v3'
            : 'https://api.flutterwave.com/v3';

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function initiatePayment(array $data)
    {
        try {
            $response = $this->client->post('/payments', [
                'json' => array_merge($data, [
                    'public_key' => $this->publicKey,
                ]),
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            throw new FlutterwaveException($e->getMessage());
        }
    }

    public function verifyTransaction($transactionId)
    {
        try {
            $response = $this->client->get("/transactions/{$transactionId}/verify");
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            throw new FlutterwaveException($e->getMessage());
        }
    }

    public function verifyWebhookSignature($signature, $payload)
    {
        $computedSignature = hash_hmac('sha256', json_encode($payload), $this->secretKey);
        return hash_equals($signature, $computedSignature);
    }
}