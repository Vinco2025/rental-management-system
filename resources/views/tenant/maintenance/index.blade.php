@extends('layouts.tenant')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold" style="color:#3D2314;">My Maintenance Requests</h1>
        <p class="text-sm mt-1" style="color:#7A5542;">Track the status of your submitted requests</p>
    </div>
    <a href="{{ route('tenant.maintenance.create') }}"
        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-white text-sm font-medium"
        style="background:#C2622A;">
        <i class="ti ti-plus text-base"></i> New Request
    </a>
</div>

@if(session('success'))
    <div class="mb-4 px-4 py-3 rounded-lg text-sm font-medium" style="background:#EAF3DE;color:#3D2314;">
        {{ session('success') }}
    </div>
@endif

<div class="rounded-xl overflow-hidden" style="border:1px solid #E8DDD4;">
    <table class="w-full text-sm">
        <thead>
            <tr style="background:#FDF8F4;">
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Title</th>
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Priority</th>
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Status</th>
                <th class="text-left px-4 py-3 font-semibold" style="color:#3D2314;">Submitted</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
            <tr style="border-top:1px solid #E8DDD4;">
                <td class="px-4 py-3 font-medium" style="color:#3D2314;">{{ $request->title }}</td>
                <td class="px-4 py-3">
                    @if($request->priority === 'urgent')
                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#fdecea;color:#b91c1c;">Urgent</span>
                    @elseif($request->priority === 'high')
                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#FEF3C7;color:#92400E;">High</span>
                    @elseif($request->priority === 'medium')
                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#E0F0FF;color:#1D4ED8;">Medium</span>
                    @else
                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#F3F4F6;color:#6B7280;">Low</span>
                    @endif
                </td>
                <td class="px-4 py-3">
                    @if($request->status === 'resolved')
                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#EAF3DE;color:#3D6B1F;">Resolved</span>
                    @elseif($request->status === 'in_progress')
                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#FEF3C7;color:#92400E;">In Progress</span>
                    @else
                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#fdecea;color:#b91c1c;">Pending</span>
                    @endif
                </td>
                <td class="px-4 py-3" style="color:#7A5542;">{{ $request->created_at->format('M d, Y') }}</td>
                <td class="px-4 py-3">
                    <a href="{{ route('tenant.maintenance.show', $request) }}" class="text-sm font-medium" style="color:#C2622A;">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-12 text-center">
                    <i class="ti ti-tool text-4xl" style="color:#E8DDD4;"></i>
                    <p class="mt-2 text-sm" style="color:#7A5542;">No requests submitted yet.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection