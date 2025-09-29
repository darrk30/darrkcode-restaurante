<div>
    <div class="space-y-6">
        {{-- Skeleton Header --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="h-10 w-10 rounded-full bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 bg-[length:200%_100%] animate-shimmer">
                </div>
                <div>
                    <div
                        class="h-4 w-40 rounded bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 bg-[length:200%_100%] animate-shimmer mb-2">
                    </div>
                    <div
                        class="h-3 w-28 rounded bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 bg-[length:200%_100%] animate-shimmer">
                    </div>
                </div>
            </div>
            <div
                class="h-8 w-24 rounded-lg bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 bg-[length:200%_100%] animate-shimmer">
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6">
            {{-- 📌 Columna izquierda: Tabla de impresoras --}}
            <div class="lg:col-span-2 border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                <div class="px-4 py-3 bg-gray-100 animate-pulse h-8"></div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody>
                            @for ($i = 0; $i < 5; $i++)
                                <tr class="border-b border-gray-200">
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="h-6 w-6 rounded-full bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 animate-shimmer">
                                            </div>
                                            <div
                                                class="h-6 w-40 rounded-lg bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 animate-shimmer">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div
                                            class="h-6 w-20 rounded-lg bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 animate-shimmer">
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-right">
                                        <div class="inline-flex gap-2">
                                            <div
                                                class="h-6 w-10 rounded-lg bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 animate-shimmer">
                                            </div>
                                            <div
                                                class="h-6 w-10 rounded-lg bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 animate-shimmer">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <div class="p-2">
                    <div
                        class="h-6 w-32 rounded-lg bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 animate-shimmer mx-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tailwind CSS Animate Shimmer --}}
    <style>
        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .animate-shimmer {
            animation: shimmer 1.5s infinite linear;
        }
    </style>

</div>
