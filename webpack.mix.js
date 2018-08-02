let mix = require('laravel-mix');

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
    'resources/assets/css/vendors/bootstrap.min.css',
    /*import theme style */

    'resources/assets/css/vendors/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.css',
    'resources/assets/css/vendors/theme_assets/icons/simple-line-icons/css/simple-line-icons.css',
    'resources/assets/css/vendors/theme_assets/icons/weather-icons/css/weather-icons.min.css',
    'resources/assets/css/vendors/theme_assets/icons/linea-icons/linea.css',
    'resources/assets/css/vendors/theme_assets/icons/themify-icons/themify-icons.css',
    'resources/assets/css/vendors/theme_assets/cons/flag-icon-css/flag-icon.min.css',
    'resources/assets/css/vendors/theme_assets/icons/material-design-iconic-font/css/materialdesignicons.min.css',
    'resources/assets/css/vendors/theme_assets/spinners.css',
    'resources/assets/css/vendors/theme_assets/animate.css',

    'resources/assets/css/vendors/theme_styles.css',

    'resources/assets/css/mystyles.css',


], 'public/css/all.css');

  mix.scripts([
    'resources/assets/js/vendors/jquery.min.js',
  	'resources/assets/js/vendors/popper.min.js',
  	 'resources/assets/js/vendors/bootstrap.min.js',
  	'resources/assets/js/vendors/perfect-scrollbar.jquery.min.js',
  	'resources/assets/js/vendors/wave.js',
  	'resources/assets/js/vendors/sidebarmenu.js',
  	'resources/assets/js/vendors/sticky-kit.min.js',
  	'resources/assets/js/vendors/jquery.sparkline.min.js',
  	'resources/assets/js/vendors/custom.min.js',
  	'resources/assets/js/vendors/jQuery.style.switcher.js',
    'resources/assets/js/vendors/typed.min.js',
    'resources/assets/js/myscripts.js',


], 'public/js/all.js');

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');
