@extends('layouts.tenant')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold" style="color:#3D2314;">My Lease Contract</h1>
    <p class="text-sm mt-1" style="color:#7A5542;">Your current active lease details</p>
</div>

@if(!$lease)
    <div class="px-4 py-3 rounded-lg text-sm" style="background:#fdecea;color:#b91c1c;">
        <i class="ti ti-alert-circle mr-1"></i>
        You don't have an active lease. Please contact the admin.
    </div>
@else

<div class="grid grid-cols-2 gap-4 mb-4">

    {{-- Room Info --}}
    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <p class="text-xs font-semibold uppercase tracking-wide mb-4" style="color:#7A5542;">Room Information</p>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between">
                <span style="color:#7A5542;">Room Number</span>
                <span class="font-semibold" style="color:#3D2314;">{{ $lease->room->room_number }}</span>
            </div>
            <div class="flex justify-between">
                <span style="color:#7A5542;">Room Type</span>
                <span class="font-semibold" style="color:#3D2314;">{{ $lease->room->roomType->name }}</span>
            </div>
            <div class="flex justify-between">
                <span style="color:#7A5542;">Floor</span>
                <span class="font-semibold" style="color:#3D2314;">{{ $lease->room->floor ?? '—' }}</span>
            </div>
            <div class="flex justify-between">
                <span style="color:#7A5542;">Monthly Rate</span>
                <span class="font-semibold" style="color:#3D2314;">₱{{ number_format($lease->room->roomType->monthly_rate, 2) }}</span>
            </div>
        </div>
    </div>

    {{-- Lease Details --}}
    <div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
        <p class="text-xs font-semibold uppercase tracking-wide mb-4" style="color:#7A5542;">Lease Details</p>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between">
                <span style="color:#7A5542;">Start Date</span>
                <span class="font-semibold" style="color:#3D2314;">{{ \Carbon\Carbon::parse($lease->start_date)->format('M d, Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span style="color:#7A5542;">End Date</span>
                <span class="font-semibold" style="color:#3D2314;">{{ \Carbon\Carbon::parse($lease->end_date)->format('M d, Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span style="color:#7A5542;">Duration</span>
                <span class="font-semibold" style="color:#3D2314;">
                    {{ \Carbon\Carbon::parse($lease->start_date)->diffInMonths(\Carbon\Carbon::parse($lease->end_date)) }} months
                </span>
            </div>
            <div class="flex justify-between items-center">
                <span style="color:#7A5542;">Status</span>
                <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#EAF3DE;color:#3D6B1F;">Active</span>
            </div>
        </div>
    </div>

</div>

{{-- Amenities --}}
@if($lease->room->amenities)
<div class="rounded-xl p-5" style="border:1px solid #E8DDD4;background:#fff;">
    <p class="text-xs font-semibold uppercase tracking-wide mb-4" style="color:#7A5542;">Room Amenities</p>
    <div class="flex flex-wrap gap-2">
        @foreach(json_decode($lease->room->amenities, true) ?? [] as $amenity)
            <span class="px-3 py-1 rounded-full text-xs font-medium" style="background:#FDF8F4;border:1px solid #E8DDD4;color:#3D2314;">
                {{ $amenity }}
            </span>
        @endforeach
    </div>
</div>
@endif

@endif

@endsection