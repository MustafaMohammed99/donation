const mix = require('laravel-mix');

// mix.combine([
//     'resources/js/app.js',
//     'resources/js/firebase.js',
// ], 'public/js/app.js', 'public/js');


mix.js([
    'resources/js/app.js',
    'resources/js/firebase.js'
],'public/js');



//.js('resources/js/app.js', 'public/js')
//     // .js('resources/js/firebase.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         require('postcss-import'),
//         require('tailwindcss'),
//         require('autoprefixer'),
//     ]);
