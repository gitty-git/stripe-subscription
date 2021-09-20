module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        fontFamily: {
            'mono': ['Courier Prime', 'Courier New'],
        },
        extend: {
            colors: {
                gray: {
                    '100': '#F5F5F5',
                    '200': '#E5E5E5',
                    '300': '#D4D4D4',
                    '400': '#A3A3A3',
                    '500': '#737373',
                    '600': '#525252',
                    '700': '#404040',
                    '800': '#262626',
                    '900': '#171717',
                },
            },
        },
    },
    variants: {
        extend: {
            inset: ['checked'],
        }
    },
    plugins: [],
}