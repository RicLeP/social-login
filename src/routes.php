<?php

// Social login routes
Route::group(['middleware' => ['web']], function () {
	Route::get('/social-auth/{provider}/redirect', 'RicLeP\SocialLogin\SocialAuthController@redirectToProvider');
	Route::get('/social-auth/{provider}/callback', 'RicLeP\SocialLogin\SocialAuthController@handleProviderCallback');
});