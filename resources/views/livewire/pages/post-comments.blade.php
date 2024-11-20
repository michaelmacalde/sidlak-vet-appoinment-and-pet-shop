<!-- Comment Form -->
<div class="px-4 py-10 mx-auto sm:px-6 lg:px-8 lg:py-14">
    <div class="max-w-2xl mx-auto">
      <div class="text-center">
        <h2 class="text-xl font-bold text-gray-800 sm:text-3xl dark:text-white">
          Post a comment
        </h2>
      </div>

      <!-- Card -->
      <div class="relative z-10 p-4 mt-5 bg-white border rounded-xl sm:mt-10 md:p-10 dark:bg-neutral-900 dark:border-neutral-700">
        @if(auth()->check())
        <form wire:submit.prevent="submitComment" class="mb-4">
          <div class="mb-4 sm:mb-8">
          <div>
            <label for="content" class="block mb-2 text-sm font-medium dark:text-white">{{'Comment'}}</label>
            <div class="mt-1">
              <textarea
              wire:model="content"
              id="content"
              name="content"
              rows="3" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Leave your comment here..."></textarea>
            </div>
          </div>

          <div class="grid mt-6">
            <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white border border-transparent rounded-lg gap-x-2 bg-amber-600 hover:bg-amber-700 focus:outline-none focus:bg-amber-700 disabled:opacity-50 disabled:pointer-events-none">{{'Submit Comment'}}</button>
          </div>
        </form>
        @else
        <p>
            <div class="flex flex-row items-center justify-center">
                <div class="mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                    </svg>
                </div>


                <div class="text-gray-800 dark:text-neutral-400">
                    Please <a class="mx-4 font-medium text-amber-600 decoration-2 hover:underline focus:outline-none focus:underline dark:text-amber-500" href="{{ route('login') }}">login</a> to comment
                </div>
            </div>
        </p>
        @endif

      </div>
      <!-- End Card -->

      <div class="mt-5 lg:mt-7 comments-section">
        <h4 class="my-4 text-xl font-bold">Comments ({{ $comments->count() }})</h4>
        @forelse($comments as $comment)
        <div class="mb-4 comment">
            <strong class="text-gray-900 dark:text-white">{{ $comment->user->name }}</strong>
            <p class="mb-3 ml-5 text-gray-800 lg:ml-8 dark:text-neutral-400">{{ $comment->content }}</p>
            <small class="py-4 ml-5 text-xs text-gray-500 lg:ml-8 dark:text-neutral-500">
                <div class="flex flex-row items-center justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>

                    {{ $comment->created_at->diffForHumans() }}
                </div>
            </small>
            <hr class="my-4">
        </div>
        @empty
        <p class="text-gray-800 dark:text-neutral-400">No comments yet.</p>
        @endforelse
    </div>
    </div>
  </div>
  <!-- End Comment Form -->
