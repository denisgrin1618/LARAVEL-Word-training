<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GoogleSheet;

class GoogleSheetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('googleSheet','App\Services\GoogleSheet');
        
//        $this->app->singleton(App\Services\GoogleSheet::class, function ($app) {
//            return new GoogleSheet();
//        });
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       
    }
}
