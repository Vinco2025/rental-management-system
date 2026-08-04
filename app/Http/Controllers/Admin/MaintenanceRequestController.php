<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRequest;
use App\Models\Tenant;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MaintenanceRequestController extends Controller
{
    public function index()
    {
        $requests = MaintenanceRequest::with(['tenant', 'room'])
            ->orderByRaw("FIELD(status, 'pending', 'in_progress', 'resolved')")
            ->orderByRaw("FIELD(priority, 'urgent', 'high', 'medium', 'low')")
            ->paginate(15);

        return view('admin.maintenance.index', compact('requests'));
    }

    public function create()
    {
        $tenants = Tenant::orderBy('first_name')->get();
        $rooms = Room::orderBy('room_number')->get();
        return view('admin.maintenance.create', compact('tenants', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenant_id'   => 'required|exists:tenants,id',
            'room_id'     => 'required|exists:rooms,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'priority'    => 'required|in:low,medium,high,urgent',
        ]);

        MaintenanceRequest::create([
            'tenant_id'    => $request->tenant_id,
            'room_id'      => $request->room_id,
            'title'        => $request->title,
            'description'  => $request->description,
            'priority'     => $request->priority,
            'status'       => 'pending',
            'submitted_by' => 'admin',
        ]);

        return redirect()->route('admin.maintenance.index')
            ->with('success', 'Maintenance request created.');
    }

    public function show(MaintenanceRequest $maintenance)
    {
        $maintenance->load(['tenant', 'room']);
        return view('admin.maintenance.show', compact('maintenance'));
    }

    public function edit(MaintenanceRequest $maintenance)
    {
        return view('admin.maintenance.edit', compact('maintenance'));
    }

    public function update(Request $request, MaintenanceRequest $maintenance)
    {
        $request->validate([
            'priority'         => 'required|in:low,medium,high,urgent',
            'status'           => 'required|in:pending,in_progress,resolved',
            'resolution_notes' => 'nullable|string',
        ]);

        $resolvedAt = $maintenance->resolved_at;

        if ($request->status === 'resolved' && $maintenance->status !== 'resolved') {
            $resolvedAt = Carbon::now();
        }

        if ($request->status !== 'resolved') {
            $resolvedAt = null;
        }

        $maintenance->update([
            'priority'         => $request->priority,
            'status'           => $request->status,
            'resolution_notes' => $request->resolution_notes,
            'resolved_at'      => $resolvedAt,
        ]);

        return redirect()->route('admin.maintenance.show', $maintenance)
            ->with('success', 'Request updated.');
    }

    public function destroy(MaintenanceRequest $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('admin.maintenance.index')
            ->with('success', 'Request deleted.');
    }
}