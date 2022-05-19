const mix = require('laravel-mix');

mix.js('resources/js/find-pairs.js', 'public/js/')
    .js('resources/js/app.js', 'public/js/')
    .sass('resources/css/scss/app.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [])
    .version()
// .sourceMaps()
;

// if (mix.inProduction()) {
//     mix.minify(undefined, undefined, undefined);
// }

mix.browserSync('http://backend.family.local/');
// mix.browserSync('http://localhost:3000/');
