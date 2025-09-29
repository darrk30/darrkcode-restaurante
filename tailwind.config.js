import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Manrope', ...defaultTheme.fontFamily.sans], // 👈 Manrope por defecto
                figtree: ['Figtree', ...defaultTheme.fontFamily.sans], // opcional si aún quieres Figtree
            },
        },
    },

    plugins: [forms],

    darkMode: 'class',
};
