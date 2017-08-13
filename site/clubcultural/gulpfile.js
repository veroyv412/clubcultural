const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss').webpack('app.js');

    mix.scripts([
        //'vendor/vue.min.js',
        //'vendor/vue-resource.min.js',
    
        'vendor/jquery.min.js',
        'vendor/bootstrap.min.js',
        'vendor/jquery.animsition.min.js',
        'vendor/jquery.flexslider-min.js',
        'vendor/owl.carousel/owl.carousel.min.js',
        'vendor/plugins.js',
    ], 'public/js/vendor.js');

    mix.styles([
        'vendor/bootstrap.min.css',
        'vendor/animate.min.css',
        'vendor/animsition.css',
        'vendor/flexslider.css',
        'vendor/font-awesome.css',
        'vendor/plugins.min.css',
        'vendor/themify-icons.css',
        'vendor/owl.carousel.css',
        'vendor/owl.theme.css',
        'vendor/owl.transitions.css',
    ], 'public/css/vendor.css');
});
