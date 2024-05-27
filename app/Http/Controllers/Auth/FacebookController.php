<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        dd('fb');
    }

    public function handleFacebookCallback(Request $request)
    {
        dd($request);
    }
}
