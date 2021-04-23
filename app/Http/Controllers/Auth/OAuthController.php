<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class OAuthController extends Controller
{
    /**
     * 各SNSのOAuth認証画面にリダイレクトして認証
     * @param string $provider サービス名
     * @return mixed
     */
    public function socialOAuth(string $provider)
    {
        // TODO あとで実装
        return Socialite::driver($provider)->redirect();
        // return redirect('/login');
    }

    /**
     * 各サイトからのコールバック
     * @param string $provider サービス名
     * @return mixed
     */
    public function handleProviderCallback($provider)
    {
        // TODO あとで実装
        // return redirect('/posts');
        $social_user = Socialite::driver($provider)->user();
        $social_email = $social_user->getEmail();
        $social_name = $social_user->getName();

        if(!is_null($social_email)) {

            $user = User::firstOrCreate([
                'email' => $social_email
            ], [
                'email' => $social_email,
                'name' => $social_name,
                'password' => Hash::make(Str::random())
            ]);

            auth()->login($user);
            return redirect('/posts');

        }
    }
}
