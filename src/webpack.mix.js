const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.setPublicPath('../html/beta/assets');

// app.js is the app-wide JavaScript that will be used across all pages.

mix.js('resources/js/app.js', 'primary/js') // Site-wide JavaScript.
    .sass('resources/sass/app.scss', 'primary/css') // Site-wide CSS.

mix.js('resources/js/tools/generators/raycasting/raycasting.js', 'primary/js/tools/generators/raycasting') // Raycasting generator JavaScript.
    .vue()
    .sass('resources/sass/tools/generators/raycasting.scss', 'primary/css/tools/generators/raycasting') // Raycasting generator CSS.

mix.version();
