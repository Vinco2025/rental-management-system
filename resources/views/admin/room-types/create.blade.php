<x-app-layout>
    <x-slot name="header">
        <div>
            <nav class="flex items-center gap-2 text-sm text-[#C4A08A] mb-2">
                <a href="{{ route('admin.room-types.index') }}" class="hover:text-[#C2622A] transition-colors">Room Types</a>
                <i class="ti ti-chevron-right text-xs"></i>
                <span class="text-[#7A5542]">Add New</span>
            </nav>
            <h2 class="text-[22px] font-bold text-[#3D2314]">Add Room Type</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-6">

            <form action="{{ route('admin.room-types.store') }}" method="POST" class="space-y-5">
                @csrf

                <div class="bg-white rounded-2xl border border-[#E8DDD4] shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-[#F3EDE8] bg-[#FDF8F4]">
                        <h2 class="text-xs font-bold text-[#7A5542] uppercase tracking-widest">Room Type Details</h2>
                    </div>
                    <div class="p-6 space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Single, Double, Studio"
                                class="{{ $errors->has('name') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:outline-none' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }}">
                            @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Description</label>
                            <textarea name="description" rows="3" placeholder="Optional description..."
                                class='w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition resize-none'>{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#3D2314] mb-1.5">Max Occupants <span class="text-red-500">*</span></label>
                            <input type="number" name="max_occupants" value="{{ old('max_occupants', 1) }}" min="1"
                                class="{{ $errors->has('max_occupants') ? 'w-full rounded-xl border border-red-300 bg-red-50 px-3.5 py-2.5 text-sm text-[#3D2314] focus:outline-none' : 'w-full rounded-xl border border-[#E8DDD4] px-3.5 py-2.5 text-sm text-[#3D2314] placeholder-[#C4A08A] bg-white focus:border-[#C2622A] focus:ring-2 focus:ring-[#C2622A]/20 focus:outline-none transition' }}">
                            @error('max_occupants') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-1">
                    <a href="{{ route('admin.room-types.index') }}"
                    class="px-5 py-2.5 rounded-xl text-sm font-medium text-[#7A5542] bg-white border border-[#E8DDD4] hover:bg-[#FDF8F4] transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 rounded-xl text-sm font-semibold text-white bg-[#C2622A] hover:bg-[#A8521F] transition-colors shadow-sm">
                        Save Room Type
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>