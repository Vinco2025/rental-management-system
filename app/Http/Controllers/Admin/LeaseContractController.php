<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaseContract;
use App\Models\Tenant;
use App\Models\Room;
use Illuminate\Http\Request;

class LeaseContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leases = LeaseContract::with(['tenant', 'room'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.lease-contracts.index', compact('leases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tenants = Tenant::with('user')
            ->whereDoesntHave('leaseContracts', function ($query) {
                $query->where('status', 'active');
            })
            ->get();

        $rooms = Room::where('status', 'available')->get();

        return view('admin.lease-contracts.create', compact('tenants', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_id'    => 'required|exists:tenants,id',
            'room_id'      => 'required|exists:rooms,id',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after:start_date',
            'monthly_rate' => 'required|numeric|min:0',
            'notes'        => 'nullable|string',
        ]);

        $validated['status'] = 'active';

        LeaseContract::create($validated);

        Room::findOrFail($validated['room_id'])->update(['status' => 'occupied']);

        session()->flash('success', 'Lease contract created successfully.');

        return redirect()->route('admin.lease-contracts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaseContract $leaseContract)
    {
        $leaseContract->load(['tenant.user', 'room.roomType']);

        return view('admin.lease-contracts.show', compact('leaseContract'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaseContract $leaseContract)
    {
        $tenants = Tenant::with('user')->get();
        $rooms = Room::all();

        return view('admin.lease-contracts.edit', compact('leaseContract', 'tenants', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaseContract $leaseContract)
    {
        $validated = $request->validate([
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after:start_date',
            'monthly_rate' => 'required|numeric|min:0',
            'status'       => 'required|in:active,expired,terminated',
            'notes'        => 'nullable|string',
        ]);

        $oldStatus = $leaseContract->status;
        $leaseContract->update($validated);

        if ($oldStatus === 'active' && in_array($validated['status'], ['expired', 'terminated'])) {
            $leaseContract->room->update(['status' => 'available']);
        }

        if ($validated['status'] === 'active' && $oldStatus !== 'active') {
            $leaseContract->room->update(['status' => 'occupied']);
        }

        session()->flash('success', 'Lease contract updated successfully.');

        return redirect()->route('admin.lease-contracts.show', $leaseContract);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaseContract $leaseContract)
    {
        $room = $leaseContract->room;
        $leaseContract->delete();
        $room->update(['status' => 'available']);

        session()->flash('success', 'Lease contract deleted.');

        return redirect()->route('admin.lease-contracts.index');
    }
}
