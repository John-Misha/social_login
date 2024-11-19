<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        if ($request->has('error') && $request->error == 'access_denied') {
            return redirect('/login')->with('error', 'Access denied. You need to grant permission to access your Google account.');
        }

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            return redirect('/login')->with('error', 'Invalid state exception. Please try again.');
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong. Please try again.');
        }
        
        $user = User::where('email', $googleUser->email)->first();
        
        if ($user) {;
            Auth::login($user);
        } else {
            DB::transaction(function () use($googleUser) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('123456')
                ]);
                
                UserDetails::create([
                    'user_id' => $user->id,
                    'google_id' => $googleUser->id,
                    'google_avatar' => $googleUser->avatar,
                ]);

                Auth::login($user);
            });

        }

        return redirect()->intended('dashboard');
    }
}
