@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center px-3 py-2 border-b-2 border-white text-sm font-bold leading-5 text-white focus:outline-none transition duration-150'
            : 'inline-flex items-center px-3 py-2 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-400 hover:text-white hover:border-gray-600 focus:outline-none focus:text-white focus:border-gray-600 transition duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
