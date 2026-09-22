# Tarwege SMS & WhatsApp API Client

PHP client for the [Tarwege dashboard API](https://sms.tarwege.com/dashboard/docs) (`/api/*` paths, `secret` auth, form-encoded POST bodies). Includes Laravel auto-discovery.

## Installation

```bash
composer require tarwege/sms-whatsapp
```

Laravel — publish config:

```bash
php artisan vendor:publish --provider="Tarwege\SmsWhatsapp\Providers\TarwegeServiceProvider" --tag="tarwege-config"
```

`.env`:

```env
TARWEGE_API_SECRET=your_api_secret_from_tools_api_keys
TARWEGE_BASE_URL=https://sms.tarwege.com/api
```

## Usage

Inject services or resolve from the container:

```php
use Tarwege\SmsWhatsapp\Services\AccountService;
use Tarwege\SmsWhatsapp\Services\SmsService;
use Tarwege\SmsWhatsapp\Services\OTPService;

$credits = app(AccountService::class)->getCredits();
// ['status' => 200, 'message' => '...', 'data' => ...]

app(SmsService::class)->sendSms([
    'mode' => 'devices',
    'phone' => '+967781606026',
    'message' => 'Hello',
    'sim' => 1,
]);

app(OTPService::class)->sendOTP([
    'type' => 'sms',
    'phone' => '+967781606026',
    'message' => 'Your code is {{otp}}',
    'expire' => 300,
]);

app(OTPService::class)->verifyOTP('123456');
```

Standalone (no Laravel):

```php
use Tarwege\SmsWhatsapp\Services\TarwegeClient;
use Tarwege\SmsWhatsapp\Services\SmsService;

$client = new TarwegeClient(getenv('TARWEGE_API_SECRET'), 'https://sms.tarwege.com/api');
$sms = new SmsService($client);
```

### Errors

Non-2xx `status` in the JSON body throws `Tarwege\SmsWhatsapp\Exceptions\TarwegeApiException` with the API `message` and full payload via `getResponse()`.

### Service map (official paths)

| Service | Methods |
|--------|---------|
| **AccountService** | `getEarnings`, `getCredits`, `getSubscription` |
| **ContactService** | `createContact`, `createGroup`, `deleteContact`, `deleteGroup`, `deleteUnsubscribed`, `getContacts`, `getGroups`, `getUnsubscribed` |
| **SmsService** | `sendSms`, `sendSmsBulk`, `getDevices`, `getPendingMessages`, `getReceivedMessages`, `getSentMessages`, `getSmsCampaigns`, `getSmsMessage`, `delete*`, `startSmsCampaign`, `stopSmsCampaign` |
| **WhatsAppService** | `sendWhatsApp`, `sendWhatsAppBulk`, accounts/chats/campaigns CRUD-style getters and deletes, `linkWhatsAppAccount`, `relinkWhatsAppAccount`, `getWhatsAppQrImage` (token), `getWhatsAppInformationAfterLinking` (token) |
| **OTPService** | `sendOTP`, `verifyOTP` |
| **UssdService** | `sendUssdRequest`, `getUssdRequests`, `deleteUssdRequest` |
| **SystemService** | `getGatewayRates`, `getShorteners` |
| **NotificationService** | `deleteNotification` only (no list endpoint in spec) |

Older method names (`sendSingleMessage`, `getRemainingCredits`, etc.) remain as deprecated aliases where applicable.

## Testing

```bash
composer test
```

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for **2.0.0** breaking changes and migration from 1.x.

## License

MIT — see [LICENSE](LICENSE).
