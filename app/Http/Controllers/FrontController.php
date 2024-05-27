<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function support()
    {
       return view('front.support');
    }

    public function terms_condition()
    {
        return view('front.terms_condition');
    }

    public function privacy_policy()
    {
        return view('front.privacy_policy');
    }
}
