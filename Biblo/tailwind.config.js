import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.jsx",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    colors: {
        "biblo-sage": "#9FAF9A",
        "biblo-greige": "#CFC8BE",
        "biblo-oat": "#F2EFEA",
        "biblo-charcoal": "#3F453F",
        "biblo-moss": "#7E8F7A",
        "biblo-clay": "#B09D85",
    },
    plugins: [forms],
};
