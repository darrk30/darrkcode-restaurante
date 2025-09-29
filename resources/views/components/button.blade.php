@props([
    'color' => 'gray',
    'icon' => null,
    'title' => null,
])

@php
    $baseClasses = 'inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium focus:outline-none focus:ring-2 transition-colors duration-150';

    $colors = [
        'blue' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-300',
        'red' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-300',
        'green' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-300',
        'gray' => 'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-300',
    ];
@endphp

<button {{ $attributes->merge(['class' => "$baseClasses {$colors[$color]}"]) }} title="{{ $title }}">
    @if ($icon)
        <i class="{{ $icon }} mr-1"></i>
    @endif
    {{ $slot }}
</button>
