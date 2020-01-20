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
    .sass('resources/sass/components/forms.scss', 'public/css')
    .sass('resources/sass/components/tables.scss', 'public/css')

    // Donut.js
    .js('resources/js/Donut.js', 'public/js')

    // Dashbaord Assets
    .sass('resources/sass/dashboard.scss', 'public/css')
    .js('resources/js/menu.js', 'public/js')
    .js('resources/js/alert.js', 'public/js')

    // Register Assets
    .js('resources/js/register.js', 'public/js')

    // Vehicle Assets
    .sass('resources/sass/vehicles.scss', 'public/css')
    .js('resources/js/vehicleList.js', 'public/js');