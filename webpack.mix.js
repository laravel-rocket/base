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

mix.react('resources/assets/admin/src/index.js', 'public/static/admin/js')
  .sass('resources/assets/admin/scss/style.scss', 'public/static/admin/css')
  .sourceMaps()
  .copy( 'resources/assets/admin/images/', 'public/static/admin/images/' )
  .copy( 'node_modules/font-awesome/fonts/', 'public/static/user/fonts/' )
  .version();
