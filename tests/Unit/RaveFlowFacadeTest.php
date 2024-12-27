<?php

namespace OnyedikaAnagha\RaveFlow\Tests\Unit;

use OnyedikaAnagha\RaveFlow\Tests\TestCase;
use OnyedikaAnagha\RaveFlow\Facades\RaveFlow;

class RaveFlowFacadeTest extends TestCase
{
    /** @test */
    public function it_can_use_facade_to_initialize_payment()
    {
        $data = [
            'amount' => 5000,
            'email' => 'customer@example.com',
            'tx_ref' => 'test_' . time(),
            'currency' => 'NGN'
        ];

        $response = RaveFlow::initiatePayment($data);
        
        $this->assertArrayHasKey('status', $response);
    }

    /** @test */
    public function it_can_use_facade_to_verify_transaction()
    {
        $response = RaveFlow::verifyTransaction('test_transaction');
        
        $this->assertArrayHasKey('status', $response);
    }
} 