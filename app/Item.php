<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ResponsableTrait;

class Item extends Model
{
    use SoftDeletes, ResponsableTrait;

    /**
     * The attributes that should be mutated into dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'missing_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'room_id', 'make_id', 'item_type_id', 'name', 'description', 'serial_number', 'purchase_price',
      'purchase_date', 'meta', 'created_by', 'write_off', 'missing_at', 'bardcode'
    ];

    /**
      * The attributes that should be cast to native types.
      *
      * @var array
      */
    protected $casts = [
         'meta' => 'array',
    ];

    /**
     * The building that the item belongs to.
     *
     * @return collection
     */
    public function room()
    {
         return $this->belongsTo('App\Room');
    }

    /**
    * The make of the item.
    *
    * @return collection
    */
    public function make()
    {
        return $this->belongsTo('App\Make');
    }

    /**
    * The Item Type that the item belongs to.
    *
    * @return collection
    */
    public function itemCategory()
    {
        return $this->belongsTo('App\ItemCategory');
    }

    /**
     * Return the id of the school that this room is in.
     *
     * @return String
     */
    public function getSchoolIdAttribute()
    {
        return $this->room->school_id;
    }

    /**
     * Scope items by a school ID.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $schoolId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInSchool($query, $schoolId)
    {
        return $query->join('rooms', 'items.room_id', '=', 'rooms.id')
                     ->leftJoin('buildings', 'rooms.building_id', '=', 'buildings.id')
                     ->where('buildings.school_id', $schoolId)
                     ->select('items.*');
    }
}
