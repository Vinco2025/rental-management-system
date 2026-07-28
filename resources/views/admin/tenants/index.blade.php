@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-6xl mx-auto px-4 py-10">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Tenants</h1>
                <p class="text-slate-500 mt-1 text-sm">Manage all tenant profiles and accounts.</p>
            </div>
            <a href="{{ route('admin.tenants.create') }}"
            class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Tenant
            </a>
        </div>

        {{-- Generated Password Alert --}}
        @if (session('generated_password'))
            <div class="mb-6 rounded-lg bg-amber-50 border border-amber-200 p-4">
                <p class="text-sm font-semibold text-amber-800 mb-1">⚠ Save this login credential — it won't be shown again.</p>
                <p class="text-sm text-amber-700">Email: <span class="font-mono font-bold">{{ session('generated_email') }}</span></p>
                <p class="text-sm text-amber-700">Password: <span class="font-mono font-bold">{{ session('generated_password') }}</span></p>
            </div>
        @endif

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-700 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-left">
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Phone</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Move-in Date</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($tenants as $tenant)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium text-slate-800">{{ $tenant->full_name }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $tenant->user->email }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $tenant->phone }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $tenant->move_in_date->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                @if ($tenant->status === 'active')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 ring-1 ring-green-200">Active</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500 ring-1 ring-slate-200">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.tenants.show', $tenant) }}" class="text-indigo-600 hover:text-indigo-800 font-medium transition">View</a>
                                    <a href="{{ route('admin.tenants.edit', $tenant) }}" class="text-slate-500 hover:text-slate-700 font-medium transition">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 text-sm">
                                No tenants found. <a href="{{ route('admin.tenants.create') }}" class="text-indigo-600 hover:underline">Add your first tenant.</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            @if ($tenants->hasPages())
                <div class="px-6 py-4 border-t border-slate-100">
                    {{ $tenants->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection