<?php

namespace App\Providers;

use App\Helpers\TimeslotFunctions;
use Illuminate\Support\ServiceProvider;

class HelperFunctions extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('parseDay', function () {
            return new TimeslotFunctions();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
