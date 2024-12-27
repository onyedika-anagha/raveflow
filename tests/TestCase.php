<?php

namespace OnyedikaAnagha\RaveFlow\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        // Setup default configuration
        $this->app['config']->set('flutterwave.public_key', 'FLWPUBK-xxxxxxxxxxxxxxxxxxxxx-X');
        $this->app['config']->set('flutterwave.secret_key', 'FLWSECK-xxxxxxxxxxxxxxxxxxxxx-X');
        $this->app['config']->set('flutterwave.encryption_key', 'xxxxxxxxxxxxxxxxxxxxx');
    }

    protected function getPackageProviders($app)
    {
        return [
            'OnyedikaAnagha\RaveFlow\RaveFlowServiceProvider'
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'RaveFlow' => 'OnyedikaAnagha\RaveFlow\Facades\RaveFlow'
        ];
    }
}
