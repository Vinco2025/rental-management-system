<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tenant = $user->tenant;

        $lease = $tenant?->activeLease()?->with('room.roomType')->first();
        $room = $lease?->room;

        $bills = $tenant ? \App\Models\Bill::where('tenant_id', $tenant->id)
            ->orderBy('billing_month', 'desc')
            ->take(5)
            ->get() : collect();

        $unpaidBalance = $tenant ? \App\Models\Bill::where('tenant_id', $tenant->id)
            ->whereIn('status', ['unpaid', 'partial'])
            ->sum('balance') : 0;

        $maintenanceRequests = $tenant ? \App\Models\MaintenanceRequest::where('tenant_id', $tenant->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get() : collect();

        $openRequestsCount = $tenant ? \App\Models\MaintenanceRequest::where('tenant_id', $tenant->id)
            ->whereIn('status', ['pending', 'in_progress'])
            ->count() : 0;

        return view('tenant.dashboard', compact(
            'tenant', 'lease', 'room', 'bills',
            'unpaidBalance', 'maintenanceRequests', 'openRequestsCount'
        ));
    }
}