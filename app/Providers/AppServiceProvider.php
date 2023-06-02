<?php

namespace App\Providers;

use App\Models\typeProduct;
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
        view()->composer('header', function ($view) {
            $loai_sp = typeProduct::all();
            $view->compact('loai_sp', $loai_sp);
        });
        view()->composer('page.product_type', function ($view) {
            $product_new = typeProduct::where('new', 1)->orderBy('id', 'DESC')->skip(1)->take(8)->get();
            $view->with('product_new', $product_new);
        });
    }
}
