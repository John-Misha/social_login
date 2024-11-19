<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(Request $request)
    {
        if ($request->has('error') && $request->error == 'access_denied') {
            return redirect('/login')->with('error', 'Access denied. You need to grant permission to access your Facebook account.');
        }

        try {
            $facebookUser = Socialite::driver('facebook')->user();
            dd($facebookUser);
        } catch (InvalidStateException $e) {
            return redirect('/login')->with('error', 'Invalid state exception. Please try again.');
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong. Please try again.');
        }

        $user = User::where('email', $facebookUser->email)->first();
        
        if ($user) {;
            Auth::login($user);
        } else {
            DB::transaction(function () use($facebookUser) {
                $user = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'password' => Hash::make('123456')
                ]);
                
                UserDetails::create([
                    'user_id' => $user->id,
                    'facebook_id' => $facebookUser->id,
                    'facebook_avatar' => $facebookUser->avatar,
                ]);

                Auth::login($user);
            });

        }

        return redirect()->intended('dashboard');
    }
}
