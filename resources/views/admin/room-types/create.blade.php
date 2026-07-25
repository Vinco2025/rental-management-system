<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Room Type
        </h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4">
        <form action="{{ route('admin.room-types.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="mt-1 w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200"
                    placeholder="e.g. Single, Double, Studio">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="3"
                    class="mt-1 w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200"
                    placeholder="Optional description">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Max Occupants</label>
                <input type="number" name="max_occupants" value="{{ old('max_occupants', 1) }}" min="1"
                    class="mt-1 w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200">
                @error('max_occupants') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Save Room Type
                </button>
                <a href="{{ route('admin.room-types.index') }}"
                    class="px-6 py-2 rounded border text-gray-600 hover:bg-gray-100">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>