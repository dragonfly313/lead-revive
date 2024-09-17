<?php

namespace App\Providers;

use App\Models\MenuManage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\View;
use App\Models\PageManage;
use App\Models\SeoManage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::composer('layouts.guest', function ($view) {
            $view->with([
                'settings' => PageManage::get(),
                'menu' => MenuManage::get(),
                'seo' => SeoManage::where('page', 'home')->first(),
            ]);
        });
        View::composer('layouts.account', function ($view) {
            $view->with([
                'seo' => SeoManage::where('page', 'profile')->first(),
            ]);
        });
    }
}
