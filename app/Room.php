<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated into dates.
     *
     * @var array
     */
     protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = ['building_id', 'name', 'created_by', 'type', 'meta'];

     /**
     * The building that the room belongs to.
     *
     * @return collection
     */
     public function building()
     {
         return $this->belongsTo('App\Building');
     }

     /**
     * The items that are inside the room.
     *
     * @return collection
     */
     public function items()
     {
         return $this->hasMany('App\Item');
     }
}
