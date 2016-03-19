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
    mix.sass('app.scss').version(["css/app.css"]);

    mix.copy('bower_components/jquery/dist/jquery.min.js', 'public/build/js');

    mix.copy('bower_components/radial-progress-chart/dist/radial-progress-chart.min.js', 'public/build/js');

    mix.copy('bower_components/Materialize/dist/css/*.min.css', 'public/build/css');
    mix.copy('bower_components/Materialize/dist/js/*.min.js', 'public/build/js');
    mix.copy('bower_components/Materialize/dist/font/*', 'public/build/font');
});
