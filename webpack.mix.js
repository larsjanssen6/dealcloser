const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/stylus/bulma.scss', 'public/css')
    .stylus('resources/assets/stylus/app.styl', 'public/css')
    .combine([
        'resources/assets/libraries/css/animations.css',
        './node_modules/sweetalert2/dist/sweetalert2.css'
    ], 'public/css/packages.css')
    .version();
