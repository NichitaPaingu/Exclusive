<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('dashboard.profile.partials.profile-info', ['user' => Auth::user()]);
    }
    public function edit()
    {
        return view('dashboard.profile.partials.edit_profile');
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->update($request->only('first_name', 'last_name', 'email'));

        if ($request->filled('current_password') || $request->filled('new_password') || $request->filled('confirm_password')) {
            // Проверяем, заполнены ли все три поля пароля
            if (!$request->filled('current_password') || !$request->filled('new_password') || !$request->filled('confirm_password')) {
                return response()->json(['error' => 'Please fill out all password fields.'], 400);
            }

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
