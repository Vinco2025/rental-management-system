<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password — Boarding House</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="min-height: 100vh; background: #FDF8F4; display: flex; align-items: center; justify-content: center; font-family: 'Figtree', sans-serif;">

    <div style="width: 100%; max-width: 420px; padding: 24px;">

        {{-- Logo / Brand --}}
        <div style="text-align: center; margin-bottom: 32px;">
            <div style="display: inline-flex; align-items: center; justify-content: center; width: 56px; height: 56px; background: #3D2314; border-radius: 16px; margin-bottom: 16px;">
                <i class="ti ti-home" style="font-size: 28px; color: #fff;"></i>
            </div>
            <h1 style="font-size: 22px; font-weight: 700; color: #3D2314; margin: 0 0 4px 0;">Forgot Password?</h1>
            <p style="font-size: 14px; color: #7A5542; margin: 0;">No problem. We'll send you a reset link.</p>
        </div>

        {{-- Card --}}
        <div style="background: #fff; border: 1px solid #E8DDD4; border-radius: 16px; padding: 32px;">

            {{-- Session Status --}}
            @if (session('status'))
                <div style="background: #D1FAE5; border: 1px solid #6EE7B7; border-radius: 10px; padding: 12px 16px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                    <i class="ti ti-circle-check" style="font-size: 18px; color: #065F46;"></i>
                    <span style="font-size: 14px; color: #065F46;">{{ session('status') }}</span>
                </div>
            @endif

            {{-- Error --}}
            @if ($errors->any())
                <div style="background: #FEE2E2; border: 1px solid #FECACA; border-radius: 10px; padding: 12px 16px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                    <i class="ti ti-alert-circle" style="font-size: 18px; color: #991B1B;"></i>
                    <span style="font-size: 14px; color: #991B1B;">{{ $errors->first('email') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                {{-- Email --}}
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #3D2314; margin-bottom: 6px;">
                        Email Address
                    </label>
                    <div style="position: relative;">
                        <i class="ti ti-mail" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 16px; color: #C4A08A;"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="Enter your email"
                            style="width: 100%; padding: 10px 12px 10px 38px; border: 1px solid {{ $errors->has('email') ? '#FCA5A5' : '#E8DDD4' }}; border-radius: 10px; font-size: 14px; color: #3D2314; background: {{ $errors->has('email') ? '#FEF2F2' : '#fff' }}; outline: none; box-sizing: border-box;">
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        style="width: 100%; background: #C2622A; color: #fff; border: none; border-radius: 10px; padding: 11px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="ti ti-send" style="font-size: 16px;"></i>
                    Email Password Reset Link
                </button>
            </form>
        </div>

        {{-- Back to login --}}
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('login') }}"
            style="font-size: 13px; color: #7A5542; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                <i class="ti ti-arrow-left" style="font-size: 14px;"></i>
                Back to login
            </a>
        </div>

    </div>

</body>
</html>