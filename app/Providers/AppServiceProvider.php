<?php

namespace App\Providers;

use App\Models\DistributorProduct;
use App\Models\ManifactureProduct;
use App\Observers\DistributorProductObserver;
use App\Observers\ManifactureProductObserver;
use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();
        ManifactureProduct::observe(ManifactureProductObserver::class);
        DistributorProduct::observe(DistributorProductObserver::class);

    }
}
