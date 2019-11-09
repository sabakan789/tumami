<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class TwitterController extends Controller
{

    // ログイン
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    // コールバック
    public function handleProviderCallback()
    {
        try {
            $twitterUser = \Socialite::driver('twitter')->user();
            // $twitterUser = \Socialite::driver('twitter')->userFromTokenAndSecret(env('TWITTER_ACCESS_TOKEN'), env('TWITTER_ACCESS_TOKEN_SECRET'));
        } catch (\Exception $e) {
            return redirect('auth/twitter');
            // return redirect('/login');

        }

        // // 各自ログイン処理
        // // 例
        // $user = User::where('auth_id', $twitterUser->id)->first();
        // if (!$user) {
        //     $user = User::create([
        //         'auth_id' => $twitterUser->id
        //     ]);
        // }
        // Auth::login($user);
        //     return redirect('/home');
        // }
        if ($email = $twitterUser->getEmail()) {
            Auth::login(User::firstOrCreate([
                'email' => $email
            ], [
                'name' => $twitterUser->getName()
            ]));

            return redirect('/home');
        } else {
            return redirect('/login')->with('oauth_error', 'メールアドレスが取得できませんでした');
        }
    }


    // ログアウト
    public function logout(Request $request)
    {
        // 各自ログアウト処理
        // 例
        // Auth::logout();
        return redirect('/');
    }
}
