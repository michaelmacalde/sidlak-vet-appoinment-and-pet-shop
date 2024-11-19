@props(['active'])

@php
$classes = ($active ?? false)
            ? 'font-medium text-amber-400'
            : 'font-medium text-gray-600 hover:text-gray-400 dark:text-neutral-400 dark:hover:text-neutral-500';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
