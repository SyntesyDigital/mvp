<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Config;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // load roles
        foreach(Config::get('roles') as $k => $v) {
            if(!defined($k)) {
                define($k, $v);
            }
        }

        if(request('cache-clear')) {
            Cache::flush();
        }

        if(config('app.env') == 'production') {
            \URL::forceScheme('https');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

      foreach (glob(app_path().'/Helpers/*.php') as $filename){
          require_once($filename);
      }

    }
}
