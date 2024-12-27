<?php

namespace OnyedikaAnagha\RaveFlow\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static object initializePayment(array $data)
 * @method static object verifyTransaction(string $transactionId)
 * @method static object verifyTransactionReference(string $reference)
 * @method static object getBanks(string $country = 'NG')
 * @method static object getBankBranches(string $bankId)
 * @method static object initiateTransfer(array $data)
 * @method static object getTransferFee(array $data)
 * @method static object getTransferStatus(string $reference)
 * @method static bool verifyWebhookSignature(string $signature = null, string $payload = null)
 * 
 * @see \OnyedikaAnagha\RaveFlow\RaveFlow
 */
class RaveFlow extends Facade
{
    /**
     * Get the registered name of the component
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'raveflow';
    }
} 