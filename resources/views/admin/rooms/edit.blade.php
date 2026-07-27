@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-3xl mx-auto px-4 py-10">

        {{-- Page Header --}}
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-3">
                <a href="{{ route('admin.rooms.index') }}" class="hover:text-indigo-600 transition-colors">Rooms</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('admin.rooms.show', $room) }}" class="hover:text-indigo-600 transition-colors">Room {{ $room->room_number }}</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-600">Edit</span>
            </nav>
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Edit Room {{ $room->room_number }}</h1>
                    <p class="text-slate-500 mt-1 text-sm">Update the details for this room.</p>
                </div>
                @php
                    $statusColors = [
                        'vacant'           => 'bg-green-100 text-green-700 ring-green-200',
                        'occupied'         => 'bg-blue-100 text-blue-700 ring-blue-200',
                        'under_maintenance'=> 'bg-amber-100 text-amber-700 ring-amber-200',
                        'reserved'         => 'bg-purple-100 text-purple-700 ring-purple-200',
                    ];
                    $color = $statusColors[$room->status] ?? 'bg-slate-100 text-slate-600 ring-slate-200';
                @endphp
                <span class="mt-1 px-3 py-1 rounded-full text-xs font-semibold ring-1 {{ $color }}">
                    {{ ucwords(str_replace('_', ' ', $room->status)) }}
                </span>
            </div>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                <div class="flex items-center gap-2 text-red-700 font-semibold text-sm mb-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    Please fix the following errors:
                </div>
                <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.rooms.update', $room) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Basic Info --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                    <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">Basic Information</h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

                    {{-- Room Number --}}
                    <div>
                        <label for="room_number" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Room Number <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="room_number"
                            id="room_number"
                            value="{{ old('room_number', $room->room_number) }}"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('room_number') border-red-400 bg-red-50 @enderror"
                        >
                        @error('room_number')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Floor --}}
                    <div>
                        <label for="floor" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Floor <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            name="floor"
                            id="floor"
                            value="{{ old('floor', $room->floor) }}"
                            min="1"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('floor') border-red-400 bg-red-50 @enderror"
                        >
                        @error('floor')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Room Type --}}
                    <div>
                        <label for="room_type_id" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Room Type <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="room_type_id"
                            id="room_type_id"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('room_type_id') border-red-400 bg-red-50 @enderror"
                        >
                            <option value="">— Select a type —</option>
                            @foreach ($roomTypes as $type)
                                <option value="{{ $type->id }}" {{ old('room_type_id', $room->room_type_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_type_id')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Monthly Rate --}}
                    <div>
                        <label for="monthly_rate" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Monthly Rate (₱) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-medium">₱</span>
                            <input
                                type="number"
                                name="monthly_rate"
                                id="monthly_rate"
                                value="{{ old('monthly_rate', $room->monthly_rate) }}"
                                min="0"
                                step="0.01"
                                class="w-full rounded-lg border border-slate-300 bg-white pl-8 pr-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('monthly_rate') border-red-400 bg-red-50 @enderror"
                            >
                        </div>
                        @error('monthly_rate')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Max Occupants --}}
                    <div>
                        <label for="max_occupants" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Max Occupants <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            name="max_occupants"
                            id="max_occupants"
                            value="{{ old('max_occupants', $room->max_occupants) }}"
                            min="1"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('max_occupants') border-red-400 bg-red-50 @enderror"
                        >
                        @error('max_occupants')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="status"
                            id="status"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition @error('status') border-red-400 bg-red-50 @enderror"
                        >
                            @foreach (['vacant', 'occupied', 'under_maintenance', 'reserved'] as $s)
                                <option value="{{ $s }}" {{ old('status', $room->status) === $s ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('_', ' ', $s)) }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Amenities --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                    <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">Amenities</h2>
                </div>
                <div class="p-6">
                    @php
                        $amenityList = ['Air Conditioning', 'Private Bathroom', 'Wi-Fi', 'Cable TV', 'Ref / Mini Fridge', 'Wardrobe', 'Study Desk', 'Water Heater', 'Balcony', 'Kitchen Access', 'Washing Machine Access', 'CCTV'];
                        $savedAmenities = old('amenities', is_array($room->amenities) ? $room->amenities : json_decode($room->amenities ?? '[]', true));
                    @endphp
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach ($amenityList as $amenity)
                            <label class="flex items-center gap-2.5 cursor-pointer group">
                                <input
                                    type="checkbox"
                                    name="amenities[]"
                                    value="{{ $amenity }}"
                                    {{ in_array($amenity, $savedAmenities) ? 'checked' : '' }}
                                    class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-0 cursor-pointer"
                                >
                                <span class="text-sm text-slate-600 group-hover:text-slate-800 transition-colors select-none">{{ $amenity }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Notes --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                    <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">Additional Notes</h2>
                </div>
                <div class="p-6">
                    <textarea
                        name="notes"
                        id="notes"
                        rows="4"
                        placeholder="Any special notes about this room (optional)..."
                        class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition resize-none"
                    >{{ old('notes', $room->notes) }}</textarea>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-between pt-2">
                {{-- Delete (left side) --}}
                <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST"
                    onsubmit="return confirm('Delete Room {{ $room->room_number }}? This cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-5 py-2.5 rounded-lg text-sm font-medium text-red-600 bg-white border border-red-200 hover:bg-red-50 transition shadow-sm">
                        Delete Room
                    </button>
                </form>

                {{-- Save / Cancel (right side) --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.rooms.show', $room) }}"
                    class="px-5 py-2.5 rounded-lg text-sm font-medium text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 transition shadow-sm">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 transition shadow-sm">
                        Save Changes
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection