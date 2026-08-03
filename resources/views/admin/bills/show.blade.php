@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <nav class="text-sm mb-2" style="color:#7A5542;">
        <a href="{{ route('admin.bills.index') }}" style="color:#C2622A;">Bills</a>
        <span class="mx-1">›</span> Bill Detail
    </nav>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold" style="color:#3D2314;">
            {{ $bill->tenant->full_name }} — {{ $bill->billing_month->format('F Y') }}
        </h1>
        <div class="flex gap-2">
            @if($bill->status !== 'paid')
                <a href="{{ route('admin.payments.create', $bill) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-white text-sm font-medium"
                    style="background:#C2622A;">
                    <i class="ti ti-cash text-base"></i> Record Payment
                </a>
            @endif
            <a href="{{ route('admin.bills.edit', $bill) }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium"
                style="border:1px solid #E8DDD4;color:#3D2314;">
                <i class="ti ti-pencil text-base"></i> Edit
            </a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="mb-4 px-4 py-3 rounded-lg text-sm font-medium" style="background:#EAF3DE;color:#3D2314;">
        {{ session('success') }}
    </div>
@endif

{{-- Bill Summary --}}
<div class="grid grid-cols-2 gap-4 mb-6">
    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <p class="text-xs font-semibold uppercase tracking-wide mb-3" style="color:#7A5542;">Charges</p>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span style="color:#7A5542;">Monthly Rent</span>
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
            <div class="flex justify-between font-semibold pt-2" style="border-top:1px solid #E8DDD4;">
                <span style="color:#3D2314;">Total</span>
                <span style="color:#3D2314;">₱{{ number_format($bill->total_amount, 2) }}</span>
            </div>
        </div>
    </div>

    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <p class="text-xs font-semibold uppercase tracking-wide mb-3" style="color:#7A5542;">Payment Status</p>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span style="color:#7A5542;">Amount Paid</span>
                <span style="color:#3D2314;">₱{{ number_format($bill->amount_paid, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span style="color:#7A5542;">Balance</span>
                <span style="color:#3D2314;">₱{{ number_format($bill->balance, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span style="color:#7A5542;">Due Date</span>
                <span style="color:#3D2314;">{{ $bill->due_date->format('M d, Y') }}</span>
            </div>
            <div class="flex justify-between items-center pt-2" style="border-top:1px solid #E8DDD4;">
                <span style="color:#3D2314;">Status</span>
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

{{-- Payments List --}}
<div class="rounded-xl overflow-hidden" style="border:1px solid #E8DDD4;">
    <div class="px-4 py-3" style="background:#FDF8F4;border-bottom:1px solid #E8DDD4;">
        <p class="text-sm font-semibold" style="color:#3D2314;">Payment History</p>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr style="background:#FDF8F4;">
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Date</th>
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Amount</th>
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Method</th>
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Notes</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($bill->payments as $payment)
            <tr style="border-top:1px solid #E8DDD4;">
                <td class="px-4 py-3" style="color:#7A5542;">{{ $payment->payment_date->format('M d, Y') }}</td>
                <td class="px-4 py-3 font-medium" style="color:#3D2314;">₱{{ number_format($payment->amount, 2) }}</td>
                <td class="px-4 py-3" style="color:#7A5542;">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                <td class="px-4 py-3" style="color:#7A5542;">{{ $payment->notes ?? '—' }}</td>
                <td class="px-4 py-3 text-right">
                    <form action="{{ route('admin.payments.destroy', [$bill, $payment]) }}" method="POST"
                        onsubmit="return confirm('Remove this payment?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs" style="color:#b91c1c;">Remove</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-sm" style="color:#7A5542;">
                    No payments recorded yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Delete Bill --}}
<div class="mt-6">
    <form action="{{ route('admin.bills.destroy', $bill) }}" method="POST"
        onsubmit="return confirm('Delete this bill and all its payments?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-sm" style="color:#b91c1c;">Delete Bill</button>
    </form>
</div>
@endsection