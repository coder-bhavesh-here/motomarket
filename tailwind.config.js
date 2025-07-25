import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    safelist: [
        'peer-checked:flex',
        'peer-checked:block',
        'peer-checked:ring-4',
        'peer-checked:grayscale-0'
    ],          
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/vildanbina/livewire-wizard/resources/views/*.blade.php",
        "./vendor/wireui/wireui/src/View/*.php",
        "./vendor/wireui/wireui/src/View/**/*.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
    ],

    theme: {
        extend: {
            screens: {
                womxs: "280px",
                womsm: "540px",
                wommd: "1080px",
                womlg: "1920px",
                'tall': {'raw': '(min-height: 800px)'},
                'short': {'raw': '(min-height: 600px)'},
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: "#fafafa",
                    100: "#f5f5f5",
                    200: "#e5e5e5",
                    300: "#d4d4d4",
                    400: "#a3a3a3",
                    500: "#737373",
                    600: "#525252",
                    700: "#404040",
                    800: "#262626",
                    900: "#171717",
                    950: "#0a0a0a",
                },
                secondary: {
                    50: "#fafaf9",
                    100: "#f5f5f4",
                    200: "#e7e5e4",
                    300: "#d6d3d1",
                    400: "#a8a29e",
                    500: "#78716c",
                    600: "#57534e",
                    700: "#44403c",
                    800: "#292524",
                    900: "#1c1917",
                    950: "#0c0a09",
                },
            },
        },
    },

    plugins: [forms],
    darkMode: "false",
};
