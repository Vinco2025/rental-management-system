@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">New Lease Contract</h1>
        <p class="text-sm text-slate-500 mt-1">Assign a tenant to a room and set the lease terms.</p>
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

    <form action="{{ route('admin.lease-contracts.store') }}" method="POST"
        class="bg-white rounded-xl shadow p-6 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tenant</label>
                <select name="tenant_id" required
                        class="w-full rounded-lg border-slate-300 text-sm px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    <option value="">— Select Tenant —</option>
                    @foreach($tenants as $tenant)
                        <option value="{{ $tenant->id }}" {{ old('tenant_id') == $tenant->id ? 'selected' : '' }}>
                            {{ $tenant->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Room</label>
                <select name="room_id" required
                        class="w-full rounded-lg border-slate-300 text-sm px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
                    <option value="">— Select Room —</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                            Room {{ $room->room_number }} ({{ $room->roomType->name }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Start Date</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" required
                    class="w-full rounded-lg border-slate-300 text-sm px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">End Date <span class="text-slate-400">(optional)</span></label>
                <input type="date" name="end_date" value="{{ old('end_date') }}"
                    class="w-full rounded-lg border-slate-300 text-sm px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Monthly Rate (₱)</label>
                <input type="number" name="monthly_rate" value="{{ old('monthly_rate') }}" step="0.01" min="0" required
                    class="w-full rounded-lg border-slate-300 text-sm px-3 py-2 focus:ring-orange-500 focus:border-orange-500">
            </div>

        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Notes <span class="text-slate-400">(optional)</span></label>
            <textarea name="notes" rows="3"
                    class="w-full rounded-lg border-slate-300 text-sm px-3 py-2 focus:ring-orange-500 focus:border-orange-500">{{ old('notes') }}</textarea>
        </div>

        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('admin.lease-contracts.index') }}"
            class="text-sm text-slate-500 hover:text-slate-700">Cancel</a>
            <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-5 py-2 rounded-lg">
                Create Lease
            </button>
        </div>

    </form>
</div>
@endsection