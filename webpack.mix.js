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
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/forms.scss', 'public/css')

    // Dashbaord Assets
    .sass('resources/sass/dashboard.scss', 'public/css')
    .js('resources/js/menu.js', 'public/js')

    // Register Assets
    .js('resources/js/register.js', 'public/js')

    // Vehicle Assets
    .sass('resources/sass/vehicles.scss', 'public/css');