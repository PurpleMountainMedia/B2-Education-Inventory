<?php

namespace App\Policies;

use App\User;
use App\Room;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list rooms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->can('read rooms');
    }

    /**
     * Determine whether the user can view the room.
     *
     * @param  \App\User  $user
     * @param  \App\Room  $room
     * @return mixed
     */
    public function view(User $user, Room $room)
    {
        //
    }

    /**
     * Determine whether the user can create rooms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the room.
     *
     * @param  \App\User  $user
     * @param  \App\Room  $room
     * @return mixed
     */
    public function update(User $user, Room $room)
    {
        //
    }

    /**
     * Determine whether the user can delete the room.
     *
     * @param  \App\User  $user
     * @param  \App\Room  $room
     * @return mixed
     */
    public function delete(User $user, Room $room)
    {
        //
    }

    /**
     * Determine whether the user can restore the room.
     *
     * @param  \App\User  $user
     * @param  \App\Room  $room
     * @return mixed
     */
    public function restore(User $user, Room $room)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the room.
     *
     * @param  \App\User  $user
     * @param  \App\Room  $room
     * @return mixed
     */
    public function forceDelete(User $user, Room $room)
    {
        //
    }
}
