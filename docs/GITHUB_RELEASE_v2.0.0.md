# GitHub release v2.0.0 — description (copy into release editor)

Major release: the client matches the official dashboard API (`/api/*`, `secret` auth, form-encoded POST bodies).

**Docs:** https://sms.tarwege.com/dashboard/docs

### Added
- `TarwegeClient::get()`, `post()`, `deleteById()` aligned with spec paths
- Full service coverage: SMS, WhatsApp, contacts, OTP, USSD, account, system
- `sendSms` / `sendSmsBulk`, `getEarnings` / `getCredits` / `getSubscription`, `sendWhatsApp` / `sendWhatsAppBulk`
- Config: `secret`, `base_url` (default `https://sms.tarwege.com/api`), `timeout`
- `TarwegeApiException::getResponse()` for API error payloads

### Changed (breaking vs 1.x)
- Auth: `secret` in query/body (not Bearer)
- POST: `application/x-www-form-urlencoded` (not JSON)
- Responses: `{ status, message, data }`; non-2xx `status` throws
- OTP verify: `GET /get/otp?otp=...`
- Deletes & campaigns: official GET paths (`/delete/...`, `/remote/start.sms`, etc.)
- WhatsApp link/QR/info: token-based flow

### Removed
- `getNotifications()`, `clearPendingUssd()`, `validateWhatsAppPhoneNumber()` (not in spec)

### Upgrade
```env
TARWEGE_API_SECRET=your_secret
TARWEGE_BASE_URL=https://sms.tarwege.com/api
```

```bash
composer require tarwege/sms-whatsapp:^2.0
```

**Full changelog:** https://github.com/Anwar-alhitar/tarwege-sms-whatsapp/blob/main/CHANGELOG.md
