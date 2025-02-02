<?php

namespace Tarwege\SmsWhatsapp\Providers;

use Illuminate\Support\ServiceProvider;
use Tarwege\SmsWhatsapp\Services\TarwegeClient;

class TarwegeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TarwegeClient::class, function ($app) {
            $config = $app['config']['tarwege'];
            return new TarwegeClient($config['api_key'], $config['base_url'] ?? 'https://api.tarwege.com');
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/tarwege.php' => config_path('tarwege.php'),
        ], 'config');
    }
}
