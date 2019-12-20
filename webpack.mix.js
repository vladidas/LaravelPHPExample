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

const timestamp = Date.now();

/** Frontend. */
mix.babel([
    'src/Services/Frontend/resources/assets/js/jquery.min.js',
    'src/Services/Frontend/resources/assets/js/app.js',
    'src/Services/Frontend/resources/assets/js/main.js',
], 'public/assets/frontend/js/main.js');

mix.styles([
    'src/Services/Frontend/resources/assets/css/app.css',
    'src/Services/Frontend/resources/assets/css/main.css',
], 'public/assets/frontend/css/main.css');

mix.copyDirectory('src/Services/Frontend/resources/assets/fonts', 'public/assets/frontend/fonts');
mix.copyDirectory('src/Services/Frontend/resources/assets/img', 'storage/app/public/assets/frontend/img');

/** Dashboard. */
mix.babel([
    'src/Services/Dashboard/resources/assets/js/jquery.min.js',
    'src/Services/Dashboard/resources/assets/js/app.js',
    'src/Services/Dashboard/resources/assets/js/main.js',
], 'public/assets/dashboard/js/main.js');

mix.styles([
    'src/Services/Dashboard/resources/assets/css/app.css',
    'src/Services/Dashboard/resources/assets/css/main.css',
], 'public/assets/dashboard/css/main.css');

mix.copyDirectory('src/Services/Dashboard/resources/assets/fonts', 'public/assets/dashboard/fonts');
mix.copyDirectory('src/Services/Dashboard/resources/assets/img', 'storage/app/public/assets/dashboard/img');
