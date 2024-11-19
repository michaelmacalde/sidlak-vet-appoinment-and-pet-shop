<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('imgs/sdas-logo.png') }}" type="image/png">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased dark:bg-neutral-800">
        @include('navigation-menu')

        <main>
            {{ $slot }}
        </main>

        <livewire:partials.footer />
        @livewireScripts
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
