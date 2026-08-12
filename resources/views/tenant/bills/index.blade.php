@extends('layouts.tenant')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold" style="color:#3D2314;">My Bills</h1>
    <p class="text-sm mt-1" style="color:#7A5542;">View and track your monthly billing statements</p>
</div>

{{-- Summary Cards --}}
<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold uppercase tracking-wide" style="color:#7A5542;">Total Bills</p>
            <span class="flex items-center justify-center w-8 h-8 rounded-lg" style="background:#FDF8F4;">
                <i class="ti ti-files text-base" style="color:#C2622A;"></i>
            </span>
        </div>
        <p class="text-2xl font-bold" style="color:#3D2314;">{{ $bills->count() }}</p>
        <p class="text-xs mt-1" style="color:#7A5542;">all time</p>
    </div>

    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold uppercase tracking-wide" style="color:#7A5542;">Outstanding Balance</p>
            <span class="flex items-center justify-center w-8 h-8 rounded-lg" style="background:#FDF8F4;">
                <i class="ti ti-alert-circle text-base" style="color:#C2622A;"></i>
            </span>
        </div>
        <p class="text-2xl font-bold" style="{{ $unpaidBalance > 0 ? 'color:#b91c1c;' : 'color:#3D2314;' }}">
            ₱{{ number_format($unpaidBalance, 2) }}
        </p>
        <p class="text-xs mt-1" style="color:#7A5542;">{{ $unpaidCount }} unpaid / partial</p>
    </div>

    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold uppercase tracking-wide" style="color:#7A5542;">Paid Bills</p>
            <span class="flex items-center justify-center w-8 h-8 rounded-lg" style="background:#FDF8F4;">
                <i class="ti ti-circle-check text-base" style="color:#C2622A;"></i>
            </span>
        </div>
        <p class="text-2xl font-bold" style="color:#3D2314;">{{ $paidCount }}</p>
        <p class="text-xs mt-1" style="color:#7A5542;">fully settled</p>
    </div>
</div>

{{-- Bills Table --}}
<div class="rounded-xl overflow-hidden" style="border:1px solid #E8DDD4;">
    <table class="w-full text-sm">
        <thead>
            <tr style="background:#FDF8F4;">
                <th class="text-left px-5 py-3 font-semibold" style="color:#3D2314;">Billing Month</th>
                <th class="text-left px-5 py-3 font-semibold" style="color:#3D2314;">Total</th>
                <th class="text-left px-5 py-3 font-semibold" style="color:#3D2314;">Paid</th>
                <th class="text-left px-5 py-3 font-semibold" style="color:#3D2314;">Balance</th>
                <th class="text-left px-5 py-3 font-semibold" style="color:#3D2314;">Due Date</th>
                <th class="text-left px-5 py-3 font-semibold" style="color:#3D2314;">Status</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($bills as $bill)
            <tr style="border-top:1px solid #E8DDD4;">
                <td class="px-5 py-3 font-medium" style="color:#3D2314;">
                    {{ $bill->billing_month->format('F Y') }}
                </td>
                <td class="px-5 py-3" style="color:#3D2314;">₱{{ number_format($bill->total_amount, 2) }}</td>
                <td class="px-5 py-3" style="color:#3D2314;">₱{{ number_format($bill->amount_paid, 2) }}</td>
                <td class="px-5 py-3" style="{{ $bill->balance > 0 ? 'color:#b91c1c;' : 'color:#3D2314;' }}">
                    ₱{{ number_format($bill->balance, 2) }}
                </td>
                <td class="px-5 py-3" style="color:#7A5542;">
                    {{ $bill->due_date?->format('M d, Y') ?? '—' }}
                </td>
                <td class="px-5 py-3">
                    @if($bill->status === 'paid')
                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#EAF3DE;color:#3D6B1F;">Paid</span>
                    @elseif($bill->status === 'partial')
                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#FEF3C7;color:#92400E;">Partial</span>
                    @else
                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#fdecea;color:#b91c1c;">Unpaid</span>
                    @endif
                </td>
                <td class="px-5 py-3 text-right">
                    <a href="{{ route('tenant.bills.show', $bill) }}" class="text-sm font-medium" style="color:#C2622A;">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-5 py-12 text-center">
                    <i class="ti ti-file-off text-4xl" style="color:#E8DDD4;"></i>
                    <p class="mt-2 text-sm" style="color:#7A5542;">No bills found.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection