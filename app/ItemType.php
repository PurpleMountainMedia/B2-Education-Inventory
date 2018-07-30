<?php

namespace App;

class ItemType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['make_id', 'name', 'description', 'owned_by', 'created_by'];

    /**
    * The items that are a certain ItemType
    *
    * @return collection
    */
    public function items()
    {
        return $this->hasMany('App\Item');
    }

    /**
     * The make of the Item Type.
     *
     * @return collection
     */
    public function make()
    {
        return $this->belongsTo('App\Make');
    }
}
