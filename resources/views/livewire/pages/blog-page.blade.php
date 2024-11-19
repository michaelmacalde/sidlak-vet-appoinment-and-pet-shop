<div >
    <div class="lg:my-16">
        <div class="px-4 py-10 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:py-14">
            <!-- Grid -->
            <div class="grid gap-6 lg:grid-cols-2">
                @foreach ($blogPostsPage as $blog_post_page )
                    <x-pages.blog-partials.blog-card wire:key="blog-post-{{ $blog_post_page->id }}" :$blog_post_page />
                @endforeach
            </div>
            <!-- End Grid -->

            <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto mt-16 py-6">
                {{ $blogPostsPage->links('vendor.pagination.sdas-pagination') }}
            </div>
        </div>
    </div>
</div>
