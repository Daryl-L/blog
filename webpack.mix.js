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

mix.styles([
    'resources/assets/css/font.css',
    'resources/assets/css/global.css',
    'resources/assets/css/sidebar.css',
    'resources/assets/css/layouts/social_btn.css',
    'resources/assets/css/article_list.css'
], 'public/css/app.css');

if (mix.config.inProduction) {
    mix.version();
}