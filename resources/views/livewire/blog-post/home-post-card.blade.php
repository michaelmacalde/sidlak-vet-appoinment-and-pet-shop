<div>
    @foreach ($blogPost as $index_post)
        <a class="group sm:flex rounded-xl" href="{{ route('blog.view', $index_post->post_slug) }}">
            <div class="flex-shrink-0 relative rounded-xl overflow-hidden h-[200px] sm:w-[250px] sm:h-[350px] w-full">
            <img class="absolute top-0 object-cover size-full start-0" src="{{ asset(Storage::url($index_post->post_image)) }}" alt="{{ $index_post->post_title }}">
            </div>

            <div class="grow">
            <div class="flex flex-col h-full p-4 sm:p-6">
                <div class="mb-3">
                    @foreach ($index_post->categories as $index_category)
                    <p class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-amber-400 text-amber-400">
                        {{ $index_category->category_name }}
                    </p>
                    @endforeach
                </div>
                <h3 class="text-lg font-semibold text-gray-800 sm:text-2xl group-hover:text-amber-600 dark:text-neutral-300 dark:group-hover:text-white">
                    {{ $index_post->post_title }}
                </h3>
                <p class="mt-2 text-gray-600 dark:text-neutral-400">
                {{ truncate_html($index_post->post_content) }}
                </p>

                <div class="mt-5 sm:mt-auto">
                <!-- Avatar -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                    <img class="size-[46px] rounded-full" src="{{ $index_post->author->profile_photo_url }}" alt="{{ $index_post->author->name }}">
                    </div>
                    <div class="ms-2.5 sm:ms-4">
                    <h4 class="font-semibold text-gray-800 dark:text-neutral-200">
                        {{ $index_post->author->name }}
                    </h4>
                    <p class="text-xs text-gray-500 dark:text-neutral-500">
                        {{ $index_post->created_at->diffForHumans() }}
                    </p>
                    </div>
                </div>
                <!-- End Avatar -->
                </div>
            </div>
            </div>
        </a>
    @endforeach
</div>
