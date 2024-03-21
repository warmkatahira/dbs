import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/*.js',
    ],

    theme: {
        extend: {
            colors: {
                theme: {
                    'main': "#54ACFD",
                    'sub': "#c3e2ff",
                    'gray': "#ebe6e6",
                },
            },
            fontSize: {
                '10px': '10px',
            },
        },
    },

    plugins: [forms],
};
