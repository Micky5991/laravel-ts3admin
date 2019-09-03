# laravel-ts3admin
[par0noid's ts3admin.class](https://github.com/par0noid/ts3admin.class) integration for Laravel 5.5 and higher

**INFO:** This package uses a singleton to access a **single** ts3admin.class-object. So you currently **can't access multiple TeamSpeak-3-Servers**!

### Supported Laravel Versions

| Laravel Version | Supported | 
| --------------- |:---------:|
| 5.5 - 5.8 | :heavy_check_mark: |
| 6.0 | :heavy_check_mark: |

## Installation

This package will be autodiscovered, so no further setup is needed.

```
composer require micky5991/laravel-ts3admin
```

## Configuration

Copy configuration to config-folder: 

```bash 
$ php artisan vendor:publish --provider=Micky5991\laravel_ts3admin\Providers\TeamspeakServiceProvider
``` 

Add environmental variables to your `.env`

```
TS_SERVER_HOST=127.0.0.1
TS_SERVER_PORT=9987
TS_SERVER_TIMEOUT=2
TS_QUERY_PORT=10011
TS_QUERY_USERNAME=serveradmin
TS_QUERY_PASSWORD=supersecretpassword
```

After completing all steps from above you should have a configuration file under: `config/teamspeak.php`. There you can configure some other aspects like the name of the ServerQuery.

## Example

An example for a controller to the `/clients` endpoint that lists all connected clients.

```php
Route::get('/users', function(\ts3admin $ts) {
    $result = $ts->clientList();
    if($ts->succeeded($result)) {
        $users = $ts->getElement("data", $result);
        dd($users);
    } else {
        return "Connection failed";
    }
});
```
