<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} — Tenant Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
</head>
<body style="margin:0;padding:0;background:#FDF8F4;display:flex;height:100vh;overflow:hidden;">

    {{-- Sidebar --}}
    <aside style="width:220px;background:#3D2314;flex-shrink:0;display:flex;flex-direction:column;height:100vh;">

        {{-- Brand --}}
        <div style="display:flex;align-items:center;gap:12px;padding:20px 20px 16px;">
            <div style="width:32px;height:32px;background:#C2622A;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="ti ti-home-2" style="font-size:16px;color:#fff;"></i>
            </div>
            <span style="font-size:14px;font-weight:500;color:#F5EDE6;line-height:1.3;">Tenant<br>Portal</span>
        </div>

        {{-- Nav --}}
        <nav style="display:flex;flex-direction:column;gap:2px;padding:0 12px;flex:1;">
            <a href="{{ route('tenant.dashboard') }}" style="border-radius:7px;padding:8px 10px;font-size:13px;display:flex;align-items:center;gap:9px;text-decoration:none;
                {{ request()->routeIs('tenant.dashboard') ? 'background:#C2622A;color:#fff;' : 'color:#C4A08A;' }}">
                <i class="ti ti-layout-dashboard" style="font-size:16px;"></i> Dashboard
            </a>
            <a href="{{ route('tenant.lease.index') }}" style="border-radius:7px;padding:8px 10px;font-size:13px;display:flex;align-items:center;gap:9px;text-decoration:none;
                {{ request()->routeIs('tenant.lease*') ? 'background:#C2622A;color:#fff;' : 'color:#C4A08A;' }}">
                <i class="ti ti-clipboard-text" style="font-size:16px;"></i> My Lease
            </a>
            <a href="{{ route('tenant.bills.index') }}" style="border-radius:7px;padding:8px 10px;font-size:13px;display:flex;align-items:center;gap:9px;text-decoration:none;
                {{ request()->routeIs('tenant.bills*') ? 'background:#C2622A;color:#fff;' : 'color:#C4A08A;' }}">
                <i class="ti ti-receipt-2" style="font-size:16px;"></i> My Bills
            </a>
            <a href="{{ route('tenant.maintenance.index') }}" style="border-radius:7px;padding:8px 10px;font-size:13px;display:flex;align-items:center;gap:9px;text-decoration:none;
                {{ request()->routeIs('tenant.maintenance*') ? 'background:#C2622A;color:#fff;' : 'color:#C4A08A;' }}">
                <i class="ti ti-tools" style="font-size:16px;"></i> My Requests
            </a>

            <div style="border-top:0.5px solid #5C3420;margin:8px 0;"></div>

            <a href="{{ route('tenant.profile.edit') }}" style="border-radius:7px;padding:8px 10px;font-size:13px;display:flex;align-items:center;gap:9px;text-decoration:none;
                {{ request()->routeIs('tenant.profile*') ? 'background:#C2622A;color:#fff;' : 'color:#C4A08A;' }}">
                <i class="ti ti-user-circle" style="font-size:16px;"></i> My Profile
            </a>
            <a href="{{ route('tenant.password.edit') }}" style="border-radius:7px;padding:8px 10px;font-size:13px;display:flex;align-items:center;gap:9px;text-decoration:none;
                {{ request()->routeIs('tenant.password*') ? 'background:#C2622A;color:#fff;' : 'color:#C4A08A;' }}">
                <i class="ti ti-shield-lock" style="font-size:16px;"></i> Change Password
            </a>
        </nav>

        {{-- User + Logout --}}
        <div style="border-top:0.5px solid #5C3420;padding:16px 14px;">
            <p style="font-size:11px;color:#7A5542;margin:0 0 10px;">{{ auth()->user()->name }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="font-size:13px;color:#7A5542;display:flex;align-items:center;gap:8px;background:none;border:none;cursor:pointer;padding:0;">
                    <i class="ti ti-logout" style="font-size:15px;"></i> Sign out
                </button>
            </form>
        </div>
    </aside>

    {{-- Main content --}}
    <main style="flex:1;overflow-y:auto;padding:32px;">
        <div style="max-width:1200px;margin:0 auto;">
            @yield('content')
        </div>
    </main>

</body>
</html>