<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);

        $data['user'] = $user;

        return view('profile', $data);
    }

    public function update(Request $request)
    {
        $fields = $request->validate([
            'id' => ['required', 'exists:users,id'],
            'name' => ['required'],
        ]);

        $user = User::find($fields['id']);

        DB::transaction(function () use ($user, $fields) {
            $user->update([
                'name' => $fields['name']
            ]);
        });

        return redirect()->back()->with('err_msg', 'Profile updated');
    }
}
