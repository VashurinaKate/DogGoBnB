<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Responders\APIBaseResponder;
use App\Contracts\ResponseContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(ResponseContract::class, APIBaseResponder::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
