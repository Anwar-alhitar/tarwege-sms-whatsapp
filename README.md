

```markdown
# Tarwege SMS & WhatsApp API Client
Official PHP client for Tarwege's SMS & WhatsApp API with first-class Laravel support
use your sim to send SMS as provider
Here's a comprehensive list of features we can implement for the Tarwege API client package, including your requested features and additional professional capabilities:

### Core Messaging Features
1. **SMS Operations**
   - Send Single SMS
   - Send Bulk SMS
   - Scheduled SMS Campaigns
   - SMS Delivery Status Tracking
   - SMS Message History
   - SMS Auto-Reply System
   - SMS Forwarding
   - SMS Number Validation

2. **WhatsApp Operations**
   - Send Text Messages
   - Send Media Messages (Images/Video/Audio)
   - Send Documents (PDF, DOC, XLS)
   - Send Location Sharing
   - Send Contact Cards
   - Bulk WhatsApp Campaigns
   - WhatsApp Template Messages
   - WhatsApp Group Management

### Contact Management
3. **Contact System**
   - CSV Contact Upload
   - Contact Group Management
   - Contact Tagging
   - Contact Import/Export
   - Contact Deduplication
   - Contact Segmentation
   - Unsubscribe Management

### Campaign Management
4. **Campaign Engine**
   - Create SMS/WhatsApp Campaigns
   - Campaign Scheduling
   - Campaign Analytics Dashboard
   - A/B Testing for Messages
   - Personalized Message Variables
   - Click Tracking (for URLs)
   - Campaign Pause/Resume

### OTP & Security
5. **OTP Services**
   - OTP Generation & Sending
   - OTP Verification
   - OTP Resend Functionality
   - OTP Expiry Tracking
   - OTP Rate Limiting
   - OTP Delivery Reports

### Advanced Features
6. **Automation**
   - Event-based Auto-Responders
   - Drip Campaign Sequences
   - Birthday/Anniversary Automation
   - Payment Reminders
   - Appointment Reminders

7. **USSD Services**
   - USSD Session Initiation
   - USSD Menu Management
   - USSD Payment Integration
   - USSD Balance Checking
   - USSD Session Logs

8. **Notification System**
   - Transactional Notifications
   - System Alerts
   - Promotional Notifications
   - Multi-channel Notifications
   - Notification Templates

9. **API Enhancements**
   - Webhook Integration
   - Delivery Receipt Callbacks
   - Message Status Webhooks
   - Inbound Message Handling
   - Rate Limit Monitoring
   - API Usage Analytics

### Enterprise Features
10. **Advanced Tools**
    - Number Masking/Pooling
    - Two-Way Messaging
    - Message Translation API
    - Spam Detection
    - Compliance Management (TCPA/GDPR)
    - Sentiment Analysis
    - Chatbot Integration

11. **Account Management**
    - Sub-Account Management
    - API Key Rotation
    - IP Whitelisting
    - Usage Reports
    - Billing Integration
    - Credit Alerts

### Technical Implementation Plan

**Example Code Implementation for Key Features:**

```php
// Send OTP with expiration
Tarwege::sendOtp(
    phone: '+967781606026',
    message: 'Your verification code: {{otp}}',
    expire: 300 // 5 minutes
);

// Verify OTP
try {
    Tarwege::verifyOtp(
        phone: '+967781606026',
        otp: '123456'
    );
} catch (InvalidOtpException $e) {
    // Handle invalid OTP
}

// Upload contacts from CSV
Tarwege::uploadContacts(
    filePath: storage_path('contacts.csv'),
    groups: 'customers,vip',
    mapping: [
        'phone' => 0,
        'name' => 1,
        'email' => 2
    ]
);

// Create auto-reply rule
Tarwege::createAutoReply(
    trigger: 'ORDER_STATUS',
    message: 'Your order {{order_id}} is {{status}}',
    channels: ['sms', 'whatsapp'],
    conditions: [
        'keywords' => ['status', 'update']
    ]
);

// Start scheduled campaign
Tarwege::startCampaign(
    name: 'Black Friday Sale',
    type: 'whatsapp',
    message: 'Get 50% off!',
    schedule: '2023-11-24 09:00:00',
    recipients: [
        'groups' => ['subscribers'],
        'numbers' => '+967781606026,+967781606027'
    ]
);






[![Latest Version](https://img.shields.io/packagist/v/tarwege/sms-whatsapp)](https://packagist.org/packages/tarwege/sms-whatsapp)
[![Total Downloads](https://img.shields.io/packagist/dt/tarwege/sms-whatsapp)](https://packagist.org/packages/tarwege/sms-whatsapp)
[![License](https://img.shields.io/packagist/l/tarwege/sms-whatsapp)](LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/tarwege/sms-whatsapp)](https://php.net)



## Features ✨

- **Full API Coverage** - Support for 100+ API endpoints
- **Laravel Integration** - Service provider, facade & config
- **Type Safety** - Strict PHP 8.0+ type declarations
- **Error Handling** - Custom exceptions with error codes
- **File Uploads** - Multipart support for media messages
- **Smart Retries** - Configurable retries with backoff
- **Testing Ready** - PHPUnit/Pest scaffolding included

## Installation 🚀

```bash
composer require tarwege/sms-whatsapp
```

For Laravel projects:

```bash
php artisan vendor:publish --provider="Tarwege\SmsWhatsapp\Providers\TarwegeServiceProvider" --tag="tarwege-config"
```

Add to `.env`:
```env
TARWEGE_API_SECRET=your_api_secret_here
```

## Usage Examples 📖

### 1. Account Management
```php
use Tarwege\SmsWhatsapp\Facades\Tarwege;

// Get account balance
$balance = Tarwege::getRemainingCredits();

// Get subscription details
$subscription = Tarwege::getSubscriptionPackage();
```

### 2. SMS Operations
```php
// Send single SMS
Tarwege::sendSms([
    'mode' => 'credits',
    'phone' => '+967781606026',
    'message' => 'Your OTP is {{otp}}',
    'gateway' => 'partner_device_id'
]);

// Bulk SMS campaign
Tarwege::sendBulkMessages([
    'campaign' => 'Holiday Sale',
    'groups' => '1,2,5',
    'message' => 'Special discounts inside!'
]);
```

### 3. WhatsApp Integration
```php
// Send media message
Tarwege::sendWhatsAppMessage(
    params: [
        'account' => 'wa_account_id',
        'recipient' => '+967781606026',
        'type' => 'media',
        'message' => 'Our new product!'
    ],
    files: [
        'media_file' => 'product.jpg'
    ]
);

// Validate WhatsApp number
$validation = Tarwege::validateWhatsAppNumber(
    unique: 'wa_account_id',
    phone: '+967781606026'
);
```

### 4. Error Handling
```php
try {
    Tarwege::deleteContact(id: 123);
} catch (\Tarwege\SmsWhatsapp\Exceptions\TarwegeApiException $e) {
    logger()->error("API Error {$e->getCode()}: {$e->getMessage()}");
    
    if ($e->getCode() === 401) {
        return response()->invalidApiSecret();
    }
}
```

## Advanced Configuration ⚙️

`config/tarwege.php`:
```php
return [
    'secret' => env('TARWEGE_API_SECRET'),
    
    // Request timeout in seconds
    'timeout' => 15,
    
    // Automatic retry configuration
    'retries' => [
        'attempts' => 3,
        'sleep_ms' => 1000,
        'http_codes' => [500, 502, 503, 504]
    ],
    
    // Default SMS settings
    'sms_defaults' => [
        'mode' => 'credits',
        'sim' => 1,
        'priority' => 1
    ]
];
```

## API Method Reference 📚

| Category       | Methods                                                                 |
|----------------|-------------------------------------------------------------------------|
| Account        | `getPartnerEarnings()`, `getRemainingCredits()`, `getSubscriptionPackage()` |
| Contacts       | `createContact()`, `getContacts()`, `deleteContact()`, `getGroups()`   |
| SMS            | `sendSms()`, `sendBulkMessages()`, `getSentMessages()`, `deleteSms()`  |
| WhatsApp       | `sendWhatsAppMessage()`, `getAccounts()`, `validateNumber()`, `createQr()` |
| USSD           | `sendUssdRequest()`, `getUssdRequests()`, `clearPendingUssd()`         |
| Notifications  | `getNotifications()`, `deleteNotification()`                           |

## Testing 🧪

Run tests with:

```bash
composer test
```

Test coverage includes:
- API request validation
- Error code handling
- Retry logic
- File uploads
- Response parsing

## Security 🔒

Please report security vulnerabilities to **security@tarwege.com** - do NOT use the public issue tracker.

## Support & Contributing 🤝

**Official Support:** 
- 📧 Email: support@tarwege.com
- 💬 Chat: [Tarwege Support Portal](https://wa.me/+967781606026)
  
**Community Contributions:**
1. Fork the repository
2. Create feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

## License 📄

MIT License - See [LICENSE](LICENSE) for full text.

---

📄 Full API Documentation: [Tarwege API Docs](https://sms.tarwege.com/docs)  
🐛 Issue Tracker: [GitHub Issues](https://github.com/tarwege/sms-whatsapp/issues)  
💡 Changelog: [Releases Page](https://github.com/tarwege/sms-whatsapp/releases)


