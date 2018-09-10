<?php

namespace App\Policies;

use App\User;
use App\Building;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuildingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list buildings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->can('read buildings');
    }

    /**
     * Determine whether the user can view the building.
     *
     * @param  \App\User  $user
     * @param  \App\Building  $building
     * @return mixed
     */
    public function view(User $user, Building $building)
    {
        //
    }

    /**
     * Determine whether the user can create buildings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the building.
     *
     * @param  \App\User  $user
     * @param  \App\Building  $building
     * @return mixed
     */
    public function update(User $user, Building $building)
    {
        //
    }

    /**
     * Determine whether the user can delete the building.
     *
     * @param  \App\User  $user
     * @param  \App\Building  $building
     * @return mixed
     */
    public function delete(User $user, Building $building)
    {
        //
    }

    /**
     * Determine whether the user can restore the building.
     *
     * @param  \App\User  $user
     * @param  \App\Building  $building
     * @return mixed
     */
    public function restore(User $user, Building $building)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the building.
     *
     * @param  \App\User  $user
     * @param  \App\Building  $building
     * @return mixed
     */
    public function forceDelete(User $user, Building $building)
    {
        //
    }
}
