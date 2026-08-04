@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <nav class="text-sm mb-2" style="color:#7A5542;">
        <a href="{{ route('admin.maintenance.index') }}" style="color:#C2622A;">Maintenance</a>
        <span class="mx-1">›</span>
        <a href="{{ route('admin.maintenance.show', $maintenance) }}" style="color:#C2622A;">{{ $maintenance->title }}</a>
        <span class="mx-1">›</span> Update
    </nav>
    <h1 class="text-2xl font-bold" style="color:#3D2314;">Update Request</h1>
    <p class="text-sm mt-1" style="color:#7A5542;">{{ $maintenance->tenant->full_name }} — Room {{ $maintenance->room->room_number }}</p>
</div>

<div class="rounded-xl p-6 max-w-lg" style="border:1px solid #E8DDD4;background:#fff;">
    <form action="{{ route('admin.maintenance.update', $maintenance) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Priority</label>
            <select name="priority" class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
                <option value="low" {{ $maintenance->priority === 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $maintenance->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $maintenance->priority === 'high' ? 'selected' : '' }}>High</option>
                <option value="urgent" {{ $maintenance->priority === 'urgent' ? 'selected' : '' }}>Urgent</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Status</label>
            <select name="status" class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
                <option value="pending" {{ $maintenance->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $maintenance->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="resolved" {{ $maintenance->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
            </select>
        </div>

        <div class="mb-5">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Resolution Notes</label>
            <textarea name="resolution_notes" rows="4"
                placeholder="Describe what was done to resolve the issue..."
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">{{ old('resolution_notes', $maintenance->resolution_notes) }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                class="px-5 py-2 rounded-lg text-white text-sm font-medium"
                style="background:#C2622A;">Save Changes</button>
            <a href="{{ route('admin.maintenance.show', $maintenance) }}"
                class="px-5 py-2 rounded-lg text-sm font-medium"
                style="border:1px solid #E8DDD4;color:#3D2314;">Cancel</a>
        </div>
    </form>
</div>
@endsection