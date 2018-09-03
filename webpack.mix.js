let mix = require('laravel-mix');
const WebpackShellPlugin = require('webpack-shell-plugin');

mix.webpackConfig({
    plugins: [
        new WebpackShellPlugin({
            onBuildStart: [
                'php artisan lang:js public/modules/architect/js/lang.dist.js -s Modules/Architect/Resources/lang',
                'php artisan lang:js public/modules/turisme/js/lang.dist.js -s Modules/Turisme/Resources/lang'
            ],
            onBuildEnd: []
        }),
    ]
});


mix.react('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.react('Modules/Architect/Resources/assets/js/app.js', 'modules/architect/js')
  .sass('Modules/Architect/Resources/assets/sass/architect/app.scss', 'modules/architect/css');

mix.react('Modules/Turisme/Resources/assets/js/app.js', 'modules/turisme/js')
  .sass('Modules/Turisme/Resources/assets/sass/app.scss', 'modules/turisme/css');

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
