<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-slate-950 text-slate-100">
        <div class="relative isolate overflow-hidden">
            <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_left,_rgba(249,115,22,0.28),_transparent_35%),radial-gradient(circle_at_bottom_right,_rgba(168,85,247,0.18),_transparent_25%)]"></div>

            <header class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-8">
                <div>
                    <a href="{{ url('/') }}" class="text-xl font-semibold tracking-tight text-white">{{ config('app.name', 'Rental System') }}</a>
                    <p class="text-sm text-slate-400">Discover rooms, manage bookings, and stay in control.</p>
                </div>

                @if (Route::has('login'))
                    <nav class="flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm font-medium text-white transition hover:bg-white/20">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 transition hover:text-white">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="rounded-full bg-orange-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-orange-400">Register</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <main class="mx-auto max-w-7xl px-6 pb-16 pt-6 lg:px-8 lg:pt-12">
                <section class="grid gap-8 rounded-[2rem] border border-white/10 bg-slate-900/70 p-8 shadow-2xl shadow-black/30 backdrop-blur lg:grid-cols-[1.15fr_0.85fr] lg:p-12">
                    <div class="flex flex-col justify-center">
                        <h1 class="max-w-2xl text-4xl font-semibold tracking-tight text-white sm:text-5xl">
                            Find your next home and manage every stay with confidence.
                        </h1>
                        <p class="mt-4 max-w-xl text-lg leading-8 text-slate-300">
                            Browse premium rooms, check availability instantly, and keep your bookings organized from one polished dashboard.
                        </p>

                        <div class="mt-8 flex flex-wrap gap-3">
                            <a href="#listings" class="rounded-full bg-orange-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-orange-400">Browse listings</a>
                            <a href="{{ route('login') }}" class="rounded-full border border-white/15 bg-white/10 px-5 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/20">Manage bookings</a>
                        </div>

                        <div class="mt-8 flex flex-wrap gap-6 text-sm text-slate-400">
                            <div>
                                <p class="text-2xl font-semibold text-white">120+</p>
                                <p>verified rentals</p>
                            </div>
                            <div>
                                <p class="text-2xl font-semibold text-white">24/7</p>
                                <p>support</p>
                            </div>
                            <div>
                                <p class="text-2xl font-semibold text-white">4.9/5</p>
                                <p>guest rating</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[1.5rem] border border-white/10 bg-gradient-to-br from-orange-500/15 via-fuchsia-500/10 to-slate-800 p-6">
                        <div class="rounded-[1.25rem] bg-slate-950/80 p-5 shadow-lg shadow-black/20">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-medium text-orange-300">Featured stay</p>
                                    <h2 class="mt-1 text-2xl font-semibold text-white">Oceanview Studio</h2>
                                </div>
                                <span class="rounded-full bg-emerald-500/15 px-3 py-1 text-sm font-semibold text-emerald-300">Available</span>
                            </div>

                            <div class="mt-5 space-y-3">
                                <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-slate-400">Monthly rate</span>
                                        <span class="text-xl font-semibold text-white">,850</span>
                                    </div>
                                </div>
                                <div class="grid gap-3 sm:grid-cols-2">
                                    <div class="rounded-2xl border border-white/10 bg-slate-900/80 p-4">
                                        <p class="text-sm text-slate-400">Bedrooms</p>
                                        <p class="mt-1 text-lg font-semibold text-white">2 spacious rooms</p>
                                    </div>
                                    <div class="rounded-2xl border border-white/10 bg-slate-900/80 p-4">
                                        <p class="text-sm text-slate-400">Amenities</p>
                                        <p class="mt-1 text-lg font-semibold text-white">Wi-Fi • Parking</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="features" class="mt-10 grid gap-6 md:grid-cols-3">
                    <div class="rounded-[1.5rem] border border-white/10 bg-slate-900/70 p-6">
                        <div class="mb-4 inline-flex rounded-2xl bg-orange-500/10 p-3 text-orange-300">🏡</div>
                        <h3 class="text-xl font-semibold text-white">Curated listings</h3>
                        <p class="mt-2 text-sm leading-7 text-slate-400">Explore handpicked rooms and apartments that fit every lifestyle and budget.</p>
                    </div>
                    <div class="rounded-[1.5rem] border border-white/10 bg-slate-900/70 p-6">
                        <div class="mb-4 inline-flex rounded-2xl bg-fuchsia-500/10 p-3 text-fuchsia-300">📅</div>
                        <h3 class="text-xl font-semibold text-white">Flexible booking</h3>
                        <p class="mt-2 text-sm leading-7 text-slate-400">Check availability quickly and confirm stays without the usual back-and-forth.</p>
                    </div>
                    <div class="rounded-[1.5rem] border border-white/10 bg-slate-900/70 p-6">
                        <div class="mb-4 inline-flex rounded-2xl bg-emerald-500/10 p-3 text-emerald-300">🔒</div>
                        <h3 class="text-xl font-semibold text-white">Secure access</h3>
                        <p class="mt-2 text-sm leading-7 text-slate-400">Stay protected with a simple and reliable system for guests and property owners alike.</p>
                    </div>
                </section>

                <section id="listings" class="mt-10 rounded-[2rem] border border-white/10 bg-slate-900/70 p-8">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p class="text-sm font-medium uppercase tracking-[0.35em] text-slate-500">Popular now</p>
                            <h2 class="text-2xl font-semibold text-white">Ready-to-book homes</h2>
                        </div>
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-orange-300 transition hover:text-orange-200">View all listings</a>
                    </div>

                    <div class="mt-6 grid gap-6 lg:grid-cols-3">
                        <div class="rounded-[1.25rem] border border-white/10 bg-slate-950/70 p-5">
                            <div class="mb-4 h-36 rounded-2xl bg-gradient-to-br from-slate-700 to-slate-800"></div>
                            <h3 class="text-lg font-semibold text-white">City Loft</h3>
                            <p class="mt-2 text-sm text-slate-400">Bright apartment with skyline views and fast Wi-Fi.</p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-sm text-slate-400">From ,200/mo</span>
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-orange-300">Book</a>
                            </div>
                        </div>
                        <div class="rounded-[1.25rem] border border-white/10 bg-slate-950/70 p-5">
                            <div class="mb-4 h-36 rounded-2xl bg-gradient-to-br from-orange-600/40 to-amber-500/30"></div>
                            <h3 class="text-lg font-semibold text-white">Garden House</h3>
                            <p class="mt-2 text-sm text-slate-400">Quiet living with a private balcony and lounge area.</p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-sm text-slate-400">From ,550/mo</span>
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-orange-300">Book</a>
                            </div>
                        </div>
                        <div class="rounded-[1.25rem] border border-white/10 bg-slate-950/70 p-5">
                            <div class="mb-4 h-36 rounded-2xl bg-gradient-to-br from-fuchsia-600/40 to-purple-500/20"></div>
                            <h3 class="text-lg font-semibold text-white">Harbor Studio</h3>
                            <p class="mt-2 text-sm text-slate-400">Minimal design, premium finish, and effortless access.</p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-sm text-slate-400">From ,300/mo</span>
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-orange-300">Book</a>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
