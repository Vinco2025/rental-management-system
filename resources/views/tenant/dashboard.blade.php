@extends('layouts.tenant')

@section('content')

{{-- Header --}}
<div class="mb-6">
    <h1 class="text-2xl font-bold" style="color:#3D2314;">My Dashboard</h1>
    <p class="text-sm mt-1" style="color:#7A5542;">
        Welcome back, {{ Auth::user()->name }}
    </p>
</div>

{{-- No lease warning --}}
@if(!$lease)
    <div class="px-4 py-3 rounded-lg text-sm mb-6" style="background:#fdecea;color:#b91c1c;">
        <i class="ti ti-alert-circle mr-1"></i>
        You don't have an active lease. Please contact the admin.
    </div>
@endif

{{-- Stat Cards --}}
<div class="grid grid-cols-4 gap-4 mb-6">

    {{-- Room --}}
    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold uppercase tracking-wide" style="color:#7A5542;">Room</p>
            <span class="flex items-center justify-center w-8 h-8 rounded-lg" style="background:#FDF8F4;">
                <i class="ti ti-door text-base" style="color:#C2622A;"></i>
            </span>
        </div>
        <p class="text-2xl font-bold" style="color:#3D2314;">
            {{ $room ? $room->room_number : '—' }}
        </p>
        <p class="text-xs mt-1" style="color:#7A5542;">
            {{ $room ? $room->roomType->name : 'No active lease' }}
        </p>
    </div>

    {{-- Monthly Rent --}}
    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold uppercase tracking-wide" style="color:#7A5542;">Monthly Rent</p>
            <span class="flex items-center justify-center w-8 h-8 rounded-lg" style="background:#FDF8F4;">
                <i class="ti ti-cash text-base" style="color:#C2622A;"></i>
            </span>
        </div>
        <p class="text-2xl font-bold" style="color:#3D2314;">
            ₱{{ $room ? number_format($room->roomType->monthly_rate, 2) : '0.00' }}
        </p>
        <p class="text-xs mt-1" style="color:#7A5542;">per month</p>
    </div>

    {{-- Outstanding Balance --}}
    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold uppercase tracking-wide" style="color:#7A5542;">Outstanding Balance</p>
            <span class="flex items-center justify-center w-8 h-8 rounded-lg" style="background:#FDF8F4;">
                <i class="ti ti-receipt text-base" style="color:#C2622A;"></i>
            </span>
        </div>
        <p class="text-2xl font-bold" style="{{ $unpaidBalance > 0 ? 'color:#b91c1c;' : 'color:#3D2314;' }}">
            ₱{{ number_format($unpaidBalance, 2) }}
        </p>
        <p class="text-xs mt-1" style="color:#7A5542;">
            {{ $unpaidBalance > 0 ? 'unpaid / partial bills' : 'all clear' }}
        </p>
    </div>

    {{-- Open Requests --}}
    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold uppercase tracking-wide" style="color:#7A5542;">Open Requests</p>
            <span class="flex items-center justify-center w-8 h-8 rounded-lg" style="background:#FDF8F4;">
                <i class="ti ti-tool text-base" style="color:#C2622A;"></i>
            </span>
        </div>
        <p class="text-2xl font-bold" style="color:#3D2314;">{{ $openRequestsCount }}</p>
        <p class="text-xs mt-1" style="color:#7A5542;">pending or in progress</p>
    </div>

</div>

{{-- Lease Summary + Quick Actions --}}
<div class="grid grid-cols-3 gap-4 mb-6">

    {{-- Lease Summary --}}
    <div class="col-span-2 rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <p class="text-xs font-semibold uppercase tracking-wide mb-4" style="color:#7A5542;">Lease Summary</p>
        @if($lease)
            <div class="grid grid-cols-2 gap-y-3 text-sm">
                <div>
                    <p class="text-xs" style="color:#7A5542;">Room Number</p>
                    <p class="font-semibold mt-0.5" style="color:#3D2314;">{{ $room->room_number }}</p>
                </div>
                <div>
                    <p class="text-xs" style="color:#7A5542;">Room Type</p>
                    <p class="font-semibold mt-0.5" style="color:#3D2314;">{{ $room->roomType->name }}</p>
                </div>
                <div>
                    <p class="text-xs" style="color:#7A5542;">Start Date</p>
                    <p class="font-semibold mt-0.5" style="color:#3D2314;">{{ \Carbon\Carbon::parse($lease->start_date)->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-xs" style="color:#7A5542;">End Date</p>
                    <p class="font-semibold mt-0.5" style="color:#3D2314;">{{ \Carbon\Carbon::parse($lease->end_date)->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-xs" style="color:#7A5542;">Monthly Rate</p>
                    <p class="font-semibold mt-0.5" style="color:#3D2314;">₱{{ number_format($room->roomType->monthly_rate, 2) }}</p>
                </div>
                <div>
                    <p class="text-xs" style="color:#7A5542;">Status</p>
                    <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold mt-0.5" style="background:#EAF3DE;color:#3D6B1F;">Active</span>
                </div>
            </div>
        @else
            <p class="text-sm" style="color:#7A5542;">No active lease on record.</p>
        @endif
    </div>

    {{-- Quick Actions --}}
    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <p class="text-xs font-semibold uppercase tracking-wide mb-4" style="color:#7A5542;">Quick Actions</p>
        <div class="flex flex-col gap-3">
            <a href="{{ route('tenant.maintenance.create') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium"
                style="background:#FDF8F4;color:#3D2314;border:1px solid #E8DDD4;">
                <i class="ti ti-plus text-base" style="color:#C2622A;"></i>
                Submit Maintenance Request
            </a>
            <a href="{{ route('tenant.maintenance.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium"
                style="background:#FDF8F4;color:#3D2314;border:1px solid #E8DDD4;">
                <i class="ti ti-list text-base" style="color:#C2622A;"></i>
                View All Requests
            </a>
            <a href="{{ route('tenant.bills.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium"
                style="background:#FDF8F4;color:#3D2314;border:1px solid #E8DDD4;">
                <i class="ti ti-file-invoice text-base" style="color:#C2622A;"></i>
                View My Bills
            </a>
        </div>
    </div>

</div>

{{-- Recent Bills + Recent Maintenance --}}
<div class="grid grid-cols-2 gap-4">

    {{-- Recent Bills --}}
    <div class="rounded-xl overflow-hidden" style="border:1px solid #E8DDD4;background:#fff;">
        <div class="flex items-center justify-between px-5 py-4" style="border-bottom:1px solid #E8DDD4;">
            <p class="text-xs font-semibold uppercase tracking-wide" style="color:#7A5542;">Recent Bills</p>
            <a href="{{ route('tenant.bills.index') }}" class="text-xs font-medium" style="color:#C2622A;">View all</a>
        </div>
        <table class="w-full text-sm">
            <tbody>
                @forelse($bills as $bill)
                <tr style="border-bottom:1px solid #E8DDD4;">
                    <td class="px-5 py-3" style="color:#3D2314;">
                        {{ \Carbon\Carbon::parse($bill->billing_month)->format('F Y') }}
                    </td>
                    <td class="px-5 py-3 text-right font-medium" style="color:#3D2314;">
                        ₱{{ number_format($bill->total_amount, 2) }}
                    </td>
                    <td class="px-5 py-3 text-right">
                        @if($bill->status === 'paid')
                            <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#EAF3DE;color:#3D6B1F;">Paid</span>
                        @elseif($bill->status === 'partial')
                            <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#FEF3C7;color:#92400E;">Partial</span>
                        @else
                            <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#fdecea;color:#b91c1c;">Unpaid</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-5 py-8 text-center text-sm" style="color:#7A5542;">No bills yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Recent Maintenance Requests --}}
    <div class="rounded-xl overflow-hidden" style="border:1px solid #E8DDD4;background:#fff;">
        <div class="flex items-center justify-between px-5 py-4" style="border-bottom:1px solid #E8DDD4;">
            <p class="text-xs font-semibold uppercase tracking-wide" style="color:#7A5542;">Recent Maintenance</p>
            <a href="{{ route('tenant.maintenance.index') }}" class="text-xs font-medium" style="color:#C2622A;">View all</a>
        </div>
        <table class="w-full text-sm">
            <tbody>
                @forelse($maintenanceRequests as $req)
                <tr style="border-bottom:1px solid #E8DDD4;">
                    <td class="px-5 py-3 font-medium" style="color:#3D2314;">{{ $req->title }}</td>
                    <td class="px-5 py-3 text-right">
                        @if($req->status === 'resolved')
                            <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#EAF3DE;color:#3D6B1F;">Resolved</span>
                        @elseif($req->status === 'in_progress')
                            <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#FEF3C7;color:#92400E;">In Progress</span>
                        @else
                            <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#fdecea;color:#b91c1c;">Pending</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-right text-xs" style="color:#7A5542;">
                        {{ $req->created_at->format('M d') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-5 py-8 text-center text-sm" style="color:#7A5542;">No requests yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection