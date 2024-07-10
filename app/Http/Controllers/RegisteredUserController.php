<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.main');
    }

    // public function store(Request $request)
    // {
    //     $validatedAttributes = $request->validate([
    //         'first_name' => ['required', 'string', 'max:255'],
    //         'last_name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'email', 'unique:users,email', 'max:255'],
    //         'password' => ['required', Password::min(8)],
    //     ]);

    //     $user = User::create([
    //         'first_name' => $validatedAttributes['first_name'],
    //         'last_name' => $validatedAttributes['last_name'],
    //         'email' => $validatedAttributes['email'],
    //         'password' => bcrypt($validatedAttributes['password']),
    //     ]);

    //     Auth::login($user);

    //     return redirect()->route('dashboard')->with('success', 'Регистрация прошла успешно');
    // }
}
