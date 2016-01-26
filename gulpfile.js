
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


var elixir = require('laravel-elixir');

//elixir.registerWatcher("default", "resources/assets/**");

var bowerDir = './resources/assets/bower/';
 
var lessPaths = [
//    bowerDir + "bootstrap/less",
//    bowerDir + "font-awesome/less",
//    bowerDir + "bootstrap-select/less",
];
 
elixir(function(mix) {
    mix.less(
            'app.less',  //src - assumes resources/assets/less
            'public/css/app.css', //output - defaults to 
            {
                paths: lessPaths
            }
        )
        .browserify('app.js')
        //.babelify('app.js')
       /* .scripts( //All these go into the next file
            [
               'jquery/dist/jquery.min.js',
//                'bootstrap/dist/js/bootstrap.min.js',
//                'bootstrap-select/dist/js/bootstrap-select.min.js',
 //               'react/react.js',
 //               'react/react-dom.js',
            ],
            'public/js/vendor.js', //output file of the script array
            bowerDir)*/
        //.copy('resources/assets/js/app.js', 'public/js/app.js')  //simple copy for raw additions
        .copy(bowerDir + 'font-awesome/fonts', 'public/fonts')
});