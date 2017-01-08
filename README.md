# laravel-ts3admin
Laravel integration for [par0noid's ts3admin.class](https://github.com/par0noid/ts3admin.class)

#### Installation
1. Add this git repository to your `composer.json`: `composer config repo.laravel-ts3admin git https://github.com/Micky5991/laravel-ts3admin`
2. `composer require micky5991/laravel-ts3admin`
3. Add Service Provider to your `app.php` configuration-file:
```php
   Micky5991\laravel_ts3admin\Providers\TeamspeakServiceProvider::class
   ```
4. Copy configuration to config-folder: `php artisan vendor:publish` 

_If you only want to publish this package:_ `php artsan vendor:publish --provider=Micky5991\laravel_ts3admin\Providers\TeamspeakServiceProvider`
> Adding a repository to your `composer.json` is only needed as long this package is not available at [Packagist.org](https://packagist.org/)!

##### Remove repository from `composer.json`

1. `composer config --unset repo.laravel-ts3admin`