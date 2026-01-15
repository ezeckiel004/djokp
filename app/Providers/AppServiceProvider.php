<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Partager la locale avec toutes les vues
        view()->composer('*', function ($view) {
            $view->with('currentLocale', app()->getLocale());
        });
    }
}
