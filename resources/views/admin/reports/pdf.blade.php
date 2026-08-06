<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report — {{ $monthLabel }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #2D1A0E;
            background: #fff;
            padding: 32px;
        }

        /* ── Header ── */
        .header {
            border-bottom: 3px solid #C2622A;
            padding-bottom: 14px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 20px;
            font-weight: 700;
            color: #3D2314;
        }
        .header p {
            font-size: 11px;
            color: #7A5542;
            margin-top: 3px;
        }

        /* ── Section titles ── */
        h2 {
            font-size: 13px;
            font-weight: 700;
            color: #3D2314;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 1px solid #E8DDD4;
        }

        /* ── Summary cards row ── */
        .cards {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            border-spacing: 8px 0;
        }
        .card {
            display: table-cell;
            background: #FDF8F4;
            border: 1px solid #E8DDD4;
            border-radius: 6px;
            padding: 10px 14px;
            width: 25%;
        }
        .card-label {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #7A5542;
            margin-bottom: 5px;
        }
        .card-value {
            font-size: 16px;
            font-weight: 700;
            color: #3D2314;
        }
        .card-sub {
            font-size: 9px;
            color: #7A5542;
            margin-top: 3px;
        }

        /* ── Tables ── */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10.5px;
        }
        thead tr {
            background: #3D2314;
            color: #fff;
        }
        thead th {
            padding: 7px 10px;
            text-align: left;
            font-weight: 600;
        }
        thead th.right { text-align: right; }
        thead th.center { text-align: center; }

        tbody tr:nth-child(even) { background: #FDF8F4; }
        tbody td {
            padding: 7px 10px;
            border-bottom: 1px solid #E8DDD4;
            color: #3D2314;
        }
        tbody td.right { text-align: right; }
        tbody td.center { text-align: center; }

        tfoot tr { background: #E8DDD4; }
        tfoot td {
            padding: 7px 10px;
            font-weight: 700;
            color: #3D2314;
        }
        tfoot td.right { text-align: right; }

        /* ── Status badges ── */
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 99px;
            font-size: 9px;
            font-weight: 700;
        }
        .badge-paid    { background: #D1FAE5; color: #065F46; }
        .badge-unpaid  { background: #FEE2E2; color: #991B1B; }
        .badge-partial { background: #FEF3C7; color: #92400E; }

        /* ── Two-column layout ── */
        .two-col { display: table; width: 100%; margin-bottom: 20px; }
        .col-left  { display: table-cell; width: 60%; padding-right: 12px; vertical-align: top; }
        .col-right { display: table-cell; width: 40%; vertical-align: top; }

        /* ── Side table (maintenance / payments) ── */
        .side-table { width: 100%; border-collapse: collapse; font-size: 10.5px; }
        .side-table td { padding: 6px 8px; border-bottom: 1px solid #E8DDD4; }
        .side-table td.right { text-align: right; font-weight: 700; }

        /* ── Footer ── */
        .footer {
            margin-top: 28px;
            padding-top: 10px;
            border-top: 1px solid #E8DDD4;
            font-size: 9px;
            color: #7A5542;
            display: table;
            width: 100%;
        }
        .footer-left  { display: table-cell; text-align: left; }
        .footer-right { display: table-cell; text-align: right; }
    </style>
</head>
<body>

    {{-- ── HEADER ── --}}
    <div class="header">
        <h1>Boarding House — Monthly Report</h1>
        <p>Period: {{ $monthLabel }} &nbsp;|&nbsp; Generated: {{ now()->format('F d, Y \a\t h:i A') }}</p>
    </div>

    {{-- ── SUMMARY CARDS ── --}}
    <h2>Summary</h2>
    <div class="cards">
        <div class="card">
            <div class="card-label">Total Billed</div>
            <div class="card-value">&#8369;{{ number_format($totalBilled, 2) }}</div>
            <div class="card-sub">{{ $bills->count() }} bill(s)</div>
        </div>
        <div class="card">
            <div class="card-label">Collected</div>
            <div class="card-value">&#8369;{{ number_format($totalCollected, 2) }}</div>
            <div class="card-sub">{{ $paidCount }} fully paid</div>
        </div>
        <div class="card">
            <div class="card-label">Outstanding</div>
            <div class="card-value">&#8369;{{ number_format($totalOutstanding, 2) }}</div>
            <div class="card-sub">{{ $unpaidCount }} unpaid · {{ $partialCount }} partial</div>
        </div>
        <div class="card">
            <div class="card-label">Occupancy</div>
            <div class="card-value">{{ $occupancyRate }}%</div>
            <div class="card-sub">{{ $occupiedRooms }} of {{ $totalRooms }} rooms</div>
        </div>
    </div>

    {{-- ── BILLING DETAIL ── --}}
    <h2>Billing Detail</h2>
    <table>
        <thead>
            <tr>
                <th>Tenant</th>
                <th>Room</th>
                <th class="right">Billed</th>
                <th class="right">Paid</th>
                <th class="right">Balance</th>
                <th class="center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bills as $bill)
            <tr>
                <td>{{ $bill->tenant->first_name }} {{ $bill->tenant->last_name }}</td>
                <td>{{ $bill->leaseContract->room->room_number ?? '—' }}</td>
                <td class="right">&#8369;{{ number_format($bill->total_amount, 2) }}</td>
                <td class="right">&#8369;{{ number_format($bill->amount_paid, 2) }}</td>
                <td class="right">&#8369;{{ number_format($bill->balance, 2) }}</td>
                <td class="center">
                    <span class="badge badge-{{ $bill->status }}">{{ ucfirst($bill->status) }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; padding: 16px; color: #7A5542;">
                    No bills generated for this period.
                </td>
            </tr>
            @endforelse
        </tbody>
        @if($bills->count())
        <tfoot>
            <tr>
                <td colspan="2">Totals</td>
                <td class="right">&#8369;{{ number_format($totalBilled, 2) }}</td>
                <td class="right">&#8369;{{ number_format($totalCollected, 2) }}</td>
                <td class="right">&#8369;{{ number_format($totalOutstanding, 2) }}</td>
                <td></td>
            </tr>
        </tfoot>
        @endif
    </table>

    {{-- ── MAINTENANCE + ACTIVE LEASES ── --}}
    <div class="two-col">
        <div class="col-left">
            <h2>Active Leases</h2>
            <table style="margin-bottom:0;">
                <thead>
                    <tr>
                        <th>Tenant</th>
                        <th>Room</th>
                        <th>Start</th>
                        <th>End</th>
                        <th class="right">Rate</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activeLeases as $lease)
                    <tr>
                        <td>{{ $lease->tenant->first_name }} {{ $lease->tenant->last_name }}</td>
                        <td>{{ $lease->room->room_number }}</td>
                        <td>{{ \Carbon\Carbon::parse($lease->start_date)->format('M d, Y') }}</td>
                        <td>{{ $lease->end_date ? \Carbon\Carbon::parse($lease->end_date)->format('M d, Y') : '—' }}</td>
                        <td class="right">&#8369;{{ number_format($lease->monthly_rate, 2) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center; color:#7A5542;">No active leases.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-right">
            <h2>Maintenance</h2>
            <table class="side-table" style="margin-bottom:0;">
                <tbody>
                    @foreach(['open' => 'Open', 'in_progress' => 'In Progress', 'resolved' => 'Resolved'] as $key => $label)
                    <tr>
                        <td>{{ $label }}</td>
                        <td class="right">{{ $maintenanceStats[$key] ?? 0 }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── FOOTER ── --}}
    <div class="footer">
        <div class="footer-left">Boarding House Rental Management System</div>
        <div class="footer-right">{{ now()->format('Y') }} — Confidential</div>
    </div>

</body>
</html>