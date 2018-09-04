<?php

namespace B2Systems\B2\Resources;

class School extends Resource
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
     * Delete the given user.
     *
     * @return void
     */
    public function delete()
    {
        $this->forge->deleteSchool($this->id);
    }
}
