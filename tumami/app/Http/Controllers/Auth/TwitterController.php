<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class TwitterController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $twitterUser = \Socialite::driver('twitter')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        if ($email = $twitterUser->getEmail()) {
            Auth::login(User::firstOrCreate([
                'email' => $email
            ], [
                'name' => $twitterUser->getName()
            ]));
            return redirect('/');
        }else {
            return redirect('/login')->with('oauth_error', 'メールアドレスが取得できませんでした');
        }
    }
}
