<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UniversityService;
use App\Services\UserService;
use App\Services\SkillService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UniversityService::class, function ($app) {
            return new UniversityService();
        });

        $this->app->bind(UserService::class, function ($app) {
            return new UserService();
        });

        $this->app->bind(SkillService::class, function ($app) {
            return new SkillService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
