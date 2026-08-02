@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between gap-4 flex-wrap mb-6">
        <div>
            <h1 class="text-2xl font-bold text-[#3D2314]">Room Types</h1>
            <p class="text-[13px] text-[#7A5542] mt-1">Manage room categories and their occupant limits.</p>
        </div>
        <a href="{{ route('admin.room-types.create') }}"
        class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#C2622A] hover:bg-[#A8521F] text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
            <i class="ti ti-plus text-[15px]"></i>
            Add Room Type
        </a>
    </div>

    {{-- Success --}}
    @if (session('success'))
        <div class="mb-5 rounded-xl bg-[#EAF3DE] border border-[#c3dfa8] px-4 py-3 text-[#3B6D11] text-sm font-medium">
            <i class="ti ti-circle-check mr-1"></i>{{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-[#E8DDD4] shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-[#FDF8F4] border-b border-[#E8DDD4] text-left">
                    <th class="px-6 py-3.5 text-xs font-semibold text-[#7A5542] uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3.5 text-xs font-semibold text-[#7A5542] uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3.5 text-xs font-semibold text-[#7A5542] uppercase tracking-wider">Max Occupants</th>
                    <th class="px-6 py-3.5 text-xs font-semibold text-[#7A5542] uppercase tracking-wider">Rooms</th>
                    <th class="px-6 py-3.5 text-xs font-semibold text-[#7A5542] uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#F3EDE8]">
                @forelse ($roomTypes as $type)
                    <tr class="hover:bg-[#FDF8F4] transition-colors">
                        <td class="px-6 py-4 font-semibold text-[#3D2314]">{{ $type->name }}</td>
                        <td class="px-6 py-4 text-[#7A5542]">{{ $type->description ?? '—' }}</td>
                        <td class="px-6 py-4 text-[#7A5542]">{{ $type->max_occupants }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-[#F8ECE4] text-[#C2622A]">
                                {{ $type->rooms->count() }} room{{ $type->rooms->count() !== 1 ? 's' : '' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.room-types.edit', $type) }}"
                                class="text-[#C2622A] hover:text-[#A8521F] font-semibold transition-colors">Edit</a>
                                <form action="{{ route('admin.room-types.destroy', $type) }}" method="POST"
                                    onsubmit="return confirm('Delete this room type?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-[#7A5542] hover:text-red-600 font-medium transition-colors">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-[#F8ECE4] flex items-center justify-center">
                                    <i class="ti ti-category text-[22px] text-[#C2622A]"></i>
                                </div>
                                <p class="text-[#7A5542] text-sm">No room types yet.</p>
                                <a href="{{ route('admin.room-types.create') }}"
                                class="text-sm font-semibold text-[#C2622A] hover:underline">Add your first room type</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection