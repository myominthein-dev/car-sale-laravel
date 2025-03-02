<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle () {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback () {
        try {
        $googleUser = Socialite::driver('google')->user();
         
        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => Hash::make('password123'),
                'email_verified_at' => now()
            ]);
        } else {
            $user->google_id = $googleUser->id;
            $user->save();
        }

        Auth::login($user, true);

        return redirect()->to('/home');
        } catch (\Exception $e) {
            return redirect()->to('/login');
        }
    }
}
