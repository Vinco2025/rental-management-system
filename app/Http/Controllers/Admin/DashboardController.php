<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\LeaseContract;
use App\Models\Bill;
use App\Models\MaintenanceRequest;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRooms     = Room::count();
        $occupiedRooms  = Room::where('status', 'occupied')->count();
        $availableRooms = Room::where('status', 'available')->count();
        $occupancyRate  = $totalRooms > 0
            ? round(($occupiedRooms / $totalRooms) * 100)
            : 0;

        $totalTenants  = Tenant::count();
        $activeTenants = LeaseContract::where('status', 'active')->count();

        $unpaidBills      = Bill::where('status', 'unpaid')->count();
        $partialBills     = Bill::where('status', 'partial')->count();
        $totalOutstanding = Bill::whereIn('status', ['unpaid', 'partial'])
            ->sum('balance');
        $collectedThisMonth = DB::table('payments')
            ->whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->sum('amount');

        $openRequests     = MaintenanceRequest::where('status', 'open')->count();
        $inProgressRequests = MaintenanceRequest::where('status', 'in_progress')->count();
        $resolvedThisMonth  = MaintenanceRequest::where('status', 'resolved')
            ->whereMonth('resolved_at', now()->month)
            ->whereYear('resolved_at', now()->year)
            ->count();

        $recentLeases = LeaseContract::with(['tenant', 'room'])
            ->latest()
            ->take(5)
            ->get();

        $recentPayments = DB::table('payments')
            ->join('bills', 'payments.bill_id', '=', 'bills.id')
            ->join('tenants', 'bills.tenant_id', '=', 'tenants.id')
            ->select(
                'payments.amount',
                'payments.payment_date',
                'payments.payment_method',
                'tenants.first_name',
                'tenants.last_name',
                'bills.billing_month'
            )
            ->orderByDesc('payments.created_at')
            ->take(5)
            ->get();

        $recentMaintenance = MaintenanceRequest::with(['tenant', 'room'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRooms', 'occupiedRooms', 'availableRooms', 'occupancyRate',
            'totalTenants', 'activeTenants',
            'unpaidBills', 'partialBills', 'totalOutstanding', 'collectedThisMonth',
            'openRequests', 'inProgressRequests', 'resolvedThisMonth',
            'recentLeases', 'recentPayments', 'recentMaintenance'
        ));
    }
}