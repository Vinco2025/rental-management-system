<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in — Boarding House</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background: #FDF8F4; min-height: 100vh; display: flex; align-items: center; justify-content: center;">

    <div style="width: 100%; max-width: 380px; padding: 24px;">

        {{-- Card --}}
        <div style="background: #fff; border-radius: 16px; border: 0.5px solid #E8DDD4; padding: 36px 32px;">

            {{-- Logo --}}
            <div style="text-align: center; margin-bottom: 28px;">
                <div style="width: 48px; height: 48px; background: #3D2314; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px;" fill="none" stroke="#F5EDE6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M3 10.5 12 3l9 7.5"/>
                        <path d="M5 9.5V20a1 1 0 0 0 1 1h3v-5h6v5h3a1 1 0 0 0 1-1V9.5"/>
                    </svg>
                </div>
                <p style="font-size: 18px; font-weight: 500; color: #3D2314;">Boarding House</p>
                <p style="font-size: 13px; color: #C4A08A; margin-top: 4px;">Sign in to your admin account</p>
            </div>

            {{-- Session status --}}
            @if(session('status'))
                <div style="background: #EAF3DE; color: #3B6D11; border-radius: 8px; padding: 10px 14px; font-size: 13px; margin-bottom: 16px;">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Errors --}}
            @if($errors->any())
                <div style="background: #FCEBEB; color: #A32D2D; border-radius: 8px; padding: 10px 14px; font-size: 13px; margin-bottom: 16px;">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div style="margin-bottom: 14px;">
                    <label style="font-size: 12px; color: #7A5542; display: block; margin-bottom: 5px;">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        style="width: 100%; border: 0.5px solid #E0D5CB; border-radius: 8px; padding: 9px 12px; font-size: 13px; color: #3D2314; background: #FDFAF7; box-sizing: border-box;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-size: 12px; color: #7A5542; display: block; margin-bottom: 5px;">Password</label>
                    <div style="position: relative;">
                        <input type="password" name="password" id="password" required autocomplete="current-password"
                            style="width: 100%; border: 0.5px solid #E0D5CB; border-radius: 8px; padding: 9px 36px 9px 12px; font-size: 13px; color: #3D2314; background: #FDFAF7; box-sizing: border-box;">
                        <button type="button" onclick="togglePassword()"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 0; color: #C4A08A;">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg id="eye-off-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                    <label style="display: flex; align-items: center; gap: 7px; cursor: pointer;">
                        <input type="checkbox" name="remember" style="accent-color: #C2622A; width: 14px; height: 14px;">
                        <span style="font-size: 12px; color: #7A5542;">Remember me</span>
                    </label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                        style="font-size: 12px; color: #C2622A; text-decoration: none;">Forgot password?</a>
                    @endif
                </div>

                <button type="submit"
                        style="width: 100%; background: #C2622A; color: #fff; font-size: 13px; font-weight: 500; padding: 10px; border-radius: 8px; border: none; cursor: pointer;">
                    Sign in
                </button>

            </form>
        </div>

        <p style="text-align: center; font-size: 12px; color: #C4A08A; margin-top: 16px;">
            Boarding House Rental Management System
        </p>

    </div>

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