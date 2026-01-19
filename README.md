# Laravel Paystack SDK

A comprehensive, scalable, and fully testable Paystack SDK for Laravel 11+ with complete API coverage.

## Features

- ✅ **Complete Paystack API Coverage**: All endpoints including Transactions, Customers, Subscriptions, Plans, Products, Transfers, Refunds, Disputes, Payment Pages, Payment Requests, Settlements, Charges, Invoices, and more
- ✅ **Type-Safe DTOs**: Immutable, strongly-typed request and response objects for all endpoints
- ✅ **Full Webhook Support**: Signature verification, event handling, and Laravel event dispatching
- ✅ **Comprehensive Exception Handling**: Specific exceptions for different error types
- ✅ **Pagination Support**: Built-in pagination handling with metadata
- ✅ **Fully Tested**: Comprehensive test suite with Pest PHP
- ✅ **Laravel 11+ Compatible**: Built for modern Laravel applications
- ✅ **Auto-Discovery**: Service provider automatically registered
- ✅ **Facade Support**: Easy access via Laravel facades
- ✅ **Production Ready**: Error handling, retries, logging, and more

## Installation

You can install the package via Composer:

```bash
composer require scwar/laravel-paystack
```

The package will automatically register its service provider and facade.

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=paystack-config
```

This will create a `config/paystack.php` file. Configure your Paystack keys in your `.env` file:

```env
PAYSTACK_SECRET_KEY=sk_test_xxxxx
PAYSTACK_PUBLIC_KEY=pk_test_xxxxx
PAYSTACK_BASE_URL=https://api.paystack.co
PAYSTACK_WEBHOOK_SECRET=xxxxx
PAYSTACK_TIMEOUT=30
PAYSTACK_RETRY_ATTEMPTS=3
PAYSTACK_ENABLE_LOGGING=false
```

## Usage

### Using the Facade

```php
use Scwar\LaravelPaystack\Facades\Paystack;

// Initialize a transaction
$transaction = Paystack::transaction()->initialize([
    'amount' => 10000, // Amount in kobo (smallest currency unit)
    'email' => 'customer@example.com',
    'reference' => 'unique_reference_123',
    'callback_url' => 'https://yourapp.com/callback',
]);

// Get authorization URL
$authorizationUrl = $transaction->data->authorizationUrl;

// Verify a transaction
$verified = Paystack::transaction()->verify('unique_reference_123');

// List transactions
$transactions = Paystack::transaction()->list([
    'perPage' => 50,
    'page' => 1,
]);
```

### Using Dependency Injection

```php
use Scwar\LaravelPaystack\Paystack;

class PaymentController extends Controller
{
    public function __construct(
        protected Paystack $paystack
    ) {}

    public function initialize(Request $request)
    {
        $transaction = $this->paystack->transaction()->initialize([
            'amount' => $request->amount,
            'email' => $request->email,
        ]);

        return redirect($transaction->data->authorizationUrl);
    }
}
```

## API Resources

### Transactions

```php
// Initialize transaction
$transaction = Paystack::transaction()->initialize([
    'amount' => 10000,
    'email' => 'customer@example.com',
]);

// Verify transaction
$verified = Paystack::transaction()->verify('reference');

// List transactions
$result = Paystack::transaction()->list(['perPage' => 50]);
$transactions = $result['data'];
$pagination = $result['pagination'];

// Fetch transaction
$transaction = Paystack::transaction()->fetch('id_or_reference');

// Charge authorization
$transaction = Paystack::transaction()->chargeAuthorization([
    'authorization_code' => 'AUTH_xxx',
    'email' => 'customer@example.com',
    'amount' => 10000,
]);

// Get transaction totals
$totals = Paystack::transaction()->totals();

// Export transactions
$export = Paystack::transaction()->export(['from' => '2024-01-01']);

// Get transaction timeline
$timeline = Paystack::transaction()->timeline('reference');
```

### Customers

```php
// Create customer
$customer = Paystack::customer()->create([
    'email' => 'customer@example.com',
    'first_name' => 'John',
    'last_name' => 'Doe',
    'phone' => '+2348123456789',
]);

// List customers
$result = Paystack::customer()->list(['perPage' => 50]);

// Fetch customer
$customer = Paystack::customer()->fetch('id_or_code');

// Update customer
$customer = Paystack::customer()->update('id_or_code', [
    'first_name' => 'Jane',
    'last_name' => 'Doe',
]);

// Set risk action
$customer = Paystack::customer()->setRiskAction('CUS_xxx', 'allow');

// Deactivate authorization
Paystack::customer()->deactivateAuthorization('AUTH_xxx');
```

### Subscriptions

```php
// Create subscription
$subscription = Paystack::subscription()->create([
    'customer' => 'CUS_xxx',
    'plan' => 'PLN_xxx',
]);

// List subscriptions
$result = Paystack::subscription()->list();

// Fetch subscription
$subscription = Paystack::subscription()->fetch('id_or_code');

// Enable subscription
Paystack::subscription()->enable('code', 'token');

// Disable subscription
Paystack::subscription()->disable('code', 'token');

// Generate update link
$link = Paystack::subscription()->generateUpdateLink('code');
```

### Plans

```php
// Create plan
$plan = Paystack::plan()->create([
    'name' => 'Monthly Plan',
    'amount' => 10000,
    'interval' => 'monthly',
    'currency' => 'NGN',
]);

// List plans
$result = Paystack::plan()->list();

// Fetch plan
$plan = Paystack::plan()->fetch('id_or_code');

// Update plan
$plan = Paystack::plan()->update('id_or_code', [
    'name' => 'Updated Plan Name',
]);
```

### Products

```php
// Create product
$product = Paystack::product()->create([
    'name' => 'Product Name',
    'description' => 'Product Description',
    'price' => 10000,
    'currency' => 'NGN',
]);

// List products
$result = Paystack::product()->list();

// Fetch product
$product = Paystack::product()->fetch('id');

// Update product
$product = Paystack::product()->update('id', [
    'name' => 'Updated Name',
]);
```

### Transfers

```php
// Initiate transfer
$transfer = Paystack::transfer()->initiate([
    'source' => 'balance',
    'amount' => 10000,
    'recipient' => 'RCP_xxx',
    'reason' => 'Payment for services',
]);

// List transfers
$result = Paystack::transfer()->list();

// Fetch transfer
$transfer = Paystack::transfer()->fetch('id_or_code');

// Finalize transfer
$transfer = Paystack::transfer()->finalize([
    'transfer_code' => 'TRF_xxx',
    'otp' => '123456',
]);

// Bulk transfer
$transfer = Paystack::transfer()->bulk([
    'currency' => 'NGN',
    'source' => 'balance',
    'transfers' => [
        ['amount' => 10000, 'recipient' => 'RCP_xxx'],
        ['amount' => 20000, 'recipient' => 'RCP_yyy'],
    ],
]);

// Verify transfer
$transfer = Paystack::transfer()->verify('reference');

// Resend OTP
Paystack::transfer()->resendOtp([
    'transfer_code' => 'TRF_xxx',
    'reason' => 'insufficient_funds',
]);

// Disable OTP
Paystack::transfer()->disableOtp();

// Enable OTP
Paystack::transfer()->enableOtp([
    'otp' => '123456',
]);
```

### Transfer Recipients

```php
// Create recipient
$recipient = Paystack::transferRecipient()->create([
    'type' => 'nuban',
    'name' => 'John Doe',
    'account_number' => '0123456789',
    'bank_code' => '058',
    'currency' => 'NGN',
]);

// List recipients
$result = Paystack::transferRecipient()->list();

// Fetch recipient
$recipient = Paystack::transferRecipient()->fetch('id_or_code');

// Update recipient
$recipient = Paystack::transferRecipient()->update('id_or_code', [
    'name' => 'Jane Doe',
]);

// Delete recipient
Paystack::transferRecipient()->delete('id_or_code');
```

### Verification

```php
// Resolve account number
$account = Paystack::verification()->resolveAccountNumber([
    'account_number' => '0123456789',
    'bank_code' => '058',
]);

// Resolve BVN
$bvn = Paystack::verification()->resolveBvn('12345678901');

// Resolve card BIN
$bin = Paystack::verification()->resolveCardBin('539983');

// Validate account
$validation = Paystack::verification()->validateAccount([
    'account_number' => '0123456789',
    'bank_code' => '058',
    'account_name' => 'John Doe',
]);
```

### Miscellaneous

```php
// Get balance
$balance = Paystack::miscellaneous()->balance();

// Get balance ledger
$ledger = Paystack::miscellaneous()->balanceLedger([
    'perPage' => 50,
    'page' => 1,
]);

// List banks
$banks = Paystack::miscellaneous()->banks(['country' => 'nigeria']);

// List countries
$countries = Paystack::miscellaneous()->countries();

// List states
$states = Paystack::miscellaneous()->states('nigeria');
```

## Webhooks

### Setting Up Webhooks

1. Configure your webhook secret in `.env`:
```env
PAYSTACK_WEBHOOK_SECRET=your_webhook_secret
```

2. The package automatically registers a webhook route at `/paystack/webhook` (configurable via `PAYSTACK_WEBHOOK_PREFIX`).

3. Listen to webhook events:

```php
use Scwar\LaravelPaystack\Webhooks\WebhookEvent;
use Illuminate\Support\Facades\Event;

Event::listen(WebhookEvent::class, function (WebhookEvent $event) {
    // Handle the webhook event
    $eventType = $event->event; // e.g., 'charge.success'
    $eventData = $event->data;
    
    // Process the event
    match($eventType) {
        'charge.success' => $this->handleSuccessfulCharge($eventData),
        'charge.failed' => $this->handleFailedCharge($eventData),
        default => null,
    };
});
```

### Webhook Middleware

The webhook route is automatically protected by the `WebhookMiddleware` which verifies the Paystack signature. Make sure your webhook secret matches the one configured in your Paystack dashboard.

## Exception Handling

The package provides specific exception types for different error scenarios:

```php
use Scwar\LaravelPaystack\Exceptions\{
    PaystackException,
    AuthenticationException,
    ValidationException,
    NotFoundException,
    ServerException,
    RateLimitException
};

try {
    $transaction = Paystack::transaction()->initialize([...]);
} catch (ValidationException $e) {
    // Handle validation errors
    $errors = $e->getErrors();
} catch (AuthenticationException $e) {
    // Handle authentication errors
} catch (NotFoundException $e) {
    // Handle not found errors
} catch (RateLimitException $e) {
    // Handle rate limit errors
} catch (PaystackException $e) {
    // Handle other Paystack errors
    $response = $e->getResponse();
}
```

## Pagination

List methods return pagination information:

```php
$result = Paystack::transaction()->list(['perPage' => 50, 'page' => 1]);

$transactions = $result['data'];
$pagination = $result['pagination'];

if ($pagination->hasNextPage()) {
    // Load next page
    $nextPage = $pagination->nextPage;
}

// Access pagination data
$total = $pagination->total;
$perPage = $pagination->perPage;
$currentPage = $pagination->currentPage;
$totalPages = $pagination->totalPages;
```

## Testing

The package includes comprehensive tests using Pest PHP. Run tests with:

```bash
composer test
```

Or with PHPUnit:

```bash
vendor/bin/phpunit
```

Tests are automatically run on every push and pull request via GitHub Actions.

## CI/CD

This package uses GitHub Actions for continuous integration and deployment:

### Tests Workflow
- Runs on every push and pull request
- Tests against PHP 8.2 and 8.3
- Tests against Laravel 11.x
- Runs on Ubuntu latest

### Version Bump Workflow
- Manually triggered workflow
- Creates a pull request with version bump
- Supports patch, minor, and major version bumps
- Updates `composer.json` and `CHANGELOG.md`

### Release Workflow
- Manually triggered workflow
- Bumps version automatically or uses specified version
- Creates Git tag
- Creates GitHub release
- Optionally publishes to Packagist

### Packagist Publishing
- Automatically triggered on GitHub release
- Can also be manually triggered
- Requires `PACKAGIST_TOKEN` and `PACKAGIST_USERNAME` secrets

### Required GitHub Secrets

For Packagist publishing, add these secrets to your GitHub repository:

- `PACKAGIST_TOKEN`: Your Packagist API token
- `PACKAGIST_USERNAME`: Your Packagist username

To get your Packagist token:
1. Go to https://packagist.org/profile/
2. Click "Show API Token"
3. Copy the token and add it as a GitHub secret

## Requirements

- PHP 8.2+
- Laravel 11.0+

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details on how to contribute to this project.

## Support

For issues, questions, or contributions, please open an issue on GitHub.

## Complete API Coverage

This SDK provides comprehensive coverage of the Paystack API:

### Core Resources
- ✅ **Transactions**: Initialize, verify, list, fetch, charge authorization, totals, export, timeline
- ✅ **Charges**: Create, submit PIN/OTP/phone/birthday/address, check pending
- ✅ **Customers**: Create, list, fetch, update, whitelist/blacklist, validate identification, manage authorizations
- ✅ **Subscriptions**: Create, list, fetch, enable, disable, generate update link
- ✅ **Plans**: Create, list, fetch, update
- ✅ **Products**: Create, list, fetch, update

### Payment Processing
- ✅ **Transfers**: Initiate, list, fetch, finalize, bulk, verify, OTP management
- ✅ **Transfer Recipients**: Create, list, fetch, update, delete
- ✅ **Refunds**: Create, list, fetch
- ✅ **Payment Pages**: Create, list, fetch, update, check slug availability
- ✅ **Payment Requests**: Create, list, fetch, update, verify, send notification, finalize, archive

### Advanced Features
- ✅ **Subaccounts**: Create, list, fetch, update
- ✅ **Splits**: Create, list, fetch, update, add/remove subaccount
- ✅ **Virtual Accounts**: Create dedicated account, assign, list, fetch, deactivate
- ✅ **Disputes**: List, fetch, update, export, add evidence, upload evidence URL
- ✅ **Settlements**: List, fetch
- ✅ **Authorizations**: List, fetch, check

### Utilities
- ✅ **Verification**: Resolve account number, BVN, card BIN, validate account
- ✅ **Apple Pay**: Register domain, list domains, unregister domain
- ✅ **Integration**: Get/update payment session timeout
- ✅ **Miscellaneous**: Balance, ledger, banks, countries, states

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.
