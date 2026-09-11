<?php

namespace ShareXOS\PayPing\Laravel;

use Illuminate\Support\ServiceProvider;
use ShareXOS\PayPing\PayPing;

class PayPingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/payping.php', 'payping');

        $this->app->singleton(PayPing::class, function ($app) {
            $config = $app['config']['payping'];
            return new PayPing(
                $config['token'],
                $config['test_mode'] ?? false,
                $config['timeout'] ?? 45
            );
        });

        $this->app->alias(PayPing::class, 'payping');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/payping.php' => config_path('payping.php'),
            ], 'payping-config');
        }
    }
}
