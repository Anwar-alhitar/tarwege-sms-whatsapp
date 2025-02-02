<?php

namespace Tarwege\SmsWhatsapp\Providers;

use Illuminate\Support\ServiceProvider;
use Tarwege\SmsWhatsapp\Services\TarwegeClient;

class TarwegeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/tarwege.php', 'tarwege');

        $this->app->singleton(TarwegeClient::class, function ($app) {
            return new TarwegeClient(config('tarwege.secret'));
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/tarwege.php' => config_path('tarwege.php'),
            ], 'tarwege-config');
        }
    }
}