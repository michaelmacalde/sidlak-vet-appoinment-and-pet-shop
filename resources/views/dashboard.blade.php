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
                        <a class="inline-flex items-center gap-2 px-1 py-4 text-sm font-medium border-b-2 text-amber-600 border-amber-500 whitespace-nowrap focus:outline-none focus:text-amber-800 dark:text-amber-500" href="{{ route('page.cart') }}" aria-current="page">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="10" r="3"></circle>
                            <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"></path>
                            </svg>
                            Selected Dog
                        </a>

                        <a class="inline-flex items-center gap-2 px-1 py-4 text-sm text-gray-500 border-b-2 border-transparent whitespace-nowrap hover:text-amber-600 focus:outline-none focus:text-amber-600 dark:text-neutral-500 dark:hover:text-amber-500 dark:focus:text-amber-500" href="{{ route('page.cart') }}">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"  width="24" height="24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                            Request
                        </a>
{{--


                        <a class="inline-flex items-center gap-2 px-1 py-4 text-sm text-gray-500 border-b-2 border-transparent whitespace-nowrap hover:text-amber-600 focus:outline-none focus:text-amber-600 dark:text-neutral-500 dark:hover:text-amber-500 dark:focus:text-amber-500" href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            Tab 3
                        </a> --}}
                    </nav>
                </div>
            </div>


            <div class="overflow-hidden bg-white border border-gray-200 shadow-sm lg:shadow-xl rounded-xl dark:bg-neutral-900 dark:border-neutral-700 sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
