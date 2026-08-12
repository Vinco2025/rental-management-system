@extends('layouts.tenant')

@section('content')

<div class="mb-6">
    <nav class="text-sm mb-2" style="color:#7A5542;">
        <a href="{{ route('tenant.bills.index') }}" style="color:#C2622A;">My Bills</a>
        <span class="mx-1">›</span> {{ $bill->billing_month->format('F Y') }}
    </nav>
    <h1 class="text-2xl font-bold" style="color:#3D2314;">
        Bill for {{ $bill->billing_month->format('F Y') }}
    </h1>
    <p class="text-sm mt-1" style="color:#7A5542;">Due {{ $bill->due_date?->format('M d, Y') ?? 'N/A' }}</p>
</div>

<div class="grid grid-cols-2 gap-4 mb-6">

    {{-- Bill Breakdown --}}
    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <p class="text-xs font-semibold uppercase tracking-wide mb-4" style="color:#7A5542;">Breakdown</p>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between">
                <span style="color:#7A5542;">Rent</span>
                <span style="color:#3D2314;">₱{{ number_format($bill->rent_amount, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span style="color:#7A5542;">Electricity</span>
                <span style="color:#3D2314;">₱{{ number_format($bill->electricity_amount, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span style="color:#7A5542;">Water</span>
                <span style="color:#3D2314;">₱{{ number_format($bill->water_amount, 2) }}</span>
            </div>
            <div class="flex justify-between pt-3 font-semibold" style="border-top:1px solid #E8DDD4;">
                <span style="color:#3D2314;">Total</span>
                <span style="color:#3D2314;">₱{{ number_format($bill->total_amount, 2) }}</span>
            </div>
        </div>
    </div>

    {{-- Payment Status --}}
    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <p class="text-xs font-semibold uppercase tracking-wide mb-4" style="color:#7A5542;">Payment Status</p>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between">
                <span style="color:#7A5542;">Total Amount</span>
                <span style="color:#3D2314;">₱{{ number_format($bill->total_amount, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span style="color:#7A5542;">Amount Paid</span>
                <span style="color:#3D6B1F;">₱{{ number_format($bill->amount_paid, 2) }}</span>
            </div>
            <div class="flex justify-between pt-3 font-semibold" style="border-top:1px solid #E8DDD4;">
                <span style="color:#3D2314;">Balance</span>
                <span style="{{ $bill->balance > 0 ? 'color:#b91c1c;' : 'color:#3D2314;' }}">
                    ₱{{ number_format($bill->balance, 2) }}
                </span>
            </div>
            <div class="flex justify-between items-center">
                <span style="color:#7A5542;">Status</span>
                @if($bill->status === 'paid')
                    <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#EAF3DE;color:#3D6B1F;">Paid</span>
                @elseif($bill->status === 'partial')
                    <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#FEF3C7;color:#92400E;">Partial</span>
                @else
                    <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#fdecea;color:#b91c1c;">Unpaid</span>
                @endif
            </div>
        </div>
    </div>

</div>

{{-- Payment History --}}
<div class="rounded-xl overflow-hidden" style="border:1px solid #E8DDD4;">
    <div class="px-5 py-4" style="border-bottom:1px solid #E8DDD4;">
        <p class="text-xs font-semibold uppercase tracking-wide" style="color:#7A5542;">Payment History</p>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr style="background:#FDF8F4;">
                <th class="text-left px-5 py-3 font-semibold" style="color:#3D2314;">Date</th>
                <th class="text-left px-5 py-3 font-semibold" style="color:#3D2314;">Amount</th>
                <th class="text-left px-5 py-3 font-semibold" style="color:#3D2314;">Method</th>
                <th class="text-left px-5 py-3 font-semibold" style="color:#3D2314;">Notes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
            <tr style="border-top:1px solid #E8DDD4;">
                <td class="px-5 py-3" style="color:#3D2314;">{{ $payment->created_at->format('M d, Y') }}</td>
                <td class="px-5 py-3 font-medium" style="color:#3D6B1F;">₱{{ number_format($payment->amount, 2) }}</td>
                <td class="px-5 py-3" style="color:#7A5542;">{{ ucfirst($payment->payment_method ?? '—') }}</td>
                <td class="px-5 py-3" style="color:#7A5542;">{{ $payment->notes ?? '—' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-5 py-8 text-center text-sm" style="color:#7A5542;">No payments recorded yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection