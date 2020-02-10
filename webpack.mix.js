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
    .sass('resources/sass/welcome/landing.scss', 'public/css')
    .sass('resources/sass/welcome/register.scss', 'public/css')
    .sass('resources/sass/dashboard.scss', 'public/css')
    .sass('resources/sass/dashboard/vehicles.scss', 'public/css')
    
    .js('resources/js/welcome/welcomeLoad.js', 'public/js')
    .js('resources/js/dashboard/dashboardLoad.js', 'public/js')
    .js('resources/js/alert.js', 'public/js')
    .js('resources/js/form.js', 'public/js')
    .js('resources/js/dashboard/vehicleList.js', 'public/js');