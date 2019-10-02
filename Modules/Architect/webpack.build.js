let mix = require('laravel-mix');

exports.build = {
    run : function(){
        mix.webpackConfig({
            plugins: [
                new WebpackShellPlugin({
                    onBuildStart: [
                        'php artisan lang:js public/modules/architect/js/lang.dist.js -s Modules/Architect/Resources/lang',
                    ],
                    onBuildEnd: []
                })
            ]
        });

        mix.react('Modules/Architect/Resources/assets/js/app.js', 'modules/architect/js')
            .sass('Modules/Architect/Resources/assets/sass/architect/app.scss', 'modules/architect/css')
            .scripts([
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
            ], 'public/modules/rrhh/js/admin.js');
    },

    shell : {
        onBuildStart: [
            'php artisan lang:js public/modules/architect/js/lang.dist.js -s Modules/Architect/Resources/lang'
        ]
    },

    filesCopy: [],
}