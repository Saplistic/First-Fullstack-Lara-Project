<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['profile']]);
    }

    public function profile($name)
    {
        $user = User::where('name', '=', $name)->firstOrFail();
        return view('users.profile', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'birthdate' => 'required|date|before_or_equal:' . now()->subYears(13)->format('Y-m-d'),
            'biography' => 'nullable',
            'profile_image' => 'nullable|mimes:png,jpg,jpeg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('profile_image')) {
            $newImageName = time() . '-' . $request->name . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('images/users'), $newImageName);
        } else {
            //assign the path to the previous value if no new file has been uploaded
            $newImageName = $user->profile_image_path;
        }

        $user->update([
            'name' => $request->input('name'),
            'birthdate' => $request->input('birthdate'),
            'biography' => $request->input('biography'),
            'profile_image_path' => $newImageName
        ]);

        return redirect()->route('profile', $user->name)->with('status', 'Profile succesfully updated');
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
