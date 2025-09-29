<div class="flex items-center justify-between bg-white shadow-sm rounded-lg p-4 mb-6 border-b-2 border-blue-500">
    <div class="flex items-center gap-4">
        @if(isset($icon))
            <div class="text-blue-600 text-3xl">
                <i class="{{ $icon }}"></i>
            </div>
        @elseif(isset($image))
            <img src="{{ $image }}" alt="Icono" class="w-10 h-10 rounded-full">
        @endif

        <div>
            <h1 class="text-2xl font-bold text-gray-700">{{ $title }}</h1>
            @if(isset($subtitle))
                <p class="text-gray-500 text-sm">{{ $subtitle }}</p>
            @endif
        </div>
    </div>

    @if(isset($action))
        <div>
            {{ $action }}
        </div>
    @endif
</div>
