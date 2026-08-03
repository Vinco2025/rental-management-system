@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <nav class="text-sm mb-2" style="color:#7A5542;">
        <a href="{{ route('admin.bills.index') }}" style="color:#C2622A;">Bills</a>
        <span class="mx-1">›</span>
        <a href="{{ route('admin.bills.show', $bill) }}" style="color:#C2622A;">{{ $bill->tenant->full_name }}</a>
        <span class="mx-1">›</span> Edit
    </nav>
    <h1 class="text-2xl font-bold" style="color:#3D2314;">Edit Bill</h1>
    <p class="text-sm mt-1" style="color:#7A5542;">{{ $bill->billing_month->format('F Y') }}</p>
</div>

<div class="rounded-xl p-6 max-w-lg" style="border:1px solid #E8DDD4;background:#fff;">
    <form action="{{ route('admin.bills.update', $bill) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Monthly Rent</label>
            <input type="text" value="₱{{ number_format($bill->rent_amount, 2) }}" disabled
                class="w-full px-3 py-2 rounded-lg text-sm" style="border:1px solid #E8DDD4;background:#f5f5f5;color:#7A5542;">
            <p class="text-xs mt-1" style="color:#7A5542;">Set by the lease contract — not editable here.</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Electricity Amount (₱)</label>
            <input type="number" name="electricity_amount" step="0.01" min="0"
                value="{{ old('electricity_amount', $bill->electricity_amount) }}"
                class="w-full px-3 py-2 rounded-lg text-sm @error('electricity_amount') border-red-300 bg-red-50 @else @enderror"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
            @error('electricity_amount')
                <p class="mt-1 text-xs" style="color:#b91c1c;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Water Amount (₱)</label>
            <input type="number" name="water_amount" step="0.01" min="0"
                value="{{ old('water_amount', $bill->water_amount) }}"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
            @error('water_amount')
                <p class="mt-1 text-xs" style="color:#b91c1c;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Due Date</label>
            <input type="date" name="due_date"
                value="{{ old('due_date', $bill->due_date->format('Y-m-d')) }}"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
            @error('due_date')
                <p class="mt-1 text-xs" style="color:#b91c1c;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Notes</label>
            <textarea name="notes" rows="3"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">{{ old('notes', $bill->notes) }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                class="px-5 py-2 rounded-lg text-white text-sm font-medium"
                style="background:#C2622A;">Save Changes</button>
            <a href="{{ route('admin.bills.show', $bill) }}"
                class="px-5 py-2 rounded-lg text-sm font-medium"
                style="border:1px solid #E8DDD4;color:#3D2314;">Cancel</a>
        </div>
    </form>
</div>
@endsection