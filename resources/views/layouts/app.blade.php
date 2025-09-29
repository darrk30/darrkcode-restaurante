<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700&display=swap" rel="stylesheet" />

    {{-- font-awesome --}}
    <script src="https://kit.fontawesome.com/e73c23d988.js" crossorigin="anonymous"></script>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#F5F6FB]">
    {{-- <div class="min-h-[calc(100vh-3rem)] bg-gray-100"> --}}
    <livewire:layout.navigation />
    {{-- <main class="p-6 sm:p-8 sm:ml-64 mt-12"> --}}
    <div class="p-4 min-[836px]:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
            <div class="grid grid-cols-1 gap-4">
                <main>
                    {{ $slot ?? '' }}
                </main>
            </div>
        </div>
    </div>
</body>

</html>
