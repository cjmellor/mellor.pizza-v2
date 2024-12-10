import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './app/Providers/AnimationsServiceProvider.php',
        './app/View/**/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './storage/framework/views/*.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        extend: {
            animation: {
                'slide-in-down': 'slideInDown 0.5s',
            },
            colors: {
                dark: 'hsl(215,15%,16%)',
                'dark-input': 'hsl(220,16%,15%)',
                'dark-focus': 'hsl(215,15%,16%)',
                'dark-gray': 'hsl(210,32%,85%)',
                'dark-line': 'hsl(214,13%,25%)',
                'dark-line-lighter': 'hsl(208,13%,30%)',
                pizza: 'hsl(29,100%,52%)',
                'pizza-dark': 'hsl(331,94%,52%)',
            },

            fontFamily: {
                anton: ['Anton', 'sans-serif'],
                merriweather: ['Merriweather', 'serif'],
                'roboto-mono': ['Roboto Mono', 'sans-serif'],
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                slideInDown: {
                    from: {
                        transform: 'translate3d(0, -100%, 0)',
                    },
                    to: {
                        transform: 'translate3d(0, 0, 0)',
                    },
                },
            },
        },
    },
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
