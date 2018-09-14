<?php

namespace App\Traits;

trait CreatedByTrait
{
    /**
     * Return the user that created a specific resource
     *
     * @return App\App\User
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
