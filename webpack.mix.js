const {mix} = require('laravel-mix');

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

mix.js('resources/assets/js/admin/app.js', 'public/static/admin/js')
  .sass('resources/assets/sass/admin/app.scss', 'public/static/admin/css')
  .js('resources/assets/js/user/app.js', 'public/static/user/js')
  .sass('resources/assets/sass/user/app.scss', 'public/static/user/css');
