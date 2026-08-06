@extends('layouts.tenant')

@section('content')
<div class="mb-6">
    <nav class="text-sm mb-2" style="color:#7A5542;">
        <a href="{{ route('tenant.maintenance.index') }}" style="color:#C2622A;">My Requests</a>
        <span class="mx-1">›</span> Request Detail
    </nav>
    <h1 class="text-2xl font-bold" style="color:#3D2314;">{{ $maintenance->title }}</h1>
    <p class="text-sm mt-1" style="color:#7A5542;">Submitted {{ $maintenance->created_at->format('M d, Y') }}</p>
</div>

<div class="grid grid-cols-2 gap-4 mb-6">
    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <p class="text-xs font-semibold uppercase tracking-wide mb-3" style="color:#7A5542;">Details</p>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span style="color:#7A5542;">Room</span>
                <span style="color:#3D2314;">Room {{ $maintenance->room->room_number }}</span>
            </div>
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
                <span style="color:#3D2314;">{{ $maintenance->resolved_at->format('M d, Y') }}</span>
            </div>
            @endif
        </div>
    </div>

    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <p class="text-xs font-semibold uppercase tracking-wide mb-2" style="color:#7A5542;">Description</p>
        <p class="text-sm" style="color:#3D2314;">{{ $maintenance->description }}</p>
    </div>
</div>

@if($maintenance->resolution_notes)
<div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
    <p class="text-xs font-semibold uppercase tracking-wide mb-2" style="color:#7A5542;">Resolution Notes</p>
    <p class="text-sm" style="color:#3D2314;">{{ $maintenance->resolution_notes }}</p>
</div>
@endif
@endsection