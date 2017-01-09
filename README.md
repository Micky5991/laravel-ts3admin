# laravel-ts3admin
Laravel integration for [par0noid's ts3admin.class](https://github.com/par0noid/ts3admin.class)

### Installation
1. `composer require micky5991/laravel-ts3admin`
2. Add Service Provider to your `app.php` configuration-file:
```php
Micky5991\laravel_ts3admin\Providers\TeamspeakServiceProvider::class
```
3. Copy configuration to config-folder: `php artisan vendor:publish` 

4. Add environmental variables to your `.env`
```
TS_SERVER_HOST=127.0.0.1
TS_SERVER_PORT=9987
TS_SERVER_TIMEOUT=1
TS_QUERY_PORT=10011
TS_QUERY_USERNAME=serveradmin
TS_QUERY_PASSWORD=secretpassword
```

##### Example
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