<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Item;
use App\Observers\ItemObserver;
use B2Systems\B2\B2;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Item::observe(ItemObserver::class);

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

        Blade::directive('reportName', function ($upper) {
            return getTypeName('report', false, $upper);
        });

        Blade::directive('reportsName', function ($upper) {
            return getTypeName('report', true, $upper);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(B2::class, function ($app) {
            return new B2(
                Auth::user()->token
            );
        });
    }
}
