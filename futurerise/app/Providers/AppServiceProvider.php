<?php

namespace App\Providers;

use App\Models\SiteLogo;
use App\Models\SiteBackground;
use Illuminate\Support\Facades\View;
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
    public function boot(): void
    {
        View::composer('*', static function ($view): void {
            $view->with('siteLogo', SiteLogo::latest()->first());
            $view->with('siteBackground', SiteBackground::latest()->first());
        });
    }
}
