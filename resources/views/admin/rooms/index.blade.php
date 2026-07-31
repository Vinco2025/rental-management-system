@extends('layouts.admin')

@section('content')
<div class="p-8">

    @if(session('success'))
        <div style="background: #EAF3DE; color: #3B6D11; border-radius: 8px; padding: 12px 16px; font-size: 13px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
        <h1 style="font-size: 20px; font-weight: 500; color: #3D2314;">Rooms</h1>
        <a href="{{ route('admin.rooms.create') }}"
        style="background: #C2622A; color: #fff; font-size: 13px; font-weight: 500; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
            + Add room
        </a>
    </div>

    <div style="background: #fff; border-radius: 12px; border: 0.5px solid #E8DDD4; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
            <thead>
                <tr style="background: #FDF8F4; border-bottom: 0.5px solid #E8DDD4;">
                    <th style="padding: 10px 16px; text-align: left; font-size: 11px; color: #7A5542; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Room</th>
                    <th style="padding: 10px 16px; text-align: left; font-size: 11px; color: #7A5542; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Floor</th>
                    <th style="padding: 10px 16px; text-align: left; font-size: 11px; color: #7A5542; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Type</th>
                    <th style="padding: 10px 16px; text-align: left; font-size: 11px; color: #7A5542; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Rate</th>
                    <th style="padding: 10px 16px; text-align: left; font-size: 11px; color: #7A5542; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Status</th>
                    <th style="padding: 10px 16px; text-align: left; font-size: 11px; color: #7A5542; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rooms as $room)
                <tr style="border-bottom: 0.5px solid #F5EDE6;">
                    <td style="padding: 12px 16px; font-weight: 500; color: #3D2314;">{{ $room->room_number }}</td>
                    <td style="padding: 12px 16px; color: #7A5542;">Floor {{ $room->floor }}</td>
                    <td style="padding: 12px 16px; color: #7A5542;">{{ $room->roomType->name }}</td>
                    <td style="padding: 12px 16px; color: #7A5542;">₱{{ number_format($room->monthly_rate, 2) }}</td>
                    <td style="padding: 12px 16px;">
                        @php
                            $badge = match($room->status) {
                                'available'         => ['bg: #EAF3DE', 'color: #3B6D11'],
                                'occupied'          => ['bg: #FAECE7', 'color: #993C1D'],
                                'under_maintenance' => ['bg: #FAEEDA', 'color: #854F0B'],
                                default             => ['bg: #F1EFE8', 'color: #5F5E5A'],
                            };
                        @endphp
                        <span style="font-size: 11px; font-weight: 500; padding: 3px 10px; border-radius: 20px; background: {{ str_replace('bg: ', '', $badge[0]) }}; color: {{ str_replace('color: ', '', $badge[1]) }};">
                            {{ ucfirst(str_replace('_', ' ', $room->status)) }}
                        </span>
                    </td>
                    <td style="padding: 12px 16px;">
                        <a href="{{ route('admin.rooms.show', $room) }}"
                        style="color: #C2622A; font-size: 13px; text-decoration: none; margin-right: 12px;">View</a>
                        <a href="{{ route('admin.rooms.edit', $room) }}"
                        style="color: #7A5542; font-size: 13px; text-decoration: none; margin-right: 12px;">Edit</a>
                        <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" style="display: inline;"
                            onsubmit="return confirm('Delete this room?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="color: #993C1D; font-size: 13px; background: none; border: none; cursor: pointer; padding: 0;">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 40px; text-align: center; color: #C4A08A; font-size: 13px;">
                        No rooms added yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection