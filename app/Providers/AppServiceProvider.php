<?php

namespace App\Providers;

use App\Interfaces\Repository\CategoryRepository;
use App\Interfaces\Repository\SubCategoryRepository;
use App\Interfaces\Service\CategoryService;
use App\Interfaces\Service\SubCategoryService;
use App\Repositories\CategoryRepositoryImpl;
use App\Repositories\SubCategoryRepositoryImpl;
use App\Services\CategoryServiceImpl;
use App\Services\SubCategoryServiceImpl;
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
        $this->app->bind(CategoryRepository::class, CategoryRepositoryImpl::class);
        $this->app->bind(CategoryService::class, CategoryServiceImpl::class);

        $this->app->bind(SubCategoryRepository::class, SubCategoryRepositoryImpl::class);
        $this->app->bind(SubCategoryService::class, SubCategoryServiceImpl::class);
    }
}
