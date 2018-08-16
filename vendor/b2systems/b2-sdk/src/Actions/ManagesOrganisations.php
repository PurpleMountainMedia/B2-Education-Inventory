<?php

namespace B2Systems\B2\Actions;

use B2Systems\B2\Resources\Organisation;

trait ManagesOrganisations
{
    /**
     * Get the collection of organisations.
     *
     * @return Organisation[]
     */
    public function organisations($options = [])
    {
        return $this->transformCollection(
            $this->get("organisations", $options['query'] ?? [])['data'],
            Organisation::class,
            [],
            $options['query']['with'] ?? []
        );
    }

    /**
     * Get a organisation instance.
     *
     * @param  integer $organisationId
     * @return Organisation
     */
    public function organisation($organisationId, $options = [])
    {
        return new Organisation(
            $this->get("organisations/$organisationId", $options['query'] ?? [])['data'],
            $this,
            $options['query']['with'] ?? []
        );
    }

    /**
     * Create a new organisation.
     *
     * @param  integer $organisationId
     * @param  array $data
     * @param  boolean $wait
     * @return User
     */
    public function createOrganisation(array $data, array $options = [], $wait = true)
    {
        $organisation = $this->post("organisations", $data)['data'];
        if ($wait) {
            return $this->retry($this->getTimeout(), function () use ($organisation, $options) {
                return $this->organisation($organisation['id'], $options);
            });
        }
        return new Organisation($organisation, $this, $options['query']['with'] ?? []);
    }

    /**
     * Delete the given user.
     *
     * @param  integer $organisationId
     * @param  integer $userId
     * @return void
     */
    public function deleteOrganisation($organisationId)
    {
        $this->delete("organisations/$organisationId");
    }
}
