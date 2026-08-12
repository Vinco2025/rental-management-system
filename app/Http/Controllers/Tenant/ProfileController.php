<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user   = Auth::user();
        $tenant = $user->tenant;

        return view('tenant.profile.edit', compact('user', 'tenant'));
    }

    public function update(Request $request)
    {
        $user   = Auth::user();
        $tenant = $user->tenant;

        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $user->update(['name' => $request->name]);

        $tenant->update([
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('tenant.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}