<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'rentify') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('rentify-logo.svg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body style="margin:0;padding:0;background:#FDF8F4;font-family:system-ui,sans-serif;">

    {{-- HERO --}}
    <div style="
        position:relative;
        height:100vh;
        min-height:600px;
        background-image:url('https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=1600&q=80');
        background-size:cover;
        background-position:center;
        display:flex;
        flex-direction:column;
    ">
        {{-- Dark overlay --}}
        <div style="position:absolute;inset:0;background:linear-gradient(to bottom, rgba(20,8,2,0.55) 0%, rgba(61,35,20,0.75) 100%);"></div>

        {{-- Nav --}}
        <nav style="position:relative;z-index:10;display:flex;align-items:center;justify-content:space-between;padding:24px 48px;">
            <div style="display:flex;align-items:center;gap:12px;">
                <img src="{{ asset('rentify-logo.svg') }}" alt="Rentify" style="width:40px;height:40px;border-radius:10px;background:#2A1509;padding:3px;">
                <div>
                    <p style="font-size:16px;font-weight:600;color:#fff;margin:0;line-height:1;">Rentify</p>
                    <p style="font-size:11px;color:#C4A08A;margin:3px 0 0;">Rental Management System</p>
                </div>
            </div>
            @if(Route::has('login'))
                @auth
                    <a href="{{ url('/admin') }}" style="font-size:13px;font-weight:600;color:#fff;background:#2A1509;padding:9px 20px;border-radius:999px;text-decoration:none;">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" style="font-size:13px;font-weight:600;color:#fff;background:rgba(255,255,255,0.15);backdrop-filter:blur(6px);border:1px solid rgba(255,255,255,0.25);padding:9px 20px;border-radius:999px;text-decoration:none;">Sign in</a>
                @endauth
            @endif
        </nav>

        {{-- Hero content --}}
        <div style="position:relative;z-index:10;flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:0 24px;">
            <p style="font-size:11px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:#C2622A;margin:0 0 16px;">Welcome</p>
            <h1 style="font-size:clamp(32px,5vw,60px);font-weight:700;color:#fff;margin:0 0 20px;line-height:1.15;max-width:700px;">
                Find your next home.<br>Manage every stay with confidence.
            </h1>
            <p style="font-size:15px;color:rgba(255,255,255,0.75);margin:0 0 36px;max-width:480px;line-height:1.8;">
                Browse premium rooms, check availability instantly, and keep your bookings organized from one polished dashboard.
            </p>
            <div style="display:flex;gap:12px;flex-wrap:wrap;justify-content:center;">
                <a href="#listings" style="display:inline-flex;align-items:center;gap:8px;padding:13px 28px;background:#C2622A;color:#fff;font-size:14px;font-weight:600;border-radius:12px;text-decoration:none;">
                    <i class="ti ti-search" style="font-size:16px;"></i> Browse listings
                </a>
                <a href="{{ route('login') }}" style="display:inline-flex;align-items:center;padding:13px 28px;background:rgba(255,255,255,0.15);backdrop-filter:blur(6px);border:1px solid rgba(255,255,255,0.3);color:#fff;font-size:14px;font-weight:600;border-radius:12px;text-decoration:none;">
                    Manage bookings
                </a>
            </div>

            {{-- Stats --}}
            <div style="display:flex;gap:48px;margin-top:56px;flex-wrap:wrap;justify-content:center;">
                <div style="text-align:center;">
                    <p style="font-size:28px;font-weight:700;color:#fff;margin:0;">120+</p>
                    <p style="font-size:12px;color:rgba(255,255,255,0.6);margin:4px 0 0;">verified rentals</p>
                </div>
                <div style="text-align:center;">
                    <p style="font-size:28px;font-weight:700;color:#fff;margin:0;">24/7</p>
                    <p style="font-size:12px;color:rgba(255,255,255,0.6);margin:4px 0 0;">support</p>
                </div>
                <div style="text-align:center;">
                    <p style="font-size:28px;font-weight:700;color:#fff;margin:0;">4.9/5</p>
                    <p style="font-size:12px;color:rgba(255,255,255,0.6);margin:4px 0 0;">guest rating</p>
                </div>
            </div>
        </div>

        {{-- Scroll hint --}}
        <div style="position:relative;z-index:10;text-align:center;padding-bottom:28px;">
            <i class="ti ti-chevrons-down" style="font-size:22px;color:rgba(255,255,255,0.4);"></i>
        </div>
    </div>

    {{-- CONTENT SECTION --}}
    <div style="max-width:960px;margin:0 auto;padding:64px 24px;">

        {{-- Pillars --}}
        <div style="text-align:center;margin-bottom:40px;">
            <p style="font-size:11px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:#C2622A;margin:0 0 10px;">Why choose us</p>
            <h2 style="font-size:28px;font-weight:700;color:#3D2314;margin:0;">Everything you need, in one place</h2>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px;margin-bottom:64px;">
            <div style="background:#fff;border:1px solid #E8DDD4;border-radius:14px;padding:24px;">
                <div style="width:40px;height:40px;background:#F8ECE4;border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
                    <i class="ti ti-building" style="font-size:20px;color:#C2622A;"></i>
                </div>
                <p style="font-size:15px;font-weight:600;color:#3D2314;margin:0 0 8px;">Curated listings</p>
                <p style="font-size:13px;line-height:1.7;color:#7A5542;margin:0;">Handpicked rooms and apartments that fit every lifestyle and budget.</p>
            </div>
            <div style="background:#fff;border:1px solid #E8DDD4;border-radius:14px;padding:24px;">
                <div style="width:40px;height:40px;background:#F8ECE4;border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
                    <i class="ti ti-calendar" style="font-size:20px;color:#C2622A;"></i>
                </div>
                <p style="font-size:15px;font-weight:600;color:#3D2314;margin:0 0 8px;">Flexible booking</p>
                <p style="font-size:13px;line-height:1.7;color:#7A5542;margin:0;">Check availability and confirm stays without the usual back-and-forth.</p>
            </div>
            <div style="background:#fff;border:1px solid #E8DDD4;border-radius:14px;padding:24px;">
                <div style="width:40px;height:40px;background:#F8ECE4;border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
                    <i class="ti ti-lock" style="font-size:20px;color:#C2622A;"></i>
                </div>
                <p style="font-size:15px;font-weight:600;color:#3D2314;margin:0 0 8px;">Secure access</p>
                <p style="font-size:13px;line-height:1.7;color:#7A5542;margin:0;">A simple, reliable system for guests and property owners alike.</p>
            </div>
        </div>

        {{-- Listings --}}
        <div id="listings" style="background:#FDF8F4;border:1px solid #E8DDD4;border-radius:20px;padding:32px;">
            <div style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:12px;margin-bottom:24px;">
                <div>
                    <p style="font-size:11px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:#C4A08A;margin:0 0 6px;">Popular now</p>
                    <p style="font-size:22px;font-weight:700;color:#3D2314;margin:0;">Ready-to-book homes</p>
                </div>
                <a href="{{ route('login') }}" style="font-size:13px;font-weight:600;color:#C2622A;text-decoration:none;">View all listings →</a>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;">
                <div style="background:#fff;border:1px solid #E8DDD4;border-radius:14px;overflow:hidden;">
                    <div style="height:160px;background-image:url('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=600&q=80');background-size:cover;background-position:center;"></div>
                    <div style="padding:16px;">
                        <p style="font-size:15px;font-weight:600;color:#3D2314;margin:0 0 6px;">City Loft</p>
                        <p style="font-size:12px;line-height:1.6;color:#7A5542;margin:0 0 14px;">Bright apartment with skyline views and fast Wi-Fi.</p>
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <span style="font-size:12px;color:#7A5542;">From ₱8,200/mo</span>
                            <a href="{{ route('login') }}" style="font-size:13px;font-weight:700;color:#C2622A;text-decoration:none;">Book →</a>
                        </div>
                    </div>
                </div>

                <div style="background:#fff;border:1px solid #E8DDD4;border-radius:14px;overflow:hidden;">
                    <div style="height:160px;background-image:url('https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=600&q=80');background-size:cover;background-position:center;"></div>
                    <div style="padding:16px;">
                        <p style="font-size:15px;font-weight:600;color:#3D2314;margin:0 0 6px;">Garden House</p>
                        <p style="font-size:12px;line-height:1.6;color:#7A5542;margin:0 0 14px;">Quiet living with a private balcony and lounge area.</p>
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <span style="font-size:12px;color:#7A5542;">From ₱9,550/mo</span>
                            <a href="{{ route('login') }}" style="font-size:13px;font-weight:700;color:#C2622A;text-decoration:none;">Book →</a>
                        </div>
                    </div>
                </div>

                <div style="background:#fff;border:1px solid #E8DDD4;border-radius:14px;overflow:hidden;">
                    <div style="height:160px;background-image:url('https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=600&q=80');background-size:cover;background-position:center;"></div>
                    <div style="padding:16px;">
                        <p style="font-size:15px;font-weight:600;color:#3D2314;margin:0 0 6px;">Harbor Studio</p>
                        <p style="font-size:12px;line-height:1.6;color:#7A5542;margin:0 0 14px;">Minimal design, premium finish, and effortless access.</p>
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <span style="font-size:12px;color:#7A5542;">From ₱8,300/mo</span>
                            <a href="{{ route('login') }}" style="font-size:13px;font-weight:700;color:#C2622A;text-decoration:none;">Book →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <p style="text-align:center;font-size:12px;color:#C4A08A;margin-top:40px;">
            © {{ date('Y') }} Rentify - Rental Management System
        </p>
    </div>

</body>
</html>