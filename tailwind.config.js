import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
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
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
    darkMode: "false",
};
