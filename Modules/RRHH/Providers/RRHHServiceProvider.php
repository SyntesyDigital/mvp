<?php

namespace Modules\RRHH\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class RRHHServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('rrhh.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php',
            'rrhh'
        );

        $this->mergeConfigFrom(
            __DIR__.'/../Config/offers.php',
            'offers'
        );

        $this->mergeConfigFrom(
            __DIR__.'/../Config/customers.php',
            'customers'
        );

        $this->mergeConfigFrom(
            __DIR__.'/../Config/emails_templates.php',
            'emails_templates'
        );

        $this->mergeConfigFrom(
            __DIR__.'/../Config/users.php',
            'architect::settings.users'
        );

        $this->mergeConfigFrom(
            __DIR__.'/../Config/settings.php',
            'architect::plugins.settings'
        );

        $this->mergeConfigFrom(
            __DIR__.'/../Config/topbar_menu.php',
            'architect::plugins.topbar.menu'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/rrhh');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/rrhh';
        }, \Config::get('view.paths')), [$sourcePath]), 'rrhh');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/rrhh');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'rrhh');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'rrhh');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
