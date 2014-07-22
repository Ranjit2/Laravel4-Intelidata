# Velocity

Velocity is a url analyzer for Laravel 4. Velocity saves every request information to database. You  can review log at any time.


## Screenshot

![alt text](http://ahir.com.tr/packages-images/velocity.jpg "Screenshot")


## Installation

To install through composer, simply put the following in your `composer.json` file:

```json
{
    "require": {
        "ahir/velocity": "dev-master",
    }
}
```
After installing the package, open your Laravel config file `app/config/app.php` and add the following lines.

In the $providers array add the following service provider for this package;

```php
'Ahir\Velocity\VelocityServiceProvider',
```

Add the `Velocity` facades to the `aliases` in `app/config/app.php`:

```php
'Velocity' => 'Ahir\Velocity\Facades\Velocity',
```

## Configuration

You must run the following code on the console;

```
php artisan migrate --package=ahir/velocity
php artisan config:publish ahir/velocity
php artisan asset:publish ahir/boothead

```

The following arrangements should be made.

 `app/start/global.php`
```php 
App::before(function($request)
{
	Velocity::start();
});

App::after(function($request, $response)
{
    Velocity::stop();
});

Event::listen('ahir.velocity', 'Ahir\Velocity\Velocity@handle');
```

`app/controllers/BaseController.php`
```php
/**
 * Construct 
 * 
 * @return null
 */
public function __construct()
{
	Event::fire('ahir.velocity', $this);
}
```

If you don't want to tracked a URL, you must define it in the configuration file. `ban_url_array` parameter can be used for this operation.

## Analysis

You can use this URL to examine all requests; `domain.com/ahir/velocity`

## License

GPL


