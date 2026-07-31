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
                    <input type="password" name="password" required autocomplete="current-password"
                        style="width: 100%; border: 0.5px solid #E0D5CB; border-radius: 8px; padding: 9px 12px; font-size: 13px; color: #3D2314; background: #FDFAF7; box-sizing: border-box;">
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

</body>
</html>