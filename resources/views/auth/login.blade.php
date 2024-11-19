<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">{{ __('Sign in') }}</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                  {{ __("Don't have an account yet?") }}
                  @if (Route::has('register'))
                  <a class="font-medium text-amber-600 decoration-2 hover:underline dark:text-amber-500" href="{{ route('register') }}">
                    {{ __('Sign up here') }}
                  </a>
                  @endif
                </p>
              </div>

        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />
            </div>



            <div class="flex items-center justify-between my-5 gap-x-3">
                <div>
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-500 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-amber-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

            </div>

            <x-button class="w-full ">
                    {{ __('Sign in') }}
            </x-button>
        </form>
    </x-authentication-card>
</x-guest-layout>
