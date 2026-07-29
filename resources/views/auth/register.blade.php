<x-guest-layout>
    <div class="w-full">
        <div class="mb-6 text-center">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-orange-500/10 text-orange-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 10.5 12 3l9 7.5"></path>
                    <path d="M5 9.5V20a1 1 0 0 0 1 1h3v-5h6v5h3a1 1 0 0 0 1-1V9.5"></path>
                </svg>
            </div>
            <h2 class="mt-4 text-2xl font-semibold text-slate-900">Create your account</h2>
            <p class="mt-2 text-sm text-slate-500">Join the rental system and start managing your bookings.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Name')" class="text-slate-700" />
                <x-text-input id="name" class="mt-1 block w-full rounded-xl border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-orange-500 focus:ring-orange-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" class="text-slate-700" />
                <x-text-input id="email" class="mt-1 block w-full rounded-xl border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-orange-500 focus:ring-orange-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" class="text-slate-700" />
                <x-text-input id="password" class="mt-1 block w-full rounded-xl border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-orange-500 focus:ring-orange-500" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-slate-700" />
                <x-text-input id="password_confirmation" class="mt-1 block w-full rounded-xl border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-orange-500 focus:ring-orange-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between pt-2">
                <a class="text-sm font-medium text-slate-500 transition hover:text-orange-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="rounded-full bg-orange-500 px-5 py-2.5 text-sm font-semibold text-white hover:bg-orange-400">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
