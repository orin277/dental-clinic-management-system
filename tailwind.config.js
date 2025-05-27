import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            zIndex: {
                '100': '100',
            },
            colors: {
                'avatar': '#556080',
            },
        },
        screens: {
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
            'xl': '1280px',
            '2xl': '1536px',
        },
        fontFamily: {
            'inter-regular': [
                'Inter-Regular',
            ],
            'inter-bold': [
                'Inter-Bold',
            ],
            'inter-extra-bold': [
                'Inter-ExtraBold',
            ],
            'inter-extra-light': [
                'Inter-ExtraLight',
            ],
            'inter-extra-black': [
                'Inter-Black',
            ],
            'inter-light': [
                'Inter-Light',
            ],
            'inter-medium': [
                'Inter-Medium',
            ],
            'inter-semi-bold': [
                'Inter-SemiBold',
            ],
            'inter-semi-thin': [
                'Inter-Thin',
            ],
        },
    },

    plugins: [
        require('flowbite/plugin')({
            charts: true,
        }),

    ]
};
