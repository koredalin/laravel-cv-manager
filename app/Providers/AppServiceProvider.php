<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UniversityService;
use App\Services\UserService;
use App\Services\SkillService;
use App\Services\CvService;

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

        $this->app->bind(CvService::class, function ($app) {
            return new CvService();
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
