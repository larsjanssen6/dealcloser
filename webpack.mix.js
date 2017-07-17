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
   .fastSass('resources/assets/stylus/bulma.scss', 'public/css')
   .stylus('resources/assets/stylus/app.styl', 'public/css')
    .combine([
        'resources/assets/libraries/css/animations.css',
        './node_modules/sweetalert2/dist/sweetalert2.css',
        './node_modules/vue-multiselect/dist/vue-multiselect.min.css'
    ], 'public/css/packages.css')
    .sourceMaps()
    .version();
