import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import preset from './vendor/filament/support/tailwind.config.preset'


/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        "./resources/views/**/*.blade.php",
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/lara-zeus/accordion/resources/views/**/*.blade.php',
        '.resources/views/layouts/guest.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    darkMode: "media",

    plugins: [forms],
};
