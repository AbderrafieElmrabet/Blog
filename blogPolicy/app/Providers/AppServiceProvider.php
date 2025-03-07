<?php

namespace App\Providers;

use App\Models\Product;
use App\Policies\ArticlePolicy;
use App\Repositories\Repository;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Product::class => ArticlePolicy::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(ProductRepositoryInterface::class, Repository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Product::class, ArticlePolicy::class);
    }
}
