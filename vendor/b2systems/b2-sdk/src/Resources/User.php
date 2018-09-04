<?php

namespace B2Systems\B2\Resources;

class User extends Resource
{
    /**
     * The id of the user.
     *
     * @var integer
     */
    public $id;

    /**
     * The first name of the user.
     *
     * @var integer
     */
    public $firstName;

    /**
     * The last name of the user.
     *
     * @var integer
     */
    public $lastName;

    /**
     * The email of the user.
     *
     * @var integer
     */
    public $email;

    /**
     * The phone number of the user.
     *
     * @var integer
     */
    public $phone;


    /**
     * Delete the given user.
     *
     * @return void
     */
    public function delete()
    {
        $this->forge->deleteUser($this->id);
    }
}
