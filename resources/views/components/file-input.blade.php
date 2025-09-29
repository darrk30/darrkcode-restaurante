@props([
    'id' => 'file_input',
    'help' => 'SVG, PNG, JPG or GIF (MAX. 800x400px).',
])

<input id="{{ $id }}" type="file" aria-describedby="{{ $id }}_help"
    {{ $attributes->merge([
        'class' =>
            'block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400',
    ]) }}>

<p id="{{ $id }}_help" class="mt-1 text-sm text-gray-500 dark:text-gray-300">
    {{ $help }}
</p>
