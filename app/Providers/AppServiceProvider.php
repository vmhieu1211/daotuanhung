<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\SystemSetting;
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
        $shareSettings = SystemSetting::first(); // Get settings
        View::share('shareSettings', $shareSettings);
        $systemName = SystemSetting::first(); // Get settings
        View::share('systemName', $systemName);
    }
}
