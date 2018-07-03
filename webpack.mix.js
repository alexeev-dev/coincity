let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/dragula.min.js', 'public/js')
   .js('resources/assets/js/jquery.scrollbar.min.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .styles('resources/assets/css/main.css', 'public/css/main.css')
   .styles('resources/assets/css/print.css', 'public/css/print.css');
