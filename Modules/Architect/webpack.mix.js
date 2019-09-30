const mix = require('laravel-mix');
const WebpackShellPlugin = require('webpack-shell-plugin');

require('laravel-mix-merge-manifest');

mix
    .setPublicPath('../../public')
    .mergeManifest();
    
mix.options({ processCssUrls: false });


// ---------------------------------------- //
//      LANGUAGES
// ---------------------------------------- //
mix.webpackConfig({
    plugins: [
        new WebpackShellPlugin({
            onBuildStart: [
                'php ../../artisan lang:js ../../public/modules/architect/js/lang.dist.js -s Resources/lang',
            ],
            onBuildEnd: []
        })
    ]
});
// ---------------------------------------- //


// ---------------------------------------- //
//      COMPILE ASSETS
// ---------------------------------------- //
mix.react('Resources/assets/js/app.js', 'modules/architect/js')
    .sass('Resources/assets/sass/architect/app.scss', 'modules/architect/css')
    .scripts([
        'Resources/assets/js/architect/architect.js',
        'Resources/assets/js/architect/architect.dialog.js',
        'Resources/assets/js/architect/architect.medias.js',
        'Resources/assets/js/architect/architect.contents.js',
        'Resources/assets/js/architect/architect.tags.js',
        'Resources/assets/js/architect/architect.users.js',
        'Resources/assets/js/architect/architect.pageLayouts.js',
        'Resources/assets/js/architect/architect.menu.js',
        'Resources/assets/js/architect/architect.languages.js',
        'Resources/assets/js/architect/architect.translations.js'
    ], '../../public/modules/architect/js/admin.js');
// ---------------------------------------- //


if (mix.inProduction()) {
    mix.version();
}

