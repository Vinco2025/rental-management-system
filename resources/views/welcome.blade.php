<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body style="background: #FDF8F4; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 32px 20px;">
        <div style="width: 100%; max-width: 980px;">
            <div style="background: #fff; border-radius: 20px; border: 0.5px solid #E8DDD4; padding: 28px; box-shadow: 0 10px 38px rgba(61, 35, 20, 0.08);">
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 24px; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 48px; height: 48px; background: #3D2314; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px;" fill="none" stroke="#F5EDE6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M3 10.5 12 3l9 7.5"/>
                                <path d="M5 9.5V20a1 1 0 0 0 1 1h3v-5h6v5h3a1 1 0 0 0 1-1V9.5"/>
                            </svg>
                        </div>
                        <div>
                            <p style="font-size: 18px; font-weight: 600; color: #3D2314; margin: 0;">Boarding House</p>
                            <p style="font-size: 13px; color: #C4A08A; margin: 2px 0 0;">Rental Management System</p>
                        </div>
                    </div>

                    @if (Route::has('login'))
                        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                            @auth
                                <a href="{{ url('/dashboard') }}" style="display: inline-flex; align-items: center; justify-content: center; padding: 9px 16px; border-radius: 999px; background: #F8ECE4; color: #3D2314; text-decoration: none; font-size: 13px; font-weight: 600;">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" style="font-size: 13px; color: #7A5542; text-decoration: none;">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" style="display: inline-flex; align-items: center; justify-content: center; padding: 9px 16px; border-radius: 999px; background: #C2622A; color: #fff; text-decoration: none; font-size: 13px; font-weight: 600;">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>

                <div style="display: grid; grid-template-columns: 1.15fr 0.85fr; gap: 24px; align-items: center;">
                    <div>
                        <p style="font-size: 12px; color: #C2622A; letter-spacing: 0.2em; text-transform: uppercase; margin: 0 0 10px; font-weight: 700;">Welcome</p>
                        <h1 style="font-size: 42px; line-height: 1.12; color: #3D2314; margin: 0 0 14px; font-weight: 700;">
                            Find your next home and manage every stay with confidence.
                        </h1>
                        <p style="font-size: 15px; line-height: 1.8; color: #7A5542; margin: 0 0 24px; max-width: 640px;">
                            Browse premium rooms, check availability instantly, and keep your bookings organized from one polished dashboard.
                        </p>

                        <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 28px;">
                            <a href="#listings" style="display: inline-flex; align-items: center; justify-content: center; padding: 11px 18px; border-radius: 10px; background: #C2622A; color: #fff; text-decoration: none; font-size: 13px; font-weight: 600;">Browse listings</a>
                            <a href="{{ route('login') }}" style="display: inline-flex; align-items: center; justify-content: center; padding: 11px 18px; border-radius: 10px; background: #F8ECE4; color: #3D2314; text-decoration: none; font-size: 13px; font-weight: 600;">Manage bookings</a>
                        </div>

                        <div style="display: flex; gap: 28px; flex-wrap: wrap;">
                            <div>
                                <p style="font-size: 24px; font-weight: 700; color: #3D2314; margin: 0;">120+</p>
                                <p style="font-size: 13px; color: #7A5542; margin: 3px 0 0;">verified rentals</p>
                            </div>
                            <div>
                                <p style="font-size: 24px; font-weight: 700; color: #3D2314; margin: 0;">24/7</p>
                                <p style="font-size: 13px; color: #7A5542; margin: 3px 0 0;">support</p>
                            </div>
                            <div>
                                <p style="font-size: 24px; font-weight: 700; color: #3D2314; margin: 0;">4.9/5</p>
                                <p style="font-size: 13px; color: #7A5542; margin: 3px 0 0;">guest rating</p>
                            </div>
                        </div>
                    </div>

                    <div style="background: linear-gradient(135deg, #F7E7D8, #FFF8F1); border: 0.5px solid #E8DDD4; border-radius: 16px; padding: 20px;">
                        <div style="background: #fff; border-radius: 14px; padding: 20px; border: 0.5px solid #E8DDD4;">
                            <div style="display: flex; justify-content: space-between; gap: 12px; align-items: start;">
                                <div>
                                    <p style="font-size: 12px; color: #C2622A; margin: 0 0 6px; font-weight: 700; text-transform: uppercase;">Featured stay</p>
                                    <h2 style="font-size: 24px; color: #3D2314; margin: 0;">Oceanview Studio</h2>
                                </div>
                                <span style="padding: 6px 10px; border-radius: 999px; background: #EAF3DE; color: #3B6D11; font-size: 12px; font-weight: 700;">Available</span>
                            </div>

                            <div style="margin-top: 18px; display: grid; gap: 12px;">
                                <div style="padding: 14px; border-radius: 12px; background: #FBF6F1; border: 0.5px solid #E8DDD4;">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span style="font-size: 12px; color: #7A5542;">Monthly rate</span>
                                        <span style="font-size: 20px; color: #3D2314; font-weight: 700;">₱8,500</span>
                                    </div>
                                </div>
                                <div style="display: grid; gap: 12px; grid-template-columns: repeat(2, minmax(0, 1fr));">
                                    <div style="padding: 14px; border-radius: 12px; background: #FDF8F4; border: 0.5px solid #E8DDD4;">
                                        <p style="font-size: 12px; color: #7A5542; margin: 0 0 6px;">Bedrooms</p>
                                        <p style="font-size: 15px; color: #3D2314; font-weight: 600; margin: 0;">2 spacious rooms</p>
                                    </div>
                                    <div style="padding: 14px; border-radius: 12px; background: #FDF8F4; border: 0.5px solid #E8DDD4;">
                                        <p style="font-size: 12px; color: #7A5542; margin: 0 0 6px;">Amenities</p>
                                        <p style="font-size: 15px; color: #3D2314; font-weight: 600; margin: 0;">Wi-Fi • Parking</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 28px; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px;">
                    <div style="padding: 18px; border-radius: 14px; background: #FDF8F4; border: 0.5px solid #E8DDD4;">
                        <div style="margin-bottom: 12px; display: inline-flex; background: #F8ECE4; border-radius: 10px; padding: 9px;">🏡</div>
                        <h3 style="font-size: 18px; color: #3D2314; margin: 0 0 8px;">Curated listings</h3>
                        <p style="font-size: 13px; line-height: 1.7; color: #7A5542; margin: 0;">Explore handpicked rooms and apartments that fit every lifestyle and budget.</p>
                    </div>
                    <div style="padding: 18px; border-radius: 14px; background: #FDF8F4; border: 0.5px solid #E8DDD4;">
                        <div style="margin-bottom: 12px; display: inline-flex; background: #F8ECE4; border-radius: 10px; padding: 9px;">📅</div>
                        <h3 style="font-size: 18px; color: #3D2314; margin: 0 0 8px;">Flexible booking</h3>
                        <p style="font-size: 13px; line-height: 1.7; color: #7A5542; margin: 0;">Check availability quickly and confirm stays without the usual back-and-forth.</p>
                    </div>
                    <div style="padding: 18px; border-radius: 14px; background: #FDF8F4; border: 0.5px solid #E8DDD4;">
                        <div style="margin-bottom: 12px; display: inline-flex; background: #F8ECE4; border-radius: 10px; padding: 9px;">🔒</div>
                        <h3 style="font-size: 18px; color: #3D2314; margin: 0 0 8px;">Secure access</h3>
                        <p style="font-size: 13px; line-height: 1.7; color: #7A5542; margin: 0;">Stay protected with a simple and reliable system for guests and property owners alike.</p>
                    </div>
                </div>

                <div id="listings" style="margin-top: 28px; padding: 18px; border-radius: 16px; background: #FDF8F4; border: 0.5px solid #E8DDD4;">
                    <div style="display: flex; justify-content: space-between; gap: 12px; align-items: end; flex-wrap: wrap;">
                        <div>
                            <p style="font-size: 11px; color: #C4A08A; letter-spacing: 0.22em; text-transform: uppercase; font-weight: 700; margin: 0 0 6px;">Popular now</p>
                            <h2 style="font-size: 22px; color: #3D2314; margin: 0;">Ready-to-book homes</h2>
                        </div>
                        <a href="{{ route('login') }}" style="font-size: 13px; color: #C2622A; text-decoration: none; font-weight: 600;">View all listings</a>
                    </div>

                    <div style="margin-top: 16px; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px;">
                        <div style="padding: 16px; border-radius: 12px; background: #fff; border: 0.5px solid #E8DDD4;">
                            <div style="height: 140px; border-radius: 12px; background: linear-gradient(135deg, #7A5542, #D6BBA7);"></div>
                            <h3 style="font-size: 17px; color: #3D2314; margin: 14px 0 6px;">City Loft</h3>
                            <p style="font-size: 13px; color: #7A5542; line-height: 1.7; margin: 0;">Bright apartment with skyline views and fast Wi-Fi.</p>
                            <div style="margin-top: 14px; display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 13px; color: #7A5542;">From ₱8,200/mo</span>
                                <a href="{{ route('login') }}" style="font-size: 13px; color: #C2622A; text-decoration: none; font-weight: 700;">Book</a>
                            </div>
                        </div>
                        <div style="padding: 16px; border-radius: 12px; background: #fff; border: 0.5px solid #E8DDD4;">
                            <div style="height: 140px; border-radius: 12px; background: linear-gradient(135deg, #C2622A, #F1D0A8);"></div>
                            <h3 style="font-size: 17px; color: #3D2314; margin: 14px 0 6px;">Garden House</h3>
                            <p style="font-size: 13px; color: #7A5542; line-height: 1.7; margin: 0;">Quiet living with a private balcony and lounge area.</p>
                            <div style="margin-top: 14px; display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 13px; color: #7A5542;">From ₱9,550/mo</span>
                                <a href="{{ route('login') }}" style="font-size: 13px; color: #C2622A; text-decoration: none; font-weight: 700;">Book</a>
                            </div>
                        </div>
                        <div style="padding: 16px; border-radius: 12px; background: #fff; border: 0.5px solid #E8DDD4;">
                            <div style="height: 140px; border-radius: 12px; background: linear-gradient(135deg, #7E4A2A, #B99980);"></div>
                            <h3 style="font-size: 17px; color: #3D2314; margin: 14px 0 6px;">Harbor Studio</h3>
                            <p style="font-size: 13px; color: #7A5542; line-height: 1.7; margin: 0;">Minimal design, premium finish, and effortless access.</p>
                            <div style="margin-top: 14px; display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 13px; color: #7A5542;">From ₱8,300/mo</span>
                                <a href="{{ route('login') }}" style="font-size: 13px; color: #C2622A; text-decoration: none; font-weight: 700;">Book</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
