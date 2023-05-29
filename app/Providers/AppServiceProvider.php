<?php

namespace App\Providers;

use App\Models\Process;
use App\Models\User;
use App\Observers\ProcessObserver;
use App\Observers\UserObserver;
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
        Process::observe(ProcessObserver::class);

        User::observe(UserObserver::class);
    }
}
