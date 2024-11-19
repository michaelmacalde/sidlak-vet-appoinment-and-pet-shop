<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6 ']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2 ">
        <div class="px-4 py-5 bg-white border shadow-sm sm:p-6 rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
            {{ $content }}
        </div>
    </div>
</div>
