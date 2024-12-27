# Callback Verification

## Implementation

```php
<?php

namespace App\Http\Controllers;

use OnyedikaAnagha\RaveFlow\Facades\RaveFlow;

class PaymentController extends Controller
{
    public function handleCallback()
    {
        try {
            $transactionId = request()->transaction_id;
            $verification = RaveFlow::verifyTransaction($transactionId);

            if ($verification['status'] === 'success') {
                // Verify transaction details
                $amount = $verification['data']['amount'];
                $currency = $verification['data']['currency'];
                $txRef = $verification['data']['tx_ref'];

                // Retrieve original transaction from your database
                $originalTx = Transaction::where('reference', $txRef)->first();

                if (
                    $originalTx &&
                    $amount === $originalTx->amount &&
                    $currency === $originalTx->currency
                ) {
                    // Update transaction status
                    $originalTx->update([
                        'status' => 'completed',
                        'payment_data' => $verification['data']
                    ]);

                    // Process order/give value
                    return redirect()->route('payment.success');
                }
            }

            return redirect()->route('payment.failed');
        } catch (\Exception $e) {
            logger()->error('Payment verification failed: ' . $e->getMessage());
            return redirect()->route('payment.failed');
        }
    }
}
```

## Important Verification Steps

1. Verify transaction status is "successful"
2. Confirm the currency matches your original transaction
3. Verify the amount matches your original transaction
4. Update your database with the transaction status
5. Give value to your customer only after verification

## Route Setup

Add this to your `routes/web.php`:

```php
Route::get('/payment/callback', [PaymentController::class, 'handleCallback'])
    ->name('payment.callback');
```

Remember to include this callback URL when initializing payments:

```php
$data = [
    // ... other payment data
    'redirect_url' => route('payment.callback'),
];
```
