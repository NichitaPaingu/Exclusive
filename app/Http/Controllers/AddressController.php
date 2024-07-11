<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('dashboard.address.partials.profile-address', ['address' => $user->address]);
    }
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.address.partials.edit_address', ['address' => $user->address]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $address = $user->address;

        $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
        ]);

        if ($address) {
            $address->update($request->all());
        } else {
            $address = Address::create($request->all());
            $user->address()->associate($address);
            $user->save();
        }

        return response()->json(['success' => 'Address updated successfully!']);
    }

    public function create()
    {
        return view('dashboard.address.partials.create_address');
    }

    public function store(Request $request)
    {
        $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
        ]);

        $address = Address::create($request->all());
        $user = Auth::user();
        $user->address()->associate($address);
        $user->save();

        return response()->json(['success' => 'Address added successfully!']);
    }
}
