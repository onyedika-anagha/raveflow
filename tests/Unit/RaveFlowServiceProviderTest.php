<?php

namespace OnyedikaAnagha\RaveFlow\Tests\Unit;

use OnyedikaAnagha\RaveFlow\Tests\TestCase;
use OnyedikaAnagha\RaveFlow\RaveFlow;

class RaveFlowServiceProviderTest extends TestCase
{
    /** @test */
    public function it_can_resolve_raveflow_from_container()
    {
        $this->assertInstanceOf(
            RaveFlow::class,
            $this->app->make('raveflow')
        );
    }

    /** @test */
    public function it_registers_config_file()
    {
        $this->assertArrayHasKey('flutterwave', $this->app['config']);
        $this->assertEquals(
            'FLWPUBK-xxxxxxxxxxxxxxxxxxxxx-X',
            config('flutterwave.public_key')
        );
    }

    /** @test */
    public function it_registers_facade()
    {
        $this->assertTrue(
            class_exists('OnyedikaAnagha\RaveFlow\Facades\RaveFlow')
        );
    }
} 