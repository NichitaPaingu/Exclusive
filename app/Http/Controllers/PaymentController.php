<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $paymentMethods = $user->paymentMethods->map(function ($paymentMethod) {
            $paymentMethod->card_number = Crypt::decryptString($paymentMethod->card_number);
            $paymentMethod->cvv = Crypt::decryptString($paymentMethod->cvv);
            return $paymentMethod;
        });

        return view('dashboard.payment.partials.profile-payment', ['paymentMethods' => $paymentMethods]);
    }

    public function edit($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->card_number = Crypt::decryptString($paymentMethod->card_number);
        $paymentMethod->cvv = Crypt::decryptString($paymentMethod->cvv);

        return view('dashboard.payment.partials.edit_payment', ['paymentMethod' => $paymentMethod]);
    }

    public function create()
    {
        return view('dashboard.payment.partials.create_payment');
    }
    public function store(Request $request)
    {
        \Log::info($request->all()); // Логирование данных запроса

        $request->validate([
            'card_number' => 'required|string|size:16',
            'expiry_date' => 'required|string|size:4',
            'cvv' => 'required|string|size:3',
        ]);

        $user = Auth::user();
        $paymentMethod = new PaymentMethod([
            'card_number' => Crypt::encryptString($request->card_number),
            'expiry_date' => $request->expiry_date,
            'cvv' => Crypt::encryptString($request->cvv),
        ]);
        $user->paymentMethods()->save($paymentMethod);

        return response()->json(['success' => 'Payment options added successfully!']);
    }

    public function update(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        $request->validate([
            'card_number' => 'required|string|size:16',
            'expiry_date' => 'required|string|size:4',
            'cvv' => 'required|string|size:3',
        ]);

        $paymentMethod->update([
            'card_number' => Crypt::encryptString($request->card_number),
            'expiry_date' => $request->expiry_date,
            'cvv' => Crypt::encryptString($request->cvv),
        ]);

        return response()->json(['success' => 'Payment options updated successfully!']);
    }
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->delete();

        return response()->json(['success' => 'Payment option deleted successfully!']);
    }
}

