<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ResponsableTrait;
use App\Traits\LinkableTrait;
use App\Traits\CreatedByTrait;
use App\Item;

class Report extends Model
{
    use SoftDeletes, ResponsableTrait, LinkableTrait, CreatedByTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'created_by', 'school_id', 'type', 'name', 'repeat_every',
        'notifications', 'data', 'created_at', 'updated_at'
    ];

    /**
      * The attributes that should be cast to native types.
      *
      * @var array
      */
    protected $casts = [
         'data' => 'collection',
    ];

    /**
     * Scope items by a school ID.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $schoolId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInSchool($query, $schoolId)
    {
        return $query->where('school_id', $schoolId);
    }

    public function getFormattedDataAttribute($data)
    {
        $formattedData = [];

        foreach ($this->data as $key => $d) {
            $formattedData[] = $d;
        }
        return collect($formattedData);
    }
}
