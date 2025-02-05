/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    darkMode: 'class',
    important: true,
    theme: {
        extend: {
            colors: {
                primary: '#9FE88D',
                secondary: '#FF7D5C',
                accent: '#C792E9',
                neutral: '#1c212b',
                'neutral-content': '#B2CCD6',
                'base-100': '#2A303C',
                'base-200': '#242933',
                'base-300': '#20252E',
                'base-content': '#B2CCD6',
                info: '#28ebff',
                success: '#62efbd',
                warning: '#efd057',
                error: '#ffae9b',
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            },
        },
    },
}
