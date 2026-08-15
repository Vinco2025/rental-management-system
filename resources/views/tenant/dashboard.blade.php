@extends('layouts.tenant')

@section('content')

{{-- Header --}}
<div style="margin-bottom:24px;">
    <h1 style="font-size:24px;font-weight:700;color:#3D2314;margin:0;">My Dashboard</h1>
    <p style="font-size:14px;color:#7A5542;margin:4px 0 0;">Welcome back, {{ Auth::user()->name }}</p>
</div>

{{-- No lease warning --}}
@if(!$lease)
    <div style="background:#fdecea;color:#b91c1c;border-radius:8px;padding:12px 16px;font-size:13px;margin-bottom:24px;">
        <i class="ti ti-alert-circle" style="margin-right:6px;"></i>
        You don't have an active lease. Please contact the admin.
    </div>
@endif

{{-- Stat Cards --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">

    {{-- Room --}}
    <div style="background:#fff;border:1px solid #E8DDD4;border-radius:12px;padding:20px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
            <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:#7A5542;margin:0;">Room</p>
            <span style="width:32px;height:32px;background:#FDF8F4;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <i class="ti ti-door" style="font-size:16px;color:#C2622A;"></i>
            </span>
        </div>
        <p style="font-size:28px;font-weight:700;color:#3D2314;margin:0;">{{ $room ? $room->room_number : '—' }}</p>
        <p style="font-size:12px;color:#7A5542;margin:4px 0 0;">{{ $room ? $room->roomType->name : 'No active lease' }}</p>
    </div>

    {{-- Monthly Rent --}}
    <div style="background:#fff;border:1px solid #E8DDD4;border-radius:12px;padding:20px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
            <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:#7A5542;margin:0;">Monthly Rent</p>
            <span style="width:32px;height:32px;background:#FDF8F4;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <i class="ti ti-cash" style="font-size:16px;color:#C2622A;"></i>
            </span>
        </div>
        <p style="font-size:28px;font-weight:700;color:#3D2314;margin:0;">
            ₱{{ $room ? number_format($room->monthly_rate, 2) : '0.00' }}
        </p>
        <p style="font-size:12px;color:#7A5542;margin:4px 0 0;">per month</p>
    </div>

    {{-- Outstanding Balance --}}
    <div style="background:#fff;border:1px solid #E8DDD4;border-radius:12px;padding:20px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
            <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:#7A5542;margin:0;">Outstanding Balance</p>
            <span style="width:32px;height:32px;background:#FDF8F4;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <i class="ti ti-receipt" style="font-size:16px;color:#C2622A;"></i>
            </span>
        </div>
        <p style="font-size:28px;font-weight:700;margin:0;{{ $unpaidBalance > 0 ? 'color:#b91c1c;' : 'color:#3D2314;' }}">
            ₱{{ number_format($unpaidBalance, 2) }}
        </p>
        <p style="font-size:12px;color:#7A5542;margin:4px 0 0;">{{ $unpaidBalance > 0 ? 'unpaid / partial bills' : 'all clear' }}</p>
    </div>

    {{-- Open Requests --}}
    <div style="background:#fff;border:1px solid #E8DDD4;border-radius:12px;padding:20px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
            <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:#7A5542;margin:0;">Open Requests</p>
            <span style="width:32px;height:32px;background:#FDF8F4;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <i class="ti ti-tool" style="font-size:16px;color:#C2622A;"></i>
            </span>
        </div>
        <p style="font-size:28px;font-weight:700;color:#3D2314;margin:0;">{{ $openRequestsCount }}</p>
        <p style="font-size:12px;color:#7A5542;margin:4px 0 0;">pending or in progress</p>
    </div>

</div>

{{-- Lease Summary + Quick Actions --}}
<div style="display:grid;grid-template-columns:2fr 1fr;gap:16px;margin-bottom:24px;">

    {{-- Lease Summary --}}
    <div style="background:#fff;border:1px solid #E8DDD4;border-radius:12px;padding:20px;">
        <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:#7A5542;margin:0 0 16px;">Lease Summary</p>
        @if($lease)
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <p style="font-size:11px;color:#7A5542;margin:0;">Room Number</p>
                    <p style="font-size:14px;font-weight:600;color:#3D2314;margin:4px 0 0;">{{ $room->room_number }}</p>
                </div>
                <div>
                    <p style="font-size:11px;color:#7A5542;margin:0;">Room Type</p>
                    <p style="font-size:14px;font-weight:600;color:#3D2314;margin:4px 0 0;">{{ $room->roomType->name }}</p>
                </div>
                <div>
                    <p style="font-size:11px;color:#7A5542;margin:0;">Start Date</p>
                    <p style="font-size:14px;font-weight:600;color:#3D2314;margin:4px 0 0;">{{ \Carbon\Carbon::parse($lease->start_date)->format('M d, Y') }}</p>
                </div>
                <div>
                    <p style="font-size:11px;color:#7A5542;margin:0;">End Date</p>
                    <p style="font-size:14px;font-weight:600;color:#3D2314;margin:4px 0 0;">{{ \Carbon\Carbon::parse($lease->end_date)->format('M d, Y') }}</p>
                </div>
                <div>
                    <p style="font-size:11px;color:#7A5542;margin:0;">Monthly Rate</p>
                    <p style="font-size:14px;font-weight:600;color:#3D2314;margin:4px 0 0;">₱{{ number_format($room->monthly_rate, 2) }}</p>
                </div>
                <div>
                    <p style="font-size:11px;color:#7A5542;margin:0;">Status</p>
                    <span style="display:inline-block;background:#EAF3DE;color:#3D6B1F;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;margin-top:4px;">Active</span>
                </div>
            </div>
        @else
            <p style="font-size:14px;color:#7A5542;margin:0;">No active lease on record.</p>
        @endif
    </div>

    {{-- Quick Actions --}}
    <div style="background:#fff;border:1px solid #E8DDD4;border-radius:12px;padding:20px;">
        <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:#7A5542;margin:0 0 16px;">Quick Actions</p>
        <div style="display:flex;flex-direction:column;gap:10px;">
            <a href="{{ route('tenant.maintenance.create') }}"
                style="display:flex;align-items:center;gap:12px;padding:12px 14px;background:#FDF8F4;border:1px solid #E8DDD4;border-radius:9px;font-size:13px;font-weight:500;color:#3D2314;text-decoration:none;">
                <i class="ti ti-plus" style="font-size:16px;color:#C2622A;"></i>
                Submit Maintenance Request
            </a>
            <a href="{{ route('tenant.maintenance.index') }}"
                style="display:flex;align-items:center;gap:12px;padding:12px 14px;background:#FDF8F4;border:1px solid #E8DDD4;border-radius:9px;font-size:13px;font-weight:500;color:#3D2314;text-decoration:none;">
                <i class="ti ti-list" style="font-size:16px;color:#C2622A;"></i>
                View All Requests
            </a>
            <a href="{{ route('tenant.bills.index') }}"
                style="display:flex;align-items:center;gap:12px;padding:12px 14px;background:#FDF8F4;border:1px solid #E8DDD4;border-radius:9px;font-size:13px;font-weight:500;color:#3D2314;text-decoration:none;">
                <i class="ti ti-file-invoice" style="font-size:16px;color:#C2622A;"></i>
                View My Bills
            </a>
        </div>
    </div>

</div>

{{-- Recent Bills + Recent Maintenance --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

    {{-- Recent Bills --}}
    <div style="background:#fff;border:1px solid #E8DDD4;border-radius:12px;overflow:hidden;">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid #E8DDD4;">
            <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:#7A5542;margin:0;">Recent Bills</p>
            <a href="{{ route('tenant.bills.index') }}" style="font-size:12px;font-weight:500;color:#C2622A;text-decoration:none;">View all</a>
        </div>
        <table style="width:100%;font-size:13px;">
            <tbody>
                @forelse($bills as $bill)
                <tr style="border-bottom:1px solid #E8DDD4;">
                    <td style="padding:12px 20px;color:#3D2314;">{{ \Carbon\Carbon::parse($bill->billing_month)->format('F Y') }}</td>
                    <td style="padding:12px 20px;text-align:right;font-weight:500;color:#3D2314;">₱{{ number_format($bill->total_amount, 2) }}</td>
                    <td style="padding:12px 20px;text-align:right;">
                        @if($bill->status === 'paid')
                            <span style="background:#EAF3DE;color:#3D6B1F;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;">Paid</span>
                        @elseif($bill->status === 'partial')
                            <span style="background:#FEF3C7;color:#92400E;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;">Partial</span>
                        @else
                            <span style="background:#fdecea;color:#b91c1c;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;">Unpaid</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="padding:32px 20px;text-align:center;font-size:13px;color:#7A5542;">No bills yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Recent Maintenance --}}
    <div style="background:#fff;border:1px solid #E8DDD4;border-radius:12px;overflow:hidden;">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid #E8DDD4;">
            <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:#7A5542;margin:0;">Recent Maintenance</p>
            <a href="{{ route('tenant.maintenance.index') }}" style="font-size:12px;font-weight:500;color:#C2622A;text-decoration:none;">View all</a>
        </div>
        <table style="width:100%;font-size:13px;">
            <tbody>
                @forelse($maintenanceRequests as $req)
                <tr style="border-bottom:1px solid #E8DDD4;">
                    <td style="padding:12px 20px;font-weight:500;color:#3D2314;">{{ $req->title }}</td>
                    <td style="padding:12px 20px;text-align:right;">
                        @if($req->status === 'resolved')
                            <span style="background:#EAF3DE;color:#3D6B1F;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;">Resolved</span>
                        @elseif($req->status === 'in_progress')
                            <span style="background:#FEF3C7;color:#92400E;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;">In Progress</span>
                        @else
                            <span style="background:#fdecea;color:#b91c1c;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;">Pending</span>
                        @endif
                    </td>
                    <td style="padding:12px 20px;text-align:right;font-size:12px;color:#7A5542;">{{ $req->created_at->format('M d') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="padding:32px 20px;text-align:center;font-size:13px;color:#7A5542;">No requests yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection