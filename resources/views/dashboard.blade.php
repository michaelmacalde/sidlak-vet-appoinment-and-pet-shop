<x-app-layout>
    <div class="py-12 mb-10 lg:mb-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="flex flex-col items-center justify-between mb-6 lg:flex-row">
                <div class="p-6 overflow-hidden lg:p-8 ">

                    <h2 class="flex flex-row items-center mb-2 text-2xl font-bold text-gray-800 dark:text-neutral-200">
                        <svg class="flex-shrink-0 mr-4" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                        {{ __('Dashboard') }}
                    </h2>

                    <p class="mb-6 text-gray-800 dark:text-neutral-200">
                        {{ __('Welcome to your dashboard') }}

                        <span class="inline-flex items-center px-3 py-1 mt-3 font-medium text-yellow-800 bg-yellow-100 rounded-full lg:mt-0 lg:ml-3 gap-x-1 dark:bg-yellow-500/10 dark:text-yellow-500">
                            <svg class="size-3.5"  width="16" height="16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>

                            {{ Auth::user()->name }}
                        </span>

                    </p>
                </div>

                <div class="border-b-2 border-gray-200 dark:border-neutral-700">
                    <nav class="-mb-0.5 flex gap-x-6">
                        {{-- cart for dogs --}}
                        <a class="inline-flex items-center gap-2 px-1 py-4 text-sm font-medium border-b-2 text-amber-600 border-amber-500 whitespace-nowrap focus:outline-none focus:text-amber-800 dark:text-amber-500" href="{{ route('page.cart') }}" aria-current="page">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="10" r="3"></circle>
                            <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"></path>
                            </svg>
                            Selected Dog
                        </a>
                        {{-- cart for ecommerce --}}
                        

                        <a class="inline-flex items-center gap-2 px-1 py-4 text-sm text-gray-500 border-b-2 border-transparent whitespace-nowrap hover:text-amber-600 focus:outline-none focus:text-amber-600 dark:text-neutral-500 dark:hover:text-amber-500 dark:focus:text-amber-500" href="{{ route('page.cart') }}">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"  width="24" height="24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                            Request
                        </a>

                        @if(Auth::user()->hasRole('volunteer'))
                        <a class="inline-flex items-center gap-2 px-1 py-4 text-sm text-gray-500 border-b-2 border-transparent whitespace-nowrap hover:text-amber-600 focus:outline-none focus:text-amber-600 dark:text-neutral-500 dark:hover:text-amber-500 dark:focus:text-amber-500" href="{{ route('page.announcements') }}">

                            <svg class="shrink-0 size-4" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                            </svg>

                            Announcements
                        </a>
                        @endif
                    </nav>
                </div>
            </div>


            <div class="overflow-hidden bg-white border border-gray-200 shadow-sm lg:shadow-xl rounded-xl dark:bg-neutral-900 dark:border-neutral-700 sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
