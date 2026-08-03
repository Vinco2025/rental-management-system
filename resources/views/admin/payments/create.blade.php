@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <nav class="text-sm mb-2" style="color:#7A5542;">
        <a href="{{ route('admin.bills.index') }}" style="color:#C2622A;">Bills</a>
        <span class="mx-1">›</span>
        <a href="{{ route('admin.bills.show', $bill) }}" style="color:#C2622A;">{{ $bill->tenant->full_name }}</a>
        <span class="mx-1">›</span> Record Payment
    </nav>
    <h1 class="text-2xl font-bold" style="color:#3D2314;">Record Payment</h1>
    <p class="text-sm mt-1" style="color:#7A5542;">{{ $bill->billing_month->format('F Y') }} — Balance: ₱{{ number_format($bill->balance, 2) }}</p>
</div>

<div class="rounded-xl p-6 max-w-lg" style="border:1px solid #E8DDD4;background:#fff;">
    <form action="{{ route('admin.payments.store', $bill) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Amount (₱)</label>
            <input type="number" name="amount" step="0.01" min="0.01" max="{{ $bill->balance }}"
                value="{{ old('amount', $bill->balance) }}"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
            @error('amount')
                <p class="mt-1 text-xs" style="color:#b91c1c;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Payment Date</label>
            <input type="date" name="payment_date"
                value="{{ old('payment_date', now()->format('Y-m-d')) }}"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
            @error('payment_date')
                <p class="mt-1 text-xs" style="color:#b91c1c;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Payment Method</label>
            <select name="payment_method"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
                <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="bank_transfer" {{ old('payment_method') === 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                <option value="gcash" {{ old('payment_method') === 'gcash' ? 'selected' : '' }}>GCash</option>
                <option value="other" {{ old('payment_method') === 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="mb-5">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Notes</label>
            <textarea name="notes" rows="3"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">{{ old('notes') }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                class="px-5 py-2 rounded-lg text-white text-sm font-medium"
                style="background:#C2622A;">Record Payment</button>
            <a href="{{ route('admin.bills.show', $bill) }}"
                class="px-5 py-2 rounded-lg text-sm font-medium"
                style="border:1px solid #E8DDD4;color:#3D2314;">Cancel</a>
        </div>
    </form>
</div>
@endsection