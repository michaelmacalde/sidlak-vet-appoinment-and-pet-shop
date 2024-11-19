<div class="flex justify-between md:col-span-1">
    <div class="px-4 sm:px-0">
        <h3 class="font-bold text-gray-800 lg:text-lg dark:text-white">{{ $title }}</h3>

        <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>
