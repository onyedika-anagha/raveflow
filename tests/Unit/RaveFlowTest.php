<?php

namespace OnyedikaAnagha\RaveFlow\Tests\Unit;

use OnyedikaAnagha\RaveFlow\RaveFlow;
use OnyedikaAnagha\RaveFlow\Tests\TestCase;
use OnyedikaAnagha\RaveFlow\Exceptions\FlutterwaveException;

class RaveFlowTest extends TestCase
{
    protected RaveFlow $raveFlow;

    protected function setUp(): void
    {
        parent::setUp();
        $this->raveFlow = new RaveFlow();
    }

    /** @test */
    public function it_can_initialize_payment()
    {
        $data = [
            'amount' => 5000,
            'email' => 'customer@example.com',
            'tx_ref' => 'test_' . time(),
            'currency' => 'NGN',
            'payment_options' => 'card,banktransfer',
            'customer' => [
                'email' => 'customer@example.com',
                'name' => 'John Doe'
            ],
            'customizations' => [
                'title' => 'Test Payment',
                'description' => 'Test Payment Description'
            ]
        ];

        $response = $this->raveFlow->initiatePayment($data);
        
        $this->assertArrayHasKey('status', $response);
    }

    /** @test */
    public function it_can_verify_transaction()
    {
        $transactionId = 'test_transaction';
        
        $response = $this->raveFlow->verifyTransaction($transactionId);
        
        $this->assertArrayHasKey('status', $response);
    }

    /** @test */
    public function it_can_verify_webhook_signature()
    {
        $payload = ['event' => 'test'];
        $signature = hash_hmac('sha256', json_encode($payload), config('flutterwave.secret_key'));

        $isValid = $this->raveFlow->verifyWebhookSignature($signature, json_encode($payload));
        
        $this->assertTrue($isValid);
    }

    /** @test */
    public function it_throws_exception_on_invalid_payment()
    {
        $this->expectException(FlutterwaveException::class);

        $this->raveFlow->initiatePayment([]);
    }
} 