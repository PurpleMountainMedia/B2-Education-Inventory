<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Extensions\B2UserProvider;
use Laravel\Passport\Passport;
use App\Building;
use App\Policies\BuildingPolicy;
use App\Room;
use App\Policies\RoomPolicy;
use App\Item;
use App\Policies\ItemPolicy;
use App\Report;
use App\Policies\ReportPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Building::class => BuildingPolicy::class,
        Room::class => RoomPolicy::class,
        Item::class => ItemPolicy::class,
        Report::class => ReportPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Auth::provider('b2', function ($app, array $config) {
            return new B2UserProvider();
        });
    }
}
