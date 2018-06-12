<?php

namespace RicLeP\SocialLogin;


use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\Provider;

class SocialAccountService
{
	/**
	 * Checks for and returns an authenticated user.
	 * It takes a Socialite driver and creates and social and laravel user
	 * if required. If two social accounts have matching email addresses
	 * then they are both linked to the same Laravel user
	 *
	 * @param Provider $provider
	 * @return User
	 */
	public function createOrGetUser(Provider $provider)
	{
		$providerUser = $provider->user();
		$providerName = class_basename($provider);

		// look for existing social auth
		$account = SocialAccount::whereProvider($providerName)
			->whereProviderUserId($providerUser->getId())
			->first();

		if ($account) {
			// return social auth’s Laravel user
			return $account->user;
		}

		// this is a new social auth to save it
		$account = new SocialAccount([
			'provider_user_id' => $providerUser->getId(),
			'provider' => $providerName
		]);

		// check for an existing user by email or create a new one
		$user = User::whereEmail($providerUser->getEmail())->first();

		if (!$user) {
			$user = new User();
			$user->name = $providerUser->getName();
			$user->email = $providerUser->getEmail();
			$user->password = Hash::make(str_random(100)); // we are generating this account so add a crazy password!
			$user->last_read_announcements_at = Carbon::now();
			$user->save();
		}

		$account->user()->associate($user);
		$account->save();

		return $user;
	}
}