<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        Blade::directive('uang', function ($expression) {
            return "Rp. {{ number_format($expression,0,',','.'); }}";
        });
        Blade::directive('uangold', function ($expression) {
            return "Rp.  number_format($expression,0,',','.');";
        });

        Blade::directive('diskon', function ($expression) {
            return "{{ number_format($expression,0,',','.'); }} %";
        });

        Blade::directive('rating', function ($expression) {
            return "{{ number_format($expression,1,',','.'); }}";
        });

        Paginator::useBootstrap();
    }
}
