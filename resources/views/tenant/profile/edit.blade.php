@extends('layouts.tenant')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold" style="color:#3D2314;">My Profile</h1>
    <p class="text-sm mt-1" style="color:#7A5542;">Update your personal information</p>
</div>

@if(session('success'))
    <div class="mb-4 px-4 py-3 rounded-lg text-sm font-medium" style="background:#EAF3DE;color:#3D6B1F;">
        {{ session('success') }}
    </div>
@endif

<div class="rounded-xl p-6 max-w-lg" style="border:1px solid #E8DDD4;background:#fff;">
    <form method="POST" action="{{ route('tenant.profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Full Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
            @error('name')
                <p class="mt-1 text-xs" style="color:#b91c1c;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Email</label>
            <input type="text" value="{{ $user->email }}" disabled
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#F3EDE8;color:#7A5542;">
            <p class="mt-1 text-xs" style="color:#7A5542;">Email cannot be changed. Contact admin if needed.</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $tenant->phone) }}"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
            @error('phone')
                <p class="mt-1 text-xs" style="color:#b91c1c;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Address</label>
            <textarea name="address" rows="3"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">{{ old('address', $tenant->address) }}</textarea>
            @error('address')
                <p class="mt-1 text-xs" style="color:#b91c1c;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="px-5 py-2 rounded-lg text-white text-sm font-medium"
            style="background:#C2622A;">Save Changes</button>
    </form>
</div>

@endsection