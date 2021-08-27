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


 mix.js('resources/js/app.js','public/js')
    .js('resources/js/p5.min.js', 'public/js')
    .js('resources/js/p5_index.js', 'public/js')
    .js('resources/js/play_audio.js', 'public/js')
    .js('resources/js/popper.js', 'public/js')
    .js('resources/js/custom.js', 'public/js')
    .js('resources/js/practice3_3.js', 'public/js')
    .js('resources/js/practice4_2.js', 'public/js')
.sass('resources/sass/app.scss', 'public/css');

/*
mix.js(['resources/js/app.js',
        'resources/js/jquery.js'
        ], 'public/js',
        'resources/js/p5.min.js',
        'resources/js/p5_index.js'
        
        )
    .js('resources/js/play_audio.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
*/
//mix.sourceMaps().js('node_modelus/popper.js/dist/popper.js', 'public/js').sourceMaps();
