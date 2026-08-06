<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} — Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
</head>
<body class="flex h-screen overflow-hidden" style="background: #FDF8F4;">

    {{-- Sidebar --}}
    <aside style="width: 220px; background: #3D2314; flex-shrink: 0;" class="flex flex-col h-full">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-5 py-5">
            <div style="background: #C2622A; border-radius: 8px; width: 32px; height: 32px;" class="flex items-center justify-center flex-shrink-0">
                <i class="ti ti-home-2" style="font-size: 16px; color: #fff;"></i>
            </div>
            <span style="font-size: 14px; font-weight: 500; color: #F5EDE6; line-height: 1.3;">
                Boarding<br>House
            </span>
        </div>

        {{-- Nav --}}
        <nav class="flex flex-col gap-1 px-3 flex-1">
            <a href="{{ route('admin.dashboard') }}"
            style="display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 500;
                    {{ request()->routeIs('admin.dashboard') ? 'background: rgba(255,255,255,0.15); color: #fff;' : 'color: rgba(255,255,255,0.75);' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.rooms.index') }}"
            style="border-radius: 7px; padding: 8px 10px; font-size: 13px; display: flex; align-items: center; gap: 9px;
                    {{ request()->routeIs('admin.rooms*') ? 'background: #C2622A; color: #fff;' : 'color: #C4A08A;' }}">
                <i class="ti ti-building" style="font-size: 16px;"></i> Rooms
            </a>
            <a href="{{ route('admin.room-types.index') }}"
            style="border-radius: 7px; padding: 8px 10px; font-size: 13px; display: flex; align-items: center; gap: 9px;
                    {{ request()->routeIs('admin.room-types*') ? 'background: #C2622A; color: #fff;' : 'color: #C4A08A;' }}">
                <i class="ti ti-category" style="font-size: 16px;"></i> Room types
            </a>
            <a href="{{ route('admin.tenants.index') }}"
            style="border-radius: 7px; padding: 8px 10px; font-size: 13px; display: flex; align-items: center; gap: 9px;
                    {{ request()->routeIs('admin.tenants*') ? 'background: #C2622A; color: #fff;' : 'color: #C4A08A;' }}">
                <i class="ti ti-users" style="font-size: 16px;"></i> Tenants
            </a>
            <a href="{{ route('admin.lease-contracts.index') }}"
            style="border-radius: 7px; padding: 8px 10px; font-size: 13px; display: flex; align-items: center; gap: 9px;
                    {{ request()->routeIs('admin.lease-contracts*') ? 'background: #C2622A; color: #fff;' : 'color: #C4A08A;' }}">
                <i class="ti ti-file-text" style="font-size: 16px;"></i> Leases
            </a>
            <a href="{{ route('admin.bills.index') }}"
                style="border-radius: 7px; padding: 8px 10px; font-size: 13px; display: flex; align-items: center; gap: 9px;
                        {{ request()->routeIs('admin.bills.*') || request()->routeIs('admin.payments.*') ? 'background: #C2622A; color: #fff;' : 'color: #C4A08A;' }}">
                <i class="ti ti-file-invoice" style="font-size: 16px;"></i> Billing
            </a>
            <a href="{{ route('admin.reports.index') }}"
            style="display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 500;
                    {{ request()->routeIs('admin.reports.*') ? 'background: rgba(255,255,255,0.15); color: #fff;' : 'color: rgba(255,255,255,0.75);' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                Reports
            </a>
            <a href="{{ route('admin.maintenance.index') }}"
                style="border-radius:7px;padding:8px 10px;font-size:13px;display:flex;align-items:center;gap:9px;
                        {{ request()->routeIs('admin.maintenance*') ? 'background: #C2622A; color: #fff;' : 'color: #C4A08A;' }}">
                <i class="ti ti-tool" style="font-size:16px;"></i> Maintenance
            </a>
        </nav>

        {{-- User + sign out --}}
        <div style="border-top: 0.5px solid #5C3420; padding: 16px 14px;">
            <p style="font-size: 11px; color: #7A5542; margin-bottom: 10px;">{{ auth()->user()->name }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="font-size: 13px; color: #7A5542; display: flex; align-items: center; gap: 8px; background: none; border: none; cursor: pointer; padding: 0;">
                    <i class="ti ti-logout" style="font-size: 15px;"></i> Sign out
                </button>
            </form>
        </div>

    </aside>

    {{-- Main content --}}
    <main class="flex-1 overflow-y-auto">
        @yield('content')
    </main>

</body>
</html>