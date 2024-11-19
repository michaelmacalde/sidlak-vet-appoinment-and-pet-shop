<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            {{-- <x-authentication-card-logo /> --}}
            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">{{ __('Forgot password?') }}</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                 {{ __(' Remember your password?') }}
                  <a class="font-medium text-amber-600 decoration-2 hover:underline dark:text-amber-500" href="{{ route('login') }}">
                    {{ __('Sign in here') }}
                  </a>
                </p>
            </div>
        </x-slot>


        {{-- <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div> --}}

        @session('status')
            <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
