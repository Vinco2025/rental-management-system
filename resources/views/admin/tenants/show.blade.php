@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-3xl mx-auto px-4 py-10">

        {{-- Header --}}
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-3">
                <a href="{{ route('admin.tenants.index') }}" class="hover:text-indigo-600 transition-colors">Tenants</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-600">{{ $tenant->full_name }}</span>
            </nav>
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight">{{ $tenant->full_name }}</h1>
                    <p class="text-slate-500 mt-1 text-sm">{{ $tenant->user->email }}</p>
                </div>
                <div class="flex items-center gap-2 mt-1">
                    @if ($tenant->status === 'active')
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 ring-1 ring-green-200">Active</span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500 ring-1 ring-slate-200">Inactive</span>
                    @endif
                    <a href="{{ route('admin.tenants.edit', $tenant) }}"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                </div>
            </div>
        </div>

        {{-- Success --}}
        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-700 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Personal Info --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">Personal Information</h2>
            </div>
            <div class="divide-y divide-slate-100">
                @foreach ([
                    ['Phone',        $tenant->phone],
                    ['Birthdate',    $tenant->birthdate->format('F d, Y')],
                    ['Gender',       ucfirst($tenant->gender)],
                    ['Address',      $tenant->address],
                    ['Move-in Date', $tenant->move_in_date->format('F d, Y')],
                ] as [$label, $value])
                    <div class="flex items-start justify-between px-6 py-3.5">
                        <span class="text-sm text-slate-500 w-36 flex-shrink-0">{{ $label }}</span>
                        <span class="text-sm font-medium text-slate-800 text-right">{{ $value }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Emergency Contact --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">Emergency Contact</h2>
            </div>
            <div class="divide-y divide-slate-100">
                @foreach ([
                    ['Name',         $tenant->emergency_name],
                    ['Phone',        $tenant->emergency_phone],
                    ['Relationship', $tenant->emergency_relationship],
                ] as [$label, $value])
                    <div class="flex items-center justify-between px-6 py-3.5">
                        <span class="text-sm text-slate-500 w-36 flex-shrink-0">{{ $label }}</span>
                        <span class="text-sm font-medium text-slate-800">{{ $value }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ID Document --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">ID Document</h2>
            </div>
            <div class="divide-y divide-slate-100">
                @foreach ([
                    ['ID Type',   $tenant->id_type],
                    ['ID Number', $tenant->id_number],
                ] as [$label, $value])
                    <div class="flex items-center justify-between px-6 py-3.5">
                        <span class="text-sm text-slate-500 w-36 flex-shrink-0">{{ $label }}</span>
                        <span class="text-sm font-medium text-slate-800">{{ $value }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Notes --}}
        @if ($tenant->notes)
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                    <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wider">Notes</h2>
                </div>
                <div class="p-6">
                    <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">{{ $tenant->notes }}</p>
                </div>
            </div>
        @endif

        {{-- Footer --}}
        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('admin.tenants.index') }}"
            class="flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Tenants
            </a>
            <form action="{{ route('admin.tenants.destroy', $tenant) }}" method="POST"
                onsubmit="return confirm('Delete {{ $tenant->full_name }}? This will also delete their login account.')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-5 py-2.5 rounded-lg text-sm font-medium text-red-600 bg-white border border-red-200 hover:bg-red-50 transition shadow-sm">
                    Delete Tenant
                </button>
            </form>
        </div>

    </div>
</div>
@endsection