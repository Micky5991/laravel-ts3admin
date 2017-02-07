# laravel-ts3admin
[par0noid's ts3admin.class](https://github.com/par0noid/ts3admin.class) integration for Laravel 5.3

> **INFO:** This package uses a singleton to access a **single** ts3admin.class-object. So you currently **can't access multiple TeamSpeak-3-Servers**!

### Installation
- Add ts3admin.class repository to composer.json

> This is only a temporary step and will be removed in the next version

```bash 
$ composer config repositories.ts3admin git https://github.com/par0noid/ts3admin.class
```
__or__
```
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/par0noid/ts3admin.class"
    }
  ],
```

- `composer require micky5991/laravel-ts3admin`
- Add Service Provider to your `app.php` configuration-file:
```php
Micky5991\laravel_ts3admin\Providers\TeamspeakServiceProvider::class
```
- Copy configuration to config-folder: 
```bash 
$ php artisan vendor:publish
``` 

- Add environmental variables to your `.env`
```
TS_SERVER_HOST=127.0.0.1
TS_SERVER_PORT=9987
TS_SERVER_TIMEOUT=2
TS_QUERY_PORT=10011
TS_QUERY_USERNAME=serveradmin
TS_QUERY_PASSWORD=secretpassword
```
### Configuration
After completing all steps from above you should have a configuration file under: `config/teamspeak.php`. There you can configure some other aspects like the name of the ServerQuery.

### Example
An example for a controller to the `/clients` endpoint that lists all connected clients.
```php
Route::get('/clients', function(\par0noid\ts3admin\ts3admin $ts) {
    $result = $ts->clientList();
    if($ts->succeeded($result)) {
        $users = $ts->getElement("data", $result);
        return $users;
    } else {
        return "Connection failed";
    }
});

```