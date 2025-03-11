
<div>
    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto my-10 lg:my-24">
        <h2 class="flex flex-row items-center mb-2 text-2xl font-bold text-gray-800 dark:text-neutral-200">

            <svg  class="flex-shrink-0 mr-4" width="24" height="24"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
              </svg>

            {{ __('Announcements') }}
        </h2>
        <p class="mb-6 text-gray-800 dark:text-neutral-200">{{ __('Only 3 dogs can be selected') }}</p>
        <div class="flex flex-col mb-6 bg-white border shadow-sm lg:mb-10 rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="p-4 md:p-10">
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">

                                @foreach ($announcements as $announcement)
                                <a href="{{ route('page.announcement-single', $announcement->id) }}">
                                    <div class="p-4 mb-5 border-t-2 border-teal-500 rounded-lg bg-teal-50 dark:bg-teal-800/30 lg:mb-7" role="alert" tabindex="-1" aria-labelledby="hs-bordered-success-style-label">
                                    <div class="flex">
                                      <div class="shrink-0">
                                        <!-- Icon -->
                                        <span class="inline-flex items-center justify-center text-teal-800 bg-teal-200 border-4 border-teal-100 rounded-full size-8 dark:border-teal-900 dark:bg-teal-800 dark:text-teal-400">



                                          <svg class="shrink-0 size-4" width="24" height="24"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                                          </svg>

                                        </span>
                                        <!-- End Icon -->
                                      </div>
                                      <div class="ms-3">
                                        <h3 id="hs-bordered-success-style-label" class="font-semibold text-gray-800 dark:text-white">
                                         {{ $announcement->announcement_title }}
                                        </h3>
                                        <div class="text-sm text-gray-700 dark:text-neutral-400">
                                            {!! str(Str::limit($announcement->announcement_content, 100))->sanitizeHtml() !!}
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

