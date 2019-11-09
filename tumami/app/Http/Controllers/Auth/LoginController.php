<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * OAuth認証先にリダイレクト
     *
     * @param str $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * OAuth認証の結果受け取り
     *
     * @param str $provider
     * @return \Illuminate\Http\Response
     */
    // public function handleProviderCallback($provider)
    // {
    //     try {
    //         // $providerUser = \Socialite::with($provider)->user();
    //         $providerUser = \Socialite::driver($provider)->userFromTokenAndSecret(env('TWITTER_ACCESS_TOKEN'), env('TWITTER_ACCESS_TOKEN_SECRET'));
    //     }catch (\Exception $e) {
    //         return redirect('/login')->with('oauth_error', '予期せぬエラーが発生しました');
    //     }

    public function handleProviderCallback()
    {
        try {
            $providerUser = Socialite::driver('twitter')->user();
            // $providerUser = Socialite::driver('twitter')->userFromTokenAndSecret(env('TWITTER_ACCESS_TOKEN'), env('TWITTER_ACCESS_TOKEN_SECRET'));
        } catch (\Exception $e) {
            // return redirect('auth/twitter');
            return redirect('/login');
        }

        if ($email = $providerUser->getEmail()) {
            Auth::login(User::firstOrCreate([
                'email' => $email
            ], [
                'name' => $providerUser->getName()
            ]));

            return redirect($this->redirectTo);
            // return redirect('/home');
        } else {
            return redirect('/login')->with('oauth_error', 'メールアドレスが取得できませんでした');
        }

    }
}