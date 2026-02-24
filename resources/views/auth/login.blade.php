<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">{{ __('Welcome Back') }}</h1>
        <p class="text-gray-400 text-sm">{{ __('Sign in to your account to continue') }}</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-2 w-full px-4 py-3" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-2 w-full px-4 py-3" type="password" name="password" required
                autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-600 bg-gray-700 text-indigo-500 shadow-sm focus:ring-indigo-500 focus:ring-offset-0"
                    name="remember">
                <span class="ms-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-400 hover:text-indigo-300 transition-colors"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Buttons -->
        <div class="flex gap-3 pt-2">
            <x-primary-button
                class="flex-1 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800">
                {{ __('Sign In') }}
            </x-primary-button>
            <button type="button"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                onclick="IsiPassword()">
                {{ __('Demo') }}
            </button>
        </div>
    </form>

    <!-- Sign Up Link -->
    <div class="mt-8 pt-6 border-t border-gray-700 text-center">
        <p class="text-gray-400 text-sm">
            {{ __('Don\'t have an account?') }}
            <a href="{{ route('register') }}"
                class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">
                {{ __('Sign up') }}
            </a>
        </p>
    </div>
</x-guest-layout>

<script>
    const IsiPassword = () => {
        document.getElementById('password').value = '12345678'
    }
</script>
