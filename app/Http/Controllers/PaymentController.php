<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::all();
    }

    public function show(Payment $payment)
    {
        return $payment;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|string|max:255',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:pickup_date',
            'payment_method' => 'required|string|in:card,mobile,cash',
            'payment_details' => 'nullable|array',
        ]);

        $validated['user_id'] = Auth::id();

        $payment = Payment::create($validated);
        return response()->json($payment, 201);
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'car' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'image' => 'nullable|string|max:255',
            'pickup_date' => 'sometimes|date',
            'return_date' => 'sometimes|date|after_or_equal:pickup_date',
            'payment_method' => 'sometimes|string|in:card,mobile,cash',
            'payment_details' => 'nullable|array',
        ]);

        $payment->update($validated);
        return response()->json($payment);
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(null, 204);
    }

    // Process payment from the booking form
    public function process(Request $request)
    {
        $validated = $request->validate([
            'car' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|string|max:255',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:pickup_date',
            'payment_method' => 'required|string|in:card,mobile,cash',
            'payment_details' => 'nullable|array',
        ]);

        $validated['user_id'] = Auth::id();

        $payment = Payment::create($validated);

        return response()->json([
            'message' => 'Your booking and payment have been received!',
            'payment' => $payment
        ]);
    }
}
