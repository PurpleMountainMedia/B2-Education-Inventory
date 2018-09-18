<?php

namespace App;

use App\Traits\ResponsableTrait;

class ItemCategory extends Model
{
    use ResponsableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['make_id', 'name', 'description', 'school_id', 'created_by'];

    /**
    * The items that are a certain ItemCategory
    *
    * @return collection
    */
    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function responsableOrderByAlias()
    {
        return [
          'name' => 'name'
        ];
    }

    /**
     * The make of the item category.
     *
     * @return collection
     */
    public function make()
    {
        return $this->belongsTo('App\Make');
    }
}
