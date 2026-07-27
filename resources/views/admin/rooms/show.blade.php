@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-3xl mx-auto px-4 py-10">

        {{-- Page Header --}}
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-3">
                <a href="{{ route('admin.rooms.index') }}" class="hover:text-indigo-600 transition-colors">Rooms</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-600">Room {{ $room->room_number }}</span>
            </nav>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Room {{ $room->room_number }}</h1>
                    <p class="text-slate-500 mt-1 text-sm">{{ $room->roomType->name ?? '—' }} · Floor {{ $room->floor }}</p>
                </div>
                <a href="{{ route('admin.rooms.edit', $room) }}"
                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit Room
                </a>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 flex items-center gap-2 text-green-700 text-sm font-medium">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- ═══════════════════════════════════════════════ --}}
        {{-- STATUS CONTROL PANEL (the signature element)   --}}
        {{-- ═══════════════════════════════════════════════ --}}
        @php
            $statuses = [
                'vacant'            => ['label' => 'Vacant',            'ring' => 'ring-green-400',  'bg' => 'bg-green-50',  'text' => 'text-green-700',  'dot' => 'bg-green-500'],
                'occupied'          => ['label' => 'Occupied',          'ring' => 'ring-blue-400',   'bg' => 'bg-blue-50',   'text' => 'text-blue-700',   'dot' => 'bg-blue-500'],
                'under_maintenance' => ['label' => 'Under Maintenance', 'ring' => 'ring-amber-400',  'bg' => 'bg-amber-50',  'text' => 'text-amber-700',  'dot' => 'bg-amber-500'],
                'reserved'          => ['label' => 'Reserved',          'ring' => 'ring-purple-400', 'bg' => 'bg-purple-50', 'text' => 'text-purple-700', 'dot' => 'bg-purple-500'],
            ];
            $current = $statuses[$room->status] ?? $statuses['vacant'];
        @endphp

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">Room Status</h2>
                <span class="flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold ring-1 {{ $current['bg'] }} {{ $current['text'] }} {{ $current['ring'] }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $current['dot'] }}"></span>
                    {{ $current['label'] }}
                </span>
            </div>
            <div class="p-6">
                <p class="text-xs text-slate-500 mb-4">Change this room's status instantly without opening the edit form.</p>
                <form action="{{ route('admin.rooms.update', $room) }}" method="POST" id="statusForm">
                    @csrf
                    @method('PUT')
                    {{-- Pass all existing fields as hidden so only status changes --}}
                    <input type="hidden" name="room_number"   value="{{ $room->room_number }}">
                    <input type="hidden" name="floor"         value="{{ $room->floor }}">
                    <input type="hidden" name="room_type_id"  value="{{ $room->room_type_id }}">
                    <input type="hidden" name="monthly_rate"  value="{{ $room->monthly_rate }}">
                    <input type="hidden" name="max_occupants" value="{{ $room->max_occupants }}">
                    <input type="hidden" name="notes"         value="{{ $room->notes }}">
                    @php
                        $savedAmenities = is_array($room->amenities) ? $room->amenities : json_decode($room->amenities ?? '[]', true);
                    @endphp
                    @foreach ($savedAmenities as $amenity)
                        <input type="hidden" name="amenities[]" value="{{ $amenity }}">
                    @endforeach
                    <input type="hidden" name="status" id="statusInput" value="{{ $room->status }}">

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                        @foreach ($statuses as $value => $meta)
                            <button
                                type="button"
                                onclick="setStatus('{{ $value }}')"
                                data-status="{{ $value }}"
                                class="status-btn relative flex flex-col items-center gap-1.5 px-3 py-3 rounded-lg border text-xs font-semibold transition
                                    {{ $room->status === $value
                                        ? $meta['bg'] . ' ' . $meta['text'] . ' border-transparent ring-2 ' . $meta['ring']
                                        : 'bg-white text-slate-500 border-slate-200 hover:border-slate-300 hover:bg-slate-50' }}"
                            >
                                <span class="w-2.5 h-2.5 rounded-full {{ $meta['dot'] }}"></span>
                                {{ $meta['label'] }}
                                @if ($room->status === $value)
                                    <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 rounded-full bg-current opacity-60"></span>
                                @endif
                            </button>
                        @endforeach
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button type="submit" id="statusSubmit"
                                class="px-5 py-2 rounded-lg text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 transition shadow-sm disabled:opacity-40 disabled:cursor-not-allowed"
                                {{ $room->status === $room->status ? '' : '' }}>
                            Apply Status Change
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Room Details --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">Room Details</h2>
            </div>
            <div class="divide-y divide-slate-100">
                @php
                    $details = [
                        ['label' => 'Room Number',   'value' => $room->room_number],
                        ['label' => 'Floor',         'value' => 'Floor ' . $room->floor],
                        ['label' => 'Room Type',     'value' => $room->roomType->name ?? '—'],
                        ['label' => 'Monthly Rate',  'value' => '₱' . number_format($room->monthly_rate, 2)],
                        ['label' => 'Max Occupants', 'value' => $room->max_occupants . ' ' . Str::plural('person', $room->max_occupants)],
                    ];
                @endphp
                @foreach ($details as $detail)
                    <div class="flex items-center justify-between px-6 py-3.5">
                        <span class="text-sm text-slate-500">{{ $detail['label'] }}</span>
                        <span class="text-sm font-medium text-slate-800">{{ $detail['value'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Amenities --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">Amenities</h2>
            </div>
            <div class="p-6">
                @php
                    $amenities = is_array($room->amenities) ? $room->amenities : json_decode($room->amenities ?? '[]', true);
                @endphp
                @if (count($amenities))
                    <div class="flex flex-wrap gap-2">
                        @foreach ($amenities as $amenity)
                            <span class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-indigo-50 text-indigo-700 text-xs font-medium ring-1 ring-indigo-200">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                {{ $amenity }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-400 italic">No amenities listed for this room.</p>
                @endif
            </div>
        </div>

        {{-- Notes --}}
        @if ($room->notes)
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                    <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">Notes</h2>
                </div>
                <div class="p-6">
                    <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">{{ $room->notes }}</p>
                </div>
            </div>
        @endif

        {{-- Footer Actions --}}
        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('admin.rooms.index') }}"
            class="flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Rooms
            </a>
            <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST"
                onsubmit="return confirm('Permanently delete Room {{ $room->room_number }}?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-5 py-2.5 rounded-lg text-sm font-medium text-red-600 bg-white border border-red-200 hover:bg-red-50 transition shadow-sm">
                    Delete Room
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    const originalStatus = '{{ $room->status }}';
    let selectedStatus = originalStatus;

    const statusMeta = {
        vacant:            { bg: 'bg-green-50',  text: 'text-green-700',  ring: 'ring-green-400',  dot: 'bg-green-500'  },
        occupied:          { bg: 'bg-blue-50',   text: 'text-blue-700',   ring: 'ring-blue-400',   dot: 'bg-blue-500'   },
        under_maintenance: { bg: 'bg-amber-50',  text: 'text-amber-700',  ring: 'ring-amber-400',  dot: 'bg-amber-500'  },
        reserved:          { bg: 'bg-purple-50', text: 'text-purple-700', ring: 'ring-purple-400', dot: 'bg-purple-500' },
    };

    function setStatus(value) {
        selectedStatus = value;
        document.getElementById('statusInput').value = value;

        document.querySelectorAll('.status-btn').forEach(btn => {
            const s = btn.dataset.status;
            const m = statusMeta[s];
            btn.className = btn.className
                .replace(/bg-\S+/g, '')
                .replace(/text-\S+/g, '')
                .replace(/border-\S+/g, '')
                .replace(/ring-\d/g, '')
                .replace(/ring-\S+/g, '')
                .replace(/\s+/g, ' ')
                .trim();

            if (s === value) {
                btn.classList.add(m.bg, m.text, 'border-transparent', 'ring-2', m.ring);
            } else {
                btn.classList.add('bg-white', 'text-slate-500', 'border-slate-200', 'hover:border-slate-300', 'hover:bg-slate-50');
            }
        });

        const submitBtn = document.getElementById('statusSubmit');
        submitBtn.disabled = (value === originalStatus);
    }

    // Disable submit on load since status hasn't changed
    document.getElementById('statusSubmit').disabled = true;
</script>
@endsection