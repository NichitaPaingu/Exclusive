<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        $validatedAttributes = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email', 'max:255'],
            'password' => ['required', Password::min(8)],
        ]);

        $user = User::create([
            'first_name' => $validatedAttributes['first_name'],
            'last_name' => $validatedAttributes['last_name'],
            'email' => $validatedAttributes['email'],
            'password' => bcrypt($validatedAttributes['password']),
        ]);

        Auth::login($user);
        
        $request->session()->regenerate();

        return response()->json(['success' => 'Регистрация прошла успешно', 'user' => Auth::user()]);
    }
}
