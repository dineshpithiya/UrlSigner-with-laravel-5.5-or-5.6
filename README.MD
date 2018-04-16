This package can create URLs with a limited lifetime. This is done by adding an expiration date and a signature to the URL.

This is how you can create signed URL that's valid for 30 days:

```
UrlSigner::sign('https://myapp.com/protected-route', 30);
```
The output will look like this:

```
https://app.com/protected-route?expires=xxxxxx&signature=xxxxxx
```
The URL can be validated with the validate-function.

```
UrlSigner::validate('https://app.com/protected-route?expires=xxxxxx&signature=xxxxxx');
```
The package also provides a middleware to protect routes.

Installation
As you would have guessed the package can be installed via Composer:

```
composer require spatie/laravel-url-signer
```
In Laravel 5.5 the service provider and facade will automatically get registered. In older versions of the framework, just add the serviceprovider, and optionally register the facade:
```
// config/app.php

'providers' => [
    ...
    Spatie\UrlSigner\Laravel\UrlSignerServiceProvider::class,
];

'aliases' => [
    ...
    'UrlSigner' => Spatie\UrlSigner\Laravel\UrlSignerFacade::class,
];
```
Configuration
The configuration file can optionally be published via:
```
php artisan vendor:publish --provider="Spatie\UrlSigner\Laravel\UrlSignerServiceProvider"
```
This is the content of the file:
```
return [

    /*
    * This string is used the to generate a signature. You should
    * keep this value secret.
    */
    'signatureKey' => env('APP_KEY'),

    /*
     * The default expiration time of a URL in days.
     */
    'default_expiration_time_in_days' => 1,

    /*
     * These strings are used a parameter names in a signed url.
     */
    'parameters' => [
        'expires' => 'expires',
        'signature' => 'signature',
    ],

];
```
Usage
Signing URLs
URL's can be signed with the sign-method:
```
UrlSigner::sign('https://myapp.com/protected-route');
```
By default the lifetime of an URL is one day. This value can be change in the config-file. If you want a custom life time, you can specify the number of days the URL should be valid:

//the generated URL will be valid for 5 days.
```
UrlSigner::sign('https://myapp.com/protected-route', 5);
```
For fine grained control, you may also pass a DateTime instance as the second parameter. The url will be valid up to that moment. This example uses Carbon for convenience:

//This URL will be valid up until 2 hours from the moment it was generated.
```
UrlSigner::sign('https://myapp.com/protected-route', Carbon\Carbon::now()->addHours(2) );
```
Validating URLs
To validate a signed URL, simply call the validate()-method. This return a boolean.
```
UrlSigner::validate('https://app.com/protected-route?expires=xxxxxx&signature=xxxxxx');
```
Protecting routes with middleware
The package also provides a middleware to protect routes:
```
Route::get('protected-route', ['middleware' => 'signedurl', function () {
    return 'Hello secret world!';
}]);
```
Your app will abort with a 403 status code if the route is called without a valid signature.

Changelog
Please see CHANGELOG for more information what has changed recently.

Testing
```
$ vendor/bin/phpunit
```
Usage outside Laravel
If you're working on a non-Laravel project, you can use the framework agnostic version.

Similar libraries
If you need signed url's for CloudFront, consider dreamonkey's package, which is based on this library.

Contributing
Please see CONTRIBUTING for details.

Security
If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

Postcardware
You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

We publish all received postcards on our company website.

Credits
[Rajesh bamrotiya](https://github.com/rajbamrotiya)