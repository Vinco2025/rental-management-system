<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\LeaseContract;
use App\Models\MaintenanceRequest;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year  = $request->input('year',  now()->year);

        $bills = Bill::with(['tenant', 'leaseContract.room'])
            ->whereMonth('billing_month', $month)
            ->whereYear('billing_month', $year)
            ->orderBy('status')
            ->get();

        $totalBilled      = $bills->sum('total_amount');
        $totalCollected   = $bills->sum('amount_paid');
        $totalOutstanding = $bills->sum('balance');
        $paidCount        = $bills->where('status', 'paid')->count();
        $unpaidCount      = $bills->where('status', 'unpaid')->count();
        $partialCount     = $bills->where('status', 'partial')->count();

        $totalRooms    = Room::count();
        $occupiedRooms = Room::where('status', 'occupied')->count();
        $occupancyRate = $totalRooms > 0
            ? round(($occupiedRooms / $totalRooms) * 100)
            : 0;

        $maintenanceStats = MaintenanceRequest::selectRaw("
                status,
                COUNT(*) as count
            ")
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy('status')
            ->pluck('count', 'status');

        $paymentsByMethod = DB::table('payments')
            ->selectRaw('payment_method, SUM(amount) as total, COUNT(*) as count')
            ->whereMonth('payment_date', $month)
            ->whereYear('payment_date', $year)
            ->groupBy('payment_method')
            ->get();

        $activeLeases = LeaseContract::with(['tenant', 'room'])
            ->where('status', 'active')
            ->get();

        return view('admin.reports.index', compact(
            'month', 'year',
            'bills',
            'totalBilled', 'totalCollected', 'totalOutstanding',
            'paidCount', 'unpaidCount', 'partialCount',
            'totalRooms', 'occupiedRooms', 'occupancyRate',
            'maintenanceStats',
            'paymentsByMethod',
            'activeLeases'
        ));
    }

    public function export(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year  = $request->input('year',  now()->year);

        $bills = Bill::with(['tenant', 'leaseContract.room'])
            ->whereMonth('billing_month', $month)
            ->whereYear('billing_month', $year)
            ->orderBy('status')
            ->get();

        $totalBilled      = $bills->sum('total_amount');
        $totalCollected   = $bills->sum('amount_paid');
        $totalOutstanding = $bills->sum('balance');
        $paidCount        = $bills->where('status', 'paid')->count();
        $unpaidCount      = $bills->where('status', 'unpaid')->count();
        $partialCount     = $bills->where('status', 'partial')->count();

        $totalRooms    = Room::count();
        $occupiedRooms = Room::where('status', 'occupied')->count();
        $occupancyRate = $totalRooms > 0
            ? round(($occupiedRooms / $totalRooms) * 100)
            : 0;

        $maintenanceStats = MaintenanceRequest::selectRaw('status, COUNT(*) as count')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy('status')
            ->pluck('count', 'status');

        $activeLeases = LeaseContract::with(['tenant', 'room'])
            ->where('status', 'active')
            ->get();

        $monthLabel = \Carbon\Carbon::create($year, $month)->format('F Y');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.pdf', compact(
            'month', 'year', 'monthLabel',
            'bills',
            'totalBilled', 'totalCollected', 'totalOutstanding',
            'paidCount', 'unpaidCount', 'partialCount',
            'totalRooms', 'occupiedRooms', 'occupancyRate',
            'maintenanceStats',
            'activeLeases'
        ))->setPaper('a4', 'portrait');

        $filename = 'report-' . \Illuminate\Support\Str::slug($monthLabel) . '.pdf';

        return $pdf->download($filename);
    }
}