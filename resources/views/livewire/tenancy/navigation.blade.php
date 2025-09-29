<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

@php
    $links = [
        [
            'name' => 'Dashboard',
            'url' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
            'icon' => 'fa-solid fa-gauge',
        ],
        [
            'name' => 'Gestión de Productos',
            'icon' => 'fas fa-boxes',
            'submenu' => [
                [
                    'name' => 'Productos',
                    'url' => route('productos.index'),
                    'active' => request()->routeIs('productos.*'),
                    'icon' => 'fa-solid fa-boxes-stacked',
                ],
                [
                    'name' => 'Categorias',
                    'url' => route('categorias.index'),
                    'active' => request()->routeIs('categorias.*'),
                    'icon' => 'fas fa-tag',
                ],
            ],
        ],
        [
            'name' => 'Ajustes',
            'icon' => 'fa-solid fa-gear',
            'submenu' => [
                [
                    'name' => 'Salones / Mesas',
                    'url' => route('pisos.index'),
                    'active' => request()->routeIs('pisos.*'),
                    'icon' => 'fa-solid fa-table',
                ],
                [
                    'name' => 'Impresoras',
                    'url' => route('impresoras.index'),
                    'active' => request()->routeIs('impresoras.*'),
                    'icon' => 'fa-solid fa-print',
                ],
                [
                    'name' => 'Areas de producción',
                    'url' => route('areasproduccion.index'),
                    'active' => request()->routeIs('areasproduccion.*'),
                    'icon' => 'fa-solid fa-industry',
                ],
                [
                    'name' => 'Empresa',
                    'url' => route('empresa.index'),
                    'active' => request()->routeIs('empresa.*'),
                    'icon' => 'fa-solid fa-building',
                ],
            ],
        ],
        
    ];
@endphp

<div x-data="{ sidebarOpen: false }">
    <!-- NAV -->
    <nav class="fixed top-0 z-50 w-full border-b border-gray-200 bg-[#21388B]">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <!-- Botón hamburguesa -->
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="inline-flex items-center p-2 text-sm text-gray-100 rounded-lg min-[885px]:hidden hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>

                    <!-- Logo -->
                    <a href="#" class="flex ms-2 md:me-24">
                        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="Logo" />
                        <span class="text-white self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">
                            Mi Restaurante
                        </span>
                    </a>
                </div>

                <!-- Avatar + Dropdown -->
                <div class="flex items-center ms-3 relative" x-data="{ userMenu: false }">
                    <button @click="userMenu = !userMenu"
                        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full"
                            src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                    </button>
                    <!-- Dropdown -->
                    <div x-show="userMenu" @click.away="userMenu = false" x-cloak
                        class="absolute right-0 top-full mt-2 w-48 z-50 bg-white divide-y divide-gray-100 rounded-md shadow-lg">
                        <div class="px-4 py-3">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <ul class="py-1">
                            <li>
                                <a href="{{ route('profile') }}" wire:navigate
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    Perfil
                                </a>
                            </li>
                            <li>
                                <button wire:click="logout"
                                    class="w-full text-start block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                                    Cerrar sesión
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <aside class="fixed top-0 left-0 z-40 w-72 h-screen pt-20 transition-transform bg-white border-r border-gray-200 shadow-lg shadow-gray-300/80 
           transform -translate-x-full min-[885px]:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full min-[885px]:translate-x-0'" aria-label="Sidebar">

        <div class="h-full px-3 pb-4 overflow-y-auto">
            <ul class="space-y-1 font-xm">
                @foreach ($links as $link)
                    <li x-data="{ open: {{ collect($link['submenu'] ?? [])->contains(fn($s) => $s['active']) ? 'true' : 'false' }} }">
                        @if (isset($link['submenu']))
                            <!-- Opción con submenu -->
                            <button @click="open = !open" class="flex items-center justify-between w-full p-2 rounded-lg transition-all duration-200
                                text-gray-600 hover:bg-gray-100 hover:text-gray-900 text-sm
                                {{ collect($link['submenu'])->contains(fn($s) => $s['active']) ? 'bg-blue-50 text-blue-700' : '' }}">
                                <div class="flex items-center">
                                    <i class="{{ $link['icon'] }} w-5 h-5 mr-3 text-gray-400"></i>
                                    <span>{{ $link['name'] }}</span>
                                </div>
                                <svg :class="{ 'rotate-90': open }" class="w-4 h-4 transform transition-transform"
                                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>

                            <!-- Submenu -->
                            <ul x-show="open" x-cloak x-transition class="pl-8 mt-1 space-y-1 text-sm">
                                @foreach ($link['submenu'] as $sublink)
                                    <li>
                                        <a href="{{ $sublink['url'] }}"
                                            class="flex items-center p-2 rounded-lg transition-all duration-200
                                            {{ $sublink['active']
                                                ? 'bg-[#21388B] text-white shadow-sm'
                                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                                            <i
                                                class="{{ $sublink['icon'] }} w-4 h-4 mr-3 {{ $sublink['active'] ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                                            <span>{{ $sublink['name'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <!-- Opción normal -->
                            <a href="{{ $link['url'] ?? '#' }}" class="flex items-center w-full p-2 rounded-lg transition-all duration-200  text-sm
                                {{ $link['active']
                                    ? 'bg-[#21388B] text-white shadow-sm'
                                    : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                                <i
                                    class="{{ $link['icon'] }} w-5 h-5 mr-3 
                                {{ $link['active'] ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                                <span>{{ $link['name'] }}</span>
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </aside>

    <!-- Overlay oscuro en móvil -->
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 max-[885px]:block min-[885px]:hidden">
    </div>

</div>
