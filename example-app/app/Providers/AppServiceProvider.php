<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // Schema::defaultStringLength();

        // if(config('app.debug')){

        //     DB::listen(fn($query)=> Log::info($query->sql, $query->bindings, $query->time));
        // }
    }
}
