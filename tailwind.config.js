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
                balance: {
                    'sales-1': "#ffedd5",   // orange-100
                    'sales-2': "#fed7aa",   // orange-200
                    'cost-1': "#ffe4e6",    // rose-100
                    'cost-2': "#fecdd3",    // rose-200
                    'profit-1': "#ccfbf1",  // teal-100
                    'profit-2': "#99f6e4",  // teal-200
                },
            },
            spacing: {
                '1300px': "1300px",
            },
        },
    },

    plugins: [forms],
};
