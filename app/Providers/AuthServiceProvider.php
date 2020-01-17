<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\Auth;

use Modules\Extranet\Extensions\VeosUserProvider;
use Modules\Extranet\Extensions\VeosUserTokenProvider;

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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('veos-ws', function($app, $name, array $config) {
            return new VeosUserProvider();
        });

        Auth::extend('veos-ws-token', function($app, $name, array $config) {
            return new VeosUserTokenProvider();
        });
    }
}
