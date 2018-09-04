<?php

namespace B2Systems\B2\Actions;

use B2Systems\B2\Resources\User;

trait ManagesUsers
{
    /**
     * Get the collection of users.
     *
     * @param  integer $organisationId
     * @return User[]
     */
    public function users($organisationId, array $options = [])
    {
        return $this->transformCollection(
            $this->get("organisations/$organisationId/users", $options['query'] ?? [])['data'],
            User::class,
            [],
            $options['query']['with'] ?? []
        );
    }

    /**
     * Get a user instance.
     *
     * @param  integer $userId
     * @param  integer $organisationId
     * @return User
     */
    public function user($organisationId, $userId, array $options = [])
    {
        return new User(
            $this->get("organisations/$organisationId/users/$userId", $options['query'] ?? [])['data'],
            $this,
            $options['query']['with'] ?? []
        );
    }

    /**
     * Create a new user.
     *
     * @param  integer $organisationId
     * @param  array $data
     * @param  boolean $wait
     * @return User
     */
    public function createUser($organisationId, array $data, array $options = [], $wait = true)
    {
        $user = $this->post("organisations/$organisationId/users", $data)['user'];
        if ($wait) {
            return $this->retry($this->getTimeout(), function () use ($organisationId, $user, $options) {
                return $this->user($organisationId, $user['id'], $options);
            });
        }
        return new User($user, $this, $options['query']['with'] ?? []);
    }

    /**
     * Delete the given user.
     *
     * @param  integer $organisationId
     * @param  integer $userId
     * @return void
     */
    public function deleteUser($userId)
    {
        $this->delete("users/$userId");
    }
}
