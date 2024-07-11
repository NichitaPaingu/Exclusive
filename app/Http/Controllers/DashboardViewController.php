<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class DashboardViewController extends Controller
{
    public function returns()
    {
        return view('dashboard.partials.profile-returns', ['user' => Auth::user()]);
    }

    public function cancellations()
    {
        return view('dashboard.partials.profile-cancellations', ['user' => Auth::user()]);
    }

}
