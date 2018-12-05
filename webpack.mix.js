let mix = require('laravel-mix');
const WebpackShellPlugin = require('webpack-shell-plugin');

mix.webpackConfig({
    plugins: [
        new WebpackShellPlugin({
            onBuildStart: [
                'php artisan lang:js public/modules/architect/js/lang.dist.js -s Modules/Architect/Resources/lang',
            ],
            onBuildEnd: []
        }),
    ]
});


mix.react('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.react('Modules/Architect/Resources/assets/js/app.js', 'modules/architect/js')
  .sass('Modules/Architect/Resources/assets/sass/architect/app.scss', 'modules/architect/css');

mix.sass('Modules/RRHH/Resources/assets/sass/app.scss', 'modules/rrhh/css');

mix.js('Modules/BWO/Resources/assets/js/app.js', 'modules/bwo/js')
   .sass('Modules/BWO/Resources/assets/sass/app.scss', 'modules/bwo/css');


// Compile Architect lib
mix.scripts([
  'Modules/Architect/Resources/assets/js/architect/architect.js',
  'Modules/Architect/Resources/assets/js/architect/architect.dialog.js',
  'Modules/Architect/Resources/assets/js/architect/architect.medias.js',
  'Modules/Architect/Resources/assets/js/architect/architect.contents.js',
  'Modules/Architect/Resources/assets/js/architect/architect.tags.js',
  'Modules/Architect/Resources/assets/js/architect/architect.users.js',
  'Modules/Architect/Resources/assets/js/architect/architect.pageLayouts.js',
  'Modules/Architect/Resources/assets/js/architect/architect.menu.js',
  'Modules/Architect/Resources/assets/js/architect/architect.languages.js',
  'Modules/Architect/Resources/assets/js/architect/architect.translations.js'
], 'public/modules/architect/js/architect.js');


mix.browserSync('http://localhost:8000');
