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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/scss/button.scss', 'public/css')
    .sass('resources/scss/form.scss', 'public/css')
    .sass('resources/scss/style.scss', 'public/css')
    .sass('resources/scss/welcome.scss', 'public/css')



    .sass('resources/scss/admin-style.scss', 'public/css')

    .sourceMaps();
