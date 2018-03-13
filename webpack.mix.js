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

mix.react('resources/assets/admin/src/app.js', 'public/static/admin/js')
  .js('resources/assets/user/src/app.js', 'public/static/user/js')
  .sass('resources/assets/admin/scss/app.scss', 'public/static/admin/css')
  .sass('resources/assets/user/scss/app.scss', 'public/static/user/css')
  .sourceMaps()
  .copy( 'resources/assets/admin/images/', 'public/static/admin/images/' )
  .copy( 'resources/assets/user/images/', 'public/static/user/images/' )
  .copy( 'node_modules/font-awesome/fonts/', 'public/static/user/fonts/' )
  .version();
