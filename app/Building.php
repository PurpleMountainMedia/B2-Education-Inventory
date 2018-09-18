<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\LinkableTrait;
use App\Traits\ResponsableTrait;
use App\Traits\CreatedByTrait;

class Building extends Model
{
    use SoftDeletes, LinkableTrait, ResponsableTrait, CreatedByTrait;

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
    protected $fillable = ['id', 'name', 'school_id', 'created_by', 'type', 'meta', 'created_at', 'updated_at'];

    /**
     * Which scopes to use for filter.
     *
     * @return array
     */
    private function responsableFilterScopeAlias()
    {
        return [
            'rooms_count.equals' => 'filterRoomsCountEquals',
            'rooms_count.not_equals' => 'filterRoomsCountNotEquals',
            'rooms_count.greater_than' => 'filterRoomsCountGreaterThan',
            'rooms_count.less_than' => 'filterRoomsCountLessThan',
        ];
    }

    public function responsableOrderByAlias()
    {
        return [
          'name' => 'name'
        ];
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

    /**
    * The items inside the rooms in this building.
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @param JSON $filter
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeFilterRoomsCountEquals($query, $filter)
    {
        return $query->has('rooms', '=', $filter->value)->with('rooms');
    }

    public function scopeFilterRoomsCountNotEquals($query, $filter)
    {
        return $query->has('rooms', '!=', $filter->value)->with('rooms');
    }

    public function scopeFilterRoomsCountGreaterThan($query, $filter)
    {
        return $query->has('rooms', '>', $filter->value)->with('rooms');
    }

    public function scopeFilterRoomsCountLessThan($query, $filter)
    {
        return $query->has('rooms', '<', $filter->value)->with('rooms');
    }
}
