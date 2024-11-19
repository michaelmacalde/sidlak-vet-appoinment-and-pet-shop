@props(['breed'])
<a wire:key="{{ $breed->breed_secure_key }}" wire.navigate.hover href="{{ route('page.dogs', ['q' => $breed->breed_slug]) }}" class="flex items-center group gap-x-6">
    <div class="relative flex-shrink-0 overflow-hidden rounded-lg size-10">
        <img class="absolute top-0 object-cover rounded-lg size-full start-0" src="{{ asset(Storage::url($breed->breed_image)) }}" alt="{{ $breed->breed_name }}">
    </div>
    <div class="grow">
        <span class="text-sm font-bold text-gray-800 group-hover:text-amber-400 dark:text-neutral-200 dark:group-hover:text-amber-400">
            {{ $breed->breed_name }}
        </span>
    </div>

</a>
