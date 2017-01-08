<?php

namespace Micky5991\laravel_ts3admin\Providers;

use Illuminate\Support\ServiceProvider;
use par0noid\ts3admin\ts3admin;

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
        //
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
                env('TS_HOST', '127.0.0.1'),
                env('TS_QUERY_PORT', 10011),
                env('TS_QUERY_SOCKET_TIMEOUT', 2)
            );
            if ($ts->succeeded($ts->connect())) {
                if($ts->succeeded(
                    $ts->login(
                        env('TS_QUERY_USER', 'serveradmin'),
                        env('TS_QUERY_PASS')
                    )
                )) {
                    if ($ts->succeeded($ts->selectServer(env('TS_SERVER_PORT', 9987)))) {
                        return $ts;
                    }
                }
            }
            throw new TeamspeakException($ts);
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
