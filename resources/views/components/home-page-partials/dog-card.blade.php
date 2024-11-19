@props(['dog'])
<div wire:key="home-dog-{{ $dog->id . '-' . $dog->dog_slug }}" class="bg-center bg-no-repeat">
    <a href="{{ route('page.dog.single', $dog->dog_slug) }}">
        <img class="rounded-xl w-auto h-auto max-h-[300px] sm:max-h-[400px] md:max-h-[500px] lg:max-h-[300px] xl:max-h-[400px]" src="{{ asset(Storage::url($dog->dog_image[0]['dog_image'])) }}" alt="{{ $dog->dog_name }}">
    </a>
</div>
