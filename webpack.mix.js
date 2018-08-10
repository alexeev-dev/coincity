let mix = require('laravel-mix');

mix.copyDirectory('resources/assets/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/img', 'public/img');

mix.js('resources/assets/js/app.js', 'public/js')
	.js('resources/assets/js/app2.js', 'public/js')
	.js('resources/assets/js/odometer.min.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .styles('resources/assets/css/jquery.scrollbar.css', 'public/css/jquery.scrollbar.css')
   .styles('resources/assets/css/dragula.min.css', 'public/css/dragula.min.css')
   .version();

