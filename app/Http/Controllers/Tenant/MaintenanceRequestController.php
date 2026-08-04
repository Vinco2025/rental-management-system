<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class MaintenanceRequestController extends Controller
{
    public function index()
    {
        $tenant = auth()->user()->tenant;

        $requests = MaintenanceRequest::where('tenant_id', $tenant->id)
            ->orderByRaw("FIELD(status, 'pending', 'in_progress', 'resolved')")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tenant.maintenance.index', compact('requests'));
    }

    public function create()
    {
        $tenant = auth()->user()->tenant;

        $room = $tenant->activeLease?->room;

        return view('tenant.maintenance.create', compact('tenant', 'room'));
    }

    public function store(Request $request)
    {
        $tenant = auth()->user()->tenant;

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'priority'    => 'required|in:low,medium,high,urgent',
        ]);

        MaintenanceRequest::create([
            'tenant_id'    => $tenant->id,
            'room_id'      => $tenant->activeLease->room_id,
            'title'        => $request->title,
            'description'  => $request->description,
            'priority'     => $request->priority,
            'status'       => 'pending',
            'submitted_by' => 'tenant',
        ]);

        return redirect()->route('tenant.maintenance.index')
            ->with('success', 'Your request has been submitted.');
    }

    public function show(MaintenanceRequest $maintenance)
    {
        $tenant = auth()->user()->tenant;

        if ($maintenance->tenant_id !== $tenant->id) {
            abort(403);
        }

        return view('tenant.maintenance.show', compact('maintenance'));
    }
}