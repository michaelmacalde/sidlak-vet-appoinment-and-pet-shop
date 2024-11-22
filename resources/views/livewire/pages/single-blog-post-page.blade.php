
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
                            @foreach ($post->categories as $category )
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-amber-400 text-amber-400" href="#">
                                    {{ $category->category_name }}
                                </span>
                            @endforeach
                        </div>

                        <p class="text-xs text-gray-800 sm:text-sm dark:text-neutral-200">{{ $post->created_at->diffForHumans() }}</p>
                    </div>

                    <figure>
                        <img class="object-cover w-full rounded-xl" src="{{ asset(Storage::url($post->post_image)) }}" alt="{{ $post->post_title }}">
                    </figure>
                    {{-- <br> --}}
                    {!! str($post->post_content)->sanitizeHtml() !!}
                    {{-- <br> --}}
                    <div class="grid lg:flex lg:justify-between lg:items-center gap-y-5 lg:gap-y-0">
                        <!-- Badges/Tags -->
                        <div>
                            @foreach ($post->categories as $category )
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-amber-400 text-amber-400" href="#">
                                    {{ $category->category_name }}
                                </span>

                            @endforeach
                        </div>
                        <!-- End Badges/Tags -->

                    </div>

                    <div class="grid flex-col lg:flex">
                        <livewire:pages.post-comments :post="$post"/>
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
                <h5 class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
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
