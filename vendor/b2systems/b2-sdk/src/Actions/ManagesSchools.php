<?php

namespace B2Systems\B2\Actions;

use B2Systems\B2\Resources\School;

trait ManagesSchools
{
    /**
     * Get the collection of schools.
     *
     * @return School[]
     */
    public function schools($organisationId, array $options = [])
    {
        return $this->transformCollection(
            $this->get("organisations/$organisationId/schools", $options['query'] ?? [])['data'],
            School::class,
            [],
            $options['query']['with'] ?? []
        );
    }

    /**
     * Get a school instance.
     *
     * @param  integer $organisationId
     * @return Organisation
     */
    public function school($schoolId, array $options = [])
    {
        return new School(
            $this->get("schools/$schoolId", $options['query'] ?? [])['data'],
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
    public function createSchool(array $data, array $options = [], $wait = true)
    {
        $school = $this->post("schools", $data, $options['query'] ?? [])['data'];
        if ($wait) {
            return $this->retry($this->getTimeout(), function () use ($school, $options) {
                return $this->school($school['id'], $options);
            });
        }
        return new School($school, $this, $options['query']['with'] ?? []);
    }

    /**
     * Delete the given user.
     *
     * @param  integer $organisationId
     * @param  integer $userId
     * @return void
     */
    public function deleteSchool($schoolId)
    {
        $this->delete("schools/$schoolId");
    }
}
