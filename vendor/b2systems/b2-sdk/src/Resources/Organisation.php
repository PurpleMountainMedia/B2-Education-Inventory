<?php

namespace B2Systems\B2\Resources;

class Organisation extends Resource
{
    /**
     * The id of the organisation.
     *
     * @var integer
     */
    public $id;

    /**
     * The name of the organisation.
     *
     * @var string
     */
    public $name;

    /**
     * The type of the organisation.
     *
     * @var string
     */
    public $type;

    /**
     * The type of the organisation.
     *
     * @var array
     */
    public $schools;

    /**
     * The type of the organisation.
     *
     * @var array
     */
    public $users;

    /**
     * Delete the given user.
     *
     * @return void
     */
    public function delete()
    {
        $this->forge->deleteOrganisation($this->id);
    }

    public function schools($value)
    {
        return $this->b2->transformCollection($value['data'], School::class);
    }

    public function users($value)
    {
        return $this->b2->transformCollection($value['data'], User::class);
    }
}
