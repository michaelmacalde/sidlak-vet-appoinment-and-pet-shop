<div>
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-20 mx-auto lg:mb-10">
        <div class="max-w-2xl mx-auto lg:max-w-5xl">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-800 sm:text-4xl dark:text-white">
            Contact us
            </h1>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">
            We'd love to talk about how we can help you.
            </p>
        </div>

        <div class="grid items-center gap-6 mt-12 lg:grid-cols-2 lg:gap-16">
            <!-- Card -->
            <div class="flex flex-col p-4 border rounded-xl sm:p-6 lg:p-8 dark:border-neutral-700">
            <h2 class="mb-4 text-xl font-semibold text-gray-800 dark:text-neutral-200">
                {{ __('Fill in the form') }}
            </h2>

            <p class="mb-8 text-gray-600 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200">{{ __('All fields are required.') }}</p>

            <x-forms.contact-page-form/>


            </div>
            <!-- End Card -->

            <div class="divide-y divide-gray-200 dark:divide-neutral-800">

            <!-- Icon Block -->
            <div class="flex py-6 gap-x-7">
                <svg class="flex-shrink-0 size-6 mt-1.5 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v5Z"/><path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"/></svg>
                <div class="grow">
                <h3 class="font-semibold text-gray-800 dark:text-neutral-200">FAQ</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">{{ __('Search our FAQ for answers to anything you might ask.') }}</p>
                <a class="inline-flex items-center mt-2 text-sm font-medium text-gray-600 gap-x-2 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200" href="#">
                    Visit FAQ
                    <svg class="flex-shrink-0 size-2.5 transition ease-in-out group-hover:translate-x-1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.975821 6.92249C0.43689 6.92249 -3.50468e-07 7.34222 -3.27835e-07 7.85999C-3.05203e-07 8.37775 0.43689 8.79749 0.975821 8.79749L12.7694 8.79748L7.60447 13.7596C7.22339 14.1257 7.22339 14.7193 7.60447 15.0854C7.98555 15.4515 8.60341 15.4515 8.98449 15.0854L15.6427 8.68862C16.1191 8.23098 16.1191 7.48899 15.6427 7.03134L8.98449 0.634573C8.60341 0.268455 7.98555 0.268456 7.60447 0.634573C7.22339 1.00069 7.22339 1.59428 7.60447 1.9604L12.7694 6.92248L0.975821 6.92249Z" fill="currentColor"/>
                    </svg>
                </a>
                </div>
            </div>
            <!-- End Icon Block -->

            <!-- Icon Block -->
            <div class="flex py-6  gap-x-7">
                <svg class="flex-shrink-0 size-6 mt-1.5 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.2 8.4c.5.38.8.97.8 1.6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 .8-1.6l8-6a2 2 0 0 1 2.4 0l8 6Z"/><path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10"/></svg>
                <div class="grow">
                <h3 class="font-semibold text-gray-800 dark:text-neutral-200">Contact us by email</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">If you wish to write us an email instead please use</p>
                <a class="inline-flex items-center mt-2 text-sm font-medium text-gray-600 gap-x-2 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200" href="#">
                    example@site.com
                </a>
                </div>
            </div>
            <!-- End Icon Block -->
            </div>
        </div>
        </div>
    </div>
</div>
