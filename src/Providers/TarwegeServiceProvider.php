<?php

namespace Tarwege\SmsWhatsapp\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Tarwege\SmsWhatsapp\Services\AccountService;
use Tarwege\SmsWhatsapp\Services\ContactService;
use Tarwege\SmsWhatsapp\Services\NotificationService;
use Tarwege\SmsWhatsapp\Services\OTPService;
use Tarwege\SmsWhatsapp\Services\SmsService;
use Tarwege\SmsWhatsapp\Services\SystemService;
use Tarwege\SmsWhatsapp\Services\TarwegeClient;
use Tarwege\SmsWhatsapp\Services\UssdService;
use Tarwege\SmsWhatsapp\Services\WhatsAppService;

class TarwegeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/tarwege.php', 'tarwege');

        $this->app->singleton(TarwegeClient::class, function ($app) {
            $config = $app['config']['tarwege'];
            $timeout = (float) ($config['timeout'] ?? 30);
            $baseUrl = rtrim((string) ($config['base_url'] ?? 'https://sms.tarwege.com/api'), '/');

            $http = new Client([
                'base_uri' => $baseUrl,
                'headers' => ['Accept' => 'application/json'],
                'timeout' => $timeout,
                'http_errors' => false,
            ]);

            return new TarwegeClient((string) ($config['secret'] ?? ''), $baseUrl, $http);
        });

        $this->app->singleton(AccountService::class, fn ($app) => new AccountService($app->make(TarwegeClient::class)));
        $this->app->singleton(ContactService::class, fn ($app) => new ContactService($app->make(TarwegeClient::class)));
        $this->app->singleton(SmsService::class, fn ($app) => new SmsService($app->make(TarwegeClient::class)));
        $this->app->singleton(WhatsAppService::class, fn ($app) => new WhatsAppService($app->make(TarwegeClient::class)));
        $this->app->singleton(OTPService::class, fn ($app) => new OTPService($app->make(TarwegeClient::class)));
        $this->app->singleton(UssdService::class, fn ($app) => new UssdService($app->make(TarwegeClient::class)));
        $this->app->singleton(SystemService::class, fn ($app) => new SystemService($app->make(TarwegeClient::class)));
        $this->app->singleton(NotificationService::class, fn ($app) => new NotificationService($app->make(TarwegeClient::class)));
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/tarwege.php' => config_path('tarwege.php'),
            ], 'tarwege-config');
        }
    }
}
