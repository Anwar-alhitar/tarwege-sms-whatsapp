Below is an updated version of the README that reflects usage based on the provided class structure and the Guzzle-based API client implementation.

```markdown
# Tarwege SMS & WhatsApp API Client

Official PHP client for Tarwege's SMS & WhatsApp API with first-class Laravel support. Use your SIM to send SMS as a provider.

[![Latest Version](https://img.shields.io/packagist/v/tarwege/sms-whatsapp)](https://packagist.org/packages/tarwege/sms-whatsapp)
[![Total Downloads](https://img.shields.io/packagist/dt/tarwege/sms-whatsapp)](https://packagist.org/packages/tarwege/sms-whatsapp)
[![License](https://img.shields.io/packagist/l/tarwege/sms-whatsapp)](LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/tarwege/sms-whatsapp)](https://php.net)

---

## Features ✨

Tarwege SMS & WhatsApp API Client provides extensive API coverage including messaging, contact management, campaign management, OTP services, USSD, notifications, and more.

### Core Messaging Features
- **SMS Operations**
  - Send Single SMS
  - Send Bulk SMS
  - Scheduled SMS Campaigns
  - SMS Delivery Status Tracking
  - SMS Message History
  - SMS Auto-Reply System
  - SMS Forwarding
  - SMS Number Validation

- **WhatsApp Operations**
  - Send Text Messages
  - Send Media Messages (Images/Video/Audio)
  - Send Documents (PDF, DOC, XLS)
  - Send Location Sharing
  - Send Contact Cards
  - Bulk WhatsApp Campaigns
  - WhatsApp Template Messages
  - WhatsApp Group Management

### Contact & Campaign Management
- **Contact System**
  - Create & Manage Contacts and Groups
  - CSV Contact Upload
  - Contact Import/Export and Deduplication
  - Unsubscribe Management

- **Campaign Engine**
  - Create and Schedule SMS/WhatsApp Campaigns
  - Analytics, A/B Testing, and Personalized Messaging
  - Click Tracking and Campaign Pause/Resume

### OTP & Security
- **OTP Services**
  - OTP Generation, Sending & Verification
  - OTP Expiry and Rate Limiting

### Advanced & Enterprise Features
- Automation, USSD Services, Notifications, API Enhancements, and more

---

## Installation 🚀

Install via Composer:

```bash
composer require tarwege/sms-whatsapp
```

For Laravel projects, publish the configuration file:

```bash
php artisan vendor:publish --provider="Tarwege\SmsWhatsapp\Providers\TarwegeServiceProvider" --tag="tarwege-config"
```

Then, add your API credentials to your `.env` file:

```env
TARWEGE_API_SECRET=your_api_secret_here
TARWEGE_BASE_URL=https://api.tarwege.com
```

---

## Usage Examples 📖

This package uses a dedicated API client (`TarwegeClient`) and multiple service classes for specific endpoints. When using Laravel, you can access the client via the provided facade (`Tarwege`). Otherwise, instantiate the classes directly by passing a configured client instance.

### 1. Initializing the API Client

You can either use the facade in Laravel:

```php
use Tarwege\SmsWhatsapp\Facades\Tarwege;

// Get the underlying TarwegeClient instance
$tarwegeClient = Tarwege::getFacadeRoot();
```

Or create a new client instance manually:

```php
use Tarwege\SmsWhatsapp\Services\TarwegeClient;

$tarwegeClient = new TarwegeClient('your_api_secret_here', 'https://api.tarwege.com');
```

---

### 2. Account Management

```php
use Tarwege\SmsWhatsapp\Services\AccountService;

// Instantiate AccountService with the client
$accountService = new AccountService($tarwegeClient);

// Example: Get partner earnings and remaining credits
$partnerEarnings = $accountService->getPartnerEarnings();
$remainingCredits = $accountService->getRemainingCredits();

// Example: Get subscription package details
$subscription = $accountService->getSubscriptionPackage();
```

---

### 3. SMS Operations

```php
use Tarwege\SmsWhatsapp\Services\SmsService;

// Instantiate SmsService with the client
$smsService = new SmsService($tarwegeClient);

// Send a single SMS
$response = $smsService->sendSingleMessage([
    'mode'    => 'credits',
    'phone'   => '+967781606026',
    'message' => 'Your OTP is {{otp}}',
    'gateway' => 'partner_device_id'
]);

// Send bulk SMS messages
$bulkResponse = $smsService->sendBulkMessages([
    'campaign' => 'Holiday Sale',
    'groups'   => '1,2,5',
    'message'  => 'Special discounts inside!'
]);
```

---

### 4. WhatsApp Integration

```php
use Tarwege\SmsWhatsapp\Services\WhatsAppService;

// Instantiate WhatsAppService with the client
$waService = new WhatsAppService($tarwegeClient);

// Send a single WhatsApp chat message
$response = $waService->sendSingleChat([
    'account'   => 'wa_account_id',
    'recipient' => '+967781606026',
    'type'      => 'text',
    'message'   => 'Hello from Tarwege!'
]);

// Validate a WhatsApp phone number
$validation = $waService->validateWhatsAppPhoneNumber([
    'unique' => 'wa_account_id',
    'phone'  => '+967781606026'
]);
```

---

### 5. OTP Services

```php
use Tarwege\SmsWhatsapp\Services\OTPService;

// Instantiate OTPService with the client
$otpService = new OTPService($tarwegeClient);

// Send an OTP (with a 5-minute expiration)
$sendResponse = $otpService->sendOTP([
    'phone'   => '+967781606026',
    'message' => 'Your verification code: {{otp}}',
    'expire'  => 300
]);

// Verify an OTP
try {
    $verifyResponse = $otpService->verifyOTP([
        'phone' => '+967781606026',
        'otp'   => '123456'
    ]);
} catch (\Tarwege\SmsWhatsapp\Exceptions\TarwegeApiException $e) {
    // Handle error, e.g., invalid OTP or API error
    logger()->error("OTP Verification failed: {$e->getMessage()}");
}
```

---

### 6. Additional Services

Similarly, you can use the other provided services by instantiating them with the API client:

- **ContactService**: Manage contacts and groups  
  ```php
  use Tarwege\SmsWhatsapp\Services\ContactService;
  
  $contactService = new ContactService($tarwegeClient);
  $contacts = $contactService->getContacts();
  ```

- **NotificationService**: Manage notifications  
  ```php
  use Tarwege\SmsWhatsapp\Services\NotificationService;
  
  $notificationService = new NotificationService($tarwegeClient);
  $notifications = $notificationService->getNotifications();
  ```

- **SystemService**: Get system-related data (gateway rates, shorteners)  
  ```php
  use Tarwege\SmsWhatsapp\Services\SystemService;
  
  $systemService = new SystemService($tarwegeClient);
  $gatewayRates = $systemService->getGatewayRates();
  ```

- **UssdService**: Handle USSD requests  
  ```php
  use Tarwege\SmsWhatsapp\Services\UssdService;
  
  $ussdService = new UssdService($tarwegeClient);
  $ussdRequests = $ussdService->getUssdRequests();
  ```

---

## Advanced Configuration ⚙️

Customize settings in `config/tarwege.php` (published for Laravel or manually created for non-Laravel usage):

```php
return [
    'secret' => env('TARWEGE_API_SECRET'),
    
    // Request timeout in seconds
    'timeout' => 15,
    
    // Automatic retry configuration
    'retries' => [
        'attempts'   => 3,
        'sleep_ms'   => 1000,
        'http_codes' => [500, 502, 503, 504]
    ],
    
    // Default SMS settings
    'sms_defaults' => [
        'mode'     => 'credits',
        'sim'      => 1,
        'priority' => 1
    ]
];
```

---

## API Method Reference 📚

| Category         | Methods                                                                 |
|------------------|-------------------------------------------------------------------------|
| **Account**      | `getPartnerEarnings()`, `getRemainingCredits()`, `getSubscriptionPackage()` |
| **Contacts**     | `createContact()`, `getContacts()`, `deleteContact()`, `getGroups()`      |
| **SMS**          | `sendSingleMessage()`, `sendBulkMessages()`, `getSentMessages()`, `deleteReceivedMessage()`, etc. |
| **WhatsApp**     | `sendSingleChat()`, `sendBulkChats()`, `getAccounts()`, `validateWhatsAppPhoneNumber()`, etc. |
| **USSD**         | `sendUssdRequest()`, `getUssdRequests()`, `clearPendingUssd()`             |
| **Notifications**| `getNotifications()`, `deleteNotification()`                            |

---

## Testing 🧪

Run the test suite using:

```bash
composer test
```

Tests cover:
- API request validation
- Error handling and retry logic
- File uploads and response parsing

---

## Security 🔒

Please report security vulnerabilities to **security@tarwege.com** – do **NOT** use the public issue tracker.

---

## Support & Contributing 🤝

**Official Support:**  
- **Email:** support@tarwege.com  
- **Chat:** [Tarwege Support Portal](https://wa.me/+967781606026)

**Contributing Guidelines:**  
1. Fork the repository  
2. Create a feature branch: `git checkout -b feature/amazing-feature`  
3. Commit your changes: `git commit -m 'Add amazing feature'`  
4. Push your branch: `git push origin feature/amazing-feature`  
5. Open a Pull Request  

---

## License 📄

This project is licensed under the MIT License – see the [LICENSE](LICENSE) file for details.

---

📄 **Full API Documentation:** [Tarwege API Docs](https://sms.tarwege.com/docs)  
🐛 **Issue Tracker:** [GitHub Issues](https://github.com/tarwege/sms-whatsapp/issues)  
💡 **Changelog:** [Releases Page](https://github.com/tarwege/sms-whatsapp/releases)
