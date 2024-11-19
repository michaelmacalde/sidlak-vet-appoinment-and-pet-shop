<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="application-name" content="{{ config('app.name') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') . ' - ' .'SDAS' }}</title>
        <link rel="icon" href="{{ asset('imgs/sdas-logo.png') }}" type="image/png">
        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net"> --}}
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @vite(['resources/css/app.css'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased dark:bg-neutral-800">
        @include('navigation-menu')
        <main>
            {{ $slot }}
        </main>

         <livewire:partials.footer />

        @stack('modals')

        @livewireScripts
        @vite(['resources/js/app.js'])
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts />

        <script>
            if (typeof attrs === 'undefined') {
                let attrs = [
                    'snapshot',
                    'effects',
                ];

                function snapKill() {
                    document.querySelectorAll('div').forEach(function(element) {
                        for (let i in attrs) {
                            if (element.getAttribute(`wire:${attrs[i]}`) !== null) {
                                element.removeAttribute(`wire:${attrs[i]}`);
                            }
                        }
                    });
                }

                window.addEventListener('load', (ev) => {
                    snapKill();
                });
            }
        </script>

    </body>
</html>
