# laravel-extensions

Simple addon functionality classes for laravel. 

## Installation
require package in your laravel installation with  
```bash
composer require ktourvas/laravel-extensions
```
after installation the package will automatically be discovered through laravel's auto-discovery feature. 

follow the above with  

```bash
php artisan vendor:publish 
```
in order for the package's configuration file to be published.   

## Usage 

### Middleware
I like to register extra middleware through the ServiceProviders of project packages and not globally and that is because I usually work with different packages in one local installation that require different functionality each and I usually don't want them to interfere with eachother.
So in that case a middleware would be registered through the register() method of a Service Provider like below 

```php
public function register() 
{
    $this->app['router']->aliasMiddleware('IpRestrict', Laravel\extensions\Http\Middleware\ipRestrict::class);
}
```

#### ipRestrict
the ip restriction middleware checks a request's ip address against an array of whitelisted addresses set through configuration. The array is populated from the .env variable LE_WHITELIST. Values are separated with commas. 

ex. 
```dotenv
LE_WHITELIST=99.99.99.99,88.88.88.88,77.77.77.77
```
in the event of a non whitelisted address the request is aborted with a 404 response.  

#### setLocale
the set locale middleware will check for the first segment on every request's url. 
If the first segment corresponds to a locale set through configuration, the application locale is set to that. 
Again in this case locale's are set through the .env variable LE_LOCALES

ex. 
```dotenv
LE_LOCALES=en;el
``` 