<div>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:mt-5 lg:my-16">
        <div class="grid lg:grid-cols-3 gap-y-8 lg:gap-y-0 lg:gap-x-6">
        <!-- Content -->
        <div class="lg:col-span-2">
            <div class="py-8 lg:pe-8">
                <div class="space-y-5 lg:space-y-8 text-gray-800 dark:text-neutral-300 [&>ul]:list-disc [&>ul]:ml-4 [&_h1]:text-4xl [&_h2]:text-3xl [&_h3]:text-2xl [&_h4]:text-xl [&_h5]:text-lg [&_h6]:text-base">
                    <a class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline dark:text-amber-400" href="{{ route('page.announcements') }}" wire:navigate.hover>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    {{ __('Back to Announcements') }}
                    </a>

                    <h2 class="text-3xl font-bold lg:text-5xl dark:text-white">{{ $announcement->announcement_title }}</h2>

                    <div class="flex items-center justify-between gap-x-3">
                        <p class="text-xs text-gray-800 sm:text-sm dark:text-neutral-200">{{ \Carbon\Carbon::parse($announcement->created_at)->diffForHumans() }}</p>
                    </div>

                    <figure>
                        <img class="object-cover w-full rounded-xl" src="{{ asset(Storage::url($announcement->announcement_img)) }}" alt="{{ $announcement->announcement_title }}">
                    </figure>

                    <div class="space-y-5">
                        {!! str($announcement->announcement_content)->sanitizeHtml() !!}
                    </div>

                    <div class="grid lg:flex lg:justify-between lg:items-center gap-y-5 lg:gap-y-0">
                        <!-- Badges/Tags -->
                        <div>
                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-amber-400 text-amber-400">
                                {{ $announcement->category->category_name }}
                            </span>
                        </div>
                        <!-- End Badges/Tags -->

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
                <img class="rounded-full size-10" src="{{ $announcement->user->profile_photo_url }}" alt="{{ $announcement->user->name }}">
                </div>

                <div class="block group grow">
                <h5 class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                    {{ $announcement->user->name }}
                </h5>
                <p class="text-sm text-gray-500 dark:text-neutral-500">
                   {{ __('Announcement author') }}
                </p>
                </div>

            </div>

        </div>
        <!-- End Sidebar -->
        </div>
    </div>
</div>
