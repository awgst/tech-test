<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        if (env('APP_ENV') == 'production') {
            URL::forceScheme('https');
        }

        $this->app->bind(
            'App\Repositories\Student\StudentRepository',
            'App\Repositories\Student\EloquentStudentRepository'
        );
        $this->app->bind(
            'App\Repositories\Course\CourseRepository',
            'App\Repositories\Course\EloquentCourseRepository'
        );
        $this->app->bind(
            'App\Repositories\Assesment\AssesmentRepository',
            'App\Repositories\Assesment\EloquentAssesmentRepository'
        );
    }
}
