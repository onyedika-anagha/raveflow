# Webhook Integration

Webhooks provide real-time notifications about transaction status changes.

## Setup

1. Configure your webhook URL in Flutterwave Dashboard:

   - Go to Settings > Webhooks
   - Add your webhook URL: `https://your-domain.com/webhook/flutterwave`
   - Save your webhook secret

2. Add webhook secret to your `.env`:

```
FLW_WEBHOOK_SECRET=your_webhook_secret
```

## Implementation

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OnyedikaAnagha\RaveFlow\Facades\RaveFlow;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Verify webhook signature
        if (!RaveFlow::verifyWebhookSignature(
            $request->header('verif-hash'),
            $request->getContent()
        )) {
            return response()->json(['status' => 'Invalid signature'], 401);
        }

        $payload = $request->all();

        // Handle different event types
        switch ($payload['event']) {
            case 'charge.completed':
                $this->handleCompletedCharge($payload['data']);
                break;
            case 'transfer.completed':
                $this->handleCompletedTransfer($payload['data']);
                break;
            // Add other event types as needed
        }

        return response()->json(['status' => 'Processed']);
    }

    private function handleCompletedCharge($data)
    {
        // Verify transaction
        $verification = RaveFlow::verifyTransaction($data['id']);

        if ($verification['status'] === 'success') {
            // Update your database
            // Give value to customer
            logger()->info('Payment completed via webhook', $data);
        }
    }
}
```

## Route Configuration

1. Add the webhook route in `routes/web.php`:

```php
Route::post('webhook/flutterwave', [WebhookController::class, 'handleWebhook']);
```

2. Exclude webhook URL from CSRF protection in `app/Http/Middleware/VerifyCsrfToken.php`:

```php
protected $except = [
    'webhook/flutterwave'
];
```

## Security Best Practices

1. Always verify webhook signatures
2. Process webhooks asynchronously for better performance
3. Implement idempotency to prevent duplicate processing
4. Store raw webhook data for debugging
5. Use HTTPS for webhook endpoints
