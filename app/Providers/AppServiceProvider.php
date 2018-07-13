<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('itemName', function ($upper) {
            return getTypeName('item', false, $upper);
        });

        Blade::directive('itemsName', function ($upper) {
            return getTypeName('item', true, $upper);
        });

        Blade::directive('itemTypeName', function ($upper) {
            return getTypeName('item-type', false, $upper);
        });

        Blade::directive('itemTypesName', function ($upper) {
            return getTypeName('item-type', true, $upper);
        });

        Blade::directive('roomName', function ($upper) {
            return getTypeName('room', false, $upper);
        });

        Blade::directive('roomsName', function ($upper) {
            return getTypeName('room', true, $upper);
        });

        Blade::directive('buildingName', function ($upper) {
            return getTypeName('building', false, $upper);
        });

        Blade::directive('buildingsName', function ($upper) {
            return getTypeName('building', true, $upper);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
