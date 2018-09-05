<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\LinkableTrait;
use App\Traits\ResponsableTrait;

class Room extends Model
{
    use SoftDeletes, ResponsableTrait;

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

    /**
     * Return the id of the school that this room is in.
     *
     * @return String
     */
    public function getSchoolIdAttribute()
    {
        return $this->building->school_id;
    }

    /**
     * Scope buildings by a school ID.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $schoolId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInSchool($query, $schoolId)
    {
        return $query->join('buildings', 'rooms.building_id', '=', 'buildings.id')
                     ->where('buildings.school_id', $schoolId)
                     ->select('rooms.*');
    }
}
