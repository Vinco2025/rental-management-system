<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} — Tenant Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
</head>
<body class="flex h-screen overflow-hidden" style="background:#FDF8F4;">

    <aside style="width:220px;background:#3D2314;flex-shrink:0;" class="flex flex-col h-full">
        <div class="flex items-center gap-3 px-5 py-5">
            <div style="background:#C2622A;border-radius:8px;width:32px;height:32px;" class="flex items-center justify-center flex-shrink-0">
                <i class="ti ti-home-2" style="font-size:16px;color:#fff;"></i>
            </div>
            <span style="font-size:14px;font-weight:500;color:#F5EDE6;line-height:1.3;">
                Tenant<br>Portal
            </span>
        </div>

        <nav class="flex flex-col gap-1 px-3 flex-1">
            <a href="{{ route('tenant.maintenance.index') }}"
                style="border-radius:7px;padding:8px 10px;font-size:13px;display:flex;align-items:center;gap:9px;
                {{ request()->routeIs('tenant.maintenance*') ? 'background:#C2622A;color:#fff;' : 'color:#C4A08A;' }}">
                <i class="ti ti-tool" style="font-size:16px;"></i> My Requests
            </a>
        </nav>

        <div style="border-top:0.5px solid #5C3420;padding:16px 14px;">
            <p style="font-size:11px;color:#7A5542;margin-bottom:10px;">{{ auth()->user()->name }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="font-size:13px;color:#7A5542;display:flex;align-items:center;gap:8px;background:none;border:none;cursor:pointer;padding:0;">
                    <i class="ti ti-logout" style="font-size:15px;"></i> Sign out
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto p-8">
        @yield('content')
    </main>

</body>
</html>