<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LeaseController extends Controller
{
    public function index()
    {
        $tenant = Auth::user()->tenant;
        $lease  = $tenant?->activeLease()?->with('room.roomType')->first();

        return view('tenant.lease.index', compact('tenant', 'lease'));
    }
}