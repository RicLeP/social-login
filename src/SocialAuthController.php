<?php

namespace RicLeP\SocialLogin;

use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\Controller;

class SocialAuthController extends Controller
{
	public function redirectToProvider($provider)
	{
		return Socialite::driver($provider)->redirect();
	}

	public function handleProviderCallback(SocialAccountService $service, $provider)
	{
		$user = $service->createOrGetUser(Socialite::driver($provider));

		auth()->login($user);

		return redirect()->to('/home');
	}
}
