<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::with('user')
            ->orderBy('last_name')
            ->paginate(10);

        return view('admin.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // User account
            'name'                    => 'required|string|max:255',
            'email'                   => 'required|email|unique:users,email',

            // Basic info
            'first_name'              => 'required|string|max:255',
            'last_name'               => 'required|string|max:255',
            'phone'                   => 'required|string|max:20',
            'address'                 => 'required|string',
            'birthdate'               => 'required|date',
            'gender'                  => 'required|in:male,female,other',

            // Emergency contact
            'emergency_name'          => 'required|string|max:255',
            'emergency_phone'         => 'required|string|max:20',
            'emergency_relationship'  => 'required|string|max:255',

            // ID document
            'id_type'                 => 'required|string|max:255',
            'id_number'               => 'required|string|max:255',

            // Tenancy info
            'move_in_date'            => 'required|date',
            'status'                  => 'required|in:active,inactive',
            'notes'                   => 'nullable|string',
        ]);

        // Auto-generate a password for the tenant's account
        $password = Str::random(10);

        // Create the User account
        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        // Assign the tenant role
        $user->assignRole('tenant');

        // Create the Tenant profile linked to that user
        Tenant::create([
            'user_id'                 => $user->id,
            'first_name'              => $request->first_name,
            'last_name'               => $request->last_name,
            'phone'                   => $request->phone,
            'address'                 => $request->address,
            'birthdate'               => $request->birthdate,
            'gender'                  => $request->gender,
            'emergency_name'          => $request->emergency_name,
            'emergency_phone'         => $request->emergency_phone,
            'emergency_relationship'  => $request->emergency_relationship,
            'id_type'                 => $request->id_type,
            'id_number'               => $request->id_number,
            'move_in_date'            => $request->move_in_date,
            'status'                  => $request->status,
            'notes'                   => $request->notes,
        ]);

        // Flash the generated password so admin can share it with the tenant
        session()->flash('generated_password', $password);
        session()->flash('generated_email', $request->email);

        return redirect()->route('admin.tenants.index')
            ->with('success', "Tenant {$request->first_name} {$request->last_name} added successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        $tenant->load('user');
        return view('admin.tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        $tenant->load('user');
        return view('admin.tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        $request->validate([
            'first_name'              => 'required|string|max:255',
            'last_name'               => 'required|string|max:255',
            'phone'                   => 'required|string|max:20',
            'address'                 => 'required|string',
            'birthdate'               => 'required|date',
            'gender'                  => 'required|in:male,female,other',
            'emergency_name'          => 'required|string|max:255',
            'emergency_phone'         => 'required|string|max:20',
            'emergency_relationship'  => 'required|string|max:255',
            'id_type'                 => 'required|string|max:255',
            'id_number'               => 'required|string|max:255',
            'move_in_date'            => 'required|date',
            'status'                  => 'required|in:active,inactive',
            'notes'                   => 'nullable|string',
        ]);

        $tenant->update($request->except(['_token', '_method']));

        return redirect()->route('admin.tenants.show', $tenant)
            ->with('success', 'Tenant profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->user()->delete();

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant removed successfully.');
    }
}
