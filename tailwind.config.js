import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    safelist: [
        'bg-red-500',
        'border-red-500',
        'bg-gray-500',
        'border-gray-500',
        'cursor-not-allowed',

        'text-[#5293FF]',
        'text-[#F56B01]',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                noto: ['"Noto Sans JP"', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
