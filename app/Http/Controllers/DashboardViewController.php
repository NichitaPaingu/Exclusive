<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class DashboardViewController extends Controller
{
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

}
