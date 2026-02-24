@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-gray-600 bg-gray-700/50 text-gray-100 placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm transition-colors']) }}>
