@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div style="margin-bottom: 24px;">
    <h1 style="font-size: 24px; font-weight: 700; color: #3D2314; margin: 0 0 4px 0;">Dashboard</h1>
    <p style="color: #7A5542; margin: 0;">Welcome back! Here's what's happening in your boarding house.</p>
</div>

{{-- ── STAT CARDS ROW 1: Rooms & Tenants ── --}}
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">

    {{-- Occupancy Rate --}}
    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 13px; font-weight: 600; color: #7A5542; text-transform: uppercase; letter-spacing: .5px;">Occupancy Rate</span>
            <span style="background: #FDF8F4; border-radius: 8px; padding: 6px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C2622A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </span>
        </div>
        <div style="font-size: 32px; font-weight: 700; color: #3D2314;">{{ $occupancyRate }}%</div>
        <div style="font-size: 13px; color: #7A5542; margin-top: 4px;">{{ $occupiedRooms }} of {{ $totalRooms }} rooms occupied</div>
        {{-- Progress bar --}}
        <div style="margin-top: 12px; background: #E8DDD4; border-radius: 99px; height: 6px;">
            <div style="background: #C2622A; border-radius: 99px; height: 6px; width: {{ $occupancyRate }}%;"></div>
        </div>
    </div>

    {{-- Available Rooms --}}
    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 13px; font-weight: 600; color: #7A5542; text-transform: uppercase; letter-spacing: .5px;">Available Rooms</span>
            <span style="background: #FDF8F4; border-radius: 8px; padding: 6px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C2622A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/></svg>
            </span>
        </div>
        <div style="font-size: 32px; font-weight: 700; color: #3D2314;">{{ $availableRooms }}</div>
        <div style="font-size: 13px; color: #7A5542; margin-top: 4px;">Ready to be leased</div>
    </div>

    {{-- Active Tenants --}}
    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 13px; font-weight: 600; color: #7A5542; text-transform: uppercase; letter-spacing: .5px;">Active Tenants</span>
            <span style="background: #FDF8F4; border-radius: 8px; padding: 6px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C2622A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </span>
        </div>
        <div style="font-size: 32px; font-weight: 700; color: #3D2314;">{{ $activeTenants }}</div>
        <div style="font-size: 13px; color: #7A5542; margin-top: 4px;">{{ $totalTenants }} total registered</div>
    </div>

    {{-- Open Maintenance --}}
    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 13px; font-weight: 600; color: #7A5542; text-transform: uppercase; letter-spacing: .5px;">Open Requests</span>
            <span style="background: #FDF8F4; border-radius: 8px; padding: 6px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C2622A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
            </span>
        </div>
        <div style="font-size: 32px; font-weight: 700; color: #3D2314;">{{ $openRequests }}</div>
        <div style="font-size: 13px; color: #7A5542; margin-top: 4px;">{{ $inProgressRequests }} in progress</div>
    </div>

</div>

{{-- ── STAT CARDS ROW 2: Billing ── --}}
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 32px;">

    {{-- Outstanding Balance --}}
    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 13px; font-weight: 600; color: #7A5542; text-transform: uppercase; letter-spacing: .5px;">Outstanding</span>
            <span style="background: #FDF8F4; border-radius: 8px; padding: 6px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C2622A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </span>
        </div>
        <div style="font-size: 28px; font-weight: 700; color: #3D2314;">₱{{ number_format($totalOutstanding, 2) }}</div>
        <div style="font-size: 13px; color: #7A5542; margin-top: 4px;">Across unpaid &amp; partial bills</div>
    </div>

    {{-- Collected This Month --}}
    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 13px; font-weight: 600; color: #7A5542; text-transform: uppercase; letter-spacing: .5px;">Collected</span>
            <span style="background: #FDF8F4; border-radius: 8px; padding: 6px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C2622A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/><path d="M12 22V7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
            </span>
        </div>
        <div style="font-size: 28px; font-weight: 700; color: #3D2314;">₱{{ number_format($collectedThisMonth, 2) }}</div>
        <div style="font-size: 13px; color: #7A5542; margin-top: 4px;">Payments in {{ now()->format('F Y') }}</div>
    </div>

    {{-- Unpaid Bills --}}
    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 13px; font-weight: 600; color: #7A5542; text-transform: uppercase; letter-spacing: .5px;">Unpaid Bills</span>
            <span style="background: #FDF8F4; border-radius: 8px; padding: 6px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C2622A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            </span>
        </div>
        <div style="font-size: 32px; font-weight: 700; color: #3D2314;">{{ $unpaidBills }}</div>
        <div style="font-size: 13px; color: #7A5542; margin-top: 4px;">{{ $partialBills }} partially paid</div>
    </div>

    {{-- Resolved This Month --}}
    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 13px; font-weight: 600; color: #7A5542; text-transform: uppercase; letter-spacing: .5px;">Resolved</span>
            <span style="background: #FDF8F4; border-radius: 8px; padding: 6px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C2622A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
        </div>
        <div style="font-size: 32px; font-weight: 700; color: #3D2314;">{{ $resolvedThisMonth }}</div>
        <div style="font-size: 13px; color: #7A5542; margin-top: 4px;">Maintenance fixed in {{ now()->format('F') }}</div>
    </div>

</div>

{{-- ── RECENT ACTIVITY (3 columns) ── --}}
<div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">

    {{-- Recent Leases --}}
    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
            <h2 style="font-size: 15px; font-weight: 700; color: #3D2314; margin: 0;">Recent Leases</h2>
            <a href="{{ route('admin.lease-contracts.index') }}" style="font-size: 12px; color: #C2622A; text-decoration: none;">View all</a>
        </div>
        @forelse($recentLeases as $lease)
        <div style="padding: 10px 0; border-bottom: 1px solid #E8DDD4;">
            <div style="font-size: 13px; font-weight: 600; color: #3D2314;">
                {{ $lease->tenant->first_name }} {{ $lease->tenant->last_name }}
            </div>
            <div style="font-size: 12px; color: #7A5542; margin-top: 2px;">
                Room {{ $lease->room->room_number }} &mdash;
                <span style="color: {{ $lease->status === 'active' ? '#16a34a' : '#b45309' }};">
                    {{ ucfirst($lease->status) }}
                </span>
            </div>
        </div>
        @empty
        <p style="color: #7A5542; font-size: 13px; text-align: center; padding: 16px 0;">No leases yet.</p>
        @endforelse
    </div>

    {{-- Recent Payments --}}
    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
            <h2 style="font-size: 15px; font-weight: 700; color: #3D2314; margin: 0;">Recent Payments</h2>
            <a href="{{ route('admin.bills.index') }}" style="font-size: 12px; color: #C2622A; text-decoration: none;">View all</a>
        </div>
        @forelse($recentPayments as $payment)
        <div style="padding: 10px 0; border-bottom: 1px solid #E8DDD4;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="font-size: 13px; font-weight: 600; color: #3D2314;">
                    {{ $payment->first_name }} {{ $payment->last_name }}
                </div>
                <div style="font-size: 13px; font-weight: 700; color: #C2622A;">
                    ₱{{ number_format($payment->amount, 2) }}
                </div>
            </div>
            <div style="font-size: 12px; color: #7A5542; margin-top: 2px;">
                {{ \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') }}
                &mdash; {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
            </div>
        </div>
        @empty
        <p style="color: #7A5542; font-size: 13px; text-align: center; padding: 16px 0;">No payments yet.</p>
        @endforelse
    </div>

    {{-- Recent Maintenance --}}
    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
            <h2 style="font-size: 15px; font-weight: 700; color: #3D2314; margin: 0;">Recent Maintenance</h2>
            <a href="{{ route('admin.maintenance.index') }}" style="font-size: 12px; color: #C2622A; text-decoration: none;">View all</a>
        </div>
        @forelse($recentMaintenance as $request)
        <div style="padding: 10px 0; border-bottom: 1px solid #E8DDD4;">
            <div style="font-size: 13px; font-weight: 600; color: #3D2314;">{{ $request->title }}</div>
            <div style="font-size: 12px; color: #7A5542; margin-top: 2px;">
                {{ $request->tenant->first_name }} {{ $request->tenant->last_name }}
                &mdash; Room {{ $request->room->room_number }}
            </div>
            <div style="margin-top: 4px;">
                @php
                    $statusColors = [
                        'open'        => ['bg' => '#FEF3C7', 'text' => '#92400E'],
                        'in_progress' => ['bg' => '#DBEAFE', 'text' => '#1E40AF'],
                        'resolved'    => ['bg' => '#D1FAE5', 'text' => '#065F46'],
                    ];
                    $sc = $statusColors[$request->status] ?? ['bg' => '#F3F4F6', 'text' => '#374151'];
                @endphp
                <span style="font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 99px; background: {{ $sc['bg'] }}; color: {{ $sc['text'] }};">
                    {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                </span>
            </div>
        </div>
        @empty
        <p style="color: #7A5542; font-size: 13px; text-align: center; padding: 16px 0;">No requests yet.</p>
        @endforelse
    </div>

</div>
@endsection