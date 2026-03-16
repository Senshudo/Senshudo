<?php

use App\Providers\AppServiceProvider;
use App\Providers\Filament\AdminPanelProvider;
use App\Providers\HorizonServiceProvider;
use Olssonm\VeryBasicAuth\VeryBasicAuthServiceProvider;

return [
    AppServiceProvider::class,
    AdminPanelProvider::class,
    HorizonServiceProvider::class,
    VeryBasicAuthServiceProvider::class,
];
