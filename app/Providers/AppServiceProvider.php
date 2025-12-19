<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('frontend.layouts.app', function ($view) {
            $menuPages = \App\Models\Page::where('status', 'published')
                ->where('show_in_menu', true)
                ->orderBy('menu_order')
                ->get();

            $view->with('menuPages', $menuPages);
        });

    }
}
