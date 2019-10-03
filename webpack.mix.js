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

mix.js('Modules/Front/Resources/assets/js/app.js', 'modules/front/js')
   .sass('Modules/Front/Resources/assets/sass/app.scss', 'modules/front/css');

mix.browserSync('http://localhost:8000');
