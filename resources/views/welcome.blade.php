<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Boarding House') }}</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-[#FDF8F4] flex items-start justify-center px-5 py-8">

        <div class="w-full max-w-4xl bg-white rounded-[20px] border border-[#E8DDD4] p-8 shadow-[0_10px_38px_rgba(61,35,20,0.07)]">

            {{-- Nav --}}
            <nav class="flex items-center justify-between flex-wrap gap-4 mb-9">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-[#3D2314] rounded-xl flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="#F5EDE6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M3 10.5 12 3l9 7.5"/>
                            <path d="M5 9.5V20a1 1 0 0 0 1 1h3v-5h6v5h3a1 1 0 0 0 1-1V9.5"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[17px] font-semibold text-[#3D2314] leading-none">Boarding House</p>
                        <p class="text-[12px] text-[#C4A08A] mt-0.5">Rental Management System</p>
                    </div>
                </div>

                @if (Route::has('login'))
                    <div class="flex items-center gap-2.5">
                        @auth
                            <a href="{{ url('/admin') }}"
                            class="text-[13px] font-semibold text-white bg-[#C2622A] hover:bg-[#A8521F] px-[18px] py-[9px] rounded-full transition-colors">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                            class="text-[13px] text-[#7A5542] hover:bg-[#F8ECE4] px-3.5 py-2 rounded-lg transition-colors">
                                Log in
                            </a>
                        @endauth
                    </div>
                @endif
            </nav>

            {{-- Hero --}}
            <div class="grid grid-cols-1 md:grid-cols-[1.2fr_0.8fr] gap-8 items-center mb-9">
                <div>
                    <p class="text-[11px] font-bold text-[#C2622A] tracking-[0.18em] uppercase mb-3">Welcome</p>
                    <h1 class="text-[36px] leading-[1.15] font-bold text-[#3D2314] mb-3.5">
                        Find your next home. Manage every stay with confidence.
                    </h1>
                    <p class="text-[14px] leading-[1.8] text-[#7A5542] mb-6">
                        Browse premium rooms, check availability instantly, and keep your bookings organized from one polished dashboard.
                    </p>

                    <div class="flex flex-wrap gap-2.5 mb-7">
                        <a href="#listings"
                        class="inline-flex items-center gap-1.5 px-[18px] py-2.5 bg-[#C2622A] hover:bg-[#A8521F] text-white text-[13px] font-semibold rounded-[10px] transition-colors">
                            <i class="ti ti-search text-[15px]" aria-hidden="true"></i>
                            Browse listings
                        </a>
                        <a href="{{ route('login') }}"
                        class="inline-flex items-center px-[18px] py-2.5 bg-[#F8ECE4] hover:bg-[#F0DECE] text-[#3D2314] text-[13px] font-semibold rounded-[10px] transition-colors">
                            Manage bookings
                        </a>
                    </div>

                    <div class="flex flex-wrap gap-6">
                        <div>
                            <p class="text-[22px] font-bold text-[#3D2314]">120+</p>
                            <p class="text-[12px] text-[#7A5542] mt-0.5">verified rentals</p>
                        </div>
                        <div>
                            <p class="text-[22px] font-bold text-[#3D2314]">24/7</p>
                            <p class="text-[12px] text-[#7A5542] mt-0.5">support</p>
                        </div>
                        <div>
                            <p class="text-[22px] font-bold text-[#3D2314]">4.9/5</p>
                            <p class="text-[12px] text-[#7A5542] mt-0.5">guest rating</p>
                        </div>
                    </div>
                </div>

                {{-- Featured card --}}
                <div class="bg-gradient-to-br from-[#F7E7D8] to-[#FFF4EC] border border-[#E8DDD4] rounded-2xl p-5">
                    <div class="bg-white rounded-xl p-5 border border-[#E8DDD4]">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-[11px] font-bold text-[#C2622A] uppercase tracking-[0.12em] mb-1">Featured stay</p>
                                <p class="text-[20px] font-bold text-[#3D2314]">Oceanview Studio</p>
                            </div>
                            <span class="text-[11px] font-bold text-[#3B6D11] bg-[#EAF3DE] px-2.5 py-1.5 rounded-full whitespace-nowrap">
                                Available
                            </span>
                        </div>

                        <div class="bg-[#FBF6F1] border border-[#E8DDD4] rounded-[10px] px-4 py-3 flex justify-between items-center mb-2.5">
                            <span class="text-[12px] text-[#7A5542]">Monthly rate</span>
                            <span class="text-[20px] font-bold text-[#3D2314]">&#8369;8,500</span>
                        </div>

                        <div class="grid grid-cols-2 gap-2.5">
                            <div class="bg-[#FDF8F4] border border-[#E8DDD4] rounded-[10px] p-3">
                                <p class="text-[11px] text-[#7A5542] mb-1">Bedrooms</p>
                                <p class="text-[13px] font-semibold text-[#3D2314]">2 rooms</p>
                            </div>
                            <div class="bg-[#FDF8F4] border border-[#E8DDD4] rounded-[10px] p-3">
                                <p class="text-[11px] text-[#7A5542] mb-1">Amenities</p>
                                <p class="text-[13px] font-semibold text-[#3D2314]">Wi-Fi &middot; Parking</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pillars --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5 mb-7">
                <div class="bg-[#FDF8F4] border border-[#E8DDD4] rounded-[14px] p-[18px]">
                    <div class="w-9 h-9 bg-[#F8ECE4] rounded-[10px] flex items-center justify-center mb-3">
                        <i class="ti ti-building text-[18px] text-[#C2622A]" aria-hidden="true"></i>
                    </div>
                    <p class="text-[15px] font-semibold text-[#3D2314] mb-1.5">Curated listings</p>
                    <p class="text-[12px] leading-[1.7] text-[#7A5542]">Handpicked rooms and apartments that fit every lifestyle and budget.</p>
                </div>
                <div class="bg-[#FDF8F4] border border-[#E8DDD4] rounded-[14px] p-[18px]">
                    <div class="w-9 h-9 bg-[#F8ECE4] rounded-[10px] flex items-center justify-center mb-3">
                        <i class="ti ti-calendar text-[18px] text-[#C2622A]" aria-hidden="true"></i>
                    </div>
                    <p class="text-[15px] font-semibold text-[#3D2314] mb-1.5">Flexible booking</p>
                    <p class="text-[12px] leading-[1.7] text-[#7A5542]">Check availability and confirm stays without the usual back-and-forth.</p>
                </div>
                <div class="bg-[#FDF8F4] border border-[#E8DDD4] rounded-[14px] p-[18px]">
                    <div class="w-9 h-9 bg-[#F8ECE4] rounded-[10px] flex items-center justify-center mb-3">
                        <i class="ti ti-lock text-[18px] text-[#C2622A]" aria-hidden="true"></i>
                    </div>
                    <p class="text-[15px] font-semibold text-[#3D2314] mb-1.5">Secure access</p>
                    <p class="text-[12px] leading-[1.7] text-[#7A5542]">A simple, reliable system for guests and property owners alike.</p>
                </div>
            </div>

            {{-- Listings --}}
            <div id="listings" class="bg-[#FDF8F4] border border-[#E8DDD4] rounded-2xl p-[22px]">
                <div class="flex justify-between items-end flex-wrap gap-2 mb-4">
                    <div>
                        <p class="text-[11px] font-bold text-[#C4A08A] tracking-[0.18em] uppercase mb-1">Popular now</p>
                        <p class="text-[20px] font-bold text-[#3D2314]">Ready-to-book homes</p>
                    </div>
                    <a href="{{ route('login') }}" class="text-[13px] font-semibold text-[#C2622A] hover:underline">
                        View all listings &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5">
                    <div class="bg-white border border-[#E8DDD4] rounded-xl p-4">
                        <div class="h-[120px] rounded-[10px] mb-3.5 bg-gradient-to-br from-[#7A5542] to-[#D6BBA7]"></div>
                        <p class="text-[15px] font-semibold text-[#3D2314] mb-1">City Loft</p>
                        <p class="text-[12px] leading-[1.6] text-[#7A5542] mb-3">Bright apartment with skyline views and fast Wi-Fi.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-[12px] text-[#7A5542]">From &#8369;8,200/mo</span>
                            <a href="{{ route('login') }}" class="text-[13px] font-bold text-[#C2622A] hover:underline">Book &rarr;</a>
                        </div>
                    </div>
                    <div class="bg-white border border-[#E8DDD4] rounded-xl p-4">
                        <div class="h-[120px] rounded-[10px] mb-3.5 bg-gradient-to-br from-[#C2622A] to-[#F1D0A8]"></div>
                        <p class="text-[15px] font-semibold text-[#3D2314] mb-1">Garden House</p>
                        <p class="text-[12px] leading-[1.6] text-[#7A5542] mb-3">Quiet living with a private balcony and lounge area.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-[12px] text-[#7A5542]">From &#8369;9,550/mo</span>
                            <a href="{{ route('login') }}" class="text-[13px] font-bold text-[#C2622A] hover:underline">Book &rarr;</a>
                        </div>
                    </div>
                    <div class="bg-white border border-[#E8DDD4] rounded-xl p-4">
                        <div class="h-[120px] rounded-[10px] mb-3.5 bg-gradient-to-br from-[#7E4A2A] to-[#B99980]"></div>
                        <p class="text-[15px] font-semibold text-[#3D2314] mb-1">Harbor Studio</p>
                        <p class="text-[12px] leading-[1.6] text-[#7A5542] mb-3">Minimal design, premium finish, and effortless access.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-[12px] text-[#7A5542]">From &#8369;8,300/mo</span>
                            <a href="{{ route('login') }}" class="text-[13px] font-bold text-[#C2622A] hover:underline">Book &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>