<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Rooms
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4">

        {{-- Success message --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium">All Rooms</h3>
            <a href="{{ route('admin.rooms.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add Room
            </a>
        </div>

        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-100 text-left text-sm text-gray-600">
                <tr>
                    <th class="px-4 py-3">Room No.</th>
                    <th class="px-4 py-3">Floor</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Rate</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-200">
                @forelse($rooms as $room)
                <tr>
                    <td class="px-4 py-3">{{ $room->room_number }}</td>
                    <td class="px-4 py-3">Floor {{ $room->floor }}</td>
                    <td class="px-4 py-3">{{ $room->roomType->name }}</td>
                    <td class="px-4 py-3">₱{{ number_format($room->monthly_rate, 2) }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            @if($room->status === 'vacant') bg-green-100 text-green-700
                            @elseif($room->status === 'occupied') bg-blue-100 text-blue-700
                            @elseif($room->status === 'under_maintenance') bg-red-100 text-red-700
                            @else bg-yellow-100 text-yellow-700 @endif">
                            {{ ucfirst(str_replace('_', ' ', $room->status)) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 space-x-2">
                        <a href="{{ route('admin.rooms.edit', $room) }}"
                        class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.rooms.destroy', $room) }}"
                            method="POST" class="inline"
                            onsubmit="return confirm('Delete this room?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-400">
                        No rooms added yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>