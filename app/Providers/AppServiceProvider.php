<?php

namespace App\Providers;

use Carbon\Carbon;
/* use Illuminate\Support\Facades\URL; pour déploiement */
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Carbon::setLocale(config('app.locale'));
        Carbon::setLocale('fr');
        \Carbon\Carbon::setLocale('fr');
        /*         if(env('APP_ENV') !== 'local'){
            URL::forceScheme('https');
        } pour deploiement*/
    }
}
