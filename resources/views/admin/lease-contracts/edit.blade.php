@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Edit Lease Contract</h1>
        <p class="text-sm text-slate-500 mt-1">Update lease terms or change the contract status.</p>
    </div>

    @if($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.lease-contracts.update', $leaseContract) }}" method="POST"
        class="bg-white rounded-xl shadow p-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-slate-50 rounded-lg">
            <div>
                <p class="text-xs text-slate-400 uppercase font-semibold">Tenant</p>
                <p class="text-slate-800 font-medium mt-1">{{ $leaseContract->tenant->full_name }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase font-semibold">Room</p>
                <p class="text-slate-800 font-medium mt-1">Room {{ $leaseContract->room->room_number }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Start Date</label>
                <input type="date" name="start_date" value="{{ old('start_date', $leaseContract->start_date->format('Y-m-d')) }}" required
                    class="w-full rounded-lg border-slate-300 text-sm px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">End Date <span class="text-slate-400">(optional)</span></label>
                <input type="date" name="end_date" value="{{ old('end_date', $leaseContract->end_date?->format('Y-m-d')) }}"
                    class="w-full rounded-lg border-slate-300 text-sm px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Monthly Rate (₱)</label>
                <input type="number" name="monthly_rate" value="{{ old('monthly_rate', $leaseContract->monthly_rate) }}" step="0.01" min="0" required
                    class="w-full rounded-lg border-slate-300 text-sm px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                <select name="status" required
                        class="w-full rounded-lg border-slate-300 text-sm px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    @foreach(['active', 'expired', 'terminated'] as $status)
                        <option value="{{ $status }}" {{ old('status', $leaseContract->status) === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Notes <span class="text-slate-400">(optional)</span></label>
            <textarea name="notes" rows="3"
                    class="w-full rounded-lg border-slate-300 text-sm px-3 py-2 focus:ring-orange-500 focus:border-orange-500">{{ old('notes', $leaseContract->notes) }}</textarea>
        </div>

        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('admin.lease-contracts.show', $leaseContract) }}"
            class="text-sm text-slate-500 hover:text-slate-700">Cancel</a>
            <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-5 py-2 rounded-lg">
                Save Changes
            </button>
        </div>

    </form>
</div>
@endsection