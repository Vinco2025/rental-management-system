@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Lease Contracts</h1>
        <a href="{{ route('admin.lease-contracts.create') }}"
        class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-4 py-2 rounded-lg">
            + New Lease
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">Tenant</th>
                    <th class="px-6 py-3 text-left">Room</th>
                    <th class="px-6 py-3 text-left">Start Date</th>
                    <th class="px-6 py-3 text-left">End Date</th>
                    <th class="px-6 py-3 text-left">Monthly Rate</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($leases as $lease)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-medium text-slate-800">
                        {{ $lease->tenant->full_name }}
                    </td>
                    <td class="px-6 py-4 text-slate-600">
                        Room {{ $lease->room->room_number }}
                    </td>
                    <td class="px-6 py-4 text-slate-600">
                        {{ $lease->start_date->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 text-slate-600">
                        {{ $lease->end_date ? $lease->end_date->format('M d, Y') : '—' }}
                    </td>
                    <td class="px-6 py-4 text-slate-600">
                        ₱{{ number_format($lease->monthly_rate, 2) }}
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $badgeClass = match($lease->status) {
                                'active'     => 'bg-green-100 text-green-700',
                                'expired'    => 'bg-slate-100 text-slate-600',
                                'terminated' => 'bg-red-100 text-red-600',
                            };
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
                            {{ ucfirst($lease->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.lease-contracts.show', $lease) }}"
                        class="text-orange-500 hover:underline font-medium">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-slate-400">No lease contracts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $leases->links() }}
    </div>

</div>
@endsection