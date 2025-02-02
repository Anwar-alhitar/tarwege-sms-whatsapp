<?php

namespace Tarwege\SmsWhatsapp\Providers;

use Illuminate\Support\ServiceProvider;
use Tarwege\SmsWhatsapp\Services\TarwegeClient;

if (! function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string  $path
     * @return string
     */
    function config_path($path = '')
    {
        return __DIR__ . '/../../config' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

class TarwegeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TarwegeClient::class, function ($app) {
            $config = $app['config']['tarwege'];
            return new TarwegeClient(
                $config['api_key'],
                $config['base_url'] ?? 'https://api.tarwege.com'
            );
        });
    }

    public function boot()
    {
        if (function_exists('config_path')) {
            $this->publishes([
                __DIR__.'/../../config/tarwege.php' => config_path('tarwege.php'),
            ], 'config');
        }
    }
}
