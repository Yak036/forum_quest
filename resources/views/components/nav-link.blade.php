@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex uppercase items-center px-1 pt-1 border-b-2 border-yellow-500 text-sm text-yellow-500 font-medium'
            : 'inline-flex uppercase items-center px-1 pt-1 border-b-2 border-transparent text-sm text-white hover:text-yellow-500 hover:border-yellow-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
