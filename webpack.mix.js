let mix = require('laravel-mix');
const WebpackShellPlugin = require('webpack-shell-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');

mix.webpackConfig({
    plugins: [
        new WebpackShellPlugin({
            onBuildStart: [
                'php artisan lang:js public/modules/architect/js/lang.dist.js -s Modules/Architect/Resources/lang',
            ],
            onBuildEnd: []
        }),
        new CopyWebpackPlugin([
            {
                from: 'Modules/Extranet/Resources/assets/js/admin/',
                to: './modules/extranet/js/admin/',
                toType: 'dir'
            },
            {
                from: 'Modules/Extranet/Resources/assets/js/libs/',
                to: './modules/extranet/js/libs/',
                toType: 'dir'
            },
            {
                from: 'Modules/Extranet/Resources/assets/plugins/',
                to: './modules/extranet/plugins/',
                toType: 'dir'
            }
        ])
    ]
});


mix.react('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.react('Modules/Architect/Resources/assets/js/app.js', 'modules/architect/js')
  .sass('Modules/Architect/Resources/assets/sass/architect/app.scss', 'modules/architect/css');

mix.react('Modules/Extranet/Resources/assets/js/app.js', 'modules/extranet/js')
  .sass('Modules/Extranet/Resources/assets/sass/app.scss', 'modules/extranet/css');

mix.js('Modules/Front/Resources/assets/js/app.js', 'modules/front/js')
   .sass('Modules/Front/Resources/assets/sass/app.scss', 'modules/front/css');


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




// Compile Architect lib
// mix.scripts([
//     'Modules/Extranet/Resources/assets/js/admin/agences/agencesform.js',
// ], 'public/modules/extranet/js/admin/agences/agencesform.js');
//
// mix.scripts([
//     'Modules/Extranet/Resources/assets/js/admin/agences/agenceslist.js',
// ], 'public/modules/extranet/js/admin/agences/agenceslist.js');

// mix.scripts([
//   'Modules/Architect/Resources/assets/js/architect/architect.js',
//   'Modules/Architect/Resources/assets/js/architect/architect.dialog.js',
//   'Modules/Architect/Resources/assets/js/architect/architect.medias.js',
//   'Modules/Architect/Resources/assets/js/architect/architect.contents.js',
//   'Modules/Architect/Resources/assets/js/architect/architect.tags.js',
//   'Modules/Architect/Resources/assets/js/architect/architect.users.js',
//   'Modules/Architect/Resources/assets/js/architect/architect.pageLayouts.js',
//   'Modules/Architect/Resources/assets/js/architect/architect.menu.js',
//   'Modules/Architect/Resources/assets/js/architect/architect.languages.js',
//   'Modules/Architect/Resources/assets/js/architect/architect.translations.js'
// ], 'public/modules/extranet/js/admin.js');


mix.browserSync('http://localhost:8000');
