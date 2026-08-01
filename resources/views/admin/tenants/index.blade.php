@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-[#3D2314]">Tenants</h1>
            <p class="text-[#7A5542] text-sm mt-1">Manage all tenant profiles and accounts.</p>
        </div>
        <a href="{{ route('admin.tenants.create') }}"
        class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#C2622A] hover:bg-[#A8521F] text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
            <i class="ti ti-plus text-[15px]"></i>
            Add Tenant
        </a>
    </div>

    {{-- Generated Password Alert --}}
    @if (session('generated_password'))
        <div class="mb-5 rounded-xl bg-amber-50 border border-amber-200 p-4">
            <p class="text-sm font-semibold text-amber-800 mb-1">
                <i class="ti ti-alert-triangle mr-1"></i>Save this login credential — it won't be shown again.
            </p>
            <p class="text-sm text-amber-700">Email: <span class="font-mono font-bold">{{ session('generated_email') }}</span></p>
            <p class="text-sm text-amber-700">Password: <span class="font-mono font-bold">{{ session('generated_password') }}</span></p>
        </div>
    @endif

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
                    <th class="px-6 py-3.5 text-xs font-semibold text-[#7A5542] uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3.5 text-xs font-semibold text-[#7A5542] uppercase tracking-wider">Phone</th>
                    <th class="px-6 py-3.5 text-xs font-semibold text-[#7A5542] uppercase tracking-wider">Move-in Date</th>
                    <th class="px-6 py-3.5 text-xs font-semibold text-[#7A5542] uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3.5 text-xs font-semibold text-[#7A5542] uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#F3EDE8]">
                @forelse ($tenants as $tenant)
                    <tr class="hover:bg-[#FDF8F4] transition-colors">
                        <td class="px-6 py-4 font-semibold text-[#3D2314]">{{ $tenant->full_name }}</td>
                        <td class="px-6 py-4 text-[#7A5542]">{{ $tenant->user->email }}</td>
                        <td class="px-6 py-4 text-[#7A5542]">{{ $tenant->phone }}</td>
                        <td class="px-6 py-4 text-[#7A5542]">{{ $tenant->move_in_date->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            @if ($tenant->status === 'active')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-[#EAF3DE] text-[#3B6D11]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#3B6D11] inline-block"></span> Active
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-[#F3EDE8] text-[#7A5542]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#C4A08A] inline-block"></span> Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.tenants.show', $tenant) }}"
                                class="text-[#C2622A] hover:text-[#A8521F] font-semibold transition-colors">View</a>
                                <a href="{{ route('admin.tenants.edit', $tenant) }}"
                                class="text-[#7A5542] hover:text-[#3D2314] font-medium transition-colors">Edit</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-[#F8ECE4] flex items-center justify-center">
                                    <i class="ti ti-users text-[22px] text-[#C2622A]"></i>
                                </div>
                                <p class="text-[#7A5542] text-sm">No tenants yet.</p>
                                <a href="{{ route('admin.tenants.create') }}"
                                class="text-sm font-semibold text-[#C2622A] hover:underline">Add your first tenant</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($tenants->hasPages())
            <div class="px-6 py-4 border-t border-[#F3EDE8]">
                {{ $tenants->links() }}
            </div>
        @endif
    </div>

</div>
@endsection