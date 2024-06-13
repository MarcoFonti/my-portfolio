import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

// Importazione del modulo colors di Tailwind CSS
const colors = require("tailwindcss/colors")

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    // Configurazione del tema
    theme: {
        fontFamily: {
            primary: "Playfair Display", // Font principale
            body: "work Sans" // Font per il corpo del testo
        },
        container: {
            padding: {
                DEFAULT: "1rem", // Padding predefinito di 1 rem
                lg: "3rem" // Padding per schermi grandi (lg) di 3 rem
            }
        },

        // Estensione delle configurazioni predefinite
        extend: {

            maxHeight: {
                'custom': '900px', // Aggiunge una classe max-h-custom per 600px
              },

            // Definizione dei colori personalizzati
            colors: {
                "light-primary": "#FAF1E6",
                "light-secondary": "#FDFAF6",
                "light-tail-100": "#A9DED2",
                "light-tail-500": "#54BAB9",
                "dark-primary": "#050402",
                "dark-secondary": "#1C1D24",
                "dark-navy-100": "#07567D",
                "dark-navy-500": "#292D42",
                accent : {
                    DEFAULT: "#ac6b34", // Colore predefinito
                    hover: "#925a2b", // Colore per hover
                },
                paragraph: "#878e99", // Colore per i paragrafi
                blue: colors.blue,
                indigo: colors.indigo,
                green: colors.green,
                red: colors.red
            }
        }
    },

    plugins: [forms],
};
