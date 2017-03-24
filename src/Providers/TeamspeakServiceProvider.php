<?php

namespace Micky5991\laravel_ts3admin\Providers;

use Illuminate\Support\ServiceProvider;
use \ts3admin;

class TeamspeakServiceProvider extends ServiceProvider
{
    public $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            dirname(__DIR__) . '/teamspeak.php' => config_path('teamspeak.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ts3admin::class, function ($app) {
            $ts = new ts3admin(
                config('teamspeak.host'),
                config('teamspeak.query.port'),
                config('teamspeak.timeout')
            );
            if ($ts->succeeded($ts->connect())) {
                if ($ts->succeeded(
                    $ts->login(
                        config('teamspeak.query.username'),
                        config('teamspeak.query.password')
                    )
                )) {
                    if ($ts->succeeded($ts->selectServer(config('teamspeak.port')))) {
                        $name = config('teamspeak.nickname');
                        if ($name == null || $ts->succeeded($ts->setName($name))) {
                            return $ts;
                        }
                    }
                }
            }
            return $ts;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ts3admin::class];
    }
}
