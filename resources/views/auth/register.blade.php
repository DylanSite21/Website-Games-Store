<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">{{ __('Create Account') }}</h1>
        <p class="text-gray-400 text-sm">{{ __('Join us and start your adventure') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-2">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-2 w-full px-4 py-3" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-2 w-full px-4 py-3" type="email" name="email"
                :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-2 w-full px-4 py-3" type="password" name="password" required
                autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-2 w-full px-4 py-3" type="password"
                name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <x-primary-button
                class="w-full py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Sign In Link -->
    <div class="mt-8 pt-6 border-t border-gray-700 text-center">
        <p class="text-gray-400 text-sm">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">
                {{ __('Sign in') }}
            </a>
        </p>
    </div>
</x-guest-layout>
