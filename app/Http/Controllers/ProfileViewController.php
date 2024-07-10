<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class ProfileViewController extends Controller
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
    
}
