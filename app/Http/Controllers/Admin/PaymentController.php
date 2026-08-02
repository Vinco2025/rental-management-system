<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Bill $bill)
    {
        return view('admin.payments.create', compact('bill'));
    }

    public function store(Request $request, Bill $bill)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01|max:' . $bill->balance,
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:cash,bank_transfer,gcash,other',
            'notes' => 'nullable|string',
        ]);

        Payment::create([
            'bill_id' => $bill->id,
            'tenant_id' => $bill->tenant_id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
        ]);

        $bill->recalculate();

        return redirect()->route('admin.bills.show', $bill)
            ->with('success', 'Payment recorded successfully.');
    }

    public function destroy(Bill $bill, Payment $payment)
    {
        $payment->delete();
        $bill->recalculate();

        return redirect()->route('admin.bills.show', $bill)
            ->with('success', 'Payment removed.');
    }
}