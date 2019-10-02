let mix = require('laravel-mix');

/*----------------------------------------*/
/* Allow multiple Laravel Mix applications*/
/*----------------------------------------*/
require('laravel-mix-merge-manifest');
mix.mergeManifest();
/*----------------------------------------*/


/*----------------------------------------*/
/* LARAVEL ASSETS
/*----------------------------------------*/
mix.react('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
/*----------------------------------------*/


mix.browserSync('http://localhost:8000');
