let mix = require('laravel-mix');

mix.react('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.react('Modules/Architect/Resources/assets/js/app.js', 'modules/architect/js')
  .sass('Modules/Architect/Resources/assets/sass/architect/app.scss', 'modules/architect/css');

// Compile Architect lib
mix.scripts([
  'Modules/Architect/Resources/assets/js/architect/architect.js',
  'Modules/Architect/Resources/assets/js/architect/architect.dialog.js',
  'Modules/Architect/Resources/assets/js/architect/architect.medias.js'
], 'public/modules/architect/js/architect.js');

mix.browserSync('http://localhost:8000');
