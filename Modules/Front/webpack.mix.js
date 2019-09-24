const mix = require('laravel-mix');
const CopyWebpackPlugin = require('copy-webpack-plugin');

require('laravel-mix-merge-manifest');
mix.setPublicPath('../../public').mergeManifest();

// ---------------------------------------- //
//      COMPILE ASSETS
// ---------------------------------------- //
mix
    .react('Resources/assets/js/app.js', 'modules/front/js')
    .sass('Resources/assets/sass/app.scss', 'modules/front/css');
// ---------------------------------------- //

if (mix.inProduction()) {
    mix.version();
}

