import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    safelist: [
        // Achievement gradient colors for book milestones (very soft Biblo tones)
        'from-amber-50', 'via-amber-100', 'to-amber-50',
        'from-blue-50', 'via-slate-100', 'to-blue-50',
        'from-orange-100', 'via-amber-100', 'to-orange-100',
    ],
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                biblo: {
                    sage: "#9FAF9A",
                    greige: "#CFC8BE",
                    oat: "#F2EFEA",
                    charcoal: "#3F453F",
                    moss: "#7E8F7A",
                    clay: "#B09D85",
                },
            },
            animation: {
                "bounce-slow": "bounce 3s infinite",
            },
        },
    },

    plugins: [forms],
};
