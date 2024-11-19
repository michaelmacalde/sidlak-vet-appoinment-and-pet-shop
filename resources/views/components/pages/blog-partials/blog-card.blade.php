@props(['blog_post_page'])
<a class="group sm:flex rounded-xl" href="{{ route('page.blog.single', $blog_post_page->post_slug) }}">
    <div class="flex-shrink-0 relative rounded-xl overflow-hidden h-[200px] sm:w-[250px] sm:h-[350px] w-full">
    <img class="absolute top-0 object-cover size-full start-0" src="{{ asset(Storage::url($blog_post_page->post_image)) }}" alt="{{ $blog_post_page->post_title }}">
    </div>

    <div class="grow">
    <div class="flex flex-col h-full p-4 sm:p-6">
        <div class="mb-3">
            @foreach ($blog_post_page->categories as $category )
                <span class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-full text-xs font-medium border border-amber-400 text-amber-400 dark:text-amber-500">
                    {{ $category->category_name }}
                </span>
            @endforeach

        </div>
        <h3 class="text-lg font-semibold text-gray-800 sm:text-2xl group-hover:text-amber-600 dark:text-neutral-300 dark:group-hover:text-white">
            {{ $blog_post_page->post_title }}
        </h3>
        <p class="mt-2 text-gray-600 dark:text-neutral-400">
            {{ $blog_post_page->post_content }}
        </p>

        <div class="mt-5 sm:mt-auto">
        <!-- Avatar -->
        <div class="flex items-center">
            <div class="flex-shrink-0">
            <img class="size-[46px] rounded-full" src="{{ $blog_post_page->author->profile_photo_url }}" alt="{{ $blog_post_page->author->name }}">
            </div>
            <div class="ms-2.5 sm:ms-4">
            <h4 class="font-semibold text-gray-800 dark:text-neutral-200">
                {{ $blog_post_page->author->name }}
            </h4>
            <p class="text-xs text-gray-500 dark:text-neutral-500">
               {{ $blog_post_page->created_at->diffForHumans() }}
            </p>
            </div>
        </div>
        <!-- End Avatar -->
        </div>
    </div>
    </div>
</a>
