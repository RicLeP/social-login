## Social login using Laravel Socialite

This package implements Laravel Socialite.

When authenticating a user it will first check for existing `Users` with the same email address as used by the social network. If found it will attach the `SocialAccount` to the `User`. Multiple `SocialAccount` accounts from different providers can be attached to a single `User`.

If no `User` is found then a new one will be created. Rather than allow null passwords we generate a 100 character random string.

## Setup
The package uses Laravel package auto discovery. 

Add the social network credentials to your Laravel config/services.php file. 

```php
'facebook' => [
	'client_id' => env('FACEBOOK_CLIENT_ID'),
	'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
	'redirect' => env('FACEBOOK_REDIRECT'),
],

'twitter' => [
	'client_id' => env('TWITTER_CLIENT_ID'),
	'client_secret' => env('TWITTER_CLIENT_SECRET'),
	'redirect' => env('TWITTER_REDIRECT'),
],
```

See https://laravel.com/docs/master/socialite