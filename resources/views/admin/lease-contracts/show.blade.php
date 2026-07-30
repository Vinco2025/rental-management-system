@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Lease Contract Details</h1>
        <div class="flex gap-3">
            <a href="{{ route('admin.lease-contracts.edit', $leaseContract) }}"
            class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-4 py-2 rounded-lg">
                Edit
            </a>
            <a href="{{ route('admin.lease-contracts.index') }}"
            class="text-sm text-slate-500 hover:text-slate-700 self-center">
                ← Back
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow divide-y divide-slate-100">

        <div class="px-6 py-4 grid grid-cols-2 gap-4">
            <div>
                <p class="text-xs text-slate-400 uppercase font-semibold">Tenant</p>
                <p class="text-slate-800 font-medium mt-1">{{ $leaseContract->tenant->full_name }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase font-semibold">Room</p>
                <p class="text-slate-800 font-medium mt-1">
                    Room {{ $leaseContract->room->room_number }}
                    <span class="text-slate-400 font-normal">({{ $leaseContract->room->roomType->name }})</span>
                </p>
            </div>
        </div>

        <div class="px-6 py-4 grid grid-cols-2 gap-4">
            <div>
                <p class="text-xs text-slate-400 uppercase font-semibold">Start Date</p>
                <p class="text-slate-800 mt-1">{{ $leaseContract->start_date->format('F d, Y') }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase font-semibold">End Date</p>
                <p class="text-slate-800 mt-1">
                    {{ $leaseContract->end_date ? $leaseContract->end_date->format('F d, Y') : 'Open-ended' }}
                </p>
            </div>
        </div>

        <div class="px-6 py-4 grid grid-cols-2 gap-4">
            <div>
                <p class="text-xs text-slate-400 uppercase font-semibold">Monthly Rate</p>
                <p class="text-slate-800 font-medium mt-1">₱{{ number_format($leaseContract->monthly_rate, 2) }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase font-semibold">Status</p>
                @php
                    $badgeClass = match($leaseContract->status) {
                        'active'     => 'bg-green-100 text-green-700',
                        'expired'    => 'bg-slate-100 text-slate-600',
                        'terminated' => 'bg-red-100 text-red-600',
                    };
                @endphp
                <span class="mt-1 inline-block px-2 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
                    {{ ucfirst($leaseContract->status) }}
                </span>
            </div>
        </div>

        @if($leaseContract->notes)
        <div class="px-6 py-4">
            <p class="text-xs text-slate-400 uppercase font-semibold">Notes</p>
            <p class="text-slate-700 mt-1">{{ $leaseContract->notes }}</p>
        </div>
        @endif

    </div>

    <div class="mt-6">
        <form action="{{ route('admin.lease-contracts.destroy', $leaseContract) }}" method="POST"
            onsubmit="return confirm('Delete this lease contract? The room will be set back to available.')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="text-sm text-red-500 hover:text-red-700 font-medium">
                Delete Contract
            </button>
        </form>
    </div>

</div>
@endsection