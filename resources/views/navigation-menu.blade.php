
<div>
    <header class="z-50 flex flex-wrap w-full py-4 text-sm sm:justify-start sm:flex-nowrap bg-slate-50 dark:bg-neutral-800 lg:static">
        <nav class="flex flex-wrap items-center justify-between w-full px-4 mx-auto max-w-7xl basis-full" aria-label="Global">
        <a class="flex-none text-xl font-semibold sm:order-1 dark:text-white" href="{{ route('page.home') }}">
            <img src="{{ asset('imgs/sdas-logo.png') }}" class="h-auto w-14" alt="" srcset="">
        </a>
        <div class="flex items-center sm:order-3 gap-x-2">

            <!-- Button Group -->
            <div class="flex items-center py-1 gap-x-2 ms-auto md:ps-6 md:order-3 md:col-span-3">
                {{-- <button type="button" class="flex items-center block font-medium text-gray-600 hs-dark-mode-active:hidden hs-dark-mode group hover:text-amber-600 dark:text-neutral-400 dark:hover:text-neutral-500" data-hs-theme-click-value="dark">
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                </svg>
                </button>
                <button type="button" class="flex items-center hidden font-medium text-gray-600 hs-dark-mode-active:block hs-dark-mode group hover:text-amber-600 dark:text-neutral-400 dark:hover:text-neutral-500" data-hs-theme-click-value="light">
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="4"></circle>
                    <path d="M12 2v2"></path>
                    <path d="M12 20v2"></path>
                    <path d="m4.93 4.93 1.41 1.41"></path>
                    <path d="m17.66 17.66 1.41 1.41"></path>
                    <path d="M2 12h2"></path>
                    <path d="M20 12h2"></path>
                    <path d="m6.34 17.66-1.41 1.41"></path>
                    <path d="m19.07 4.93-1.41 1.41"></path>
                </svg>
                </button> --}}
                @auth
                @livewire('adoption.adoption-cart-counter')
                    {{-- <livewire:adoption.adoption-cart-counter /> --}}
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-black border border-gray-200 gap-x-2 rounded-xl hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:hover:bg-white/10 dark:text-white dark:hover:text-white">
                        {{ __('Sign in') }}
                    </a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-black transition border border-transparent gap-x-2 rounded-xl bg-amber-400 hover:bg-amber-500 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-amber-500">
                        {{ __('Sign Up') }}
                    </a>
                    @endif

                @endguest

                @auth
                    {{-- <a wire.navigate.hover href="{{ route('donation.index')}}" class="inline-flex items-center px-3 py-2 mr-3 text-sm font-medium text-black gap-x-2 rounded-xl bg-amber-400 hover:bg-amber-500 disabled:opacity-50 disabled:pointer-events-none">
                        <svg class="flex-shrink-0 size-4" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                        {{ __('Donate') }}
                    </a> --}}

                    <div class="relative inline-flex hs-dropdown" data-hs-dropdown-placement="bottom-right">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                    {{ Auth::user()->name }}

                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                        @endif


                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 z-10 bg-white shadow-md rounded-lg p-2 dark:bg-neutral-800 dark:border dark:border-neutral-700" aria-labelledby="hs-dropdown-with-header">
                            <div class="px-5 py-3 -m-2 bg-gray-100 rounded-t-lg dark:bg-neutral-700">
                                <p class="text-sm text-gray-500 dark:text-neutral-400">{{ __('Manage Menu') }}</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-neutral-300">{{ Auth::user()->email }}</p>
                            </div>
                        <div class="py-2 mt-2 first:pt-0 last:pb-0">

                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-amber-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300" href="{{ route('profile.show') }}">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            {{ __('Profile') }}
                            </a>

                            <a href="#!" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-amber-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300">
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M18 4c-1.71 0-2.75.33-3.35.61C13.88 4.23 13 4 12 4s-1.88.23-2.65.61C8.75 4.33 7.71 4 6 4c-3 0-5 8-5 10c0 .83 1.32 1.59 3.14 1.9c.64 2.24 3.66 3.95 7.36 4.1v-4.28c-.59-.37-1.5-1.04-1.5-1.72c0-1 2-1 2-1s2 0 2 1c0 .68-.91 1.35-1.5 1.72V20c3.7-.15 6.72-1.86 7.36-4.1C21.68 15.59 23 14.83 23 14c0-2-2-10-5-10M4.15 13.87c-.5-.12-.89-.26-1.15-.37c.25-2.77 2.2-7.1 3.05-7.5c.54 0 .95.06 1.32.11c-2.1 2.31-2.93 5.93-3.22 7.76M9 12a1 1 0 0 1-1-1c0-.54.45-1 1-1a1 1 0 0 1 1 1c0 .56-.45 1-1 1m6 0a1 1 0 0 1-1-1c0-.54.45-1 1-1a1 1 0 0 1 1 1c0 .56-.45 1-1 1m4.85 1.87c-.29-1.83-1.12-5.45-3.22-7.76c.37-.05.78-.11 1.32-.11c.85.4 2.8 4.73 3.05 7.5c-.25.11-.64.25-1.15.37"/></svg>
                                {{ __('Dogs') }}
                            </a>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-amber-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300" href="{{ route('api-tokens.index') }}">
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                {{ __('API Tokens') }}
                            </a>
                            @endif



                            <div>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-amber-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300" href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                        </svg>
                                        {{ __('Log Out') }}
                                    </a>

                                </form>
                            </div>
                        </div>
                        </div>
                    </div>

                @endauth


            </div>
            <!-- End Button Group -->


            <button type="button" class="sm:hidden hs-collapse-toggle p-2.5 inline-flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-white dark:hover:bg-white/10" data-hs-collapse="#navbar-alignment" aria-controls="navbar-alignment" aria-label="Toggle navigation">
            <svg class="flex-shrink-0 hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
            <svg class="flex-shrink-0 hidden hs-collapse-open:block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>


        </div>

        <div id="navbar-alignment" class="hidden overflow-hidden transition-all duration-300 hs-collapse basis-full grow sm:grow-0 sm:basis-auto sm:block sm:order-2">
            <div class="flex flex-col gap-5 mt-5 lg:gap-10 sm:flex-row sm:items-center sm:mt-0 sm:ps-5">
                <x-nav-link wire:navigate.hover href="{{ route('page.home') }}" :active="request()->routeIs('page.home')">{{ __('Home') }}</x-nav-link>
                <x-nav-link wire:navigate.hover href="{{ route('page.donate') }}" :active="request()->routeIs('page.donate')">{{ __('Give Love') }}</x-nav-link>
                <x-nav-link wire:navigate.hover href="{{ route('page.volunteer') }}" :active="request()->routeIs('page.volunteer')">{{ __('Volunteers') }}</x-nav-link>
                <x-nav-link wire:navigate href="{{ route('page.dogs') }}" :active="request()->routeIs('page.dogs') || request()->routeIs('page.dog.single')">{{ __('Dogs') }}</x-nav-link>
                <x-nav-link wire:navigate.hover href="{{ route('page.blogs') }}" :active="request()->routeIs('page.blogs') || request()->routeIs('page.blog.single')">{{ __('Blogs') }}</x-nav-link>
                <x-nav-link wire:navigate.hover href="{{ route('page.contact') }}" :active="request()->routeIs('page.contact')">{{ __('Contact') }}</x-nav-link>
            </div>
        </div>

        </nav>
    </header>
</div>
