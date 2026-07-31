@extends('layouts.admin')

@section('content')
<div style="padding: 32px;">

    @if(session('success'))
        <div style="background: #EAF3DE; color: #3B6D11; border-radius: 8px; padding: 12px 16px; font-size: 13px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
        <div>
            <a href="{{ route('admin.rooms.index') }}" style="font-size: 12px; color: #C4A08A; text-decoration: none;">← Rooms</a>
            <h1 style="font-size: 20px; font-weight: 500; color: #3D2314; margin-top: 4px;">Room {{ $room->room_number }}</h1>
            <p style="font-size: 13px; color: #7A5542; margin-top: 2px;">{{ $room->roomType->name ?? '—' }} · Floor {{ $room->floor }}</p>
        </div>
        <a href="{{ route('admin.rooms.edit', $room) }}"
        style="background: #fff; border: 0.5px solid #E8DDD4; color: #3D2314; font-size: 13px; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
            Edit room
        </a>
    </div>

    {{-- Status toggle --}}
    @php
        $statuses = [
            'available'         => ['label' => 'Available',         'bg' => '#EAF3DE', 'color' => '#3B6D11'],
            'occupied'          => ['label' => 'Occupied',          'bg' => '#FAECE7', 'color' => '#993C1D'],
            'under_maintenance' => ['label' => 'Under maintenance', 'bg' => '#FAEEDA', 'color' => '#854F0B'],
            'reserved'          => ['label' => 'Reserved',          'bg' => '#FAF0E8', 'color' => '#C2622A'],
        ];
        $current = $statuses[$room->status] ?? $statuses['available'];
    @endphp

    <div style="background: #fff; border-radius: 12px; border: 0.5px solid #E8DDD4; margin-bottom: 16px; overflow: hidden;">
        <div style="padding: 14px 20px; border-bottom: 0.5px solid #F5EDE6; background: #FDF8F4; display: flex; align-items: center; justify-content: space-between;">
            <p style="font-size: 11px; font-weight: 500; color: #7A5542; text-transform: uppercase; letter-spacing: 0.06em;">Room status</p>
            <span style="font-size: 11px; font-weight: 500; padding: 3px 10px; border-radius: 20px; background: {{ $current['bg'] }}; color: {{ $current['color'] }};">
                {{ $current['label'] }}
            </span>
        </div>
        <div style="padding: 20px;">
            <p style="font-size: 12px; color: #C4A08A; margin-bottom: 14px;">Change status without opening the edit form.</p>
            <form action="{{ route('admin.rooms.updateStatus', $room) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" id="statusInput" value="{{ $room->status }}">
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; margin-bottom: 16px;">
                    @foreach($statuses as $value => $meta)
                    <button type="button" onclick="setStatus('{{ $value }}')"
                            id="btn-{{ $value }}"
                            style="padding: 10px 8px; border-radius: 8px; font-size: 12px; font-weight: 500; cursor: pointer; border: 0.5px solid #E8DDD4;
                                background: {{ $room->status === $value ? $meta['bg'] : '#fff' }};
                                color: {{ $room->status === $value ? $meta['color'] : '#7A5542' }};">
                        {{ $meta['label'] }}
                    </button>
                    @endforeach
                </div>
                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" id="statusSubmit"
                        style="background: #C2622A; color: #fff; font-size: 13px; font-weight: 500; padding: 8px 18px; border-radius: 8px; border: none; cursor: pointer; opacity: 1;"
                        onclick="return document.getElementById('statusInput').value !== '{{ $room->status }}'">
                    Apply change
                </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Room details --}}
    <div style="background: #fff; border-radius: 12px; border: 0.5px solid #E8DDD4; margin-bottom: 16px; overflow: hidden;">
        <div style="padding: 14px 20px; border-bottom: 0.5px solid #F5EDE6; background: #FDF8F4;">
            <p style="font-size: 11px; font-weight: 500; color: #7A5542; text-transform: uppercase; letter-spacing: 0.06em;">Room details</p>
        </div>
        @php
            $details = [
                ['label' => 'Room number',   'value' => $room->room_number],
                ['label' => 'Floor',         'value' => 'Floor ' . $room->floor],
                ['label' => 'Room type',     'value' => $room->roomType->name ?? '—'],
                ['label' => 'Monthly rate',  'value' => '₱' . number_format($room->monthly_rate, 2)],
                ['label' => 'Max occupants', 'value' => $room->max_occupants . ' ' . Str::plural('person', $room->max_occupants)],
            ];
        @endphp
        @foreach($details as $detail)
        <div style="display: flex; justify-content: space-between; padding: 12px 20px; border-bottom: 0.5px solid #F9F4F0;">
            <span style="font-size: 13px; color: #C4A08A;">{{ $detail['label'] }}</span>
            <span style="font-size: 13px; font-weight: 500; color: #3D2314;">{{ $detail['value'] }}</span>
        </div>
        @endforeach
    </div>

    {{-- Amenities --}}
    <div style="background: #fff; border-radius: 12px; border: 0.5px solid #E8DDD4; margin-bottom: 16px; overflow: hidden;">
        <div style="padding: 14px 20px; border-bottom: 0.5px solid #F5EDE6; background: #FDF8F4;">
            <p style="font-size: 11px; font-weight: 500; color: #7A5542; text-transform: uppercase; letter-spacing: 0.06em;">Amenities</p>
        </div>
        <div style="padding: 20px; display: flex; flex-wrap: wrap; gap: 8px;">
            @php $amenities = is_array($room->amenities) ? $room->amenities : json_decode($room->amenities ?? '[]', true); @endphp
            @forelse($amenities as $amenity)
                <span style="background: #FAF0E8; color: #993C1D; font-size: 12px; padding: 4px 12px; border-radius: 20px;">{{ $amenity }}</span>
            @empty
                <p style="font-size: 13px; color: #C4A08A;">No amenities listed.</p>
            @endforelse
        </div>
    </div>

    {{-- Notes --}}
    @if($room->notes)
    <div style="background: #fff; border-radius: 12px; border: 0.5px solid #E8DDD4; margin-bottom: 16px; overflow: hidden;">
        <div style="padding: 14px 20px; border-bottom: 0.5px solid #F5EDE6; background: #FDF8F4;">
            <p style="font-size: 11px; font-weight: 500; color: #7A5542; text-transform: uppercase; letter-spacing: 0.06em;">Notes</p>
        </div>
        <div style="padding: 20px;">
            <p style="font-size: 13px; color: #3D2314; line-height: 1.7;">{{ $room->notes }}</p>
        </div>
    </div>
    @endif

</div>

<script>
    const originalStatus = '{{ $room->status }}';
    const statusColors = {
        available:         { bg: '#EAF3DE', color: '#3B6D11' },
        occupied:          { bg: '#FAECE7', color: '#993C1D' },
        under_maintenance: { bg: '#FAEEDA', color: '#854F0B' },
        reserved:          { bg: '#FAF0E8', color: '#C2622A' },
    };

    function setStatus(value) {
        document.getElementById('statusInput').value = value;
        @foreach($statuses as $value => $meta)
            document.getElementById('btn-{{ $value }}').style.background = '#fff';
            document.getElementById('btn-{{ $value }}').style.color = '#7A5542';
        @endforeach
        const meta = statusColors[value];
        document.getElementById('btn-' + value).style.background = meta.bg;
        document.getElementById('btn-' + value).style.color = meta.color;
        const submit = document.getElementById('statusSubmit');
        const changed = value !== originalStatus;
        submit.disabled = !changed;
        submit.style.opacity = changed ? '1' : '0.4';
        submit.style.cursor = changed ? 'pointer' : 'not-allowed';
    }
</script>
@endsection