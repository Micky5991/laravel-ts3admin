<?php

namespace Micky5991\laravel_ts3admin\Providers;

use Illuminate\Support\ServiceProvider;
use Micky5991\laravel_ts3admin\Exceptions\TeamspeakConnectionException;
use par0noid\ts3admin;

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
            $host = config('teamspeak.host');
            $port = config('teamspeak.query.port');
            $timeout = config('teamspeak.timeout');

            $ts = new ts3admin($host, $port, $timeout);

            if(config('teamspeak.connect') == false) {
                return $ts;
            }

            if ($ts->succeeded($ts->connect()) == false) {
                throw new TeamspeakConnectionException(sprintf('Failed to connect to %s, error: %s', $host,
                    $ts->getDebugLog()[0]));
            }

            $username = config('teamspeak.query.username');
            $password = config('teamspeak.query.password');

            $loginResponse = $ts->login($username, $password);
            if ($ts->succeeded($loginResponse) == false) {
                throw new TeamspeakConnectionException(sprintf('Failed to login with %s, error: %s', $username,
                    $ts->getDebugLog()[0]));
            }

            $serverPort = config('teamspeak.port');

            $serverSelectResponse = $ts->selectServer($serverPort);
            if ($ts->succeeded($serverSelectResponse) == false) {
                throw new TeamspeakConnectionException(sprintf('Failed to select server %i, error: %s', $serverPort,
                    $ts->getDebugLog()[0]));
            }

            $name = config('teamspeak.nickname');
            if ($name != null) {
                $nameChangeResponse = $ts->setName($name);

                if($ts->succeeded($nameChangeResponse) == false) {
                    throw new TeamspeakConnectionException(sprintf('Unable to change username to %s, error: %s',
                        $serverPort,
                        $ts->getDebugLog()[0]));
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
        return [ ts3admin::class ];
    }
}
