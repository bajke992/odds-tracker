<?php

namespace App\Providers;

use App\Models\League;
use App\Models\Match;
use App\Repositories\EloquentLeagueRepository;
use App\Repositories\EloquentMatchRepository;
use App\Repositories\LeagueRepositoryInterface;
use App\Repositories\MatchRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(LeagueRepositoryInterface::class, function (Application $app){
            return new EloquentLeagueRepository(new League);
        });
        $this->app->bind(MatchRepositoryInterface::class, function (Application $app){
            return new EloquentMatchRepository(new Match);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
