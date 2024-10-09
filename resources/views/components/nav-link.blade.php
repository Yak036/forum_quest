@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex uppercase items-center px-1 pt-1 border-b-2 border-blue-600 dark:border-indigo-600 text-sm text-white/90'
            : 'inline-flex uppercase items-center px-1 pt-1 border-b-2 border-transparent text-sm text-gray-600 dark:text-white hover:text-white dark:hover:text-gray-300 hover:border-blue-600 dark:hover:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
