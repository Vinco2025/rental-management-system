<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function index()
    {
        $tenant = Auth::user()->tenant;

        $bills = Bill::where('tenant_id', $tenant->id)
            ->orderBy('billing_month', 'desc')
            ->get();

        $unpaidBalance = $bills->whereIn('status', ['unpaid', 'partial'])->sum('balance');
        $paidCount     = $bills->where('status', 'paid')->count();
        $unpaidCount   = $bills->whereIn('status', ['unpaid', 'partial'])->count();

        return view('tenant.bills.index', compact('bills', 'unpaidBalance', 'paidCount', 'unpaidCount'));
    }

    public function show(Bill $bill)
    {

        $tenant = Auth::user()->tenant;
        abort_if($bill->tenant_id !== $tenant->id, 403);

        $payments = $bill->payments()->orderBy('created_at', 'desc')->get();

        return view('tenant.bills.show', compact('bill', 'payments'));
    }
}