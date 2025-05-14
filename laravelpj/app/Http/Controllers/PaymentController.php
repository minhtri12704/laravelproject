<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function showForm()
    {
        return view('page.payment');
    }
    public function process(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email',
            'address'         => 'required|string|max:255',
            'amount'          => 'required|numeric|min:0',
            'payment_method'  => 'required|in:cash,bank',
        ]);
        

        Payment::create($validated);

        return redirect()->route('payment.form')->with('success', 'Thanh toán thành công!');
    }
    

}