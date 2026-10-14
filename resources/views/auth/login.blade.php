<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in — Rentify</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('rentify-logo.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
</head>
<body style="margin:0;padding:0;min-height:100vh;display:flex;">

    {{-- Left — photo panel --}}
    <div style="
        flex:1;
        display:none;
        position:relative;
        background-image:url('https://images.unsplash.com/photo-1484154218962-a197022b5858?w=1200&q=80');
        background-size:cover;
        background-position:center;
        min-height:100vh;
    " class="md-show">
        <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(61,35,20,0.5),rgba(20,8,2,0.8));"></div>
        <div style="position:relative;z-index:10;height:100%;display:flex;flex-direction:column;justify-content:space-between;padding:40px;">
            {{-- Brand --}}
            <div style="display:flex;align-items:center;gap:12px;">
                <div style="width:38px;height:38px;background:#2A1509;border-radius:9px;display:flex;align-items:center;justify-content:center;">
                    <img src="{{ asset('rentify-logo.svg') }}" alt="Rentify" style="width:30px;height:30px;border-radius:10px;background:#2A1509;padding:3px;">
                </div>
                <div>
                    <p style="font-size:15px;font-weight:600;color:#fff;margin:0;">Rentify</p>
                    <p style="font-size:11px;color:#2A1509;margin:2px 0 0;">Rental Management System</p>
                </div>
            </div>

            {{-- Quote --}}
            <div>
                <p style="font-size:26px;font-weight:700;color:#fff;margin:0 0 14px;line-height:1.3;">
                    Your home away from home, managed effortlessly.
                </p>
                <p style="font-size:13px;color:rgba(255,255,255,0.65);margin:0;">
                    Track leases, bills, and maintenance requests — all in one place.
                </p>
            </div>
        </div>
    </div>

    {{-- Right — form panel --}}
    <div style="width:100%;max-width:440px;background:#FDF8F4;display:flex;align-items:center;justify-content:center;padding:40px 32px;box-sizing:border-box;min-height:100vh;">
        <div style="width:100%;max-width:360px;">

            {{-- Mobile brand (hidden on large screens) --}}
            <div style="text-align:center;margin-bottom:32px;">
                <div style="width:48px;height:48px;background:#3D2314;border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                    <img src="{{ asset('rentify-logo.svg') }}" alt="Rentify" style="width:40px;height:40px;border-radius:10px;background:#2A1509;padding:3px;">
                </div>
                <p style="font-size:20px;font-weight:700;color:#3D2314;margin:0;">Welcome back</p>
                <p style="font-size:13px;color:#7A5542;margin:6px 0 0;">Sign in to your account to continue</p>
            </div>

            {{-- Session status --}}
            @if(session('status'))
                <div style="background:#EAF3DE;color:#3B6D11;border-radius:8px;padding:10px 14px;font-size:13px;margin-bottom:16px;">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Errors --}}
            @if($errors->any())
                <div style="background:#FCEBEB;color:#A32D2D;border-radius:8px;padding:10px 14px;font-size:13px;margin-bottom:16px;">
                    @foreach($errors->all() as $error)
                        <p style="margin:0;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div style="margin-bottom:14px;">
                    <label style="font-size:12px;font-weight:500;color:#7A5542;display:block;margin-bottom:5px;">
                        <i class="ti ti-mail" style="font-size:13px;margin-right:4px;"></i>Email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        style="width:100%;border:1px solid #E8DDD4;border-radius:9px;padding:10px 13px;font-size:13px;color:#3D2314;background:#fff;box-sizing:border-box;">
                </div>

                <div style="margin-bottom:20px;">
                    <label style="font-size:12px;font-weight:500;color:#7A5542;display:block;margin-bottom:5px;">
                        <i class="ti ti-lock" style="font-size:13px;margin-right:4px;"></i>Password
                    </label>
                    <div style="position:relative;">
                        <input type="password" name="password" id="password" required autocomplete="current-password"
                            style="width:100%;border:1px solid #E8DDD4;border-radius:9px;padding:10px 38px 10px 13px;font-size:13px;color:#3D2314;background:#fff;box-sizing:border-box;">
                        <button type="button" onclick="togglePassword()"
                            style="position:absolute;right:11px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;padding:0;color:#C4A08A;">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg id="eye-off-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;">
                    <label style="display:flex;align-items:center;gap:7px;cursor:pointer;">
                        <input type="checkbox" name="remember" style="accent-color:#C2622A;width:14px;height:14px;">
                        <span style="font-size:12px;color:#7A5542;">Remember me</span>
                    </label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="font-size:12px;color:#C2622A;text-decoration:none;">Forgot password?</a>
                    @endif
                </div>

                <button type="submit"
                    style="width:100%;background:#C2622A;color:#fff;font-size:14px;font-weight:600;padding:11px;border-radius:9px;border:none;cursor:pointer;">
                    Sign in
                </button>

            </form>

            <p style="text-align:center;font-size:12px;color:#C4A08A;margin-top:28px;">
                Boarding House Rental Management System
            </p>
        </div>
    </div>

    <style>
        @media (min-width: 768px) {
            .md-show { display: block !important; }
        }
    </style>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeOffIcon = document.getElementById('eye-off-icon');
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.style.display = 'none';
                eyeOffIcon.style.display = 'block';
            } else {
                input.type = 'password';
                eyeIcon.style.display = 'block';
                eyeOffIcon.style.display = 'none';
            }
        }
    </script>

</body>
</html>