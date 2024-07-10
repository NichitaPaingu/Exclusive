<?php

namespace App\Http\Controllers;

class AuthViewController extends Controller
{
    public function create()
    {
        return view('auth.main');
    }
    public function showRegisterForm()
    {
        return view('auth.partials.register');
    }

    public function showLoginForm()
    {
        return view('auth.partials.login');
    }
}
