<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        View::composer('user.*', function ($view) {
            $activeStatus = function ($q) {
                $q->where('status', 1)
                    ->orWhere('status', '1')
                    ->orWhereRaw('LOWER(status) = ?', ['active']);
            };

            $navProductCategories = collect();

            if (Schema::hasTable('categories') && Schema::hasTable('subcategories')) {
                $navProductCategories = Category::query()
                    ->where($activeStatus)
                    ->with([
                        'subcategories' => function ($q) use ($activeStatus) {
                            $q->where($activeStatus)->orderBy('name');
                        },
                    ])
                    ->orderBy('name')
                    ->get(['id', 'name']);
            }

            $view->with('navProductCategories', $navProductCategories);
        });
    }
}
