<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $socialUser = Socialite::driver('google')->user();
        $registeredUser = User::where("google_id", $socialUser->id)->first();

        $password = Str::random(12);

        do {
            $username = 'user' . str_pad(random_int(0, 999999999999), 12, '0', STR_PAD_LEFT);
        } while (User::where('username', $username)->exists());

        if (!$registeredUser) {
            $user = User::updateOrCreate(
                [
                    'google_id' => $socialUser->id,
                ],
                [
                    'username' => $username,
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'password' => Hash::make($password),
                    'google_token' => $socialUser->token,
                    'google_refresh_token' => $socialUser->refreshToken,
                ]
            );

            Auth::login($user);

            return redirect('/');
        }

        Auth::login($registeredUser);

        return redirect('/');
    }
}