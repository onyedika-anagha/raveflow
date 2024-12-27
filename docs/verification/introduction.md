# Payment Verification

When a payment is completed, Flutterwave provides two methods to verify the transaction status:

1. **Callback URL Verification**: Flutterwave redirects back to your specified callback URL with transaction details
2. **Webhook Notifications**: Flutterwave sends a POST request to your webhook URL with transaction details

It's important to verify all transactions before giving value to your customers. You should implement at least one of these methods, though implementing both provides better security and reliability.

## Best Practices

1. Always verify transaction amount and currency
2. Check transaction status is "successful"
3. Store and verify transaction reference
4. Implement idempotency to prevent double-processing
5. Log all verification attempts

## Available Verification Methods

- [Callback Verification](/verification/callback.html)
- [Webhook Notifications](/verification/webhook.html)
