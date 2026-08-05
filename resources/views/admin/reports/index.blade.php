@extends('layouts.admin')

@section('title', 'Reports')

@section('content')

{{-- Header + Filter --}}
<div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
    <div>
        <h1 style="font-size: 24px; font-weight: 700; color: #3D2314; margin: 0 0 4px 0;">Reports</h1>
        <p style="color: #7A5542; margin: 0;">
            Showing data for
            <strong>{{ \Carbon\Carbon::create($year, $month)->format('F Y') }}</strong>
        </p>
    </div>

    {{-- Month/Year filter form --}}
    <form method="GET" action="{{ route('admin.reports.index') }}"
        style="display: flex; gap: 10px; align-items: center;">
        <select name="month"
                style="border: 1px solid #E8DDD4; border-radius: 8px; padding: 8px 12px; font-size: 14px; color: #3D2314; background: #fff;">
            @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create(null, $m)->format('F') }}
                </option>
            @endforeach
        </select>

        <select name="year"
                style="border: 1px solid #E8DDD4; border-radius: 8px; padding: 8px 12px; font-size: 14px; color: #3D2314; background: #fff;">
            @foreach(range(now()->year - 2, now()->year + 1) as $y)
                <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>

        <button type="submit"
                style="background: #C2622A; color: #fff; border: none; border-radius: 8px; padding: 8px 18px; font-size: 14px; font-weight: 600; cursor: pointer;">
            Filter
        </button>

        <a href="{{ route('admin.reports.export', ['month' => $month, 'year' => $year]) }}"
        style="background: #3D2314; color: #fff; border-radius: 8px; padding: 8px 18px; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Export PDF
        </a>
    </form>
</div>

{{-- ── SUMMARY CARDS ── --}}
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px;">

    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="font-size: 12px; font-weight: 600; color: #7A5542; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 8px;">Total Billed</div>
        <div style="font-size: 26px; font-weight: 700; color: #3D2314;">₱{{ number_format($totalBilled, 2) }}</div>
        <div style="font-size: 12px; color: #7A5542; margin-top: 4px;">{{ $bills->count() }} bill(s) generated</div>
    </div>

    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="font-size: 12px; font-weight: 600; color: #7A5542; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 8px;">Total Collected</div>
        <div style="font-size: 26px; font-weight: 700; color: #16a34a;">₱{{ number_format($totalCollected, 2) }}</div>
        <div style="font-size: 12px; color: #7A5542; margin-top: 4px;">{{ $paidCount }} fully paid</div>
    </div>

    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="font-size: 12px; font-weight: 600; color: #7A5542; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 8px;">Outstanding</div>
        <div style="font-size: 26px; font-weight: 700; color: #dc2626;">₱{{ number_format($totalOutstanding, 2) }}</div>
        <div style="font-size: 12px; color: #7A5542; margin-top: 4px;">{{ $unpaidCount }} unpaid · {{ $partialCount }} partial</div>
    </div>

    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
        <div style="font-size: 12px; font-weight: 600; color: #7A5542; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 8px;">Occupancy</div>
        <div style="font-size: 26px; font-weight: 700; color: #3D2314;">{{ $occupancyRate }}%</div>
        <div style="font-size: 12px; color: #7A5542; margin-top: 4px;">{{ $occupiedRooms }} of {{ $totalRooms }} rooms</div>
    </div>

</div>

{{-- ── BILLING TABLE + SIDE PANELS ── --}}
<div style="display: grid; grid-template-columns: 1fr 320px; gap: 20px; margin-bottom: 28px;">

    {{-- Billing Detail Table --}}
    <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; overflow: hidden;">
        <div style="padding: 16px 20px; border-bottom: 1px solid #E8DDD4;">
            <h2 style="font-size: 15px; font-weight: 700; color: #3D2314; margin: 0;">Billing Detail</h2>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                <thead>
                    <tr style="background: #FDF8F4;">
                        <th style="padding: 10px 16px; text-align: left; color: #7A5542; font-weight: 600;">Tenant</th>
                        <th style="padding: 10px 16px; text-align: left; color: #7A5542; font-weight: 600;">Room</th>
                        <th style="padding: 10px 16px; text-align: right; color: #7A5542; font-weight: 600;">Billed</th>
                        <th style="padding: 10px 16px; text-align: right; color: #7A5542; font-weight: 600;">Paid</th>
                        <th style="padding: 10px 16px; text-align: right; color: #7A5542; font-weight: 600;">Balance</th>
                        <th style="padding: 10px 16px; text-align: center; color: #7A5542; font-weight: 600;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bills as $bill)
                    @php
                        $statusMap = [
                            'paid'    => ['bg' => '#D1FAE5', 'text' => '#065F46'],
                            'unpaid'  => ['bg' => '#FEE2E2', 'text' => '#991B1B'],
                            'partial' => ['bg' => '#FEF3C7', 'text' => '#92400E'],
                        ];
                        $sc = $statusMap[$bill->status] ?? ['bg' => '#F3F4F6', 'text' => '#374151'];
                    @endphp
                    <tr style="border-top: 1px solid #E8DDD4;">
                        <td style="padding: 10px 16px; color: #3D2314; font-weight: 500;">
                            {{ $bill->tenant->first_name }} {{ $bill->tenant->last_name }}
                        </td>
                        <td style="padding: 10px 16px; color: #7A5542;">
                            {{ $bill->leaseContract->room->room_number ?? '—' }}
                        </td>
                        <td style="padding: 10px 16px; text-align: right; color: #3D2314;">
                            ₱{{ number_format($bill->total_amount, 2) }}
                        </td>
                        <td style="padding: 10px 16px; text-align: right; color: #16a34a;">
                            ₱{{ number_format($bill->amount_paid, 2) }}
                        </td>
                        <td style="padding: 10px 16px; text-align: right; color: #dc2626;">
                            ₱{{ number_format($bill->balance, 2) }}
                        </td>
                        <td style="padding: 10px 16px; text-align: center;">
                            <span style="font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 99px; background: {{ $sc['bg'] }}; color: {{ $sc['text'] }};">
                                {{ ucfirst($bill->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 24px; text-align: center; color: #7A5542;">
                            No bills generated for this month.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if($bills->count())
                <tfoot>
                    <tr style="background: #FDF8F4; border-top: 2px solid #E8DDD4;">
                        <td colspan="2" style="padding: 10px 16px; font-weight: 700; color: #3D2314;">Totals</td>
                        <td style="padding: 10px 16px; text-align: right; font-weight: 700; color: #3D2314;">₱{{ number_format($totalBilled, 2) }}</td>
                        <td style="padding: 10px 16px; text-align: right; font-weight: 700; color: #16a34a;">₱{{ number_format($totalCollected, 2) }}</td>
                        <td style="padding: 10px 16px; text-align: right; font-weight: 700; color: #dc2626;">₱{{ number_format($totalOutstanding, 2) }}</td>
                        <td></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>

    {{-- Side panels --}}
    <div style="display: flex; flex-direction: column; gap: 16px;">

        {{-- Payment Methods --}}
        <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
            <h2 style="font-size: 15px; font-weight: 700; color: #3D2314; margin: 0 0 14px 0;">Payments by Method</h2>
            @forelse($paymentsByMethod as $row)
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid #E8DDD4;">
                <div>
                    <div style="font-size: 13px; font-weight: 600; color: #3D2314;">
                        {{ ucfirst(str_replace('_', ' ', $row->payment_method)) }}
                    </div>
                    <div style="font-size: 12px; color: #7A5542;">{{ $row->count }} transaction(s)</div>
                </div>
                <div style="font-size: 14px; font-weight: 700; color: #C2622A;">
                    ₱{{ number_format($row->total, 2) }}
                </div>
            </div>
            @empty
            <p style="color: #7A5542; font-size: 13px; text-align: center; padding: 12px 0;">No payments recorded.</p>
            @endforelse
        </div>

        {{-- Maintenance Summary --}}
        <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; padding: 20px;">
            <h2 style="font-size: 15px; font-weight: 700; color: #3D2314; margin: 0 0 14px 0;">Maintenance Summary</h2>
            @php
                $maintMap = [
                    'open'        => ['label' => 'Open',        'bg' => '#FEF3C7', 'text' => '#92400E'],
                    'in_progress' => ['label' => 'In Progress', 'bg' => '#DBEAFE', 'text' => '#1E40AF'],
                    'resolved'    => ['label' => 'Resolved',    'bg' => '#D1FAE5', 'text' => '#065F46'],
                ];
            @endphp
            @forelse($maintMap as $key => $meta)
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid #E8DDD4;">
                <span style="font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 99px; background: {{ $meta['bg'] }}; color: {{ $meta['text'] }};">
                    {{ $meta['label'] }}
                </span>
                <span style="font-size: 15px; font-weight: 700; color: #3D2314;">
                    {{ $maintenanceStats[$key] ?? 0 }}
                </span>
            </div>
            @empty
            @endforelse
        </div>

    </div>
</div>

{{-- ── ACTIVE LEASES TABLE ── --}}
<div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 10px; overflow: hidden;">
    <div style="padding: 16px 20px; border-bottom: 1px solid #E8DDD4;">
        <h2 style="font-size: 15px; font-weight: 700; color: #3D2314; margin: 0;">Active Leases</h2>
    </div>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
            <thead>
                <tr style="background: #FDF8F4;">
                    <th style="padding: 10px 16px; text-align: left; color: #7A5542; font-weight: 600;">Tenant</th>
                    <th style="padding: 10px 16px; text-align: left; color: #7A5542; font-weight: 600;">Room</th>
                    <th style="padding: 10px 16px; text-align: left; color: #7A5542; font-weight: 600;">Start Date</th>
                    <th style="padding: 10px 16px; text-align: left; color: #7A5542; font-weight: 600;">End Date</th>
                    <th style="padding: 10px 16px; text-align: right; color: #7A5542; font-weight: 600;">Monthly Rate</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activeLeases as $lease)
                <tr style="border-top: 1px solid #E8DDD4;">
                    <td style="padding: 10px 16px; color: #3D2314; font-weight: 500;">
                        {{ $lease->tenant->first_name }} {{ $lease->tenant->last_name }}
                    </td>
                    <td style="padding: 10px 16px; color: #7A5542;">{{ $lease->room->room_number }}</td>
                    <td style="padding: 10px 16px; color: #7A5542;">{{ \Carbon\Carbon::parse($lease->start_date)->format('M d, Y') }}</td>
                    <td style="padding: 10px 16px; color: #7A5542;">
                        {{ $lease->end_date ? \Carbon\Carbon::parse($lease->end_date)->format('M d, Y') : '—' }}
                    </td>
                    <td style="padding: 10px 16px; text-align: right; color: #3D2314; font-weight: 600;">
                        ₱{{ number_format($lease->monthly_rate, 2) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 24px; text-align: center; color: #7A5542;">No active leases.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection