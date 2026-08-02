<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\LeaseContract;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with(['tenant', 'leaseContract'])
            ->orderBy('billing_month', 'desc')
            ->paginate(15);

        return view('admin.bills.index', compact('bills'));
    }

    public function create()
    {
        return view('admin.bills.generate');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'billing_month' => 'required|date_format:Y-m',
        ]);

        $month = Carbon::createFromFormat('Y-m', $request->billing_month)->startOfMonth();

        $activeLeases = LeaseContract::with('tenant')
            ->where('status', 'active')
            ->get();

        if ($activeLeases->isEmpty()) {
            return back()->with('error', 'No active leases found.');
        }

        $generated = 0;
        $skipped = 0;

        foreach ($activeLeases as $lease) {
            $exists = Bill::where('lease_contract_id', $lease->id)
                ->where('billing_month', $month->toDateString())
                ->exists();

            if ($exists) {
                $skipped++;
                continue;
            }

            Bill::create([
                'lease_contract_id' => $lease->id,
                'tenant_id' => $lease->tenant_id,
                'billing_month' => $month->toDateString(),
                'rent_amount' => $lease->monthly_rate,
                'electricity_amount' => 0,
                'water_amount' => 0,
                'total_amount' => $lease->monthly_rate,
                'amount_paid' => 0,
                'balance' => $lease->monthly_rate,
                'status' => 'unpaid',
                'due_date' => $month->copy()->addDays(7)->toDateString(),
            ]);

            $generated++;
        }

        $message = "Bills generated: {$generated}.";
        if ($skipped > 0) {
            $message .= " Skipped {$skipped} (already existed).";
        }

        return redirect()->route('admin.bills.index')->with('success', $message);
    }

    public function show(Bill $bill)
    {
        $bill->load(['tenant', 'leaseContract', 'payments']);
        return view('admin.bills.show', compact('bill'));
    }

    public function edit(Bill $bill)
    {
        return view('admin.bills.edit', compact('bill'));
    }

    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'electricity_amount' => 'required|numeric|min:0',
            'water_amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $total = $bill->rent_amount
            + $request->electricity_amount
            + $request->water_amount;

        $bill->update([
            'electricity_amount' => $request->electricity_amount,
            'water_amount' => $request->water_amount,
            'total_amount' => $total,
            'balance' => $total - $bill->amount_paid,
            'due_date' => $request->due_date,
            'notes' => $request->notes,
        ]);

        $bill->recalculate();

        return redirect()->route('admin.bills.show', $bill)
            ->with('success', 'Bill updated successfully.');
    }

    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('admin.bills.index')
            ->with('success', 'Bill deleted.');
    }
}