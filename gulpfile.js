var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.styles([
    	'bootstrap.css',
        'bootstrap-social.css',
        'bootcards.css',
    	'font-awesome.css',
    	'animate.css',
    	'jquery.sidr.dark.css',
    	'prettyPhoto.css',
    	'reset.css',
    	'responsive.css',
    	'style.css',
    ], 'public/css/app.css');

    mix.scripts([
    	'jquery.min.js',
    	'bootstrap.min.js',
        'bootcards.min.js',
    	'html5shiv.js',
    	'jquery.isotope.min.js',
    	'jquery.parallax.js',
    	'jquery.prettyPhoto.js',
    	'respond.min.js',
    	'smoothscroll.js',
    	'script.js',
    ], 'public/js/app.js');

});
