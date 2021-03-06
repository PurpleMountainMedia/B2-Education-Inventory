<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\LinkableTrait;
use App\Traits\ResponsableTrait;
use App\Traits\CreatedByTrait;

class Room extends Model
{
    use SoftDeletes, ResponsableTrait, LinkableTrait, CreatedByTrait;

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
    protected $fillable = ['id', 'building_id', 'name', 'created_by', 'type', 'meta', 'created_at', 'updated_at'];

    /**
     * Which scopes to use for filter.
     *
     * @return array
     */
    private function responsableFilterScopeAlias()
    {
        return [
            'items_count.equals' => 'filterItemsCountEquals',
            'items_count.not_equals' => 'filterItemsCountNotEquals',
            'items_count.greater_than' => 'filterItemsCountGreaterThan',
            'items_count.less_than' => 'filterItemsCountLessThan',
        ];
    }

    public function responsableOrderByAlias()
    {
        return [
          'name' => 'name'
        ];
    }

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

    public function scopeInBuilding($query, $buildingId)
    {
        if ($buildingId) {
            return $query->where('building_id', $buildingId);
        }

        return $query;
    }

    /**
    * The items inside the rooms in this building.
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @param JSON $filter
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeFilterItemsCountEquals($query, $filter)
    {
        return $query->has('items', '=', $filter->value)->with('items');
    }

    public function scopeFilterItemsCountNotEquals($query, $filter)
    {
        return $query->has('items', '!=', $filter->value)->with('items');
    }

    public function scopeFilterItemsCountGreaterThan($query, $filter)
    {
        return $query->has('items', '>', $filter->value)->with('items');
    }

    public function scopeFilterItemsCountLessThan($query, $filter)
    {
        return $query->has('items', '<', $filter->value)->with('items');
    }
}
