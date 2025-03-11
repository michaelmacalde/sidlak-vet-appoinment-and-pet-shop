<div>
    <!-- Hero -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Grid -->
        <div class="grid my-16 lg:grid-cols-7 lg:gap-x-8 xl:gap-x-12 lg:items-center">
            <div class="lg:col-span-3">
                <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl md:text-5xl lg:text-6xl dark:text-white">Find Your Furry Friend Today!</h1>
                <p class="mt-3 text-lg text-gray-800 dark:text-neutral-400">At Sidlak Animal Welfare, we believe every dog deserves a loving home. Our mission is to rescue, rehabilitate, and rehome dogs in need, providing them with the care and compassion they deserve. </p>

                <!-- SearchBox -->
                <livewire:pages.dog-search/>
                <!-- End SearchBox -->

                <div class="flex flex-row gap-5 mt-8">
                <a href="{{ route('page.donate') }}" class="inline-flex items-center px-4 py-3 text-sm text-black border border-transparent gap-x-2 rounded-xl bg-amber-400 hover:bg-amber-500 disabled:opacity-50 disabled:pointer-events-none ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>
                    {{'Donate'}}
                </a>

                <a href="{{ route('page.volunteer') }}" class="inline-flex items-center px-4 py-3 text-sm font-semibold text-gray-500 border border-gray-500 gap-x-2 rounded-xl hover:border-gray-800 hover:text-gray-800 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-400 dark:text-neutral-400 dark:hover:text-neutral-300 dark:hover:border-neutral-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                    {{'Volunteer'}}
                </a>
                </div>

            </div>
            <!-- End Col -->

            <div class="mt-10 lg:col-span-4 lg:mt-0">
                <img class="w-full rounded-xl" src="https://images.pexels.com/photos/1174081/pexels-photo-1174081.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Image Description">
            </div>
            <!-- End Col -->
        </div>
        <!-- End Grid -->
    </div>
    <!-- End Hero -->

    <!-- Card Section -->
    <div class="max-w-5xl px-4 py-10 mx-auto sm:px-6 lg:px-8 lg:py-14">
    <!-- Grid -->
    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3 sm:gap-6">
    <!-- Card -->
    <a class="flex flex-col transition bg-white border shadow-sm group rounded-xl hover:shadow-md dark:bg-neutral-900 dark:border-neutral-800" href="#">
        <div class="p-4 md:p-5">
        <div class="flex">
            <svg class="flex-shrink-0 mt-1 text-gray-800 size-5 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>

            <div class="grow ms-5">
            <h3 class="font-semibold text-gray-800 group-hover:text-amber-600 dark:group-hover:text-neutral-400 dark:text-neutral-200">
                Ask our community
            </h3>
            <p class="text-sm text-gray-500 dark:text-neutral-500">
                Get help from 40k+ Preline users
            </p>
            </div>
        </div>
        </div>
    </a>
    <!-- End Card -->

    <!-- Card -->
    <a class="flex flex-col transition bg-white border shadow-sm group rounded-xl hover:shadow-md dark:bg-neutral-900 dark:border-neutral-800" href="#">
        <div class="p-4 md:p-5">
        <div class="flex">
            <svg class="flex-shrink-0 mt-1 text-gray-800 size-5 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>

            <div class="grow ms-5">
            <h3 class="font-semibold text-gray-800 group-hover:text-amber-600 dark:group-hover:text-neutral-400 dark:text-neutral-200">
                Get help in the app
            </h3>
            <p class="text-sm text-gray-500 dark:text-neutral-500">
                Just head to «Help» in the app
            </p>
            </div>
        </div>
        </div>
    </a>
    <!-- End Card -->

    <!-- Card -->
    <a class="flex flex-col transition bg-white border shadow-sm group rounded-xl hover:shadow-md dark:bg-neutral-900 dark:border-neutral-800" href="#">
        <div class="p-4 md:p-5">
        <div class="flex">
            <svg class="flex-shrink-0 mt-1 text-gray-800 size-5 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.2 8.4c.5.38.8.97.8 1.6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 .8-1.6l8-6a2 2 0 0 1 2.4 0l8 6Z"/><path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10"/></svg>

            <div class="grow ms-5">
            <h3 class="font-semibold text-gray-800 group-hover:text-amber-600 dark:group-hover:text-neutral-400 dark:text-neutral-200">
                Email us
            </h3>
            <p class="text-sm text-gray-500 dark:text-neutral-500">
                Reach us at <span class="font-medium text-amber-600 decoration-2 group-hover:underline dark:text-amber-500">info@site.com</span>
            </p>
            </div>
        </div>
        </div>
    </a>
    <!-- End Card -->
    </div>
    <!-- End Grid -->
    </div>
    <!-- End Card Section -->


    <!-- Features -->
    <div class="px-4 py-10 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:py-14">
        <div class="relative p-6 md:p-16">
        <!-- Grid -->
        <div class="relative z-10 lg:grid lg:grid-cols-12 lg:gap-16 lg:items-center">
            <div class="mb-10 lg:mb-0 lg:col-span-6 lg:col-start-8 lg:order-2">
            <h2 class="text-2xl font-bold text-gray-800 sm:text-3xl dark:text-neutral-200">
                Why Adopt From Us?
            </h2>

            <!-- Tab Navs -->
            <nav class="grid gap-4 mt-5 md:mt-10" aria-label="Tabs" role="tablist">
                <button type="button" class="p-4 hs-tab-active:bg-white hs-tab-active:shadow-md hs-tab-active:hover:border-transparent text-start hover:bg-gray-200 md:p-5 rounded-xl dark:hs-tab-active:bg-neutral-700 dark:hover:bg-neutral-700 active" id="tabs-with-card-item-1" data-hs-tab="#tabs-with-card-1" aria-controls="tabs-with-card-1" role="tab">
                <span class="flex">
                    <svg class="flex-shrink-0 mt-2 text-gray-800 size-6 md:size-7 hs-tab-active:text-amber-600 dark:hs-tab-active:text-amber-500 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>


                    <span class="grow ms-6">
                    <span class="block text-lg font-semibold text-gray-800 hs-tab-active:text-amber-600 dark:hs-tab-active:text-amber-500 dark:text-neutral-200">Wide Variety of Dogs:</span>
                    <span class="block mt-1 text-gray-800 dark:hs-tab-active:text-gray-200 dark:text-neutral-200">We have dogs of all ages, sizes, and breeds, each with a unique personality ready to bring joy to your home.</span>
                    </span>
                </span>
                </button>

                <button type="button" class="p-4 hs-tab-active:bg-white hs-tab-active:shadow-md hs-tab-active:hover:border-transparent text-start hover:bg-gray-200 md:p-5 rounded-xl dark:hs-tab-active:bg-neutral-700 dark:hover:bg-neutral-700" id="tabs-with-card-item-2" data-hs-tab="#tabs-with-card-2" aria-controls="tabs-with-card-2" role="tab">
                <span class="flex">
                    <svg class="flex-shrink-0 mt-2 text-gray-800 size-6 md:size-7 hs-tab-active:text-amber-600 dark:hs-tab-active:text-amber-500 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                    <span class="grow ms-6">
                    <span class="block text-lg font-semibold text-gray-800 hs-tab-active:text-amber-600 dark:hs-tab-active:text-amber-500 dark:text-neutral-200">Health and Wellness:</span>
                    <span class="block mt-1 text-gray-800 dark:hs-tab-active:text-gray-200 dark:text-neutral-200">All our dogs are vaccinated, spayed/neutered, and undergo regular health checks to ensure they are ready for a happy life with you.</span>
                    </span>
                </span>
                </button>

                <button type="button" class="p-4 hs-tab-active:bg-white hs-tab-active:shadow-md hs-tab-active:hover:border-transparent text-start hover:bg-gray-200 md:p-5 rounded-xl dark:hs-tab-active:bg-neutral-700 dark:hover:bg-neutral-700" id="tabs-with-card-item-3" data-hs-tab="#tabs-with-card-3" aria-controls="tabs-with-card-3" role="tab">
                <span class="flex">
                    <svg class="flex-shrink-0 mt-2 text-gray-800 size-6 md:size-7 hs-tab-active:text-amber-600 dark:hs-tab-active:text-amber-500 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/></svg>
                    <span class="grow ms-6">
                    <span class="block text-lg font-semibold text-gray-800 hs-tab-active:text-amber-600 dark:hs-tab-active:text-amber-500 dark:text-neutral-200">Supportive Community: </span>
                    <span class="block mt-1 text-gray-800 dark:hs-tab-active:text-gray-200 dark:text-neutral-200">Our team offers lifelong support to ensure a smooth transition for both you and your new furry friend.</span>
                    </span>
                </span>
                </button>
            </nav>
            <!-- End Tab Navs -->
            </div>
            <!-- End Col -->

            <div class="lg:col-span-6">
            <div class="relative">
                <!-- Tab Content -->
                <div>
                <div id="tabs-with-card-1" role="tabpanel" aria-labelledby="tabs-with-card-item-1">
                    <img class="shadow-xl shadow-gray-200 rounded-xl dark:shadow-gray-900/20" src="https://images.pexels.com/photos/3628100/pexels-photo-3628100.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Image Description">
                </div>

                <div id="tabs-with-card-2" class="hidden" role="tabpanel" aria-labelledby="tabs-with-card-item-2">
                    <img class="shadow-xl shadow-gray-200 rounded-xl dark:shadow-gray-900/20" src="https://images.pexels.com/photos/7474855/pexels-photo-7474855.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Image Description">
                </div>

                <div id="tabs-with-card-3" class="hidden" role="tabpanel" aria-labelledby="tabs-with-card-item-3">
                    <img class="shadow-xl shadow-gray-200 rounded-xl dark:shadow-gray-900/20" src="https://images.pexels.com/photos/609771/pexels-photo-609771.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Image Description">
                </div>
                </div>
                <!-- End Tab Content -->

                <!-- SVG Element -->
                <div class="absolute top-0 hidden translate-x-20 end-0 md:block lg:translate-x-20">
                <svg class="w-16 h-auto text-orange-500" width="121" height="135" viewBox="0 0 121 135" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 16.4754C11.7688 27.4499 21.2452 57.3224 5 89.0164" stroke="currentColor" stroke-width="10" stroke-linecap="round"/>
                    <path d="M33.6761 112.104C44.6984 98.1239 74.2618 57.6776 83.4821 5" stroke="currentColor" stroke-width="10" stroke-linecap="round"/>
                    <path d="M50.5525 130C68.2064 127.495 110.731 117.541 116 78.0874" stroke="currentColor" stroke-width="10" stroke-linecap="round"/>
                </svg>
                </div>
                <!-- End SVG Element -->
            </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Grid -->

        <!-- Background Color -->
        <div class="absolute inset-0 grid grid-cols-12 size-full">
            <div class="w-full bg-gray-100 col-span-full lg:col-span-7 lg:col-start-6 h-5/6 rounded-xl sm:h-3/4 lg:h-full dark:bg-neutral-800"></div>
        </div>
        <!-- End Background Color -->
        </div>
    </div>
    <!-- End Features -->


    <!-- Features -->
    <div class="py-10 bg-slate-200 dark:bg-neutral-900 lg:py-24">
        <div class="px-4 py-10 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:py-14">
            <!-- Title -->
            <div class="max-w-2xl mx-auto mb-8 text-center lg:mb-14">
                <h2 class="text-3xl font-bold text-gray-800 lg:text-4xl dark:text-neutral-200">
                Dog Lists
                </h2>
                <p class="mt-3 text-gray-800 dark:text-neutral-200">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Qui, tenetur.
                </p>
            </div>
            <!-- End Title -->

            <!-- Grid -->
            <div class="grid items-center grid-cols-12 mt-20 gap-x-2 sm:gap-x-6 lg:gap-x-8">

                @foreach ($displayIndexDogs as $dogKey => $dog )
                <div class="{{ $dogKey == 0 ? 'hidden md:block' : '' }} col-span-4 md:col-span-3">
                    <x-home-page-partials.dog-card :$dog wire:key="home-dog-{{ $dog->id . '-' . $dog->dog_slug }}"/>
                </div>
                @endforeach

            </div>
            <!-- End Grid -->

            <!-- Card -->
            <div class="mt-16 text-center">
                <div class="inline-block bg-white border rounded-full shadow-sm dark:bg-neutral-900 dark:border-neutral-800">
                    <div class="flex items-center px-4 py-3 gap-x-2">
                    <p class="text-gray-600 dark:text-neutral-400">
                        {{ __('Want to view more?') }}
                    </p>
                    <a class="inline-flex items-center gap-x-1.5 text-amber-600 decoration-2 hover:underline font-medium dark:text-amber-500" href="{{ route('page.dogs') }}">
                        {{ __('Go here') }}
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
    <!-- End Features -->

    <!-- Card Blog -->
    <div class="px-4 py-10 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:py-24">
    <!-- Title -->
    <div class="max-w-2xl mx-auto mb-10 text-center lg:mb-14">
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Read our latest news</h2>
    <p class="mt-1 text-gray-600 dark:text-neutral-400">We've helped some great companies brand, design and get to market.</p>
    </div>
    <!-- End Title -->
    <!-- Grid -->
    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Card -->
        @foreach ($displayIndexPosts as $post_index )
            <x-blog-partials.blog-card :$post_index wire:key="home-dog-{{ $dog->id }}" />
        @endforeach
        <!-- End Card -->
    </div>
    <!-- End Grid -->

    <!-- Card -->
    <div class="mt-16 text-center">
        <div class="inline-block bg-white border rounded-full shadow-sm dark:bg-neutral-900 dark:border-neutral-800">
            <div class="flex items-center px-4 py-3 gap-x-2">
            <p class="text-gray-600 dark:text-neutral-400">
                Want to read more?
            </p>
            <a class="inline-flex items-center gap-x-1.5 text-amber-600 decoration-2 hover:underline font-medium dark:text-amber-500" href="{{ route('page.blogs') }}">
                Go here
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </a>
            </div>
        </div>
    </div>
    <!-- End Card -->
    </div>
    <!-- End Card Blog -->

    <!-- Subscribe -->
    {{-- <div class="max-w-full px-4 py-10 mx-auto sm:px-6 lg:px-8 lg:py-16 bg-slate-200 dark:bg-neutral-700">
    <div class="grid gap-8 mx-auto md:grid-cols-2 max-w-7xl">
    <div class="max-w-md">
        <h2 class="text-2xl font-bold md:text-3xl md:leading-tight dark:text-white">Subscribe</h2>
        <p class="mt-3 text-gray-600 dark:text-neutral-400">
        Subscribe and start making the most of every engagement.
        </p>
    </div>

    <form>
        <div class="w-full sm:max-w-lg md:ms-auto">
        <div class="flex flex-col items-center gap-2 sm:flex-row sm:gap-3">
            <div class="w-full">
            <label for="hero-input" class="sr-only">Search</label>
            <input type="text" id="hero-input" name="hero-input" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-200 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Enter your email">
            </div>
            <a class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-semibold text-black border border-transparent rounded-lg sm:w-auto whitespace-nowrap gap-x-2 bg-amber-400 hover:bg-amber-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
            Subscribe
            </a>
        </div>
        <p class="mt-3 text-sm text-gray-500 dark:text-neutral-500">
            No spam, unsubscribe at any time
        </p>
        </div>
    </form>
    </div>
    </div> --}}
    <!-- End Subscribe -->
</div>

