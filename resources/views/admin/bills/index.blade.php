@extends('layouts.admin')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold" style="color:#3D2314;">Billing & Payments</h1>
        <p class="text-sm mt-1" style="color:#7A5542;">Overview of all tenant bills</p>
    </div>
    <a href="{{ route('admin.bills.create') }}"
        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-white text-sm font-medium"
        style="background:#C2622A;">
        <i class="ti ti-plus text-base"></i> Generate Bills
    </a>
</div>

@if(session('success'))
    <div class="mb-4 px-4 py-3 rounded-lg text-sm font-medium" style="background:#EAF3DE;color:#3D2314;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 px-4 py-3 rounded-lg text-sm font-medium" style="background:#fdecea;color:#b91c1c;">
        {{ session('error') }}
    </div>
@endif

<div class="rounded-xl overflow-hidden" style="border:1px solid #E8DDD4;">
    <table class="w-full text-sm">
        <thead>
            <tr style="background:#FDF8F4;">
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Tenant</th>
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Billing Month</th>
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Total</th>
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Paid</th>
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Balance</th>
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Status</th>
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Due Date</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($bills as $bill)
            <tr style="border-top:1px solid #E8DDD4;">
                <td class="px-4 py-3 font-medium" style="color:#3D2314;">{{ $bill->tenant->full_name }}</td>
                <td class="px-4 py-3" style="color:#7A5542;">{{ $bill->billing_month->format('F Y') }}</td>
                <td class="px-4 py-3" style="color:#3D2314;">₱{{ number_format($bill->total_amount, 2) }}</td>
                <td class="px-4 py-3" style="color:#3D2314;">₱{{ number_format($bill->amount_paid, 2) }}</td>
                <td class="px-4 py-3" style="color:#3D2314;">₱{{ number_format($bill->balance, 2) }}</td>
                <td class="px-4 py-3">
                    @if($bill->status === 'paid')
                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#EAF3DE;color:#3D6B1F;">Paid</span>
                    @elseif($bill->status === 'partial')
                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#FEF3C7;color:#92400E;">Partial</span>
                    @else
                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#fdecea;color:#b91c1c;">Unpaid</span>
                    @endif
                </td>
                <td class="px-4 py-3" style="color:#7A5542;">{{ $bill->due_date->format('M d, Y') }}</td>
                <td class="px-4 py-3">
                    <a href="{{ route('admin.bills.show', $bill) }}" class="text-sm font-medium" style="color:#C2622A;">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-4 py-12 text-center">
                    <i class="ti ti-file-invoice text-4xl" style="color:#E8DDD4;"></i>
                    <p class="mt-2 text-sm" style="color:#7A5542;">No bills yet. Generate bills to get started.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($bills->hasPages())
    <div class="mt-4">{{ $bills->links() }}</div>
@endif
@endsection