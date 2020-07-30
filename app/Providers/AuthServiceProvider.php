<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Modules\Extranet\Extensions\VeosUserProvider;
use Modules\Extranet\Extensions\VeosUserTokenProvider;
use Modules\Extranet\Extensions\VeosUserLinkProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('veos-ws', function ($app, $name, array $config) {
            return new VeosUserProvider();
        });

        Auth::extend('veos-ws-token', function ($app, $name, array $config) {
            return new VeosUserTokenProvider();
        });

        Auth::extend('veos-user-link-provider', function ($app, $name, array $config) {
            return new VeosUserLinkProvider();
        });
    }
}
