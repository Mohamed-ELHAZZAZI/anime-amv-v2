<?php

namespace App\Providers;

use App\Models\AmvReaction;
use App\Observers\AmvReactionObserver;
use Illuminate\Support\ServiceProvider;

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
        AmvReaction::observe(AmvReactionObserver::class);
    }
}
