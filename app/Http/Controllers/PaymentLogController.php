<?php

namespace App\Http\Controllers;

use App\Models\PaymentLog;
use Illuminate\Http\Request;

class PaymentLogController extends Controller
{
    public function index()
    {
        return PaymentLog::all();
    }

    public function show(PaymentLog $paymentLog)
    {
        return $paymentLog;
    }

    public function store(Request $request)
    {
        $paymentLog = PaymentLog::create($request->all());
        return response()->json($paymentLog, 201);
    }

    public function update(Request $request, PaymentLog $paymentLog)
    {
        $paymentLog->update($request->all());
        return response()->json($paymentLog);
    }

    public function destroy(PaymentLog $paymentLog)
    {
        $paymentLog->delete();
        return response()->json(null, 204);
    }
}