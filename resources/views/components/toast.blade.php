@props([
    'message' => null,
    'type' => 'error', // error | success | warning | info
    'duration' => 3000, // milisegundos
])

@php
    $colors = [
        'error' => 'bg-red-600 text-white',
        'success' => 'bg-green-600 text-white',
        'warning' => 'bg-yellow-500 text-black',
        'info' => 'bg-blue-600 text-white',
    ];

    $classes = $colors[$type] ?? $colors['info'];

    // Detectar si se pasó wire:model (o variantes .defer/.lazy)
    $wireModel =
        $attributes->get('wire:model') ??
        ($attributes->get('wire:model.defer') ?? ($attributes->get('wire:model.lazy') ?? null));
@endphp

<div x-data="{
    show: @js(!empty($message)),
    message: @js($message),
    type: @js($type),
    duration: @js($duration)
}" x-init="if (show) {
    setTimeout(() => {
        show = false;
        @if($wireModel)
        $wire.set('{{ $wireModel }}', null);
        @endif
    }, duration);
}"
    x-on:alert.window="
        message = $event.detail.message;
        type = $event.detail.type ?? 'info';
        duration = $event.detail.duration ?? 3000;
        show = true;
        setTimeout(() => {
            show = false;
            @if ($wireModel)
$wire.set('{{ $wireModel }}', null);
@endif
        }, duration);
    "
    x-cloak x-show="show" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 scale-95"
    class="fixed bottom-6 left-1/2 -translate-x-1/2
           w-[90%] max-w-sm px-4 py-3 rounded-lg shadow-lg z-50 text-center
           transform"
    :class="{
        'bg-red-600 text-white': type === 'error',
        'bg-green-600 text-white': type === 'success',
        'bg-yellow-500 text-black': type === 'warning',
        'bg-blue-600 text-white': type === 'info'
    }">
    <span x-text="message"></span>
</div>
