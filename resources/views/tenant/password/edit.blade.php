@extends('layouts.tenant')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold" style="color:#3D2314;">Change Password</h1>
    <p class="text-sm mt-1" style="color:#7A5542;">Keep your account secure with a strong password</p>
</div>

@if(session('success'))
    <div class="mb-4 px-4 py-3 rounded-lg text-sm font-medium" style="background:#EAF3DE;color:#3D6B1F;">
        {{ session('success') }}
    </div>
@endif

<div class="rounded-xl p-6 max-w-lg" style="border:1px solid #E8DDD4;background:#fff;">
    <form method="POST" action="{{ route('tenant.password.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Current Password</label>
            <input type="password" name="current_password"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
            @error('current_password')
                <p class="mt-1 text-xs" style="color:#b91c1c;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">New Password</label>
            <input type="password" name="password"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
            @error('password')
                <p class="mt-1 text-xs" style="color:#b91c1c;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label class="block text-sm font-medium mb-1" style="color:#3D2314;">Confirm New Password</label>
            <input type="password" name="password_confirmation"
                class="w-full px-3 py-2 rounded-lg text-sm"
                style="border:1px solid #E8DDD4;background:#FDF8F4;color:#3D2314;">
        </div>

        <button type="submit"
            class="px-5 py-2 rounded-lg text-white text-sm font-medium"
            style="background:#C2622A;">Update Password</button>
    </form>
</div>

@endsection