@props([
    'title' => '',
    'type' => 'info',
])

@php
    $colors = [
        'info' => 'bg-blue-50 border-blue-500 text-blue-800',
        'warning' => 'bg-yellow-50 border-yellow-500 text-yellow-800',
        'success' => 'bg-green-50 border-green-500 text-green-800',
        'danger' => 'bg-red-50 border-red-500 text-red-800',
    ];

    $icons = [
        'info' => 'fas fa-info-circle',
        'warning' => 'fas fa-exclamation-triangle',
        'success' => 'fas fa-check-circle',
        'danger' => 'fas fa-times-circle',
    ];

    $colorClass = $colors[$type] ?? $colors['info'];
    $icon = $icons[$type] ?? $icons['info'];
@endphp

<div class="p-4 rounded-lg shadow-sm border-l-4 {{ $colorClass }}">
    <div class="flex items-start">
        <div class="mr-3">
            <i class="{{ $icon }} text-2xl"></i>
        </div>
        <div>
            <h3 class="font-semibold text-lg">{{ $title }}</h3>
            <p class="text-sm mt-1">
                {{ $slot }}
            </p>
        </div>
    </div>
</div>
