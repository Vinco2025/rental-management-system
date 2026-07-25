<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Room Types
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium">All Room Types</h3>
            <a href="{{ route('admin.room-types.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add Room Type
            </a>
        </div>

        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-100 text-left text-sm text-gray-600">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Description</th>
                    <th class="px-4 py-3">Max Occupants</th>
                    <th class="px-4 py-3">Rooms</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-200">
                @forelse($roomTypes as $type)
                <tr>
                    <td class="px-4 py-3 font-medium">{{ $type->name }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $type->description ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $type->max_occupants }}</td>
                    <td class="px-4 py-3">{{ $type->rooms->count() }}</td>
                    <td class="px-4 py-3 space-x-2">
                        <a href="{{ route('admin.room-types.edit', $type) }}"
                        class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.room-types.destroy', $type) }}"
                            method="POST" class="inline"
                            onsubmit="return confirm('Delete this room type?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-400">
                        No room types yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>