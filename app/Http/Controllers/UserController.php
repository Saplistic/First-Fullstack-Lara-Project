<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function profile($name)
    {
        $user = User::where('name', '=', $name)->firstOrFail();
        return view('users.profile', compact('user'));
    }

    public function grantAdmin($id)
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'You dont have the rights');
        }

        $user = User::findOrFail($id);
        $user->is_admin = true;
        $user->save();
        return redirect()->back()->with('status', 'Succesfully promoted user to admin!');
    }
}
