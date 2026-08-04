@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <nav class="text-sm mb-2" style="color:#7A5542;">
        <a href="{{ route('admin.maintenance.index') }}" style="color:#C2622A;">Maintenance</a>
        <span class="mx-1">›</span> Request Detail
    </nav>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold" style="color:#3D2314;">{{ $maintenance->title }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.maintenance.edit', $maintenance) }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium"
                style="border:1px solid #E8DDD4;color:#3D2314;">
                <i class="ti ti-pencil text-base"></i> Update Status
            </a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="mb-4 px-4 py-3 rounded-lg text-sm font-medium" style="background:#EAF3DE;color:#3D2314;">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-2 gap-4 mb-6">
    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <p class="text-xs font-semibold uppercase tracking-wide mb-3" style="color:#7A5542;">Request Details</p>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span style="color:#7A5542;">Tenant</span>
                <span style="color:#3D2314;">{{ $maintenance->tenant->full_name }}</span>
            </div>
            <div class="flex justify-between">
                <span style="color:#7A5542;">Room</span>
                <span style="color:#3D2314;">Room {{ $maintenance->room->room_number }}</span>
            </div>
            <div class="flex justify-between">
                <span style="color:#7A5542;">Submitted By</span>
                <span style="color:#3D2314;">{{ ucfirst($maintenance->submitted_by) }}</span>
            </div>
            <div class="flex justify-between">
                <span style="color:#7A5542;">Date Submitted</span>
                <span style="color:#3D2314;">{{ $maintenance->created_at->format('M d, Y') }}</span>
            </div>
        </div>
    </div>

    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <p class="text-xs font-semibold uppercase tracking-wide mb-3" style="color:#7A5542;">Status</p>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between items-center">
                <span style="color:#7A5542;">Priority</span>
                @if($maintenance->priority === 'urgent')
                    <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#fdecea;color:#b91c1c;">Urgent</span>
                @elseif($maintenance->priority === 'high')
                    <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#FEF3C7;color:#92400E;">High</span>
                @elseif($maintenance->priority === 'medium')
                    <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#E0F0FF;color:#1D4ED8;">Medium</span>
                @else
                    <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#F3F4F6;color:#6B7280;">Low</span>
                @endif
            </div>
            <div class="flex justify-between items-center">
                <span style="color:#7A5542;">Status</span>
                @if($maintenance->status === 'resolved')
                    <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#EAF3DE;color:#3D6B1F;">Resolved</span>
                @elseif($maintenance->status === 'in_progress')
                    <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#FEF3C7;color:#92400E;">In Progress</span>
                @else
                    <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#fdecea;color:#b91c1c;">Pending</span>
                @endif
            </div>
            @if($maintenance->resolved_at)
            <div class="flex justify-between">
                <span style="color:#7A5542;">Resolved At</span>
                <span style="color:#3D2314;">{{ $maintenance->resolved_at->format('M d, Y h:i A') }}</span>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="rounded-xl p-5 mb-4" style="border:1px solid #E8DDD4;background:#fff;">
    <p class="text-xs font-semibold uppercase tracking-wide mb-2" style="color:#7A5542;">Description</p>
    <p class="text-sm" style="color:#3D2314;">{{ $maintenance->description }}</p>
</div>

@if($maintenance->resolution_notes)
<div class="rounded-xl p-5 mb-6" style="border:1px solid #E8DDD4;background:#fff;">
    <p class="text-xs font-semibold uppercase tracking-wide mb-2" style="color:#7A5542;">Resolution Notes</p>
    <p class="text-sm" style="color:#3D2314;">{{ $maintenance->resolution_notes }}</p>
</div>
@endif

<form action="{{ route('admin.maintenance.destroy', $maintenance) }}" method="POST"
    onsubmit="return confirm('Delete this request?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-sm" style="color:#b91c1c;">Delete Request</button>
</form>
@endsection