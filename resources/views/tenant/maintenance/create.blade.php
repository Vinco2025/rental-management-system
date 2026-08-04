@extends('layouts.tenant')

@section('content')
<div class="mb-6">
    <nav class="text-sm mb-2" style="color:#7A5542;">
        <a href="{{ route('tenant.maintenance.index') }}" style="color:#C2622A;">My Requests</a>
        <span class="mx-1">›</span> New Request
    </nav>
    <h1 class="text-2xl font-bold" style="color:#3D2314;">Submit a Request</h1>
    <p class="text-sm mt-1" style="color:#7A5542;">
        @if($room)
            Room {{ $room->room_number }}
        @else
            No active lease found.
        @endif
    </p>
</div>

@if(!$room)
    <div class="px-4 py-3 rounded-lg text-sm" style="background:#fdecea;color:#b91c1c;">
        You don't have an active lease. Please contact the admin.
    </div>
@else
<div class="rounded-xl p-6 max-w-lg" style="border:1px solid #E8DDD4;background:#fff;">
    <form action="{{ route('tenant.maintenance.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                placeholder="e.g. Broken window latch"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
            @error('title')
                <p class="mt-1 text-xs" style="color:#b91c1c;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Description</label>
            <textarea name="description" rows="4"
                placeholder="Describe the issue in detail..."
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">{{ old('description') }}</textarea>
            @error('description')
                <p class="mt-1 text-xs" style="color:#b91c1c;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Priority</label>
            <select name="priority" class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
                <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High</option>
                <option value="urgent" {{ old('priority') === 'urgent' ? 'selected' : '' }}>Urgent</option>
            </select>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                class="px-5 py-2 rounded-lg text-white text-sm font-medium"
                style="background:#C2622A;">Submit Request</button>
            <a href="{{ route('tenant.maintenance.index') }}"
                class="px-5 py-2 rounded-lg text-sm font-medium"
                style="border:1px solid #E8DDD4;color:#3D2314;">Cancel</a>
        </div>
    </form>
</div>
@endif
@endsection