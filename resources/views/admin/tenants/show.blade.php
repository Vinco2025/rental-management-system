@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="mb-7">
        <nav class="flex items-center gap-2 text-sm text-[#C4A08A] mb-3">
            <a href="{{ route('admin.tenants.index') }}" class="hover:text-[#C2622A] transition-colors">Tenants</a>
            <i class="ti ti-chevron-right text-xs"></i>
            <span class="text-[#7A5542]">{{ $tenant->full_name }}</span>
        </nav>
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-[#3D2314]">{{ $tenant->full_name }}</h1>
                <p class="text-[#7A5542] text-sm mt-1">{{ $tenant->user->email }}</p>
            </div>
            <div class="flex items-center gap-2 mt-1 shrink-0">
                @if ($tenant->status === 'active')
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-[#EAF3DE] text-[#3B6D11]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#3B6D11] inline-block"></span> Active
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-[#F3EDE8] text-[#7A5542]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#C4A08A] inline-block"></span> Inactive
                    </span>
                @endif
                <a href="{{ route('admin.tenants.edit', $tenant) }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium text-[#7A5542] bg-white border border-[#E8DDD4] hover:bg-[#FDF8F4] transition-colors shadow-sm">
                    <i class="ti ti-pencil text-[14px]"></i> Edit
                </a>
            </div>
        </div>
    </div>

    {{-- Success --}}
    @if (session('success'))
        <div class="mb-5 rounded-xl bg-[#EAF3DE] border border-[#c3dfa8] px-4 py-3 text-[#3B6D11] text-sm font-medium">
            <i class="ti ti-circle-check mr-1"></i>{{ session('success') }}
        </div>
    @endif

    {{-- Personal Info --}}
    <div class="bg-white rounded-2xl border border-[#E8DDD4] shadow-sm overflow-hidden mb-4">
        <div class="px-6 py-4 border-b border-[#F3EDE8] bg-[#FDF8F4]">
            <h2 class="text-xs font-bold text-[#7A5542] uppercase tracking-widest">Personal Information</h2>
        </div>
        <div class="divide-y divide-[#F3EDE8]">
            @foreach ([
                ['Phone',        $tenant->phone],
                ['Birthdate',    $tenant->birthdate->format('F d, Y')],
                ['Gender',       ucfirst($tenant->gender)],
                ['Address',      $tenant->address],
                ['Move-in Date', $tenant->move_in_date->format('F d, Y')],
            ] as [$label, $value])
                <div class="flex items-start justify-between px-6 py-3.5 gap-4">
                    <span class="text-sm text-[#C4A08A] w-36 shrink-0">{{ $label }}</span>
                    <span class="text-sm font-medium text-[#3D2314] text-right">{{ $value }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Emergency Contact --}}
    <div class="bg-white rounded-2xl border border-[#E8DDD4] shadow-sm overflow-hidden mb-4">
        <div class="px-6 py-4 border-b border-[#F3EDE8] bg-[#FDF8F4]">
            <h2 class="text-xs font-bold text-[#7A5542] uppercase tracking-widest">Emergency Contact</h2>
        </div>
        <div class="divide-y divide-[#F3EDE8]">
            @foreach ([
                ['Name',         $tenant->emergency_name],
                ['Phone',        $tenant->emergency_phone],
                ['Relationship', $tenant->emergency_relationship],
            ] as [$label, $value])
                <div class="flex items-center justify-between px-6 py-3.5 gap-4">
                    <span class="text-sm text-[#C4A08A] w-36 shrink-0">{{ $label }}</span>
                    <span class="text-sm font-medium text-[#3D2314]">{{ $value }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ID Document --}}
    <div class="bg-white rounded-2xl border border-[#E8DDD4] shadow-sm overflow-hidden mb-4">
        <div class="px-6 py-4 border-b border-[#F3EDE8] bg-[#FDF8F4]">
            <h2 class="text-xs font-bold text-[#7A5542] uppercase tracking-widest">ID Document</h2>
        </div>
        <div class="divide-y divide-[#F3EDE8]">
            @foreach ([
                ['ID Type',   $tenant->id_type],
                ['ID Number', $tenant->id_number],
            ] as [$label, $value])
                <div class="flex items-center justify-between px-6 py-3.5 gap-4">
                    <span class="text-sm text-[#C4A08A] w-36 shrink-0">{{ $label }}</span>
                    <span class="text-sm font-medium text-[#3D2314]">{{ $value }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Notes --}}
    @if ($tenant->notes)
        <div class="bg-white rounded-2xl border border-[#E8DDD4] shadow-sm overflow-hidden mb-4">
            <div class="px-6 py-4 border-b border-[#F3EDE8] bg-[#FDF8F4]">
                <h2 class="text-xs font-bold text-[#7A5542] uppercase tracking-widest">Notes</h2>
            </div>
            <div class="p-6">
                <p class="text-sm text-[#3D2314] leading-relaxed whitespace-pre-line">{{ $tenant->notes }}</p>
            </div>
        </div>
    @endif

    {{-- Footer --}}
    <div class="flex items-center justify-between pt-2">
        <a href="{{ route('admin.tenants.index') }}"
        class="inline-flex items-center gap-1.5 text-sm text-[#7A5542] hover:text-[#C2622A] transition-colors">
            <i class="ti ti-arrow-left text-[14px]"></i> Back to Tenants
        </a>
        <form action="{{ route('admin.tenants.destroy', $tenant) }}" method="POST"
            onsubmit="return confirm('Delete {{ $tenant->full_name }}? This will also delete their login account.')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-5 py-2.5 rounded-xl text-sm font-medium text-red-600 bg-white border border-red-200 hover:bg-red-50 transition-colors">
                <i class="ti ti-trash mr-1"></i>Delete Tenant
            </button>
        </form>
    </div>

</div>
@endsection