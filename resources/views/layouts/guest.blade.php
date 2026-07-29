<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-950 text-slate-100">
        <div class="relative isolate overflow-hidden">
            <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_left,_rgba(249,115,22,0.28),_transparent_35%),radial-gradient(circle_at_bottom_right,_rgba(168,85,247,0.18),_transparent_25%)]"></div>

            <header class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-8">
                <div>
                    <a href="{{ url('/') }}" class="text-xl font-semibold tracking-tight text-white">{{ config('app.name', 'Rental System') }}</a>
                    <p class="text-sm text-slate-400">Discover rooms, manage bookings, and stay in control.</p>
                </div>
            </header>

            <main class="mx-auto max-w-7xl px-6 pb-16 pt-6 lg:px-8 lg:pt-12">
                <section class="grid gap-8 rounded-[2rem] border border-white/10 bg-slate-900/70 p-8 shadow-2xl shadow-black/30 backdrop-blur lg:grid-cols-[1.15fr_0.85fr] lg:p-12">
                    <div class="flex flex-col justify-center">
                        <p class="text-sm font-medium uppercase tracking-[0.35em] text-orange-300">Welcome back</p>
                        <h1 class="max-w-2xl text-4xl font-semibold tracking-tight text-white sm:text-5xl">
                            Continue your rental journey with a secure and polished experience.
                        </h1>
                        <p class="mt-4 max-w-xl text-lg leading-8 text-slate-300">
                            Sign in or create an account to manage stays, bookings, and property access from one streamlined dashboard.
                        </p>
                    </div>

                    <div class="rounded-[1.5rem] border border-white/10 bg-slate-950/80 p-6 shadow-lg shadow-black/20 sm:p-8">
                        <div class="mb-6 flex justify-center">
                        </div>

                        <div class="mx-auto max-w-md">
                            {{ $slot }}
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
