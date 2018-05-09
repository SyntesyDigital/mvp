let mix = require('laravel-mix');

mix.react('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.react('Modules/Architect/Resources/assets/js/app.js', 'modules/architect/js')
  .sass('Modules/Architect/Resources/assets/sass/architect/app.scss', 'modules/architect/css');

mix.browserSync('http://localhost:8000');
