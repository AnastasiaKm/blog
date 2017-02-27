var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('app.less')
      .scripts([
        'libs/sweetalert-dev.js'
      ], './public/js/libs.js')
      .styles([
        'libs/sweetalert.css'
      ], './public/css/libs.css');
});
