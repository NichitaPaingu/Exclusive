<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function info()
    {
        return view('dashboard.partials.profile-info', ['user' => Auth::user()]);
    }

    public function address()
    {
        return view('dashboard.partials.profile-address', ['user' => Auth::user()]);
    }

    public function payment()
    {
        return view('dashboard.partials.profile-payment', ['user' => Auth::user()]);
    }

    public function returns()
    {
        return view('dashboard.partials.profile-returns', ['user' => Auth::user()]);
    }

    public function cancellations()
    {
        return view('dashboard.partials.profile-cancellations', ['user' => Auth::user()]);
    }

    public function wishlist()
    {
        return view('dashboard.partials.profile-wishlist', ['user' => Auth::user()]);
    }
    public function cart()
    {
        return view('dashboard.partials.profile-cart', ['user' => Auth::user()]);
    }

    public function editProfile()
    {
        return view('profile.partials.edit_profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->update($request->only('first_name', 'last_name', 'email'));

        if ($request->filled('current_password') && $request->filled('new_password') && $request->filled('confirm_password')) {
            if (Hash::check($request->current_password, $user->password)) {
                if ($request->new_password === $request->confirm_password) {
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                } else {
                    return response()->json(['error' => 'New password and confirmation do not match.'], 400);
                }
            } else {
                return response()->json(['error' => 'Current password is incorrect.'], 400);
            }
        }

        return response()->json(['success' => 'Profile updated successfully!']);
    }
}

