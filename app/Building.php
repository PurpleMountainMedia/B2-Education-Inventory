<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\LinkableTrait;

class Building extends Model
{
    use SoftDeletes, LinkableTrait;

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
    protected $fillable = ['name', 'school_id', 'created_by', 'type', 'meta'];

    /**
    * Scope buildings by a school ID.
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @param string $schoolId
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeInSchool($query, $schoolId)
    {
        return $query->where('school_id', $schoolId);
    }

    /**
    * The rooms that are in a building.
    *
    * @return collection
    */
    public function rooms()
    {
        return $this->hasMany('App\Room');
    }

    /**
    * The items inside the rooms in this building.
    *
    * @return collection
    */
    public function items()
    {
        return $this->hasManyThrough('App\Item', 'App\Room');
    }
}
