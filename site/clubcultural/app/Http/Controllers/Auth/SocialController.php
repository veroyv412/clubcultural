<?php

namespace App\Http\Controllers\Auth;

use Socialite;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\SocialAccountService;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(SocialAccountService $service, $provider)
    {
        $user = $service->createOrGetUser(Socialite::driver($provider));

        auth()->login($user);

        return redirect()->to('/');
    }
}
