import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                water: {
                    DEFAULT: '#00a8e8',
                    50: '#e6f7fc',
                    100: '#b3e8f7',
                    600: '#0099d4',
                    700: '#007eb0',
                },
                fresh: {
                    DEFAULT: '#90be6d',
                    50: '#f4faf0',
                    100: '#e0f0d4',
                    600: '#7aab54',
                    700: '#5f8f3f',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
