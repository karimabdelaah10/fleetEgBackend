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


mix.styles([
    'resources/css/rtl/pace-theme-default.min.css',
    'resources/css/rtl/vendors-rtl.min.css',
    'resources/css/rtl/toastr.min.css',
    'resources/css/rtl/bootstrap.min.css',
    'resources/css/rtl/bootstrap-extended.min.css',
    'resources/css/rtl/colors.min.css',
    'resources/css/rtl/components.min.css',
    'resources/css/rtl/dark-layout.min.css',
    'resources/css/rtl/bordered-layout.min.css',
    'resources/css/rtl/semi-dark-layout.min.css',
    'resources/css/rtl/vertical-menu.min.css',
    'resources/css/rtl/dashboard-ecommerce.min.css',
    'resources/css/rtl/ext-component-toastr.min.css',
    'resources/css/rtl/custom-rtl.min.css',
    'resources/css/rtl/style-rtl.css',
    'resources/sass/app.scss'
], 'public/css/ar_vendors.css');


mix.styles([
    'resources/css/ltr/pace-theme-default.min.css',
    'resources/css/ltr/vendors.min.css',
    'resources/css/ltr/toastr.min.css',
    'resources/css/ltr/bootstrap.min.css',
    'resources/css/ltr/bootstrap-extended.min.css',
    'resources/css/ltr/colors.min.css',
    'resources/css/ltr/components.min.css',
    'resources/css/ltr/dark-layout.min.css',
    'resources/css/ltr/bordered-layout.min.css',
    'resources/css/ltr/semi-dark-layout.min.css',
    'resources/css/ltr/vertical-menu.min.css',
    'resources/css/ltr/dashboard-ecommerce.min.css',
    'resources/css/ltr/ext-component-toastr.min.css',
    'resources/css/ltr/style.css',
], 'public/css/en_vendors.css');

mix.styles([
    'resources/css/form-validation.css',
    'resources/css/page-auth.min.css'
], 'public/css/auth.css');






mix.js('resources/js/app.js', 'public/js/vendors.js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css/en_vendors.css');


mix.js([
        'resources/js/libs/toastr.min.js',
        'resources/js/libs/app-menu.min.js',
        'resources/js/libs/front.min.js',
        'resources/js/libs/customizer.min.js'
    ],
    'public/js/scripts.js');
