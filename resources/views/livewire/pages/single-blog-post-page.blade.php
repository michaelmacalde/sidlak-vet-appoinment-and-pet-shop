
<div>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:mt-5 lg:my-16">
        <div class="grid lg:grid-cols-3 gap-y-8 lg:gap-y-0 lg:gap-x-6">
        <!-- Content -->
        <div class="lg:col-span-2">
            <div class="py-8 lg:pe-8">
            <div class="space-y-5 lg:space-y-8 text-gray-800 dark:text-neutral-300 [&>ul]:list-disc [&>ul]:ml-4 [&_h1]:text-4xl [&_h2]:text-3xl [&_h3]:text-2xl [&_h4]:text-xl [&_h5]:text-lg [&_h6]:text-base">
                <a class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline dark:text-amber-400" href="{{ route('page.blogs') }}"  wire:navigate.hover>
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                {{ __('Back to Blog') }}
                </a>

                <h2 class="text-3xl font-bold lg:text-5xl dark:text-white">{{ $post->post_title }}</h2>

                <div class="flex items-center justify-between gap-x-3">
                    <div>
                        {{-- @foreach ($post->categories as $category )
                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-amber-400 text-amber-400" href="#">
                                {{ $category->category_name }}
                            </span>
                        @endforeach --}}
                    </div>

                    <p class="text-xs text-gray-800 sm:text-sm dark:text-neutral-200">{{ $post->created_at->diffForHumans() }}</p>
                </div>

                <figure>
                    <img class="object-cover w-full rounded-xl" src="{{ asset(Storage::url($post->post_image)) }}" alt="{{ $post->post_title }}">
                </figure>
                {{-- <br> --}}
                {!! $post->post_content !!}
                {{-- <br> --}}
                <div class="grid lg:flex lg:justify-between lg:items-center gap-y-5 lg:gap-y-0">
                <!-- Badges/Tags -->
                <div>
                    <a class="m-0.5 inline-flex items-center gap-1.5 py-2 px-3 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:text-neutral-200" href="#">
                    Plan
                    </a>
                    <a class="m-0.5 inline-flex items-center gap-1.5 py-2 px-3 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:text-neutral-200" href="#">
                    Web development
                    </a>
                    <a class="m-0.5 inline-flex items-center gap-1.5 py-2 px-3 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:text-neutral-200" href="#">
                    Free
                    </a>
                    <a class="m-0.5 inline-flex items-center gap-1.5 py-2 px-3 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:text-neutral-200" href="#">
                    Team
                    </a>
                </div>
                <!-- End Badges/Tags -->

                <div class="flex justify-end items-center gap-x-1.5">
                    <!-- Button -->
                    <div class="inline-block hs-tooltip">
                    <button type="button" class="flex items-center text-sm text-gray-500 hs-tooltip-toggle gap-x-2 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                        875
                        <span class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible dark:bg-black" role="tooltip">
                        Like
                        </span>
                    </button>
                    </div>
                    <!-- Button -->

                    <div class="block h-3 mx-3 border-gray-300 border-e dark:border-neutral-600"></div>

                    <!-- Button -->
                    <div class="inline-block hs-tooltip">
                    <button type="button" class="flex items-center text-sm text-gray-500 hs-tooltip-toggle gap-x-2 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"/></svg>
                        16
                        <span class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible dark:bg-black" role="tooltip">
                        Comment
                        </span>
                    </button>
                    </div>
                    <!-- Button -->

                    <div class="block h-3 mx-3 border-gray-300 border-e dark:border-neutral-600"></div>

                    <!-- Button -->
                    <div class="relative inline-flex hs-dropdown">
                    <button type="button" id="blog-article-share-dropdown" class="flex items-center text-sm text-gray-500 hs-dropdown-toggle gap-x-2 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16 6 12 2 8 6"/><line x1="12" x2="12" y1="2" y2="15"/></svg>
                        Share
                    </button>
                    <div class="hs-dropdown-menu w-56 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden mb-1 z-10 bg-gray-900 shadow-md rounded-xl p-2 dark:bg-black" aria-labelledby="blog-article-share-dropdown">
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:ring-neutral-400" href="#">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                        Copy link
                        </a>
                        <div class="my-2 border-t border-gray-600 dark:border-neutral-800"></div>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:ring-neutral-400" href="#">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                        </svg>
                        Share on Twitter
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:ring-neutral-400" href="#">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                        </svg>
                        Share on Facebook
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:ring-neutral-400" href="#">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                        </svg>
                        Share on LinkedIn
                        </a>
                    </div>
                    </div>
                    <!-- Button -->
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- End Content -->

        <!-- Sidebar -->
        <div class="lg:col-span-1 lg:w-full lg:h-full lg:bg-gradient-to-r lg:from-gray-50 lg:via-transparent lg:to-transparent dark:from-neutral-800">
            <div class="sticky top-0 py-8 start-0 lg:ps-8">
            <!-- Avatar Media -->
            <div class="flex items-center pb-8 mb-8 border-b border-gray-200 group gap-x-3 dark:border-neutral-700">

                <div class="flex-shrink-0 block">
                <img class="rounded-full size-10" src="{{ $post->author->profile_photo_url }}" alt="{{ $post->author->name }}">
                </div>

                <div class="block group grow">
                <h5 class="text-sm font-semibold text-gray-800  dark:text-neutral-200">
                    {{ $post->author->name }}
                </h5>
                <p class="text-sm text-gray-500 dark:text-neutral-500">
                   {{ __('Post author') }}
                </p>
                </div>

                <div class="grow">
                {{-- <div class="flex justify-end">
                    <button type="button" class="py-1.5 px-2.5 inline-flex items-center gap-x-2 text-xs font-semibold rounded-lg border border-transparent bg-amber-400 text-white hover:bg-amber-400 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                    Follow
                    </button>
                </div> --}}
                </div>
            </div>
            <!-- End Avatar Media -->

            <div class="space-y-6">
                {{-- @foreach ($getCategories as $category )
                    <x-pages.blog-partials.category-tag :$category wire:key="category-{{ $category->id }}" />
                @endforeach --}}
            </div>

            <div class="space-y-6">

                @foreach ($relatedPosts as $relatedPost )

                <!-- Media -->
                <a wire:navigate.hover class="flex items-center group gap-x-6" href="{{ route('page.blog.single', $relatedPost->post_slug) }}">
                    <div class="grow">
                        <h5 class="font-bold text-gray-800 text-md group-hover:text-amber-400 dark:text-neutral-200 dark:group-hover:text-amber-400">
                        {{ $relatedPost->post_title }}
                        </h5>
                    </div>

                    <div class="relative flex-shrink-0 overflow-hidden rounded-lg size-20">
                        <img class="absolute top-0 object-cover rounded-lg size-full start-0" src="{{ asset(Storage::url($relatedPost->post_image)) }}" alt="{{ $relatedPost->post_title }}">
                    </div>
                </a>
                <!-- End Media -->

                @endforeach

            </div>
            </div>
        </div>
        <!-- End Sidebar -->
        </div>
    </div>
</div>
