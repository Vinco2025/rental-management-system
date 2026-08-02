@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="mb-7">
        <nav class="flex items-center gap-2 text-sm text-[#C4A08A] mb-3">
            <a href="{{ route('admin.room-types.index') }}" class="hover:text-[#C2622A] transition-colors">Room Types</a>
            <i class="ti ti-chevron-right text-xs"></i>
            <span class="text-[#7A5542]">Edit</span>
        </nav>
        <h1 class="text-2xl font-bold text-[#3D2314]">Edit Room Type</h1>
        <p class="text-[#7A5542] text-sm mt-1">Update details for {{ $roomType->name }}.</p>
    </div>

    <form action="{{ route('admin.room-types.update', $roomType) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl border border-[#E8DDD4] shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-[#F3EDE8] bg-[#FDF8F4]">
                <h2 class="text-xs font-bold text-[#7A5542] uppercase tracking-widest">Room Type Details</h2>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $roomType->name) }}"
                        class="{{ $errors->has('name') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:outline-none' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }}">
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Description</label>
                    <textarea name="description" rows="3"
                        class='w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition resize-none'>{{ old('description', $roomType->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Max Occupants <span class="text-red-500">*</span></label>
                    <input type="number" name="max_occupants" value="{{ old('max_occupants', $roomType->max_occupants) }}" min="1"
                        class="{{ $errors->has('max_occupants') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:outline-none' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }}">
                    @error('max_occupants') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Save button inside the form --}}
        <div class="flex justify-end pt-1">
            <button type="submit"
                    class="px-6 py-2.5 rounded-xl text-sm font-semibold text-white bg-[#C2622A] hover:bg-[#A8521F] transition-colors shadow-sm">
                Update Room Type
            </button>
        </div>

    </form>

    {{-- Delete and Cancel outside the edit form --}}
    <div class="flex items-center justify-between mt-4">
        <form action="{{ route('admin.room-types.destroy', $roomType) }}" method="POST"
            onsubmit="return confirm('Delete this room type?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-5 py-2.5 rounded-xl text-sm font-medium text-red-600 bg-white border border-red-200 hover:bg-red-50 transition-colors">
                <i class="ti ti-trash mr-1"></i>Delete
            </button>
        </form>
        <a href="{{ route('admin.room-types.index') }}"
        class="px-5 py-2.5 rounded-xl text-sm font-medium text-[#7A5542] bg-white border border-[#E8DDD4] hover:bg-[#FDF8F4] transition-colors">
            Cancel
        </a>
    </div>

</div>
@endsection