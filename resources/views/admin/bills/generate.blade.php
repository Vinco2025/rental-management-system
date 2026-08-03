@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <nav class="text-sm mb-2" style="color:#7A5542;">
        <a href="{{ route('admin.bills.index') }}" style="color:#C2622A;">Bills</a>
        <span class="mx-1">›</span> Generate Bills
    </nav>
    <h1 class="text-2xl font-bold" style="color:#3D2314;">Generate Bills</h1>
    <p class="text-sm mt-1" style="color:#7A5542;">Creates one bill per active lease for the selected month.</p>
</div>

<div class="rounded-xl p-6 max-w-md" style="border:1px solid #E8DDD4;background:#fff;">
    <form action="{{ route('admin.bills.generate') }}" method="POST">
        @csrf
        <div class="mb-5">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Billing Month</label>
            <input type="month" name="billing_month"
                value="{{ old('billing_month', now()->format('Y-m')) }}"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
            @error('billing_month')
                <p class="mt-1 text-xs" style="color:#b91c1c;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full py-2 rounded-lg text-white text-sm font-medium"
            style="background:#C2622A;">
            Generate Bills
        </button>
    </form>
</div>
@endsection