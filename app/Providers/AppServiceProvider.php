<?php

namespace App\Providers;

use App\Interfaces\PostQueries;
use App\Queries\CachedPostQueries;
use App\Queries\EloquentPostQueries;
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
        $this->app->bind(PostQueries::class, CachedPostQueries::class);

        $this->app->when(CachedPostQueries::class)
            ->needs(PostQueries::class)
            ->give(EloquentPostQueries::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
