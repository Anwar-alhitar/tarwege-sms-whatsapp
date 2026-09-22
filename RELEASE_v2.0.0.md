# Release 2.0.0 (draft — not committed)

When you are ready to publish, run from the package root (`tarwege-sms-whatsapp`).

## Pre-flight

```bash
composer test
```

## Stage (exclude PHPUnit cache)

```bash
git add CHANGELOG.md README.md RELEASE_v2.0.0.md composer.json config/tarwege.php phpunit.xml
git add src/ tests/
```

Do **not** add `.phpunit.result.cache` (add to `.gitignore` if missing).

## Commit

```bash
git commit -m "$(cat <<'EOF'
Release 2.0.0: align SDK with official /api spec

Rewrite client and services for secret auth and form-encoded POSTs;
document breaking changes in CHANGELOG and add PHPUnit coverage.
EOF
)"
```

PowerShell alternative (single line):

```powershell
git commit -m "Release 2.0.0: align SDK with official /api spec"
```

## Tag

```bash
git tag -a v2.0.0 -m "v2.0.0 — spec-aligned API client (breaking vs 1.x)"
```

## Push (when you choose)

```bash
git push origin main
git push origin v2.0.0
```

Packagist will pick up the new tag if the package is linked to this repository.

## After push

- Confirm [Packagist](https://packagist.org/packages/tarwege/sms-whatsapp) shows `2.0.0`.
- Optional: GitHub release from tag `v2.0.0`, paste **Added / Changed / Removed** from [CHANGELOG.md](CHANGELOG.md).
