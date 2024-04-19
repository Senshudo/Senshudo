<?php

namespace App\Providers;

use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Configure the Horizon authorization services.
     *
     * @return void
     */
    protected function authorization()
    {
        $this->gate();

        Horizon::auth(function ($request) {
            return true;
        });
    }
}
