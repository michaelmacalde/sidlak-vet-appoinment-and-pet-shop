<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">{{ __('Reset password') }}</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                  {{ __(' Remember your password?') }}
                  <a class="font-medium text-amber-600 decoration-2 hover:underline dark:text-amber-500" href="{{ route('login') }}">
                    {{ __('Sign in here') }}
                  </a>
                </p>
              </div>

        </x-slot>



        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
