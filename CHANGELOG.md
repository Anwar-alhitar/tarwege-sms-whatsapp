# Changelog

All notable changes to `tarwege/sms-whatsapp` are documented here.

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/).

## [2.0.0] - 2026-03-23

Major release: the client now matches the official dashboard API spec (`/api/*`, `secret` authentication, form-encoded POST bodies). See [dashboard docs](https://sms.tarwege.com/dashboard/docs).

### Added

- `TarwegeClient::get()`, `post()`, and `deleteById()` aligned with spec paths.
- Service methods for every documented endpoint (SMS, WhatsApp, contacts, OTP, USSD, account, system).
- `SmsService::getSmsMessage()`, `sendSms()`, `sendSmsBulk()`.
- `AccountService::getEarnings()`, `getCredits()`, `getSubscription()`.
- `WhatsAppService::sendWhatsApp()`, `sendWhatsAppBulk()`.
- Config keys: `secret`, `base_url` (default `https://sms.tarwege.com/api`), `timeout`.
- `TarwegeApiException::getResponse()` for full API error payloads.
- PHPUnit suite with mocked HTTP (`composer test`).

### Changed

- **Authentication**: `secret` query/body parameter instead of Bearer tokens.
- **POST requests**: `application/x-www-form-urlencoded` (`form_params`) instead of JSON bodies.
- **Responses**: methods return decoded JSON arrays `{ status, message, data }`; non-2xx `status` throws `TarwegeApiException`.
- **OTP verification**: `OTPService::verifyOTP(string $otp, array $params = [])` calls `GET /get/otp` (was POST with phone + otp).
- **Deletes**: use `GET /delete/...?id=` — e.g. `deleteContact($id)`, `deleteSentMessage($id)` (not REST `DELETE` paths).
- **Campaign control**: `startSmsCampaign($campaignId)` / `stopSmsCampaign($campaignId)` use `GET /remote/start.sms` and `/remote/stop.sms` with `campaign` query param.
- **WhatsApp linking**: `linkWhatsAppAccount()` and `relinkWhatsAppAccount()` use `GET /create/wa.link` and `/create/wa.relink`.
- **WhatsApp QR / info**: `getWhatsAppQrImage(string $token)` and `getWhatsAppInformationAfterLinking(string $token)` use link `token`, not account id.
- **WhatsApp group contacts**: `getWhatsAppGroupContacts(string $unique, string $gid, array $params = [])` requires account `unique` and group `gid`.
- **Env**: prefer `TARWEGE_API_SECRET`; `TARWEGE_API_KEY` still works as fallback. Set `TARWEGE_BASE_URL=https://sms.tarwege.com/api`.

### Deprecated

- `sendSingleMessage` → `sendSms`
- `sendBulkMessages` → `sendSmsBulk`
- `sendSingleChat` → `sendWhatsApp`
- `sendBulkChats` → `sendWhatsAppBulk`
- `getPartnerEarnings` → `getEarnings`
- `getRemainingCredits` → `getCredits`
- `getSubscriptionPackage` → `getSubscription`
- `TarwegeClient::callApi()` — use `get()` / `post()` / `request()`

### Removed

- `NotificationService::getNotifications()` — no list endpoint in the official spec.
- `UssdService::clearPendingUssd()` — not in the official spec.
- `WhatsAppService::validateWhatsAppPhoneNumber()` — not in the official spec.

### Migration from 1.x

1. Set `.env`:
   ```env
   TARWEGE_API_SECRET=your_secret
   TARWEGE_BASE_URL=https://sms.tarwege.com/api
   ```
2. Replace invented paths (e.g. `/sms/send/single`) with service methods above; they now hit `/send/sms`, etc.
3. Wrap calls in `try/catch (TarwegeApiException $e)` and use `$e->getResponse()` for API details.
4. Update OTP verify calls to pass only the user-supplied OTP string to `verifyOTP()`.
5. Update WhatsApp QR/info polling to use the `token` from `create/wa.link` response, not the account unique id.

## [1.0.0] - earlier

Initial Packagist release (pre-spec client; deprecated).

[2.0.0]: https://github.com/Anwar-alhitar/tarwege-sms-whatsapp/compare/v1.0.0...v2.0.0
[1.0.0]: https://github.com/Anwar-alhitar/tarwege-sms-whatsapp/releases/tag/v1.0.0
