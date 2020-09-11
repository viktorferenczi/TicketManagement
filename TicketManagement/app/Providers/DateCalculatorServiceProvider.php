<?php

namespace App\Providers;

use App\Services\DueDate;
use Illuminate\Support\ServiceProvider;

class DateCalculatorServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\DateCalculatorInterface', function ($app) {
            return new DueDate();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


}
